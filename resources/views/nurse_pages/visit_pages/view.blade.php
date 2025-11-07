@extends('layouts.nurse_layout')

@section('title', 'View Visit')
@section('page-title', 'Visit Details')

@section('content')

<div class="mb-3">
    <a href="{{ route('nurse.visits.index') }}" class="btn btn-secondary">
        &larr; Back to Visits
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        {{-- 🧑‍⚕️ Student & Nurse Info --}}
        <div class="row">
            <div class="col-sm-12 col-md-6 mb-3">
                <div class="p-3 border rounded shadow-sm">
                    <h6 class="fw-bold">Student Name:</h6>
                    <p>John Doe</p>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <div class="p-3 border rounded shadow-sm">
                    <h6 class="fw-bold">Nurse Attended:</h6>
                    <p>Nurse Joy</p>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-3">
                <div class="p-3 border rounded shadow-sm">
                    <h6 class="fw-bold">Visited At:</h6>
                    <p>2025-11-07 10:00 AM</p>
                </div>
            </div>

            <div class="col-sm-12 col-md-6 mb-2">
                <div class="p-3 border rounded shadow-sm">
                    <h6 class="fw-bold">Emergency Case:</h6>
                    <p>
                        <span class="badge bg-danger">Yes</span>
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
                        <p>Fever</p>
                    </div>
                    <div class="col-sm-12 col-md-4 mb-2">
                        <h6 class="fw-bold">Status:</h6>
                        <p><span class="badge bg-success">Treated</span></p>
                    </div>
                    <div class="col-sm-12 col-md-4 mb-2">
                        <h6 class="fw-bold">Referred To:</h6>
                        <p>-</p>
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
                        <p>37.5°C</p>
                    </div>
                    <div class="col-sm-12 col-md-4 mb-2">
                        <h6 class="fw-bold">Blood Pressure:</h6>
                        <p>120/80 mmHg</p>
                    </div>
                    <div class="col-sm-12 col-md-4 mb-2">
                        <h6 class="fw-bold">Pulse Rate:</h6>
                        <p>78 bpm</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- 💊 Treatment & Nurse Notes --}}
        <div class="card mb-3 border-light shadow-sm">
            <div class="card-body">
                <h6 class="fw-bold">Treatment Given:</h6>
                <p>Administered paracetamol and advised rest.</p>

                <h6 class="fw-bold mt-3">Nurse Notes:</h6>
                <p>Patient’s temperature reduced after 30 minutes. Observed stable condition before discharge.</p>
            </div>
        </div>

    </div>
</div>

@endsection
