<?php

namespace App\Http\Controllers\Web\Backend\V1\CMS\StudentBlog;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use Exception;
use Illuminate\Http\Request;

class StudentBlogHeroBannerController extends Controller
{
    /**
     * It will accept the $data as the first parameter.
     * The $data should contain the following keys: page, section, title, image, sub_title.
     */
    public function index()
    {
        $data = CMS::firstOrCreate(
            ['page' => 'studentBlog', 'section' => 'hero'],
            ['title' => null, 'image' => null, 'sub_title' => null]
        );
        return view('backend.layouts.cms.studentBlog.hero', compact('data'));
    }


    /**
     * Store a newly created or updated resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'nullable|string|max:255',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:30720',
            'sub_title' => 'nullable|string|max:200',
            'description' => 'nullable|string|max:500',
        ]);

        try {
            $data = CMS::where('page', 'studentBlog')->where('section', 'hero')->firstOrFail();
            if ($request->hasFile('image')) {
                if (! empty($data->image)) {
                    $path = ltrim(parse_url($data->image, PHP_URL_PATH), '/');
                    Helper::fileDelete(public_path($path)); // Delete the old image
                }
                // Upload the new image
                $newImagePath = Helper::fileUpload($request->file('image'), 'StudentBlog/HeroBannerImages');
                $data->image  = $newImagePath;
            }

            $data->title     = $request->title;
            $data->sub_title = $request->sub_title;
            $data->description = $request->description;
            $data->save();

            return redirect()->back()->with('t-success', 'Hero section updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->with('t-error', 'Something went wrong!');
        }
    }
}
