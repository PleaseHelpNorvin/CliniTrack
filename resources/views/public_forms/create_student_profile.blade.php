@extends('layouts.public_layout')

@section('title', 'Student Profile Form')
@section('page-title', 'Student Profile Form')

@section('content')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-center mb-4 fw-bold">Student Profile Form</h3>

                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success text-center">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('public.students.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Profile Image --}}
                        <div class="mb-3 text-center">
                            <img id="photoPreview" src="{{ asset('App/images/no-image-default.jpg') }}"
                                alt="Student Photo"
                                class="mb-2 rounded-circle"
                                style="width: 150px; height: 150px; object-fit: cover; border: 1px solid #ccc;">
                            
                            <input type="file" name="photo" 
                                class="form-control mt-2 @error('photo') is-invalid @enderror"
                                onchange="previewPhoto(this)">
                            
                            @error('photo')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Student Number --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Student Number</label>
                            <input type="text" name="student_number"
                                class="form-control @error('student_number') is-invalid @enderror"
                                value="{{ old('student_number') }}">
                            @error('student_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- First Name --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">First Name</label>
                            <input type="text" name="first_name"
                                class="form-control @error('first_name') is-invalid @enderror"
                                value="{{ old('first_name') }}">
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Last Name --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Last Name</label>
                            <input type="text" name="last_name"
                                class="form-control @error('last_name') is-invalid @enderror"
                                value="{{ old('last_name') }}">
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Grade Level --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Grade Level</label>
                            <select name="grade_level" 
                                class="form-select @error('grade_level') is-invalid @enderror"
                                id="grade_level_select">
                                <option value="">-- Select Grade --</option>
                                <option value="11" {{ old('grade_level') == 11 ? 'selected' : '' }}>Grade 11</option>
                                <option value="12" {{ old('grade_level') == 12 ? 'selected' : '' }}>Grade 12</option>
                                <option value="21" {{ old('grade_level') == 21 ? 'selected' : '' }}>1st Year College</option>
                                <option value="22" {{ old('grade_level') == 22 ? 'selected' : '' }}>2nd Year College</option>
                                <option value="23" {{ old('grade_level') == 23 ? 'selected' : '' }}>3rd Year College</option>
                                <option value="24" {{ old('grade_level') == 24 ? 'selected' : '' }}>4th Year College</option>
                                <option value="0"  {{ old('grade_level') == 0  ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('grade_level')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <input type="text" name="grade_level_other"
                                class="form-control mt-2 @error('grade_level_other') is-invalid @enderror"
                                id="grade_level_other"
                                placeholder="Type other grade..."
                                value="{{ old('grade_level_other') }}"
                                style="display:none;">
                            @error('grade_level_other')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Section --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Section</label>
                            <input type="text" name="section"
                                class="form-control @error('section') is-invalid @enderror"
                                value="{{ old('section') }}">
                            @error('section')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- DOB --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Date of Birth</label>
                            <input type="date" name="dob"
                                class="form-control @error('dob') is-invalid @enderror"
                                value="{{ old('dob') }}">
                            @error('dob')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Contact Number --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Contact Number</label>
                            <input type="text" name="contact_number"
                                class="form-control @error('contact_number') is-invalid @enderror"
                                value="{{ old('contact_number') }}">
                            @error('contact_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Address --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Address</label>
                            <textarea name="address"
                                class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Allergies --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Allergies</label>
                            <input type="text" name="allergies"
                                class="form-control @error('allergies') is-invalid @enderror"
                                value="{{ old('allergies') }}"
                                placeholder="Enter allergies if any">
                            @error('allergies')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Medical Notes --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">Medical Notes</label>
                            <textarea name="medical_notes"
                                class="form-control @error('medical_notes') is-invalid @enderror"
                                placeholder="Enter any medical notes">{{ old('medical_notes') }}</textarea>
                            @error('medical_notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">Submit Profile</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const gradeSelect = document.getElementById('grade_level_select');
    const gradeOther = document.getElementById('grade_level_other');

    function previewPhoto(input) {
        const preview = document.getElementById('photoPreview');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => preview.src = e.target.result;
            reader.readAsDataURL(input.files[0]);
        }
    }

    function toggleOtherInput() {
        if (gradeSelect.value == '0') {
            gradeOther.style.display = 'block';
        } else {
            gradeOther.style.display = 'none';
            gradeOther.value = '';
        }
    }

    gradeSelect.addEventListener('change', toggleOtherInput);
    toggleOtherInput();
</script>

@endsection
