<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visit;

class ReportController extends Controller
{
    //
public function index(Request $request) {
    // Summary Cards
    $totalVisitsToday = Visit::whereDate('created_at', now())->count();
    $emergencyVisits = Visit::where('emergency', true)->count();
    $pendingReferrals = Visit::where('status', 'referred')->count();
    $completedVisits = Visit::where('status', 'completed')->count();

    // Charts
    $visitsTrend = Visit::selectRaw('DATE(visited_at) as date, COUNT(*) as count')
                        ->where('visited_at', '>=', now()->subDays(5))
                        ->groupBy('date')
                        ->pluck('count', 'date')
                        ->toArray(); 

    $mostCommonReasons = Visit::selectRaw('reason, COUNT(*) as count')
                            ->groupBy('reason')
                            ->orderByDesc('count')
                            ->take(5)
                            ->pluck('count', 'reason')
                            ->toArray(); 

    // Recent Visits with filter/search
    $recentVisitsQuery = Visit::query();

    // Filter by search
    if ($request->filled('search')) {
        $search = $request->search;
        $recentVisitsQuery->whereHas('student', function ($q) use ($search) {
            $q->where('first_name', 'like', "%$search%")
              ->orWhere('last_name', 'like', "%$search%")
              ->orWhere('student_number', 'like', "%$search%");
        })
        ->orWhere('reason', 'like', "%$search%")
        ->orWhere('status', 'like', "%$search%");
    }

    // Optional: Filter by status
    if ($request->filled('status')) {
        $recentVisitsQuery->where('status', $request->status);
    }

    // Optional: Filter by date
    if ($request->filled('date')) {
        $recentVisitsQuery->whereDate('created_at', $request->date);
    }

    $recentVisits = $recentVisitsQuery->latest()->paginate(5)->withQueryString();

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
