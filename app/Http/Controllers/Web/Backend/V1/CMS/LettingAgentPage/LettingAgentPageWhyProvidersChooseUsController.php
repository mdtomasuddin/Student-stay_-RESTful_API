<?php

namespace App\Http\Controllers\Web\Backend\V1\CMS\LettingAgentPage;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;
use Illuminate\Http\Request;

class LettingAgentPageWhyProvidersChooseUsController extends Controller
{
    public function index()
    {
        $data = CMS::firstOrCreate(
            ['page' => 'lettingAgentPage', 'section' => 'whyProvidersChooseUs']);
        return view('backend.layouts.cms.lettingAgentPage.whyProvidersChooseUs', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'extra' => 'nullable|array',
            'extra.*.title' => 'required|string|max:255',
            'extra.*.description' => 'nullable|string',
        ]);

        try {
            $data = CMS::where('page', 'lettingAgentPage')->where('section', 'whyProvidersChooseUs')->firstOrFail();
            $data->title = $request->title;

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

            return redirect()->back()->with('t-success', 'Why Providers Choose Us section updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong!');
        }
    }
}
