@extends('layouts.admin_layout')

@section('title', 'Clinic Reports')
@section('page-title', 'Clinic Reports')

@section('content')
<div class="card mb-4">
    <div class="card-body">
        {{--  Filter Section --}}
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
    </div>
</div>

<div class="row g-4 text-center mb-4">
    <div class="col-md-3 d-flex">
        <div class="card p-3   flex-fill">
            <h5>Total Visits</h5>
            <h3>{{ $totalVisits }}</h3>
        </div>
    </div>

    <div class="col-md-3 d-flex">
        <div class="card p-3  flex-fill">
            <h5>Treated</h5>
            <h3>{{ $treated }}</h3>
        </div>
    </div>

    <div class="col-md-3 d-flex">
        <div class="card p-3  flex-fill">
            <h5>Referred</h5>
            <h3>{{ $referred }}</h3>
        </div>
    </div>

    <div class="col-md-3 d-flex">
        <div class="card p-3  flex-fill">
            <h5>Sent Home</h5>
            <h3>{{ $sentHome }}</h3>
        </div>
    </div>
</div>

<div class="row mb-4 g-4">
    <div class="col-md-6 d-flex">
        <div class="card  flex-fill">
            <div class="card-body d-flex flex-column">
                <h5 class="fw-bold">Trends of Clinic Visits</h5>
                <canvas id="visitsChart"
                    data-labels='@json($trendDates)'
                    data-counts='@json($trendCounts)'></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6 d-flex">
        <div class="card  flex-fill">
            <div class="card-body d-flex flex-column">
                <h5 class="fw-bold">Most Common Reasons</h5>
                <canvas class="chart-small" id="reasonsChart"
                    data-labels='@json($reasonsLabels)'
                    data-counts='@json($reasonsCounts)'></canvas>
            </div>
        </div>
    </div>
</div>

<div class="card  mb-4">
    <div class="card-body">
        {{-- Table --}}
        <h5 class="fw-bold mt-0">Visit Records</h5>

            <form method="GET" action="{{ route('admin.reports.index') }}" class="row g-2 align-items-end mb-3">
                <div class="col-md-4 col-lg-5">
                    <input type="text" name="search" class="form-control" 
                        placeholder="Search by student, nurse, or reason..." 
                        value="{{ request('search') }}">
                </div>

                <div class="col-md-2 col-lg-2">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="treated" {{ request('status') == 'treated' ? 'selected' : '' }}>Treated</option>
                        <option value="referred" {{ request('status') == 'referred' ? 'selected' : '' }}>Referred</option>
                        <option value="sent_home" {{ request('status') == 'sent_home' ? 'selected' : '' }}>Sent Home</option>
                    </select>
                </div>

                <div class="col-md-2 col-lg-2">
                    <input type="date" name="from" class="form-control" value="{{ request('from') }}">
                </div>

                <div class="col-md-2 col-lg-2">
                    <input type="date" name="to" class="form-control" value="{{ request('to') }}">
                </div>

                <div class="col-md-2 col-lg-1">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>            
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
            {{ $visits->links('pagination::bootstrap-5') }}

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


