<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;


class ReportController extends Controller
{
    //
public function index(Request $request)
{
    $query = Visit::with(['student', 'nurse'])->latest('visited_at');

    // SEARCH FILTER
    if ($search = $request->get('search')) {
        $query->where(function ($q) use ($search) {
            $q->whereHas('student', function ($studentQuery) use ($search) {
                $studentQuery->where('first_name', 'like', "%{$search}%")
                             ->orWhere('last_name', 'like', "%{$search}%");
            })
            ->orWhereHas('nurse', function ($nurseQuery) use ($search) {
                $nurseQuery->where('name', 'like', "%{$search}%");
            })
            ->orWhere('reason', 'like', "%{$search}%")
            ->orWhere('status', 'like', "%{$search}%");
        });
    }

    // STATUS FILTER
    if ($status = $request->get('status')) {
        $query->where('status', $status);
    }

    // DATE RANGE FILTER
    if ($from = $request->get('from')) {
        $query->whereDate('visited_at', '>=', $from);
    }

    if ($to = $request->get('to')) {
        $query->whereDate('visited_at', '<=', $to);
    }

    //  PAGINATE
    $visits = $query->paginate(10)->withQueryString();

    //  For Summary Cards + Charts
    $summaryQuery = Visit::query();

    if ($from) {
        $summaryQuery->whereDate('visited_at', '>=', $from);
    }
    if ($to) {
        $summaryQuery->whereDate('visited_at', '<=', $to);
    }

    $allVisits = $summaryQuery->get();

    $totalVisits = $allVisits->count();
    $treated = $allVisits->where('status', 'treated')->count();
    $referred = $allVisits->where('status', 'referred')->count();
    $sentHome = $allVisits->where('status', 'sent_home')->count();

    // Trend and reason data
    $trendData = $allVisits->groupBy(fn($v) => \Carbon\Carbon::parse($v->visited_at)->format('Y-m-d'))->map->count();
    $trendDates = $trendData->keys();
    $trendCounts = $trendData->values();

    $reasonCounts = $allVisits->groupBy('reason')->map->count();
    $reasonsLabels = $reasonCounts->keys();
    $reasonsCounts = $reasonCounts->values();

    return view('admin_pages.report_pages.index', compact(
        'visits',
        'totalVisits',
        'treated',
        'referred',
        'sentHome',
        'trendDates',
        'trendCounts',
        'reasonsLabels',
        'reasonsCounts'
    ));
}


    public function export($format)
    {
        $visits = Visit::with(['student', 'nurse'])->get();

        if ($format === 'pdf') {
            $pdf = PDF::loadView('admin_pages.report_pages.pdf', compact('visits'));
            return $pdf->download('clinic-report.pdf');
        }

        if ($format === 'excel') {
            return Excel::download(new \App\Exports\VisitsExport, 'clinic-report.xlsx');
        }
    }

}
