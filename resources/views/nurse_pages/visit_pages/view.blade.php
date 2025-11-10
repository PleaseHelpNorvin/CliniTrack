@extends('layouts.nurse_layout')

@section('title', 'View Visit')
@section('page-title', 'Visit Details')

@section('content')
<div class="card mb-4">
    <div class="card-body">

        {{-- Student & Nurse Info --}}
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <div class="p-3 border rounded shadow-sm">
                    <h6 class="fw-bold">Student Name:</h6>
                    <p>{{ $visit->student->first_name }} {{ $visit->student->last_name }}</p>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <div class="p-3 border rounded shadow-sm">
                    <h6 class="fw-bold">Nurse Attended:</h6>
                    <p>{{ $visit->nurse_name }}</p>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <div class="p-3 border rounded shadow-sm">
                    <h6 class="fw-bold">Visited At:</h6>
                    <p>{{ \Carbon\Carbon::parse($visit->visited_at)->format('Y-m-d h:i A') }}</p>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-2">
                <div class="p-3 border rounded shadow-sm">
                    <h6 class="fw-bold">Emergency Case:</h6>
                    <p>
                        @if($visit->emergency)
                            <span class="badge bg-danger">Yes</span>
                        @else
                            <span class="badge bg-secondary">No</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        {{-- 🩺 Medical Details --}}
        <div class="card mb-3 border-light shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-4 mb-2">
                        <h6 class="fw-bold">Reason:</h6>
                        <p>{{ $visit->reason === 'other' ? $visit->other_reason : ucfirst($visit->reason) }}</p>
                    </div>
                    <div class="col-sm-12 col-md-4 mb-2">
                        <h6 class="fw-bold">Status:</h6>
                        @php
                            $statusClass = match($visit->status) {
                                'treated'   => 'success',
                                'referred'  => 'warning',
                                'sent_home' => 'secondary',
                                default     => 'light'
                            };
                        @endphp
                        <p><span class="badge bg-{{ $statusClass }}">{{ ucfirst(str_replace('_', ' ', $visit->status)) }}</span></p>
                    </div>
                    <div class="col-sm-12 col-md-4 mb-2">
                        <h6 class="fw-bold">Referred To:</h6>
                        <p>{{ $visit->referred_to ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- 🧾 Vitals --}}
        <div class="card mb-3 border-light shadow-sm">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-4 mb-2">
                        <h6 class="fw-bold">Temperature:</h6>
                        <p>{{ $visit->temperature ?? '-' }}°C</p>
                    </div>
                    <div class="col-sm-12 col-md-4 mb-2">
                        <h6 class="fw-bold">Blood Pressure:</h6>
                        <p>{{ $visit->blood_pressure ?? '-' }}</p>
                    </div>
                    <div class="col-sm-12 col-md-4 mb-2">
                        <h6 class="fw-bold">Pulse Rate:</h6>
                        <p>{{ $visit->pulse_rate ?? '-' }} bpm</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- 💊 Treatment & Nurse Notes --}}
        <div class="card mb-3 border-light shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold">Treatment Given:</h6>
                <p>{{ $visit->treatment_given ?? '-' }}</p>

                <h6 class="fw-bold mt-3">Nurse Notes:</h6>
                <p>{{ $visit->nurse_notes ?? '-' }}</p>
            </div>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('nurse.visits.index') }}" class="btn btn-secondary">Back</a>
        </div>

    </div>
    
</div>

@endsection
