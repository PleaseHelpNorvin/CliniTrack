<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CliniTrack - Student Forms</title>
    <link rel="stylesheet" href="{{ asset('Bootstrap5/css/bootstrap.min.css') }}">

    <style>
        .hover-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="{{ route('landing') }}">
            CliniTrack
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-sm">
                        Login
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO SECTION -->
<div class="py-5 bg-primary text-white text-center">
    <h1 class="fw-bold mb-3">Welcome to CliniTrack</h1>
    <p class="lead">Track your student clinical records easily by filling out required forms</p>
</div>

<!-- INSTRUCTIONS FOR STUDENTS -->
<div class="container my-5">
    <h3 class="text-center fw-bold mb-4">What You Need To Do</h3>

    <div class="row text-center">
        <div class="col-md-4 mb-4">
            <div class="p-4 shadow-sm rounded bg-white h-100">
                <i class="bi bi-ui-checks fs-1 text-primary mb-3"></i>
                <h5 class="fw-bold">1. Fill Your Forms</h5>
                <p class="text-muted">Complete your profile and any forms assigned to you by the clinic.</p>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="p-4 shadow-sm rounded bg-white h-100">
                <i class="bi bi-clipboard-plus fs-1 text-primary mb-3"></i>
                <h5 class="fw-bold">2. Submit Your Visit</h5>
                <p class="text-muted">Record your clinical visit details whenever you go to the school clinic.</p>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="p-4 shadow-sm rounded bg-white h-100">
                <i class="bi bi-check2-circle fs-1 text-primary mb-3"></i>
                <h5 class="fw-bold">3. Wait for Review</h5>
                <p class="text-muted">Your submissions will be reviewed and stored by the school clinic staff.</p>
            </div>
        </div>
    </div>
</div>

<!-- AVAILABLE FORMS -->
<div class="container my-5">
    <h3 class="text-center mb-4">Available Forms</h3>

    <div class="row justify-content-center">
        @forelse ($forms as $form)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm border-0 h-100 hover-card">
                    <div class="card-body text-center">
                        <i class="bi bi-file-earmark-text fs-1 text-primary mb-3"></i>
                        <h5 class="card-title fw-bold">{{ $form->name }}</h5>
                        <p class="text-muted">{{ $form->description ?? 'No description' }}</p>
                        <a href="{{ $form->link }}" class="btn btn-primary w-100" target="_blank">
                            Fill Form
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted text-center">No active forms available at the moment.</p>
        @endforelse
    </div>
</div>

<!-- CTA -->
<!-- <div class="py-5 bg-primary text-white text-center">
    <h2 class="fw-bold">Ready to submit your forms?</h2>
    <p class="mb-4">Click any form above to start your clinical record.</p>
    <a href="{{ route('login') }}" class="btn btn-light btn-lg fw-bold">Login to Start</a>
</div> -->

<!-- FOOTER -->
<footer class="text-center py-3 text-muted">
    <small>© {{ date('Y') }} CliniTrack | All Rights Reserved</small>
</footer>

</body>
</html>
