@extends('layouts.admin_layout')

@section('title', 'Confirm Password')
@section('page-title', 'Confirm Your Password Before Accessing Settings')

@section('content')
<div class="container mt-4">
    <h3>Please confirm your password</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('admin.settings.check-password') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Confirm</button>
    </form>
</div>

<script>
    const passwordConfirmUrl = "{{ route('admin.settings.confirm-password') }}";

    setTimeout(() => {
        alert('Password confirmation expired! Please confirm your password again.');
        window.location.href = passwordConfirmUrl;
    }, 300 * 10); // 5 minutes
</script>
@endsection
