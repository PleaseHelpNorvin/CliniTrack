@extends('layouts.admin_layout')

@section('title', 'Activity Logs Index')
@section('page-title', 'Activity Logs Index')

@section('content')
<div class="card ">
    <div class="card-body">
        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search logs..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Role</th>
                    <th>Action</th>
                    <th>Description</th>
                    <th>IP Address</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->user_name }}</td>
                        <td>{{ ucfirst($log->role) }}</td>
                        <td>{{ $log->action }}</td>
                        <td>{{ $log->description ?? '-' }}</td>
                        <td>{{ $log->ip_address ?? '-' }}</td>
                        <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No activity logs found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $logs->links('pagination::bootstrap-5') }}

    </div>
</div>
@endsection
