@extends('layouts.nurse_layout')

@section('title', 'Add Student')
@section('page-title', 'Add Student')

@section('content')

{{-- Student Info Card --}}
<div class="mb-3">
    <a href="{{ route('nurse.students.index') }}" class="btn btn-secondary">
        &larr; Back
    </a>
</div>

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

<div class="card shadow-sm mb-4">

    <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-center">

        {{-- Profile Image --}}
        <div class="mb-3 mb-md-0 me-md-3 text-center text-md-start">
            <img src="{{ $student->photo ? asset('storage/'.$student->photo) : asset('App/images/no-image-default.jpg') }}"
                alt="Student Photo"
                style="width: 120px; height: 120px; object-fit: cover;">
        </div>

        {{-- Student Info --}}
        <div class="flex-grow-1 text-center text-md-start mb-3 mb-md-0">

            <h4 class="fw-bold">{{ $student->first_name }} {{ $student->last_name }}</h4>

            <div class="row mb-1">
                <div class="col-5 col-md-4 fw-bold">Grade & Section:</div>
                <div class="col-7 col-md-8">{{ $student->gradeText }} - {{ $student->sectionText }}</div>
            </div>

            <div class="row mb-1">
                <div class="col-5 col-md-4 fw-bold">Age / DOB:</div>
                <div class="col-7 col-md-8">{{ $student->age }} / {{ $student->dob ? $student->dob->format('F j, Y') : 'N/A' }}</div>
            </div>

            <div class="row mb-1">
                <div class="col-5 col-md-4 fw-bold">Contact:</div>
                <div class="col-7 col-md-8">{{ $student->contact_number ?? 'N/A' }}</div>
            </div>

            <div class="row">
                <div class="col-5 col-md-4 fw-bold">Address:</div>
                <div class="col-7 col-md-8">{{ $student->address }}</div>
            </div>

        </div>

        {{-- Buttons --}}
        <div class="text-center text-md-end">
            <a href="{{ Route('nurse.students.edit', $student) }}" class="btn btn-warning me-2 mb-2 mb-md-0">Edit</a>

            <form action="{{ Route('nurse.documents.destroy', $student) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger me-2 mb-2 mb-md-0"
                    onclick="return confirm('Delete this student?')">Delete</button>
            </form>
        </div>

    </div>
</div>

<div class="card shadow-sm mb-4">
    <div class="card-body">

        {{-- Tabs --}}
        <ul class="nav nav-tabs mb-4">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#profile">🐦 Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#visits">📋 Visit History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#documents">📎 Documents</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#notes">⏳ Allergies / Notes</a>
            </li>
        </ul>

        {{-- Tab Content --}}
        <div class="tab-content">

            {{-- PROFILE TAB --}}
            <div class="tab-pane fade show active" id="profile">
                <h5 class="fw-bold mb-4 text-center text-md-start">Student Profile</h5>

                <div class="row mb-3 text-center text-md-start align-items-center">
                    <div class="col-12 col-md-4 fw-bold">Student Number:</div>
                    <div class="col-12 col-md-8">{{ $student->student_number }}</div>
                </div>

                <div class="row mb-3 text-center text-md-start align-items-center">
                    <div class="col-12 col-md-4 fw-bold">Full Name:</div>
                    <div class="col-12 col-md-8">{{ $student->first_name }} {{ $student->last_name }}</div>
                </div>

                <div class="row mb-3 text-center text-md-start align-items-center">
                    <div class="col-12 col-md-4 fw-bold">Grade & Section:</div>
                    <div class="col-12 col-md-8">{{ $student->gradeText }} - {{ $student->sectionText }}</div>
                </div>

                <div class="row mb-3 text-center text-md-start align-items-center">
                    <div class="col-12 col-md-4 fw-bold">Date of Birth:</div>
                    <div class="col-12 col-md-8">{{ $student->dob ? $student->dob->format('F j, Y') : 'N/A' }}</div>
                </div>

                <div class="row mb-3 text-center text-md-start align-items-center">
                    <div class="col-12 col-md-4 fw-bold">Age:</div>
                    <div class="col-12 col-md-8">{{ $student->age ?? 'N/A' }}</div>
                </div>

                <div class="row mb-3 text-center text-md-start align-items-center">
                    <div class="col-12 col-md-4 fw-bold">Contact Number:</div>
                    <div class="col-12 col-md-8">{{ $student->contact_number ?? 'N/A' }}</div>
                </div>

                <div class="row mb-3 text-center text-md-start align-items-center">
                    <div class="col-12 col-md-4 fw-bold">Email:</div>
                    <div class="col-12 col-md-8">{{ $student->email }}</div>
                </div>

                <div class="row mb-3 text-center text-md-start align-items-center">
                    <div class="col-12 col-md-4 fw-bold">Address:</div>
                    <div class="col-12 col-md-8">{{ $student->address }}</div>
                </div>
            </div>

            {{-- VISITS TAB --}}
            <div class="tab-pane fade" id="visits">
                <div class="d-flex justify-content-between mb-2">
                    <input type="text" class="form-control w-25" placeholder="Search visits...">
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Nurse</th>
                                <th>Reason</th>
                                <th>Temperature</th>
                                <th>Blood Pressure</th>
                                <th>Pulse Rate</th>
                                <th>Treatment</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($student->visits as $visit)
                            <tr>
                                <td>{{ $visit->visit_time ? $visit->visit_time->format('Y-m-d') : 'N/A' }}</td>
                                <td>{{ $visit->nurse->name ?? 'N/A' }}</td>
                                <td>{{ $visit->reason ?? 'N/A' }}</td>
                                <td>{{ $visit->temperature ?? 'N/A' }}</td>
                                <td>{{ $visit->blood_pressure ?? 'N/A' }}</td>
                                <td>{{ $visit->pulse_rate ?? 'N/A' }}</td>
                                <td>{{ $visit->notes ?? 'N/A' }}</td>
                                <td>{{ $visit->status ?? 'N/A' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">No visits yet</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- DOCUMENTS TAB --}}
            <div class="tab-pane fade" id="documents">
                
                <div class="d-flex justify-content-between mb-2">
                    <h5>Student Documents</h5>
                    <a href="{{ route('nurse.documents.create', $student->id) }}" class="btn btn-sm btn-primary">
                        Upload Document
                    </a>
                </div>

                @if($student->documents->count() > 0)
                    <ul class="list-group">
                        @foreach($student->documents as $doc)
                            @php
                                // Determine delete route dynamically
                                $prefix = request()->route()->getPrefix(); // /admin/documents or /nurse/documents
                                $deleteRoute = $prefix === '/admin/documents'
                                    ? route('admin.documents.destroy', $doc->id)
                                    : route('nurse.documents.destroy', $doc->id);
                            @endphp

                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="{{ $doc->url }}" target="_blank">{{ $doc->name }}</a>

                                <div>
                                    <form action="{{ $deleteRoute }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="redirect_to" value="{{ request()->routeIs('nurse.visits.view') ? 'visits' : 'students' }}">
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this document?')">Delete</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No documents uploaded yet.</p>
                @endif
            </div>

            {{-- NOTES TAB --}}
            <div class="tab-pane fade" id="notes">
                <div class="mb-3">
                    <strong>Allergies:</strong> {{ $student->allergies ?? 'None' }}
                </div>
                <div>
                    <strong>Medical Notes:</strong> {{ $student->medical_notes ?? 'None' }}
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
