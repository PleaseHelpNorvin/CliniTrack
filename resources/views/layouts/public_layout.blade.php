<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | CliniTrack</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('Bootstrap5/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Select2_4.0.13/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('App/css/public.css') }}">
</head>
<body class="bg-light">

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">CliniTrack</a>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white text-center py-3 shadow-sm mt-4">
        &copy; {{ date('Y') }} CliniTrack. All rights reserved.
    </footer>

    <!-- Bootstrap JS -->
     <script src="{{ asset('Jquery-3.7.1/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('Bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Select2_4.0.13/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('App/js/select.js') }}"></script>

</body>
</html>
