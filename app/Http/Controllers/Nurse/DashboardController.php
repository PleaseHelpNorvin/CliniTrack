<?php

namespace App\Http\Controllers\Nurse;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Visit;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
     public function index()
    {

        $driver = DB::getDriverName();


        // --- KPI Cards ---
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        $patientsToday = Visit::whereDate('visited_at', $today)->count();
        $patientsYesterday = Visit::whereDate('visited_at', $yesterday)->count();
        $patientsDifference = $patientsToday - $patientsYesterday;
        $pendingCases = Visit::where('status', 'referred')->count();

        $followUps = Visit::where('status', 'sent_home')->count();

        $newReferrals = Visit::where('status', 'referred')->whereDate('created_at', $today)->count();

        // --- Urgent Alerts ---
        $urgentAlerts = Visit::with('student')
            ->where('emergency', true)
            ->latest()
            ->limit(5)
            ->get();

        // --- Frequent Visitors ---
        $frequentVisitors = Student::withCount('visits')
            ->orderBy('visits_count', 'desc')
            ->limit(5)
            ->get();

        // --- Recent Visits ---
        $recentVisits = Visit::with('student')
            ->latest()
            ->limit(5)
            ->get();

        // --- Visits This Week Chart ---
        if ($driver === 'sqlite') {
            $weekData = Visit::selectRaw("strftime('%w', visited_at) as day_key, COUNT(*) as total")
                ->whereBetween('visited_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->groupBy('day_key')
                ->pluck('total', 'day_key')
                ->mapWithKeys(function ($value, $key) {
                    $days = [
                        0 => 'Sunday',
                        1 => 'Monday',
                        2 => 'Tuesday',
                        3 => 'Wednesday',
                        4 => 'Thursday',
                        5 => 'Friday',
                        6 => 'Saturday',
                    ];
                    return [$days[$key] => $value];
                });
        } else {
            $weekData = Visit::selectRaw("DAYNAME(visited_at) as day, COUNT(*) as total")
                ->whereBetween('visited_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->groupBy('day')
                ->pluck('total', 'day');
        }

        // --- Complete week + sorted ---
        $orderedWeek = collect([
            'Monday' => 0,
            'Tuesday' => 0,
            'Wednesday' => 0,
            'Thursday' => 0,
            'Friday' => 0,
            'Saturday' => 0,
            'Sunday' => 0,
        ])->merge($weekData);

        // --- Symptoms Today ---
        $symptomsToday = Visit::selectRaw('reason, COUNT(*) as total')
            ->whereDate('visited_at', $today)
            ->groupBy('reason')
            ->pluck('total', 'reason');

        $forms = Form::orderBy('created_at', 'desc')->paginate(5);
    
        $unassignedVisits = Visit::whereNull('nurse_id')
            ->orderBy('visited_at', 'desc')
            ->get();

        return view('nurse_pages.dashboard', compact(
            'patientsToday',
            'patientsYesterday',
            'patientsDifference',
            'pendingCases',
            'followUps',
            'newReferrals',
            'urgentAlerts',
            'frequentVisitors',
            'recentVisits',
            'weekData',
            'orderedWeek',   
            'symptomsToday',
            'forms',
            'unassignedVisits'
        ));
    }

    public function assignSelf($id)
    {
        $nurseId = Auth::id();

        $activeVisit = Visit::where('nurse_id', Auth::id())
                        ->whereIn('status', ['assigned','in_progress'])
                        ->first();

        if ($activeVisit) {
            return redirect()->route('nurse.dashboard')
                ->with('error', 'You already have a visit assigned. Complete it before taking a new one.');
        }

        $visit = Visit::findOrFail($id);

        if ($visit->nurse_id) {
            return redirect()->route('nurse.dashboard')
                ->with('error', 'This visit is already assigned to another nurse.');
        }

        $visit->update([
            'nurse_id' => $nurseId,
            'status' => 'assigned'
        ]);

        return redirect()->route('nurse.dashboard')
            ->with('success', 'Visit successfully assigned to you.');
    }

}
