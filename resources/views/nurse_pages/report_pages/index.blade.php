@extends('layouts.nurse_layout')

@section('title', 'Clinic Reports')
@section('page-title', 'Clinic Reports')

@section('content')


        {{--  Summary Cards --}}
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card p-3 text-center shadow-sm">
                    <h6>Total Visits Today</h6>
                    <h3>{{ $totalVisitsToday }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 text-center shadow-sm">
                    <h6>Emergency Visits</h6>
                    <h3>{{ $emergencyVisits }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 text-center shadow-sm">
                    <h6>Pending Referrals</h6>
                    <h3>{{ $pendingReferrals }}</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card p-3 text-center shadow-sm">
                    <h6>Completed Visits</h6>
                    <h3>{{ $completedVisits }}</h3>
                </div>
            </div>
        </div>
        
        <!-- {{--static Charts --}}
        <div class="row mt-4">
            <div class="col-md-6">
                <h5 class="fw-bold">Visits Trend (Past 5 Days)</h5>
                <canvas id="nurseVisitsChart"
                    data-labels='["Nov 1", "Nov 2", "Nov 3", "Nov 4", "Nov 5"]'
                    data-counts='[2, 5, 3, 6, 12]'></canvas>
            </div>
            <div class="col-md-6">
                <h5 class="fw-bold">Most Common Reasons</h5>
                <canvas id="nurseReasonsChart"
                    data-labels='["Fever", "Headache", "Cold", "Injury"]'
                    data-counts='[5, 3, 2, 2]'></canvas>
            </div>
        </div> -->

{{-- Dynamic Charts --}}
<div class="row mt-4 mb-0">
    <!-- Visits Trend Chart -->
    <div class="col-md-6 mb-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold">Visits Trend (Past 5 Days)</h5>
                <canvas id="nurseVisitsChart"
                    data-labels='@json(array_keys($visitsTrend))'
                    data-counts='@json(array_values($visitsTrend))'></canvas>
            </div>
        </div>
    </div>

    <!-- Most Common Reasons Chart -->
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold">Most Common Reasons</h5>
                <canvas id="nurseReasonsChart"
                    data-labels='@json(array_keys($mostCommonReasons))'
                    data-counts='@json(array_values($mostCommonReasons))'></canvas>
            </div>
        </div>
    </div>
</div>


<div class="card shadow-sm mt-4 mt-md-0">
    <div class="card-body">
        {{-- Recent Visits Table --}}
                <h5 class="fw-bold">Recent Visits</h5>

       <div class="mb-3">
            <form action="{{ route('nurse.reports.index') }}" method="GET" class="row g-2">
                <!-- Search input takes full width on mobile -->
                <div class="col-md-6 col-12">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search by student, reason, or status">
                </div>

                <!-- Status dropdown -->
                <div class="col-md-3 col-12">
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="referred" {{ request('status') == 'referred' ? 'selected' : '' }}>Referred</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    </select>
                </div>

                <!-- Filter button -->
                <div class="col-md-3 col-12">
                    <button type="submit" class="btn btn-primary w-100">Filter</button>
                </div>
            </form>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Student</th>
                                <th>Reason</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentVisits as $visit)
                            <tr>
                                <td>{{ $visit->created_at->format('M d, Y h:i A') }}</td>
                                <td>{{ $visit->student->first_name }}  {{ $visit->student->last_name }} - {{ $visit->student->student_number }} </td>
                                <td>{{ $visit->reason }}</td>
                                <td>{{ $visit->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                {{ $recentVisits->links('pagination::bootstrap-5') }}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
