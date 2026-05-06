<?php
namespace App\Http\Controllers\Web\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Models\SeoMeta;
use Exception;
use Illuminate\Http\Request;

class SeoMetaController extends Controller
{
    /**
     * Display SEO Meta settings for homepage.
     */
    public function homepage()
    {
        $seoMeta = SeoMeta::where('page', 'homepage')->first();
        return view('backend.layouts.settings.seo_meta_homepage', compact('seoMeta'));
    }

    /**
     * Display SEO Meta settings for accommodation.
     */
    public function accommodation()
    {
        $seoMeta = SeoMeta::where('page', 'accommodation')->first();
        return view('backend.layouts.settings.seo_meta_accommodation', compact('seoMeta'));
    }

    /**
     * Display SEO Meta settings for student resources.
     */
    public function studentResources()
    {
        $seoMeta = SeoMeta::where('page', 'student_resources')->first();
        return view('backend.layouts.settings.seo_meta_student_resources', compact('seoMeta'));
    }

    /**
     * Display SEO Meta settings for blogs.
     */
    public function blogs()
    {
        $seoMeta = SeoMeta::where('page', 'blogs')->first();
        return view('backend.layouts.settings.seo_meta_blogs', compact('seoMeta'));
    }

    /**
     * Update or create SEO Meta for a specific page.
     */
    public function update(Request $request)
    {
        $request->validate([
            'page'        => ['required', 'string', 'in:homepage,accommodation,student_resources,blogs,letting_agents'],
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:500'],
            'keywords'    => ['required', 'string'],
        ]);

        try {
            $keywords = array_filter(
                array_map('trim', explode(',', $request->keywords)),
                fn($keyword) => ! empty($keyword)
            );

            SeoMeta::updateOrCreate(
                ['page' => $request->page],
                [
                    'title'       => $request->title,
                    'description' => $request->description,
                    'keywords'    => $keywords,
                ]
            );

            return back()->with('t-success', 'SEO Meta updated successfully');
        } catch (Exception $e) {
            return back()->with('t-error', 'Failed to update SEO Meta: ' . $e->getMessage());
        }
    }
}
