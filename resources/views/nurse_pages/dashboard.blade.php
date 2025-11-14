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
                        <h5 >Patients Today

                                        <i class="bi bi-info-circle ms-1" 
                                            tabindex="0"
                                            data-bs-toggle="popover"
                                            data-bs-trigger="focus"
                                            title="Patients Today"
                                            data-bs-content="This card shows the total number of patients who visited today.">
                                        </i>
                        </h5>
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
                        <h5>
                            Pending Cases
                            <i class="bi bi-info-circle ms-1" 
                                tabindex="0"
                                data-bs-toggle="popover"
                                data-bs-trigger="focus"
                                title="Pending Cases"
                                data-bs-content="This card shows the total number of cases that are still pending today.">
                            </i>
                        </h5>
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
                        <h5>
                            Follow-ups
                            <i class="bi bi-info-circle ms-1" 
                                tabindex="0"
                                data-bs-toggle="popover"
                                data-bs-trigger="focus"
                                title="Follow-ups"
                                data-bs-content="This card shows the number of patients who need follow-up visits.">
                            </i>
                        </h5>
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
                        <h5>
                            New Referrals
                            <i class="bi bi-info-circle ms-1" 
                                tabindex="0"
                                data-bs-toggle="popover"
                                data-bs-trigger="focus"
                                title="New Referrals"
                                data-bs-content="This card shows the number of patients referred to other clinics today.">
                            </i>
                        </h5>
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
                    <h6 class="d-flex align-items-center justify-content-between ">
                        Urgent Alerts
                        <i class="bi bi-info-circle ms-1"
                            tabindex="0"
                            data-bs-toggle="popover"
                            data-bs-trigger="focus"
                            title="Urgent Alerts"
                            data-bs-content="This table shows students with urgent alerts that require immediate attention.">
                        </i>
                    </h6>
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
                    <h6 class="d-flex align-items-center justify-content-between">
                        Frequent Visitors
                        <i class="bi bi-info-circle ms-1"
                            tabindex="0"
                            data-bs-toggle="popover"
                            data-bs-trigger="focus"
                            title="Frequent Visitors"
                            data-bs-content="This table shows students who visit most often.">
                        </i>
                    </h6>
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
                <div class="card-header bg-white fw-bold d-flex align-items-center justify-content-between">Recent Visits
                    <i class="bi bi-info-circle ms-1"
                        tabindex="0"
                        data-bs-toggle="popover"
                        data-bs-trigger="focus"
                        title="Recent Visits"
                        data-bs-content="This table shows the latest visits by students including status and reason.">
                    </i>

                </div>
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
                    <i class="bi bi-info-circle ms-2"
                        tabindex="0"
                        data-bs-toggle="popover"
                        data-bs-trigger="focus"
                        title="Public Forms / Quick Links"
                        data-bs-content="This table lists all available public forms and quick links.">
                    </i>
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
                    <div class="mt-3">
                        {{ $forms->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ==================== Visits This Week + Top Symptoms Today side by side ==================== -->
    <div class="row mb-4 d-flex">
        <div class="col-lg-6 mb-3">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center fw-bold">Visits This Week
                    <i class="bi bi-info-circle ms-1"
                        tabindex="0"
                        data-bs-toggle="popover"
                        data-bs-trigger="focus"
                        title="Visits This Week"
                        data-bs-content="This chart shows the number of visits each day for the current week.">
                    </i>

                </div>
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
                <div class="card-header bg-white fw-bold d-flex justify-content-between align-items-center fw-bold">Top Symptoms Today
                    <i class="bi bi-info-circle ms-1"
                        tabindex="0"
                        data-bs-toggle="popover"
                        data-bs-trigger="focus"
                        title="Top Symptoms Today"
                        data-bs-content="This chart shows the most common symptoms reported by patients today.">
                    </i>
                </div>
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
