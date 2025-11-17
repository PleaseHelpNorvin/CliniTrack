@extends('layouts.nurse_layout')

@section('title', 'Patient Diagnosis')
@section('page-title', 'Patient Diagnosis')

@section('content')

@if($visit)
    <!-- Patient Info -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white fw-bold">
            Patient Information
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-2 d-flex justify-content-center align-items-start">
                    <img 
                        src="{{ $visit->student->photo 
                                ? asset('storage/' . $visit->student->photo) 
                                : asset('App/images/no-image-default.jpg') }}" 
                        alt="Student Photo" 
                        class="img-fluid rounded">
                </div>
                <div class="col-md-10 d-flex flex-column justify-content-center">
                    <h5>{{ $visit->student->first_name }} {{ $visit->student->last_name }}</h5>
                    <p><strong>Grade:</strong> {{ $visit->student->grade }}</p>
                    <p><strong>Section:</strong> {{ $visit->student->section }}</p>
                    <p><strong>Allergies:</strong> {{ $visit->student->allergies ?? 'None' }}</p>
                    <p><strong>Medical Notes:</strong> {{ $visit->student->medical_notes ?? '-' }}</p>
                    <p><strong>Visited At:</strong> {{ $visit->visited_at?->format('M d, Y h:i A') }}</p>
                    <p><strong>Reason:</strong> {{ ucfirst($visit->reason) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Diagnosis Form -->
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white fw-bold">
            Diagnosis & Treatment
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('nurse.diagnosis.store', $visit->id) }}">
                @csrf

                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Temperature (°C)</label>
                        <input type="text" class="form-control" name="temperature" value="{{ $visit->temperature }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Blood Pressure</label>
                        <input type="text" class="form-control" name="blood_pressure" value="{{ $visit->blood_pressure }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Pulse Rate</label>
                        <input type="text" class="form-control" name="pulse_rate" value="{{ $visit->pulse_rate }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Treatment Given</label>
                        <textarea class="form-control" name="treatment_given" rows="3">{{ $visit->treatment_given }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Nurse Notes</label>
                        <textarea class="form-control" name="nurse_notes" rows="3">{{ $visit->nurse_notes }}</textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <select class="form-select" name="status" id="statusSelect">
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" {{ $visit->status === $status ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-4 @if($visit->status !== 'referred') d-none @endif" id="referredDiv">
                        <label class="form-label">Referred To</label>
                        <input type="text" class="form-control" name="referred_to" value="{{ $visit->referred_to ?? '' }}">
                    </div>


                    <div class="col-md-4">
                        <label class="form-label">Emergency</label>
                        <select class="form-control" name="emergency">
                            <option value="0" {{ !$visit->emergency ? 'selected' : '' }}>No</option>
                            <option value="1" {{ $visit->emergency ? 'selected' : '' }}>Yes</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary">Save Diagnosis</button>
                </div>
            </form>
        </div>
    </div>

@else
    <div class="alert alert-warning">
        No assigned visit yet. No diagnosis available.
    </div>
@endif


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusSelect = document.getElementById('statusSelect');
        const referredDiv = document.getElementById('referredDiv');

        statusSelect.addEventListener('change', function () {
            if (this.value === 'referred') {
            referredDiv.classList.remove('d-none'); // show
            } else {
            referredDiv.classList.add('d-none');    // hide
            }
        });
    });
</script>

@endsection
