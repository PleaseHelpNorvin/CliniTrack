@extends('layouts.public_layout')

@section('title', 'Add Visit')
@section('page-title', 'Add New Visit')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8"><!-- Makes the card smaller & centered -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-center mb-4 fw-bold">Add New Visit</h3>

                    <form action="{{ route('public.visit.store') }}" method="POST" class="row g-3">
                        @csrf

                        {{-- 🔍 Searchable Student Dropdown --}}
                        <div class="col-12">
                            <label class="form-label">Select Student</label>
                            <select name="student_id" class="form-select @error('student_id') is-invalid @enderror" id="studentSelect">
                                <option value="">-- Select Student --</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                        {{ $student->first_name }} {{ $student->last_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('student_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Visit Date/Time --}}
                        <div class="col-12">
                            <label class="form-label">Visit Date/Time</label>
                            <input type="datetime-local" name="visited_at" class="form-control @error('visited_at') is-invalid @enderror" value="{{ old('visited_at') }}">
                            @error('visited_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Reason --}}
                        <div class="col-12">
                            <label class="form-label">Reason</label>
                            <select name="reason" id="reasonSelect" class="form-select @error('reason') is-invalid @enderror">
                                <option value="">-- Select Reason --</option>
                                @php
                                    $reasons = ['sick','injury','checkup','headache','fever','stomachache','menstrual','asthma','toothache','other'];
                                @endphp
                                @foreach($reasons as $r)
                                    <option value="{{ $r }}" {{ old('reason') == $r ? 'selected' : '' }}>{{ ucfirst($r) }}</option>
                                @endforeach
                            </select>
                            @error('reason')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-12">
                            <label class="form-label">Status</label>
                            <select name="status" id="statusSelect" class="form-select @error('status') is-invalid @enderror">
                                @php
                                    $statuses = ['treated','referred','sent_home'];
                                @endphp
                                @foreach($statuses as $s)
                                    <option value="{{ $s }}" {{ old('status') == $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_',' ',$s)) }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Other Reason --}}
                        <div class="col-12 @if(old('reason')=='other') d-block @else d-none @endif" id="otherReasonField">
                            <label class="form-label">Please specify</label>
                            <input type="text" name="other_reason" class="form-control @error('other_reason') is-invalid @enderror" placeholder="Enter reason" value="{{ old('other_reason') }}">
                            @error('other_reason')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Temperature --}}
                        <div class="col-12">
                            <label class="form-label">Temperature (°C)</label>
                            <input type="text" name="temperature" class="form-control @error('temperature') is-invalid @enderror" placeholder="e.g. 37.5" value="{{ old('temperature') }}">
                            @error('temperature')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Blood Pressure --}}
                        <div class="col-12">
                            <label class="form-label">Blood Pressure</label>
                            <input type="text" name="blood_pressure" class="form-control @error('blood_pressure') is-invalid @enderror" placeholder="e.g. 120/80" value="{{ old('blood_pressure') }}">
                            @error('blood_pressure')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Pulse Rate --}}
                        <div class="col-12">
                            <label class="form-label">Pulse Rate (bpm)</label>
                            <input type="text" name="pulse_rate" class="form-control @error('pulse_rate') is-invalid @enderror" placeholder="e.g. 75" value="{{ old('pulse_rate') }}">
                            @error('pulse_rate')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Treatment Given --}}
                        <div class="col-12">
                            <label class="form-label">Treatment Given</label>
                            <textarea name="treatment_given" class="form-control @error('treatment_given') is-invalid @enderror" rows="2">{{ old('treatment_given') }}</textarea>
                            @error('treatment_given')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nurse Notes --}}
                        <div class="col-12">
                            <label class="form-label">Notes</label>
                            <textarea name="nurse_notes" class="form-control @error('nurse_notes') is-invalid @enderror" rows="2">{{ old('nurse_notes') }}</textarea>
                            @error('nurse_notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Referred To --}}
                        <div class="col-12 @if(old('status')=='referred') d-block @else d-none @endif" id="referredToField">
                            <label class="form-label">Referred To</label>
                            <input type="text" name="referred_to" class="form-control @error('referred_to') is-invalid @enderror" placeholder="e.g. City Hospital" value="{{ old('referred_to') }}">
                            @error('referred_to')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Emergency Checkbox --}}
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="emergency" id="emergencyCheck" value="1" {{ old('emergency') ? 'checked' : '' }}>
                                <label class="form-check-label" for="emergencyCheck">
                                    Mark as Emergency
                                </label>
                            </div>
                        </div>

                        {{-- Submit --}}
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">Save Visit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
