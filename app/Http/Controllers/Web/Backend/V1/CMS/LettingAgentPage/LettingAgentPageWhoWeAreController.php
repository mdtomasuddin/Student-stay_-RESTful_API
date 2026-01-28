<?php

namespace App\Http\Controllers\Web\Backend\V1\CMS\LettingAgentPage;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;
use Illuminate\Http\Request;

class LettingAgentPageWhoWeAreController extends Controller
{
    public function index()
    {
        $data = CMS::firstOrCreate(
            ['page' => 'lettingAgentPage', 'section' => 'whoWeAre']
        );
        return view('backend.layouts.cms.lettingAgentPage.whoWeAre', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'extra' => 'nullable|array',
            'extra.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            'extra.*.title' => 'required|string|max:255',
            'extra.*.description' => 'nullable|string'
        ]);

        try {
            $data = CMS::where('page', 'lettingAgentPage')->where('section', 'whoWeAre')->firstOrFail();

            $data->title = $request->title;
            $data->description = $request->description;

            $cards = [];
            if ($request->has('extra') && is_array($request->extra)) {
                foreach ($request->extra as $key => $card) {
                    $imagePath = $card['image_path'] ?? null;

                    if ($request->hasFile("extra.$key.image")) {
                        $imagePath = Helper::fileUpload($request->file("extra.$key.image"), 'lettingAgentPage/whoWeAreCards');
                    }

                    $cards[] = [
                        'image' => $imagePath,
                        'title' => $card['title'],
                        'description' => $card['description'] ?? null,
                    ];
                }
            }

            $data->cards = $cards;
            $data->save();

            return redirect()->back()->with('t-success', 'Who We Are section updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
