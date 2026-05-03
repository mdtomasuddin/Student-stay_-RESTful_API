<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\RoomListing;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    private const UK_MOBILE_REGEX = '/^(?:\\+44|0)7\\d{9}$/';

    /**
     * Handles a user's chat message and responds with a relevant AI reply.
     * The AI is succinct and provides just enough information to be useful: it will generally only generate a single function or a couple lines of code to fulfill the *instruction. If the AI does not know how to follow the instruction, the ASSISTANT should not reply at all.
     */
    public function chat(Request $request)
    {
        $userInput = $request->input('message');
        $ipAddress = $request->ip();

        // Fetch or Create Lead Context
        $lead = Lead::firstOrCreate(['ip_address' => $ipAddress]);
        $history = is_array($lead->conversations) ? $lead->conversations : [];

        // Pre-build user profile string to pass to AI
        $knownDetails = array_filter([
            $lead->name ? "Name: {$lead->name}" : null,
            $lead->email ? "Email: {$lead->email}" : null,
            $lead->phone ? "Phone: {$lead->phone}" : null,
        ]);
        $contextStr = implode(', ', $knownDetails);

        // Pro-level System Prompt
        $systemPrompt = <<<PROMPT
            You are 'AchGoldEstates' AI Assistant.
            Goal: Capture Lead -> Ask Search Filters -> Show Rooms.

            USER CONTEXT: $contextStr

            STRICT FLOW:
            1. If Name/Email/Phone is missing in 'USER CONTEXT', ask for them first.
            2. Once contact info is secured, ask these AchGoldEstates accoumdation:
               - "Which University are you studying at?"
               - "What is your preferred Room Type? (Studio, Ensuite, Non-Ensuite, Shared)"
               - "What is your weekly budget (Min to Max)?"
               - "When is your Move-in date?"

            RESPONSE FORMAT (Strict JSON):
            {
                "message": "Conversational reply",
                "options": ["Option1", "Option2"],
                "lead_data": {"name": "...", "email": "...", "phone": "..."},
                "search_params": {
                    "university": "university name",
                    "room_type": "type name",
                    "min_price": 0,
                    "max_price": 0,
                    "move_in_date": "YYYY-MM-DD"
                },
                "should_search_db": true/false
            }
            NOTE: Set should_search_db to true only if you have at least the University name.
        PROMPT;

        // Prepare AI Message History (Last 10 messages for context)
        $messages = [['role' => 'system', 'content' => $systemPrompt]];
        foreach (array_slice($history, -10) as $chat) {
            $messages[] = ['role' => 'user', 'content' => $chat['user']];
            $messages[] = ['role' => 'assistant', 'content' => $chat['ai']];
        }
        $messages[] = ['role' => 'user', 'content' => $userInput];

        // 4. OpenAI API Call
        try {
            $openaiResponse = Http::timeout(25)->withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4o',
                'messages' => $messages,
                'response_format' => ['type' => 'json_object'],
            ]);

            if ($openaiResponse->failed()) {
                throw new Exception('OpenAI API error: ' . $openaiResponse->body());
            }

            $jsonContent = $openaiResponse->json()['choices'][0]['message']['content'];
            $data = json_decode($jsonContent, true);
        } catch (Exception $e) {
            return response()->json([
                'reply' => 'I am currently having trouble processing your request. Please try again in a moment.',
                'status' => 'error',
            ], 500);
        }

        // Update Lead info (Only if new data is provided)
        $incomingPhone = $data['lead_data']['phone'] ?? null;
        if (is_string($incomingPhone)) {
            $normalizedPhone = preg_replace('/\\s+/', '', trim($incomingPhone));
            $incomingPhone = preg_match(self::UK_MOBILE_REGEX, $normalizedPhone) ? $normalizedPhone : $lead->phone;
        } else {
            $incomingPhone = $lead->phone;
        }

        $lead->update([
            'name' => $data['lead_data']['name'] ?? $lead->name,
            'email' => $data['lead_data']['email'] ?? $lead->email,
            'phone' => $incomingPhone,
        ]);

        // DB Search Logic
        $roomListings = [];
        $aiReply = $data['message'];
        $aiOptions = $data['options'] ?? [];

        if ($data['should_search_db']) {
            $filters = $data['search_params'];

            // Reusable query for both main search and fallback
            $baseQuery = RoomListing::with(['property.city', 'property.universities'])
                ->where('is_available', true);

            $query = clone $baseQuery;

            // Apply Filters
            if (! empty($filters['university'])) {
                $query->whereHas('property.universities', function ($q) use ($filters) {
                    $q->where('name', 'like', '%' . $filters['university'] . '%');
                });
            }

            if (! empty($filters['room_type'])) {
                $query->where('room_type', 'like', '%' . $filters['room_type'] . '%');
            }

            if ($filters['min_price'] > 0) {
                $query->where('price_per_week', '>=', (float) $filters['min_price']);
            }
            if ($filters['max_price'] > 0) {
                $query->where('price_per_week', '<=', (float) $filters['max_price']);
            }
            if (! empty($filters['move_in_date'])) {
                $query->where('move_in_date', '>=', $filters['move_in_date']);
            }

            $roomListings = $query->latest()->limit(5)->get();

            // Intelligent Fallback (If no match found)
            if ($roomListings->isEmpty() && ! empty($filters['university'])) {
                // Broad search near the same University ignoring budget/type
                $fallbackResults = (clone $baseQuery)->whereHas('property.universities', function ($q) use ($filters) {
                    $q->where('name', 'like', '%' . $filters['university'] . '%');
                })->latest()->limit(5)->get();

                if ($fallbackResults->isNotEmpty()) {
                    $roomListings = $fallbackResults;
                    $aiReply = "No Available Rooms found for your budget or room type, but I found these great options near " . $filters['university'] . '. Should we try a nearby University ?';
                } else {
                    $aiReply = "Rooms currently not available near " . $filters['university'] . '. Should we try a nearby University?';
                }
            }
        }

        // Save Conversation History & Return
        $history[] = ['user' => $userInput, 'ai' => $aiReply, 'options' => $aiOptions ?: [], 'rooms' => $roomListings ?: []];
        $lead->update(['conversations' => $history]);

        return response()->json([
            'status' => 'success',
            'reply' => $aiReply,
            'options' => $aiOptions ?: [],
            'rooms' => $roomListings ?: [],
        ]);
    }
}
