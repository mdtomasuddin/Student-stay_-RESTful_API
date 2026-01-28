<?php

namespace App\Http\Controllers\Web\Backend\V1\CMS\LettingAgentPage;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;
use Illuminate\Http\Request;

class LettingAgentPageGenerateDemandController extends Controller
{
    public function index()
    {
        $data = CMS::firstOrCreate(
            ['page' => 'lettingAgentPage', 'section' => 'generateDemand']
        );
        return view('backend.layouts.cms.lettingAgentPage.generateDemand', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'extra' => 'nullable|array',
            'extra.*.title' => 'required|string|max:255',
            'extra.*.description' => 'nullable|string',
        ]);

        try {
            $data = CMS::where('page', 'lettingAgentPage')->where('section', 'generateDemand')->firstOrFail();
            $data->title = $request->title;
            $data->description = $request->description;

            $cards = [];
            if ($request->has('extra') && is_array($request->extra)) {
                foreach ($request->extra as $card) {
                    $cards[] = [
                        'title' => $card['title'],
                        'description' => $card['description'] ?? null,
                    ];
                }
            }
            $data->cards = count($cards) > 0 ? $cards : null;
            $data->save();

            return redirect()->back()->with('t-success', 'Generate Demand section updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong!');
        }
    }
}
