@extends('layouts.admin_layout')

@section('title', 'Student Index')

@section('page-title', 'Student Index')

@section('content')
<!-- <div class="container"> -->
<h1 class="mb-4">Student Module</h1>
<a href="{{ Route('admin.students.create') }}" class="btn btn-primary mb-3">Add Student</a>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="" method="GET" class="row g-2 mb-4">
    <div class="col-md-6">
        <input type="text" name="search" class="form-control" placeholder="Search name or email..." value="{{ request('search') }}">
    </div>
    <div class="col-md-3">
        <button class="btn btn-secondary w-100">Search</button>
    </div>
    <div class="col-md-3">
        <a href="{{ route('admin.students.index') }}" class="btn btn-outline-dark w-100">Reset</a>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-bordered w-100">
        <thead>
            <tr>
                <th>#</th>
                <th>Student Number</th>
                <th>Name</th>
                <th>Email</th>
                <th>Grade - Section</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($students as $student)
            <tr>
                <td>{{ $loop->iteration + ($students->currentPage() - 1) * $students->perPage() }}</td>
                <td>{{ $student->student_number }}</td>
                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->grade_text }} - {{ $student->section_text }}</td>
                <td>
                    <a href="{{ route('admin.students.view', $student->id) }}" class="btn btn-primary btn-sm">View</a>
                    <a href="{{ route('admin.students.edit', $student->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.students.destroy', $student) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Delete this student?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No students found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Pagination Links --}}
    <div>
        {{ $students->links() }}
    </div>
</div>
<!-- </div> -->
@endsection

<!-- List Students


Add Student


Edit Student


Delete Student


View student profile + visit history -->