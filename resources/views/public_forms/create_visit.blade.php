@extends('layouts.public_layout')

@section('title', 'Add Visit')
@section('page-title', 'Add New Visit')

@section('content')
<div class="container my-5">

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8"><!-- Makes the card smaller & centered -->
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-center mb-4 fw-bold">Make A Visit</h3>

                    <form action="{{ route('public.visit.store') }}" method="POST" class="row g-3">
                        @csrf

                        <div class="col-12">
                            <label class="form-label">Select Student</label>
                            <select name="student_id" id="studentSelect" class="form-select @error('student_id') is-invalid @enderror">
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

                        <div class="col-12">
                            <label class="form-label">Visit Date/Time</label>
                            <input type="datetime-local" name="visited_at" class="form-control @error('visited_at') is-invalid @enderror" value="{{ old('visited_at') }}">
                            @error('visited_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label">Reason</label>
                            <select name="reason" class="form-select @error('reason') is-invalid @enderror" id="reasonSelect">
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

                        <div class="col-12 d-none" id="otherReasonField">
                            <label class="form-label">Please specify</label>
                            <input type="text" name="other_reason" class="form-control @error('other_reason') is-invalid @enderror" value="{{ old('other_reason') }}" placeholder="Enter reason">
                            @error('other_reason')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="emergency" value="1" id="emergencyCheck">
                                <label class="form-check-label" for="emergencyCheck">
                                    Mark as Emergency
                                </label>
                            </div>
                        </div>

                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">Request Visit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection