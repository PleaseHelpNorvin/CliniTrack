@extends('layouts.nurse_layout')

@section('title', 'Nurse Dashboard')
@section('page-title', 'Nurse Dashboard')

@section('content')
<div class="container-fluid">

    <!-- ==================== Quick Action Buttons ==================== -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <a href="{{ Route('nurse.visits.create')}}" class="btn btn-primary btn-lg"><i class="bi bi-plus-circle me-1"></i> New Visit</a>
                <a href="{{ Route('nurse.students.index')}}" class="btn btn-info btn-lg text-white"><i class="bi bi-search me-1"></i> Search Student</a>
                <!-- <a href="#" class="btn btn-success btn-lg"><i class="bi bi-journal-text me-1"></i> Student History</a> -->
                <a href="{{ Route('nurse.students.create') }}" class="btn btn-warning btn-lg"><i class="bi bi-person-plus me-1"></i> Add Student</a>
                <a href="{{ Route('nurse.reports.index') }}" class="btn btn-secondary btn-lg"><i class="bi bi-bar-chart me-1"></i> Reports</a>
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
                        <h3>
                            {{ $patientsToday }}
                            @if($patientsDifference > 0)
                                <small class="text-white-50">( +{{ $patientsDifference }} from yesterday )</small>
                            @elseif($patientsDifference < 0)
                                <small class="text-white-50">( {{ $patientsDifference }} from yesterday )</small>
                            @else
                                <small class="text-white-50">( same as yesterday )</small>
                            @endif
                        </h3>
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
                        <h3>{{$pendingCases}}</h3>
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
                        <h3>{{$followUps}}</h3>
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
                        <h3>{{$newReferrals}}</h3>
                    </div>
                    <i class="bi bi-hospital" style="font-size:2.5rem;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== Urgent Alerts + Frequent Visitors ==================== -->
    <div class="row">
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
                                @foreach($urgentAlerts as $alert)
                                    <tr>
                                        <td>
                                            <span class="badge bg-{{ $alert->emergency ? 'danger' : 'warning text-dark' }}">
                                                {{ ucfirst(str_replace('_', ' ', $alert->reason)) }}
                                            </span>
                                        </td>
                                        <td>{{ $alert->student->first_name }} {{ $alert->student->last_name }}</td>
                                    </tr>
                                @endforeach
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
                                @foreach($frequentVisitors as $student)
                                    <tr>
                                        <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                                        <td><span class="badge bg-primary">{{ $student->visits_count }} Visit{{ $student->visits_count > 1 ? 's' : '' }}</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== Recent Visits + Public Forms side by side ==================== -->
    <div class="row">
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
                            @foreach($recentVisits as $visit)
                                <tr>
                                    <td>{{ $visit->student->first_name }} {{ $visit->student->last_name }}</td>
                                    <td>{{ $visit->visited_at->format('M d, h:i A') }}</td>
                                    <td>{{ ucfirst($visit->reason) }}</td>
                                    <td>
                                        <span class="badge bg-{{ 
                                            $visit->status == 'treated' ? 'success' : 
                                            ($visit->status == 'referred' ? 'warning text-dark' : 'secondary')
                                        }}">
                                            {{ ucfirst(str_replace('_',' ',$visit->status)) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center fw-bold">
                    <span>Public Forms / Quick Links</span>
                    <!-- <a href="" class="btn btn-primary btn-sm">+ Add Form</a> -->
                </div>
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
                            @forelse($forms as $form)
                            <tr>
                                <td>{{ $form->name }}</td>
                                <td>{{ $form->description }}</td>
                                <td>{{ $form->type }}</td>
                                <td><a href="{{ $form->link }}" target="_blank">Open</a></td>
                                <td>
                                    @if($form->status == 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No forms found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Laravel + Bootstrap Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        <!-- {{ $forms->links('pagination::bootstrap-5') }} -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== Visits This Week + Top Symptoms Today side by side ==================== -->
    <div class="row mb-4 d-flex">
        <div class="col-lg-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-bold">Visits This Week (done)</div>
                <div class="card-body">
                    <canvas 
                        id="dashboardVisitsChart"
                        data-week='@json($orderedWeek)'>
                    </canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-bold">Top Symptoms Today</div>
                <div class="card-body">
                    <canvas 
                        id="dashboardSymptomsChart" 
                        data-labels='@json($symptomsToday->keys())' 
                        data-values='@json($symptomsToday->values())'
                        class="chart-small">
                    </canvas>
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
