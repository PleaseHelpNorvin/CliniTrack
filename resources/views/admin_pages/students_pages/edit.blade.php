@extends('layouts.admin_layout')

@section('title', 'Edit Student')
@section('page-title', 'Edit Student')

@section('content')

<div class="card shadow-sm mb-4">
    <div class="card-body">

        <form action="{{ route('admin.students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- ✅ Profile Image --}}
            <div class="mb-3 text-center">
                <img src="{{ $student->photo ? asset('storage/'.$student->photo) : asset('App/images/no-image-default.jpg') }}"
                    alt="Student Photo"
                    class="rounded-circle mb-2"
                    style="width: 120px; height: 120px; object-fit: cover;">
                
                <input type="file" name="photo" class="form-control mt-2">
            </div>

            {{-- ✅ Student Number --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Student Number</label>
                <div class="col-md-9">
                    <input type="text" name="student_number" class="form-control"
                        value="{{ old('student_number', $student->student_number) }}" required>
                </div>
            </div>

            {{-- ✅ First Name --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">First Name</label>
                <div class="col-md-9">
                    <input type="text" name="first_name" class="form-control"
                        value="{{ old('first_name', $student->first_name) }}" required>
                </div>
            </div>

            {{-- ✅ Last Name --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Last Name</label>
                <div class="col-md-9">
                    <input type="text" name="last_name" class="form-control"
                        value="{{ old('last_name', $student->last_name) }}" required>
                </div>
            </div>

            {{-- ✅ Grade Level --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Grade Level</label>
                <div class="col-md-9">

                    <select name="grade_level" id="grade_level_select" class="form-select">
                        <option value="">-- Select Grade --</option>
                        <option value="11" {{ $student->grade_level == 11 ? 'selected' : '' }}>Grade 11</option>
                        <option value="12" {{ $student->grade_level == 12 ? 'selected' : '' }}>Grade 12</option>
                        <option value="21" {{ $student->grade_level == 21 ? 'selected' : '' }}>1st Year College</option>
                        <option value="22" {{ $student->grade_level == 22 ? 'selected' : '' }}>2nd Year College</option>
                        <option value="23" {{ $student->grade_level == 23 ? 'selected' : '' }}>3rd Year College</option>
                        <option value="24" {{ $student->grade_level == 24 ? 'selected' : '' }}>4th Year College</option>
                        <option value="0" {{ $student->grade_level == 0 ? 'selected' : '' }}>Other</option>
                    </select>

                    {{-- ✅ Other Grade Input --}}
                    <input type="text" name="grade_level_other" class="form-control mt-2"
                        id="grade_level_other"
                        value="{{ $student->grade_level_other }}"
                        style="{{ $student->grade_level == 0 ? '' : 'display:none;' }}"
                        placeholder="Type other grade...">
                </div>
            </div>

            {{-- ✅ Section --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Section</label>
                <div class="col-md-9">
                    <input type="text" name="section" class="form-control"
                        value="{{ old('section', $student->section) }}">
                </div>
            </div>

            {{-- ✅ DOB --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Date of Birth</label>
                <div class="col-md-9">
                    <input type="date" name="dob" class="form-control"
                        value="{{ old('dob', $student->dob ? $student->dob->format('Y-m-d') : '') }}">
                </div>
            </div>

            {{-- ✅ Contact --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Contact Number</label>
                <div class="col-md-9">
                    <input type="text" name="contact_number" class="form-control"
                        value="{{ old('contact_number', $student->contact_number) }}">
                </div>
            </div>

            {{-- ✅ Email --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Email</label>
                <div class="col-md-9">
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email', $student->email) }}">
                </div>
            </div>

            {{-- ✅ Address --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Address</label>
                <div class="col-md-9">
                    <textarea name="address" class="form-control">{{ old('address', $student->address) }}</textarea>
                </div>
            </div>
           

            {{-- ✅ Buttons --}}
            <div class="text-end">
                <a href="{{ route('admin.students.view', $student->id ) }}" class="btn btn-secondary me-2">
                    Cancel
                </a>
                <button type="submit" class="btn btn-success">Update Student</button>
            </div>

        </form>
    </div>
</div>

<script>
document.getElementById('grade_level_select').addEventListener('change', function () {
    let other = document.getElementById('grade_level_other');
    other.style.display = this.value == 0 ? 'block' : 'none';
});
</script>

@endsection
