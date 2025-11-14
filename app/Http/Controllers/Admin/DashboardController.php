<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Visit;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\DB;
use App\Models\Form;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
public function index()
{

    // ===== Detect DB Driver for Month Query =====
    $driver = DB::getDriverName();
    if ($driver === 'sqlite') {
        $visitsPerMonth = Visit::selectRaw("CAST(strftime('%m', visited_at) AS INTEGER) as month, count(*) as total")
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();
    } else {
        $visitsPerMonth = Visit::selectRaw('MONTH(visited_at) as month, count(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();
    }

    // Ensure 12 months (even if no data)
    $visitsPerMonthFull = [];
    for ($i = 1; $i <= 12; $i++) {
        $visitsPerMonthFull[$i] = $visitsPerMonth[$i] ?? 0;
    }

    // ===== SYSTEM USAGE =====
    $totalStudents = Student::count();
    $totalVisits = Visit::count();
    $totalNurses = User::where('role', 'nurse')->count();
    $totalUsers = User::count();
    $totalEmergencyVisits = Visit::where('emergency', true)->count();
    $visitsToday = Visit::whereDate('visited_at', now())->count();

    $cards = [
        ['bg' => 'primary', 'icon' => '👩‍🎓', 'title' => 'Total Students', 'value' => $totalStudents],
        ['bg' => 'success', 'icon' => '💉', 'title' => 'Total Visits Recorded', 'value' => $totalVisits],
        ['bg' => 'info', 'icon' => '👩‍⚕️', 'title' => 'Total Nurses', 'value' => $totalNurses],
        ['bg' => 'secondary', 'icon' => '🧑‍💻', 'title' => 'System Users', 'value' => $totalUsers],
        ['bg' => 'danger', 'icon' => '⚠️', 'title' => 'Emergency Visits', 'value' => $totalEmergencyVisits],
        ['bg' => 'warning text-dark', 'icon' => '📅', 'title' => 'Visits Today', 'value' => $visitsToday],
    ];

    // ===== Health Patterns =====
    $topReasons = Visit::select('reason')
        ->selectRaw('count(*) as total')
        ->groupBy('reason')
        ->orderByDesc('total')
        ->limit(5)
        ->get()
        ->pluck('reason')
        ->toArray();

    $mostVisitedStudents = Student::withCount('visits')
        ->orderByDesc('visits_count')
        ->limit(3)
        ->get()
        ->map(fn($s) => $s->first_name . ' ' . $s->last_name . ' (' . $s->visits_count . ' visits)');

    $avgVisitsPerMonth = Visit::count() > 0
        ? round(Visit::count() / 12)
        : 0;

    $mostActiveNurse = User::where('role', 'nurse')
        ->withCount('visits')
        ->orderByDesc('visits_count')
        ->first();

    $healthPatterns = [
        ['title' => 'Top 5 Visit Reasons', 'value' => implode(', ', $topReasons)],
        ['title' => 'Most Visited Students', 'value' => $mostVisitedStudents->implode(', ')],
        ['title' => 'Average Visits per Month', 'value' => $avgVisitsPerMonth . ' visits/month'],
        ['title' => 'Most Active Nurse', 'value' => $mostActiveNurse ? $mostActiveNurse->name . ' — ' . $mostActiveNurse->visits_count . ' visits handled' : 'N/A'],
    ];

    // ===== Common Visit Reasons =====
    $visitReasonsRaw = Visit::selectRaw('reason, count(*) as total')
        ->groupBy('reason')
        ->pluck('total', 'reason')
        ->toArray();
    $visitReasonsLabels = array_keys($visitReasonsRaw);
    $visitReasonsValues = array_values($visitReasonsRaw);

    // ===== Emergency vs Non-Emergency =====
    $emergencyData = [
        'Emergency' => Visit::where('emergency', true)->count(),
        'Non-Emergency' => Visit::where('emergency', false)->count(),
    ];

    // ===== Staff Activity =====
    $staffActivity = ActivityLog::with('user')
        ->latest()
        ->paginate(5);

    $staffActivity->getCollection()->transform(fn($log) => [
        'user' => $log->user?->name ?? 'Unknown',
        'action' => $log->action,
        'role' => $log->user?->role ?? 'N/A',
        'when' => $log->created_at->diffForHumans(),
    ]);

    $forms = Form::orderBy('created_at', 'desc')->paginate(5);

    return view('admin_pages.dashboard', compact(
        'cards',
        'healthPatterns',
        'visitsPerMonthFull',
        'visitReasonsLabels',
        'visitReasonsValues',
        'emergencyData',
        'staffActivity',
        'forms'
    ));
}

}
