<?php

namespace App\Http\Controllers\Web\Backend\V1\CMS\HomePage;

use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;
use Illuminate\Http\Request;

class HowItWorksController extends Controller
{
    public function index()
    {
        $defaultCards = [
            [
                'title' => 'Search & Select',
                'description' => 'Browse our premium home and find the perfect room for your needs.',
            ],
            [
                'title' => 'Book & Pay',
                'description' => 'Complete your booking with our secure payment system.',
            ],
            [
                'title' => 'Your booking is done',
                'description' => 'Now you can relax, pack your bags, and begin your new journey.',
            ],
        ];

        $data = CMS::firstOrCreate(
            ['page' => 'homePage', 'section' => 'howItWorks'],
            [
                'title' => 'How It Works',
                'description' => 'Renting a Accommodation has never been easier. Follow these simple steps to get on the road.',
                'cards' => $defaultCards,
            ]
        );

        return view('backend.layouts.cms.homePage.howItWorks', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'extra' => 'required|array|size:3',
            'extra.*.title' => 'required|string|max:255',
            'extra.*.description' => 'nullable|string',
        ]);

        try {
            $data = CMS::where('page', 'homePage')->where('section', 'howItWorks')->firstOrFail();

            $data->title = $request->title;
            $data->description = $request->description;

            $cards = [];
            foreach ($request->extra as $card) {
                $cards[] = [
                    'title' => $card['title'],
                    'description' => $card['description'] ?? null,
                ];
            }

            $data->cards = $cards;
            $data->save();

            return redirect()->back()->with('t-success', 'How It Works section updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong!');
        }
    }
}
