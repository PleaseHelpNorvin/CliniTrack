@extends('layouts.admin_layout')

@section('title', 'Upload Document')

@section('content')

<div class="container mt-4">

    <h3>Upload Document for {{ $student->first_name }} {{ $student->last_name }} (Student #{{ $student->student_number }})</h3>

    <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data" class="mt-3">
        @csrf

        <input type="hidden" name="student_id" value="{{ $student->id }}">

        <div class="mb-3">
            <label class="form-label">Document Name</label>
            <input type="text" name="name" class="form-control" placeholder="e.g. Medical Record" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Select File</label>
            <input type="file" name="file" class="form-control" required>
        </div>

        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>

</div>

@endsection
