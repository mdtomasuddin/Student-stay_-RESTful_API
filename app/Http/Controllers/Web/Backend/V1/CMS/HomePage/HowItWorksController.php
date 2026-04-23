<?php

namespace App\Http\Controllers\Web\Backend\V1\CMS\HomePage;

use App\Helpers\Helper;
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
                'image' => null,
            ],
            [
                'title' => 'Book & Pay',
                'description' => 'Complete your booking with our secure payment system.',
                'image' => null,
            ],
            [
                'title' => 'Your booking is done',
                'description' => 'Now you can relax, pack your bags, and begin your new journey.',
                'image' => null,
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
            'extra.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        try {
            $data = CMS::where('page', 'homePage')->where('section', 'howItWorks')->firstOrFail();

            $data->title = $request->title;
            $data->description = $request->description;

            $existingCards = $data->cards ?? [];
            $cards = [];
            foreach ($request->extra as $index => $card) {
                $imagePath = $existingCards[$index]['image'] ?? null;

                if ($request->hasFile("extra.$index.image")) {
                    // Delete old image if exists
                    if ($imagePath) {
                        $fullPath = public_path(ltrim(parse_url($imagePath, PHP_URL_PATH), '/'));
                        Helper::fileDelete($fullPath);
                    }
                    // Upload new image
                    $imagePath = Helper::fileUpload($request->file("extra.$index.image"), 'HomePage/HowItWorks');
                }

                $cards[] = [
                    'title' => $card['title'],
                    'description' => $card['description'] ?? null,
                    'image' => $imagePath,
                ];
            }

            $data->cards = $cards;
            $data->save();

            return redirect()->back()->with('t-success', 'How It Works section updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong! ' . $e->getMessage());
        }
    }
}
