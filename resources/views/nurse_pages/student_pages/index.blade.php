@extends('layouts.nurse_layout')

@section('title', 'Student Page')
@section('page-title', 'Student Page')

@section('content')
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

<div class="card mb-4">
    <div class="card-header bg-primary text-white fw-bold d-flex flex-column">
        <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ Route('nurse.students.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Add Student</a>

        </div>


        <!-- Search Form -->
        <form method="GET" action="{{ route('nurse.students.index') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search students..." value="{{ request('search') }}">
                <button class="btn btn-primary">Search</button>
            </div>
        </form>

    </div>
    <div class="card-body">

        <!-- Students Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Grade Level</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        <tr>
                            <td>{{ $student->id }}</td>
                            <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                            <td>{{ $student->email }}</td>
                            <td>
                                {{ 
                                    $student->grade_level 
                                        ? "Grade {$student->grade_level}" 
                                        : $student->grade_level_other ?? 'No Grade'
                                }}
                                -
                                {{ $student->section ?? 'No Section' }}
                            </td>
                            <td>
                                <a href="{{ route('nurse.students.view', $student) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('nurse.students.edit', $student) }}" class="btn btn-sm btn-success">Edit</a>
                                                            
                                <form action="{{ route('nurse.students.destroy', $student) }}" method="POST" class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this student?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No students found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Links -->
        {{ $students->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
