@extends('layouts.nurse_layout')

@section('title', 'Add Visit')
@section('page-title', 'Add New Visit')

@section('content')
        <div class="mb-3">
            <a href="{{ route('nurse.visits.index') }}" class="btn btn-secondary">&larr; Back to Visits</a>
        </div>

<div class="card shadow-sm w-100">
    <div class="card-body">
        <form action="{{ route('nurse.visits.store') }}" method="POST" class="row g-3">
            @csrf

            {{-- 🔍 Searchable Student Dropdown --}}
                <div class="col-md-6">
                <label class="form-label">Select Student</label>
                <div class="w-100">
                    <select name="student_id" class="form-select" id="studentSelect" required>
                        <option value="">-- Select Student --</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">
                                {{ $student->first_name }} {{ $student->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                </div>

            {{-- Visit Date/Time --}}
            <div class="col-md-6">
                <label class="form-label">Visit Date/Time</label>
                <input type="datetime-local" name="visited_at" class="form-control" required>
            </div>

            {{-- Reason --}}
            <div class="col-md-6">
                <label class="form-label">Reason</label>
                <select name="reason" class="form-select" required>
                    <option value="">-- Select Reason --</option>
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
            </div>

            {{-- Status --}}
            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select name="status" id="statusSelect" class="form-select" required>
                    <option value="treated">Treated</option>
                    <option value="referred">Referred</option>
                    <option value="sent_home">Sent Home</option>
                </select>
            </div>

            {{-- Temperature --}}
            <div class="col-md-4">
                <label class="form-label">Temperature (°C)</label>
                <input type="text" name="temperature" class="form-control" placeholder="e.g. 37.5">
            </div>

            {{-- Blood Pressure --}}
            <div class="col-md-4">
                <label class="form-label">Blood Pressure</label>
                <input type="text" name="blood_pressure" class="form-control" placeholder="e.g. 120/80">
            </div>

            {{-- Pulse Rate --}}
            <div class="col-md-4">
                <label class="form-label">Pulse Rate (bpm)</label>
                <input type="text" name="pulse_rate" class="form-control" placeholder="e.g. 75">
            </div>

            {{-- Treatment Given --}}
            <div class="col-md-12">
                <label class="form-label">Treatment Given</label>
                <textarea name="treatment_given" class="form-control" rows="2"></textarea>
            </div>

            {{-- Nurse Notes --}}
            <div class="col-md-12">
                <label class="form-label">Nurse Notes</label>
                <textarea name="nurse_notes" class="form-control" rows="2"></textarea>
            </div>

            {{-- Referred To --}}
            <div class="col-md-12" id="referredToField" style="display:none;">
                <label class="form-label">Referred To</label>
                <input type="text" name="referred_to" class="form-control" placeholder="e.g. City Hospital">
            </div>

            {{-- Emergency Checkbox --}}
            <div class="col-md-12">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="emergency" id="emergencyCheck" value="1">
                    <label class="form-check-label" for="emergencyCheck">
                        Mark as Emergency
                    </label>
                </div>
            </div>

            <div class="col-md-12 text-end">
                <button type="submit" class="btn btn-primary">Save Visit</button>
            </div>
        </form>
    </div>
</div>

@endsection