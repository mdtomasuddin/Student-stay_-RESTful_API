<?php

namespace App\Http\Controllers\Web\Backend\V1\CMS\HomePage;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;
use Illuminate\Http\Request;

class HeroBannerCardController extends Controller
{
    public function index()
    {
        $defaultCards = [
            [
                'title' => '100% Verified',
                'description' => 'Every listing is personally verified',
                'image' => null,
            ],
            [
                'title' => 'Price Match',
                'description' => 'We guarantee the best prices',
                'image' => null,
            ],
            [
                'title' => 'Quality Assured',
                'description' => 'High standards, every property',
                'image' => null,
            ],
            [
                'title' => '24/7 Support',
                'description' => 'Always here to help you',
                'image' => null,
            ],
        ];

        $data = CMS::firstOrCreate(
            ['page' => 'homePage', 'section' => 'heroBannerCard'],
            [
                'cards' => $defaultCards,
            ]
        );

        return view('backend.layouts.cms.homePage.heroBannerCard', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'cards' => 'required|array|size:4',
            'cards.*.title' => 'required|string|max:255',
            'cards.*.description' => 'nullable|string',
            'cards.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        try {
            $data = CMS::where('page', 'homePage')->where('section', 'heroBannerCard')->firstOrFail();

            $existingCards = $data->cards ?? [];
            $newCards = [];

            foreach ($request->cards as $index => $cardData) {
                $imagePath = $existingCards[$index]['image'] ?? null;

                if ($request->hasFile("cards.$index.image")) {
                    // Delete old image if exists
                    if ($imagePath) {
                        $fullPath = public_path(ltrim(parse_url($imagePath, PHP_URL_PATH), '/'));
                        Helper::fileDelete($fullPath);
                    }
                    // Upload new image
                    $imagePath = Helper::fileUpload($request->file("cards.$index.image"), 'HomePage/HeroBannerCard');
                }

                $newCards[] = [
                    'title' => $cardData['title'],
                    'description' => $cardData['description'] ?? null,
                    'image' => $imagePath,
                ];
            }

            $data->cards = $newCards;
            $data->save();

            return redirect()->back()->with('t-success', 'Hero Banner Cards updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong! ' . $e->getMessage());
        }
    }
}
