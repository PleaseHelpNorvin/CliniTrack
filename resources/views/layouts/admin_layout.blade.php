<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'School Clinic System')</title>

<link rel="stylesheet" href="{{ asset('Bootstrap5/css/bootstrap.min.css') }}">

</head>
<body>
    {{-- Sidebar --}}
    <div class="bg-light border-end position-fixed" id="sidebar-wrapper" style="width: 250px; height: 100vh; top:0; left:0; z-index: 1040;">
        <div class="sidebar-heading text-center py-4 fs-4 fw-bold text-primary">
            CliniTrack
        </div>
        <div class="list-group list-group-flush">
            <a href="{{ url('/') }}" class="list-group-item list-group-item-action bg-light">Dashboard</a>
            <a href="{{ url('/students') }}" class="list-group-item list-group-item-action bg-light">Students</a>
            <a href="{{ url('/visits') }}" class="list-group-item list-group-item-action bg-light">Visits</a>
            <a href="{{ url('/notifications') }}" class="list-group-item list-group-item-action bg-light">Notifications</a>
            <a href="{{ url('/logout') }}" class="list-group-item list-group-item-action bg-light">Logout</a>
        </div>
    </div>

    {{-- Top Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom position-fixed" style="left:250px; right:0; top:0; z-index: 1030;">
        <div class="container-fluid">
            <span class="navbar-brand ms-3">@yield('page-title', 'Dashboard')</span>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Hello, {{ auth()->user()->name ?? 'User' }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <div id="page-content-wrapper" style="margin-left:250px; margin-top:56px; padding:20px;">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="bg-light py-3 mt-auto border-top text-center" style="margin-left:250px;">
        <div class="container">
            <small>&copy; {{ date('Y') }} School Clinic System. All rights reserved.</small>
        </div>
    </footer>
</body>
<script src="{{ asset('Bootstrap5/js/bootstrap.bundle.min.js') }}"></script>

</html>
