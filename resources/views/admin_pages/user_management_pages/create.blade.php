@extends('layouts.admin_layout')

@section('page-title', 'Add User')

@section('content')
<!-- <div class="container mt-4"> -->

<form action="{{ route('admin.users.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Name</label>
        <input name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input name="email" type="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input name="password" type="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Role</label>
        <select name="role" class="form-control">
            <option value="admin">Admin</option>
            <option value="nurse">Nurse</option>
        </select>
    </div>

    <button class="btn btn-success">Save</button>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>

</form>

<!-- </div> -->
@endsection
