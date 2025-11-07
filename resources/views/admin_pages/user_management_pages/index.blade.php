@extends('layouts.admin_layout')

@section('title', 'User Index')

@section('page-title', 'User Index')

@section('content')
<div class="card shadow-sm mb-4">
    <div class="card-body">
<!-- <div class="container"> -->
    <!-- <h1 class="mb-4">Manage your Users</h1> -->

    <a href="{{ route('admin.users.create') }}" class="btn btn-primary mb-3">Add User</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.users.index') }}" method="GET" class="row mb-4">
        <div class="col-md-8">
            <input type="text" name="search" class="form-control" placeholder="Search name or email..."
                value="{{ request('search') }}">
        </div>

        <div class="col-md-2">
            <select name="role" class="form-select">
                <option value="all" {{ request('role') == 'all' ? 'selected' : '' }}>All Roles</option>
                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="nurse" {{ request('role') == 'nurse' ? 'selected' : '' }}>Nurse</option>
            </select>
        </div>

        <div class="col-md-1">
            <button class="btn btn-secondary w-100">Filter</button>
        </div>

        <div class="col-md-1">
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark w-100">Reset</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered w-100">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th width="200px">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.users.destroy',$user->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>    
        </table>
    </div>

    {{ $users->links('pagination::bootstrap-5') }}

<!-- </div> -->
</div>
</div>
@endsection

<!-- ✅ View all users


➕ Add user (admin/nurse/staff)


✏️ Edit user


🗑 Delete user


Search & filter by role

 -->
