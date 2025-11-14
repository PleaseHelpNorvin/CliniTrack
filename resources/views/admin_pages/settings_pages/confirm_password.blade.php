@extends('layouts.admin_layout')

@section('title', 'Confirm your password')
@section('page-title', 'Confirm your password')

@section('content')
<div class="container mt-5" style="max-width: 500px;">
    <div class="card shadow-sm">
        <div class="card-header bg-white fw-bold">
            Confirm Your Password
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.settings.check-password') }}">
                @csrf

                <div class="mb-3">
                    <label for="password" class="form-label">Enter your password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Confirm Password</button>
            </form>
        </div>
    </div>
</div>
@endsection
