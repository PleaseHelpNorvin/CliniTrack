@extends('layouts.admin_layout')

@section('title', 'Admin Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')
<!-- <div class="container-fluid px-3 px-md-4 py-3"> -->

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- ==================== SYSTEM USAGE ==================== -->
    <div class="row g-3 mb-4">

        @foreach ($cards as $card)
            <div class="col-12 col-sm-6 col-lg-4 col-xl-2">
                <div class="card shadow-sm h-100 text-white bg-{{ $card['bg'] }}">
                    <div class="card-body text-center p-3">
                        <h6 class="fw-semibold mb-1">{{ $card['title'] }}</h6>
                        <h3 class="fw-bold mb-0">{{ $card['value'] }}</h3>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- ==================== CLINIC TRENDS (Charts) ==================== -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light fw-bold"> Visits Per Month</div>
                <div class="card-body">
                    <canvas id="dashboardvisitsPerMonthChart"
                        data-values='@json(array_values($visitsPerMonthFull))'
                        style="min-height: 300px;">
                    </canvas>
                </div>
            </div>
        </div>
  
        <div class="col-12 col-lg-4">
            <div class="d-flex flex-column gap-3">
                <div class="card shadow-sm">
                    <div class="card-header bg-light fw-bold"> Common Visit Reasons</div>
                    <div class="card-body">
                        <canvas class="chart-small" id="visitReasonsChart"
                            data-labels='@json($visitReasonsLabels)'
                            data-values='@json($visitReasonsValues)'></canvas>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-light fw-bold"> Emergency vs Non-Emergency</div>
                    <div class="card-body">
                        <canvas class="chart-small" id="emergencyChart"
                            data-labels='@json(array_keys($emergencyData))'
                            data-values='@json(array_values($emergencyData))'>
                        </canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ====================  STAFF ACTIVITY &  HEALTH PATTERNS ==================== -->
    <div class="row g-3">
        <div class="col-12 col-lg-6"> 
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light fw-bold"> Staff Activity</div>
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

                                @forelse($staffActivity as $activity)
                                    <tr>
                                        <td>{{ $activity['user'] }}</td>
                                        <td>{{ $activity['action'] }}</td>
                                        <td>
                                            <span class="badge 
                                                {{ $activity['role'] === 'admin' ? 'bg-primary' : 'bg-info text-dark' }}">
                                                {{ ucfirst($activity['role']) }}
                                            </span>
                                        </td>
                                        <td>{{ $activity['when'] }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No recent activity</td>
                                    </tr>
                                @endforelse

                                
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $staffActivity->links('pagination::bootstrap-5') }}

                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light fw-bold"> Health Patterns</div>
                <div class="card-body">
                    <ul class="list-group mb-3">
                        @foreach ($healthPatterns as $pattern)
                            <li class="list-group-item">
                                <strong>{{ $pattern['title'] }}:</strong> {{ $pattern['value'] }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
        
    <div class="row g-3 mt-2">
        <div class="col-12">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light d-flex justify-content-between align-items-center fw-bold">
                    <span>Manage Forms</span>
                    <a href="{{ route('admin.forms.create') }}" class="btn btn-primary btn-sm">+ Add Form</a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Form Name</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Link</th>
                                <th>Status</th>
                                <th>Actions</th>
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
                                    <span class="badge bg-{{ $form->status == 'active' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($form->status) }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyToClipboard('{{ $form->link }}')">Copy</button>


                                    <a href="{{ route('admin.forms.edit', $form->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                    <form action="{{ route('admin.forms.destroy', $form->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center">No forms found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $forms->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->

<style>
.chart-small {
    max-width: 300px;
    max-height: 210px;
    margin: auto;
}
</style>
@endsection
