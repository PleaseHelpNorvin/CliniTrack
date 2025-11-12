@extends('layouts.admin_layout')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')
<div class="container-fluid px-3 px-md-4 py-3">

    <!-- ==================== 1️⃣ SYSTEM USAGE ==================== -->
    <div class="row g-3 mb-4">
        @php
            $cards = [
                ['bg' => 'primary', 'icon' => '👩‍🎓', 'title' => 'Total Students', 'value' => '1,284'],
                ['bg' => 'success', 'icon' => '💉', 'title' => 'Total Visits Recorded', 'value' => '523'],
                ['bg' => 'info', 'icon' => '👩‍⚕️', 'title' => 'Total Nurses', 'value' => '4'],
                ['bg' => 'secondary', 'icon' => '🧑‍💻', 'title' => 'System Users', 'value' => '10'],
                ['bg' => 'danger', 'icon' => '⚠️', 'title' => 'Emergency Visits', 'value' => '3'],
                ['bg' => 'warning', 'icon' => '📅', 'title' => 'Visits Today', 'value' => '7']
            ];
        @endphp
        @foreach ($cards as $card)
            <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                <div class="card shadow-sm h-100 text-white bg-{{ $card['bg'] }}">
                    <div class="card-body text-center p-3">
                        <h6 class="fw-semibold mb-1">{!! $card['icon'] !!} {{ $card['title'] }}</h6>
                        <h3 class="fw-bold mb-0">{{ $card['value'] }}</h3>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- ==================== 2️⃣ CLINIC TRENDS (Charts) ==================== -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light fw-bold">📈 Visits Per Month</div>
                <div class="card-body">
                    <canvas id="dashboardvisitsPerMonthChart" style="min-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="d-flex flex-column gap-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-light fw-bold">🩺 Common Visit Reasons</div>
                    <div class="card-body">
                        <canvas class="chart-small" id="visitReasonsChart"></canvas>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-light fw-bold">🚨 Emergency vs Non-Emergency</div>
                    <div class="card-body">
                        <canvas class="chart-small" id="emergencyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== 3️⃣ STAFF ACTIVITY & 4️⃣ HEALTH PATTERNS ==================== -->
    <div class="row g-3">
        <div class="col-12 col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light fw-bold">👩‍⚕️ Staff Activity</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>User</th>
                                    <th>Action</th>
                                    <th>Role</th>
                                    <th>When</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Nurse Joy</td>
                                    <td>Added Visit for Student 123</td>
                                    <td><span class="badge bg-info text-dark">Nurse</span></td>
                                    <td>3 mins ago</td>
                                </tr>
                                <tr>
                                    <td>Admin Carl</td>
                                    <td>Updated Student Record</td>
                                    <td><span class="badge bg-primary">Admin</span></td>
                                    <td>2 hours ago</td>
                                </tr>
                                <tr>
                                    <td>Nurse Anne</td>
                                    <td>Recorded Emergency Visit</td>
                                    <td><span class="badge bg-info text-dark">Nurse</span></td>
                                    <td>5 hours ago</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light fw-bold">🏥 Health Patterns</div>
                <div class="card-body">
                    <ul class="list-group mb-3">
                        <li class="list-group-item">
                            <strong>Top 5 Visit Reasons:</strong> Headache, Stomachache, Fever, Injury, Others
                        </li>
                        <li class="list-group-item">
                            <strong>Most Visited Students:</strong> Maria Santos (5 visits), John Cruz (4 visits)
                        </li>
                        <li class="list-group-item">
                            <strong>Average Visits per Month:</strong> 68 visits/month
                        </li>
                        <li class="list-group-item">
                            <strong>Most Active Nurse:</strong> Nurse Joy — 42 visits handled
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
.chart-small {
    max-width: 300px;
    max-height: 210px;
    margin: auto;
}
</style>
@endsection
