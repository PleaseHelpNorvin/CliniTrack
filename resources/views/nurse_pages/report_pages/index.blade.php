@extends('layouts.nurse_layout')

@section('title', 'Clinic Reports')
@section('page-title', 'Clinic Reports')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

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

        {{--dynamic Charts --}}
        <div class="row mt-4">
            <div class="col-md-6">
                <h5 class="fw-bold">Visits Trend (Past 5 Days)</h5>
                <canvas id="nurseVisitsChart"
                    data-labels='@json(array_keys($visitsTrend))'
                    data-counts='@json(array_values($visitsTrend))'></canvas>
            </div>
            <div class="col-md-6">
                <h5 class="fw-bold">Most Common Reasons</h5>
                <canvas id="nurseReasonsChart"
                    data-labels='@json(array_keys($mostCommonReasons))'
                    data-counts='@json(array_values($mostCommonReasons))'></canvas>
            </div>
        </div>

        {{-- Recent Visits Table --}}
        <div class="row mt-4">
            <div class="col-12">
                <h5 class="fw-bold">Recent Visits</h5>
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
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
