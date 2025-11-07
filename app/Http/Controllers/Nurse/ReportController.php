<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit;

class ReportController extends Controller
{
    //
    public function index() {
        // Example dynamic data
        $totalVisitsToday = Visit::whereDate('created_at', now())->count();
        $emergencyVisits = Visit::where('emergency', true)->count();
        $pendingReferrals = Visit::where('status', 'referred')->count();
        $completedVisits = Visit::where('status', 'completed')->count();

        $visitsTrend = Visit::selectRaw('DATE(created_at) as date, COUNT(*) as count')
                            ->where('created_at', '>=', now()->subDays(5))
                            ->groupBy('date')
                            ->pluck('count', 'date')
                            ->toArray(); 

        $mostCommonReasons = Visit::selectRaw('reason, COUNT(*) as count')
                                ->groupBy('reason')
                                ->orderByDesc('count')
                                ->take(5)
                                ->pluck('count', 'reason')
                                ->toArray(); 

        $recentVisits = Visit::whereDate('created_at', now())
                     ->latest()
                     ->get();

        return view('nurse_pages.report_pages.index', compact(
            'totalVisitsToday',
            'emergencyVisits',
            'pendingReferrals',
            'completedVisits',
            'visitsTrend',
            'mostCommonReasons',
            'recentVisits'
        ));
    }

}
