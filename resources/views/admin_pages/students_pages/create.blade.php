@extends('layouts.admin_layout')

@section('title', 'Add Student')
@section('page-title', 'Add Student')

@section('content')

<div class="card shadow-sm mb-4">
    <div class="card-body">

        <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- ✅ Show global validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>There were some errors:</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ✅ Profile Image --}}
            <div class="mb-3 text-center">
                <img id="photoPreview" src="{{ asset('App/images/no-image-default.jpg') }}"
                    alt="Student Photo"
                    class="mb-2"
                    style="width: 150px; height: 150px; object-fit: cover; border: 1px solid #ccc;">
                
                <input type="file" name="photo" 
                    class="form-control mt-2 @error('photo') is-invalid @enderror"
                    onchange="previewPhoto(this)">
                
                @error('photo')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            {{-- Student Number --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Student Number</label>
                <div class="col-md-9">
                    <input type="text" name="student_number"
                        class="form-control @error('student_number') is-invalid @enderror"
                        value="{{ old('student_number') }}">

                    @error('student_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            {{-- First Name --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">First Name</label>
                <div class="col-md-9">
                    <input type="text" name="first_name"
                        class="form-control @error('first_name') is-invalid @enderror"
                        value="{{ old('first_name') }}">

                    @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            {{-- Last Name --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Last Name</label>
                <div class="col-md-9">
                    <input type="text" name="last_name"
                        class="form-control @error('last_name') is-invalid @enderror"
                        value="{{ old('last_name') }}">

                    @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            {{-- Grade Level --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Grade Level</label>
                <div class="col-md-9">
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
            </div>


            {{-- Section --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Section</label>
                <div class="col-md-9">
                    <input type="text" name="section"
                        class="form-control @error('section') is-invalid @enderror"
                        value="{{ old('section') }}">

                    @error('section')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            {{-- DOB --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Date of Birth</label>
                <div class="col-md-9">
                    <input type="date" name="dob"
                        class="form-control @error('dob') is-invalid @enderror"
                        value="{{ old('dob') }}">

                    @error('dob')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            {{-- Contact Number --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Contact Number</label>
                <div class="col-md-9">
                    <input type="text" name="contact_number"
                        class="form-control @error('contact_number') is-invalid @enderror"
                        value="{{ old('contact_number') }}">

                    @error('contact_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            {{-- Email --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Email</label>
                <div class="col-md-9">
                    <input type="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}">

                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            {{-- Address --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Address</label>
                <div class="col-md-9">
                    <textarea name="address"
                        class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>

                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            {{-- Documents --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Upload Documents</label>
                <div class="col-md-9">
                    <input type="file" name="documents[]"
                        class="form-control @error('documents.*') is-invalid @enderror"
                        multiple>

                    @error('documents.*')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Buttons --}}
            <div class="text-end">
                <a href="{{ route('admin.students.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-success">Add Student</button>
            </div>

        </form>

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
