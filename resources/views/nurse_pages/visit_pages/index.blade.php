@extends('layouts.nurse_layout')

@section('title', 'Visits')
@section('page-title', 'Patient Visits')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Visits</h4>
            <a href="{{ route('nurse.visits.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add Visit
            </a>
        </div>

        {{-- 🔍 Filter Section --}}
        <div class="d-flex gap-2 mb-3">
            <input type="text" class="form-control w-25" placeholder="Search by student...">
            <input type="date" class="form-control w-25">
            <select class="form-select w-25">
                <option value="">All Reasons</option>
                <option>sick</option>
                <option>injury</option>
                <option>checkup</option>
                <option>headache</option>
                <option>fever</option>
                <option>stomachache</option>
                <option>menstrual</option>
                <option>asthma</option>
                <option>toothache</option>
                <option>other</option>
            </select>
            <button class="btn btn-secondary">Filter</button>
        </div>

        {{-- 📋 Visits Table --}}
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Reason</th>
                        <th>Visit Time</th>
                        <th>Status</th>
                        <th>Nurse Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Example Row --}}
                    <tr>
                        <td>1</td>
                        <td>John Doe</td>
                        <td>Fever</td>
                        <td>2025-11-07 10:00 AM</td>
                        <td><span class="badge bg-success">Treated</span></td>
                        <td>Given paracetamol</td>
                        <td>
                            <a href="{{ Route('nurse.visits.view') }}" class="btn btn-sm btn-info">view</a>
                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editVisitModal">Edit</button>
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                    {{-- Loop visits here --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
