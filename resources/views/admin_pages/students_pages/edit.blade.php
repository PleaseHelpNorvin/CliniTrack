@extends('layouts.admin_layout')

@section('title', 'Edit Student')
@section('page-title', 'Edit Student')

@section('content')

<div class="card shadow-sm mb-4">
    <div class="card-body">

        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') {{-- Use PUT for updating --}}

            {{-- Profile Image --}}
            <div class="mb-3 text-center">
                <img src="{{ asset('App/images/no-image-default.jpg') }}"
                    alt="Student Photo"
                    class="rounded-circle mb-2"
                    style="width: 120px; height: 120px; object-fit: cover;">
                <input type="file" name="photo" class="form-control mt-2">
            </div>


            {{-- Student Info --}}
            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Student Number</label>
                <div class="col-md-9">
                    <input type="text" name="student_number" class="form-control" value="" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Full Name</label>
                <div class="col-md-9">
                    <input type="text" name="full_name" class="form-control" value="" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Grade & Section</label>
                <div class="col-md-9">
                    <input type="text" name="grade_section" class="form-control" value="" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Date of Birth</label>
                <div class="col-md-9">
                    <input type="date" name="dob" class="form-control" value="" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Contact Number</label>
                <div class="col-md-9">
                    <input type="text" name="contact_number" class="form-control" value="">
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Email</label>
                <div class="col-md-9">
                    <input type="email" name="email" class="form-control" value="">
                </div>
            </div>

            <div class="mb-3 row">
                <label class="col-md-3 col-form-label fw-bold">Address</label>
                <div class="col-md-9">
                    <textarea name="address" class="form-control"></textarea>
                </div>
            </div>

            {{-- Buttons --}}
            <div class="text-end">
                <a href="{{ Route('admin.students.view') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-success">Update Student</button>
            </div>

        </form>

    </div>
</div>

@endsection