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
        $from = $request->get('from', Carbon::now()->startOfMonth()->toDateString());
        $to = $request->get('to', Carbon::now()->endOfMonth()->toDateString());

        $visits = Visit::with(['student', 'nurse'])
            ->whereBetween('visited_at', [$from, $to])
            ->get();

        $totalVisits = $visits->count();
        $treated = $visits->where('status', 'treated')->count();
        $referred = $visits->where('status', 'referred')->count();
        $sentHome = $visits->where('status', 'sent_home')->count();

        // Trends over time
        $trendData = $visits->groupBy(fn($v) => Carbon::parse($v->visited_at)->format('Y-m-d'))
            ->map->count();
        $trendDates = $trendData->keys();
        $trendCounts = $trendData->values();

        // Common reasons
        $reasonCounts = $visits->groupBy('reason')->map->count();
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
