@extends('layouts.admin_layout')

@section('page-title', 'Edit User')

@section('content')
<!-- <div class="container"> -->

    <h3 class="mb-3">Edit User {{$user->name}}</h3>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        <!-- @method('POST') -->

        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input 
                type="text" 
                name="name" 
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}"
                required
            >
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input 
                type="email" 
                name="email" 
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}"
                required
            >
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select 
                name="role" 
                class="form-select @error('role') is-invalid @enderror"
                required
            >
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="nurse" {{ $user->role == 'nurse' ? 'selected' : '' }}>Nurse</option>
            </select>
            @error('role')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <hr>

        <div class="mb-3">
            <label class="form-label">Password (leave blank to keep current)</label>
            <input 
                type="password" 
                name="password" 
                class="form-control @error('password') is-invalid @enderror"
            >
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <small class="text-muted fst-italic">
                Leave empty if you don't want to change password.
            </small>
        </div>

        <button class="btn btn-success">Update User</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>

    </form>

<!-- </div> -->
@endsection
