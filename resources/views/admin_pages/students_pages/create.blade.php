@extends('layouts.admin_layout')

@section('title', 'Add Student')
@section('page-title', 'Add Student')

@section('content')

<div class="card shadow-sm mb-4">
    <div class="card-body">

        <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Profile Image --}}
            <div class="mb-3 text-center">
                <img id="photoPreview" src="{{ asset('App/images/no-image-default.jpg') }}"
                    alt="Student Photo"
                    class="mb-2"
                    style="width: 150px; height: 150px; object-fit: cover; border: 1px solid #ccc;">
                <input type="file" name="photo" class="form-control mt-2" onchange="previewPhoto(this)">
            </div>


            {{-- Student Info --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Student Number</label>
                <div class="col-md-9">
                    <input type="text" name="student_number" class="form-control" value="{{ old('student_number') }}" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">First Name</label>
                <div class="col-md-9">
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Last Name</label>
                <div class="col-md-9">
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Grade Level</label>
                <div class="col-md-9">
                    <select name="grade_level" class="form-select" id="grade_level_select">
                        <option value="">-- Select Grade --</option>
                        <option value="11">Grade 11</option>
                        <option value="12">Grade 12</option>
                        <option value="21">1st Year College</option>
                        <option value="22">2nd Year College</option>
                        <option value="23">3rd Year College</option>
                        <option value="24">4th Year College</option>
                        <option value="0">Other</option>
                    </select>

                    <input type="text" name="grade_level_other" class="form-control mt-2" 
                        id="grade_level_other" 
                        placeholder="Type other role..." 
                        value="{{ old('grade_level_other') }}"
                        style="display:none;">
    
                </div>
            </div>
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Section</label>
                <div class="col-md-9">
                    <input type="text" name="section" class="form-control" value="{{ old('section') }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Date of Birth</label>
                <div class="col-md-9">
                    <input type="date" name="dob" class="form-control" value="{{ old('dob') }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Contact Number</label>
                <div class="col-md-9">
                    <input type="text" name="contact_number" class="form-control" value="{{ old('contact_number') }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Email</label>
                <div class="col-md-9">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Address</label>
                <div class="col-md-9">
                    <textarea name="address" class="form-control">{{ old('address') }}</textarea>
                </div>
            </div>

            {{-- Documents --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Upload Documents</label>
                <div class="col-md-9">
                    <input type="file" name="documents[]" class="form-control" multiple>
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
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function toggleOtherInput() {
        if(gradeSelect.value == '0') {
            gradeOther.style.display = 'block';
        } else {
            gradeOther.style.display = 'none';
            gradeOther.value = '';
        }
    }

    // Run on change
    gradeSelect.addEventListener('change', toggleOtherInput);

    // Run on page load in case old value is "Other"
    toggleOtherInput(); // Run once on page load
</script>
@endsection
