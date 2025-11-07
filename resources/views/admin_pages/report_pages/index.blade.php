@extends('layouts.admin_layout')

@section('title', 'Clinic Reports')
@section('page-title', 'Clinic Reports')

@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-body">
        {{-- ✅ Filter Section --}}
        <form method="GET" action="{{ route('admin.reports.index') }}" class="row g-3 mb-4">
            <div class="col-md-3">
                <label class="form-label fw-bold">From</label>
                <input type="date" name="from" class="form-control" value="{{ request('from') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">To</label>
                <input type="date" name="to" class="form-control" value="{{ request('to') }}">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <a href="{{ route('admin.reports.export', ['format' => 'pdf']) }}" class="btn btn-danger w-100">
                    <i class="bi bi-file-earmark-pdf"></i> Export PDF
                </a>
            </div>
        </form>

        {{-- ✅ Summary Stats --}}
        <div class="row text-center mb-4">
            <div class="col-md-3">
                <div class="card p-3 bg-light border-0 shadow-sm">
                    <h5>Total Visits</h5>
                    <h3>{{ $totalVisits }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 bg-light border-0 shadow-sm">
                    <h5>Treated</h5>
                    <h3>{{ $treated }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 bg-light border-0 shadow-sm">
                    <h5>Referred</h5>
                    <h3>{{ $referred }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 bg-light border-0 shadow-sm">
                    <h5>Sent Home</h5>
                    <h3>{{ $sentHome }}</h3>
                </div>
            </div>
        </div>
        <!-- static for development value -->
    <div class="row mb-4">
        <!-- <div class="col-md-6">
            <h5 class="fw-bold">Trends of Clinic Visits</h5>
            <canvas id="visitsChart"
                data-labels='["Jan", "Feb", "Mar", "Apr", "May"]'
                data-counts='[10, 15, 7, 20, 12]'></canvas>
        </div>

        <div class="col-md-6">
            <h5 class="fw-bold">Most Common Reasons</h5>
            <canvas class="chart-small" id="reasonsChart"
                data-labels='["Cold", "Flu", "Fever", "Headache", "Injury"]'
                data-counts='[5, 8, 3, 6, 2]'></canvas>
        </div> -->

            <!-- dynamic value -->
        {{-- ✅ Charts --}}
        <div class="col-md-6">
            <h5 class="fw-bold">Trends of Clinic Visits</h5>
            <canvas id="visitsChart"
                data-labels='@json($trendDates)'
                data-counts='@json($trendCounts)'></canvas>
        </div>

        {{-- ✅ Common Reasons --}}
        <div class="col-md-6">
            <h5 class="fw-bold">Most Common Reasons</h5>
            <canvas class="chart-small" id="reasonsChart"
                data-labels='@json($reasonsLabels)'
                data-counts='@json($reasonsCounts)'></canvas>
        </div>
    </div>
        

        {{-- ✅ Table --}}
        <h5 class="fw-bold mt-4">Visit Records</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Date</th>
                        <th>Student</th>
                        <th>Reason</th>
                        <th>Nurse</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($visits as $visit)
                        <tr>
                            <td>{{ $visit->visited_at->format('M d, Y h:i A') }}</td>
                            <td>{{ $visit->student->first_name }} {{ $visit->student->last_name }}</td>
                            <td>{{ ucfirst($visit->reason) }}</td>
                            <td>{{ $visit->nurse->name }}</td>
                            <td>{{ ucfirst($visit->status) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No visits found for selected period.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
    .chart-small {
    max-width: 400px;
    max-height: 300px;
    margin: auto;
}
</style>
@endsection


