<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CliniTrack</title>

    <!-- Local Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('Bootstrap5/css/bootstrap.min.css') }}">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="card shadow-sm" style="width: 400px;">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">CliniTrack Login</h3>

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" 
                           class="form-control @error('password') is-invalid @enderror" 
                           id="password" 
                           name="password" 
                           required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>

                <div class="text-center">
                    <a href="">Forgot your password?</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Local Bootstrap JS -->
<script src="{{ asset('Bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
