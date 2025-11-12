@extends('layouts.nurse_layout')

@section('title', 'Nurse Dashboard')
@section('page-title', 'Nurse Dashboard')

@section('content')
<div class="container-fluid">

    <!-- ==================== Quick Action Buttons ==================== -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <a href="#" class="btn btn-primary btn-lg"><i class="bi bi-plus-circle me-1"></i> New Visit</a>
                <a href="#" class="btn btn-info btn-lg text-white"><i class="bi bi-search me-1"></i> Search Student</a>
                <a href="#" class="btn btn-success btn-lg"><i class="bi bi-journal-text me-1"></i> Student History</a>
                <a href="#" class="btn btn-warning btn-lg"><i class="bi bi-person-plus me-1"></i> Add Student</a>
                <a href="#" class="btn btn-secondary btn-lg"><i class="bi bi-bar-chart me-1"></i> Reports</a>
            </div>
        </div>
    </div>

    <!-- ==================== Top KPI Cards ==================== -->
    <div class="row  d-flex">
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-success shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Patients Today</h5>
                        <h3>10 <small class="text-white-50">(+2 from yesterday)</small></h3>
                    </div>
                    <i class="bi bi-person-check" style="font-size:2.5rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-primary shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Pending Cases</h5>
                        <h3>3</h3>
                    </div>
                    <i class="bi bi-exclamation-triangle" style="font-size:2.5rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-dark bg-warning shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5>Follow-ups</h5>
                        <h3>2</h3>
                    </div>
                    <i class="bi bi-calendar-check" style="font-size:2.5rem;"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card text-white bg-danger shadow-sm h-100">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5>New Referrals</h5>
                        <h3>1</h3>
                    </div>
                    <i class="bi bi-hospital" style="font-size:2.5rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== Urgent Alerts + Frequent Visitors ==================== -->
    <div class="row d-flex">
        <div class="col-md-6 mb-3">
            <div class="card bg-light shadow-sm h-100">
                <div class="card-body">
                    <h6>Urgent Alerts</h6>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Alert</th>
                                    <th>Student</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge bg-danger">High Fever</span></td>
                                    <td>Juan Dela Cruz</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-warning text-dark">Follow-up</span></td>
                                    <td>Anna Santos</td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-danger">Injury</span></td>
                                    <td>Mark Reyes</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card bg-light shadow-sm h-100">
                <div class="card-body">
                    <h6>Frequent Visitors</h6>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Student</th>
                                    <th>Visits</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Juan Dela Cruz</td>
                                    <td><span class="badge bg-primary">3 Visits</span></td>
                                </tr>
                                <tr>
                                    <td>Anna Santos</td>
                                    <td><span class="badge bg-primary">2 Visits</span></td>
                                </tr>
                                <tr>
                                    <td>Mark Reyes</td>
                                    <td><span class="badge bg-primary">2 Visits</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== Recent Visits + Public Forms side by side ==================== -->
    <div class="row d-flex">
        <div class="col-lg-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-bold">Recent Visits</div>
                <div class="card-body table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Student</th>
                                <th>Date & Time</th>
                                <th>Reason</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Juan Dela Cruz</td>
                                <td>Nov 10, 10:30 AM</td>
                                <td>Fever</td>
                                <td><span class="badge bg-success">Treated</span></td>
                            </tr>
                            <tr>
                                <td>Anna Santos</td>
                                <td>Nov 10, 11:00 AM</td>
                                <td>Injury</td>
                                <td><span class="badge bg-warning text-dark">Referred</span></td>
                            </tr>
                            <tr>
                                <td>Mark Reyes</td>
                                <td>Nov 10, 11:30 AM</td>
                                <td>Checkup</td>
                                <td><span class="badge bg-secondary">Sent Home</span></td>
                            </tr>
                            <tr>
                                <td>Lara Cruz</td>
                                <td>Nov 10, 12:00 PM</td>
                                <td>Headache</td>
                                <td><span class="badge bg-success">Treated</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-bold">Public Forms / Quick Links</div>
                <div class="card-body table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Form Name</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Link</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Daily Health Check</td>
                                <td>Student daily health log</td>
                                <td>Form</td>
                                <td><a href="#" target="_blank">Open</a></td>
                                <td><span class="badge bg-success">Active</span></td>
                            </tr>
                            <tr>
                                <td>Incident Report</td>
                                <td>Injury or accident report</td>
                                <td>Form</td>
                                <td><a href="#" target="_blank">Open</a></td>
                                <td><span class="badge bg-success">Active</span></td>
                            </tr>
                            <tr>
                                <td>Vaccination Consent</td>
                                <td>Permission slip for vaccines</td>
                                <td>PDF/Form</td>
                                <td><a href="#" target="_blank">Open</a></td>
                                <td><span class="badge bg-success">Active</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== Visits This Week + Top Symptoms Today side by side ==================== -->
    <div class="row mb-4 d-flex">
        <div class="col-lg-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-bold">Visits This Week</div>
                <div class="card-body">
                    <canvas id="dashboardVisitsChart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-bold">Top Symptoms Today</div>
                <div class="card-body">
                    <canvas class="chart-small" id="dashboardSymptomsChart"></canvas>
                </div>
            </div>
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
