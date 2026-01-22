<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dashboard page.
     *
     * @return View
     */
    public function index(): View
    {
        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        // Initialize arrays for 12 months
        $userData = array_fill(0, 12, 0);

        // Get user data by month
        $users = User::selectRaw('MONTH(created_at) as month, COUNT(id) as total')
            ->whereYear('created_at', date('Y'))->groupByRaw('MONTH(created_at)')->get();

        foreach ($users as $user) {
            if ($user->month) {
                $userData[$user->month - 1] = (float) $user->total;
            }
        }

        return view('backend.layouts.dashboard.index', [
            'labels'   => array_values($months),
            'userData' => array_values($userData),
        ]);
    }
}
