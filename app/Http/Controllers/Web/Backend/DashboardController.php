<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Blog;
use App\Models\Property;
use App\Models\PropertyEnquirie;
use App\Models\StudentEnquirie;
use App\Models\University;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function index(): View
    {
        $total_properties = Property::count();
        $total_agents = Agent::count();
        $total_universities = University::count();
        $total_blogs = Blog::count();
        $property_enquiries_count = PropertyEnquirie::count();
        $student_enquiries_count = StudentEnquirie::count();
        $monthly_registrations = User::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();

        // Recent 3 Properties with User, Category and City
        $recent_properties = Property::with(['user', 'category', 'city'])->latest()->take(3)->get();

        // Calculate Real Growth % (This Month vs Last Month)
        $growthCalc = function ($modelName) {
            $thisMonth = $modelName::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();
            $lastMonth = $modelName::whereMonth('created_at', now()->subMonth()->month)->whereYear('created_at', now()->subMonth()->year)->count();

            if ($lastMonth == 0) {
                return $thisMonth > 0 ? 100 : 0;
            }

            return round((($thisMonth - $lastMonth) / $lastMonth) * 100, 1);
        };

        $prop_growth_pct = $growthCalc(Property::class);
        $agent_growth_pct_stat = $growthCalc(Agent::class);
        $univ_growth_pct = $growthCalc(University::class);
        $blog_growth_pct = $growthCalc(Blog::class);

        // Property & Agent Growth Data (Last 6 Months)
        $months = [];
        $property_growth = [];
        $agent_growth = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M');

            $property_growth[] = Property::whereMonth('created_at', $date->month)->whereYear('created_at', $date->year)->count();
            $agent_growth[] = Agent::whereMonth('created_at', $date->month)->whereYear('created_at', $date->year)->count();
        }

        return view('backend.layouts.dashboard.index', compact(
            'total_properties',
            'total_agents',
            'total_universities',
            'total_blogs',
            'property_enquiries_count',
            'student_enquiries_count',
            'monthly_registrations',
            'months',
            'property_growth',
            'agent_growth',
            'recent_properties',
            'prop_growth_pct',
            'agent_growth_pct_stat',
            'univ_growth_pct',
            'blog_growth_pct'
        ));
    }
}
