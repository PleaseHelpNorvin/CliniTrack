<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Nurse Panel')</title>

  <link rel="stylesheet" href="{{ asset('Bootstrap5/css/bootstrap.min.css') }}">

  <style>
    body { overflow-x: hidden; }

    #wrapper { display:flex; width:100%; transition:0.3s; }
    #sidebar-wrapper { width:250px; height:100vh; position:fixed; top:0; left:0; background:#f8f9fa; transition: all 0.3s ease;  }
    #content-area { flex-grow:1; margin-left:250px; transition:0.3s; }
    nav.navbar { transition:0.3s; }

    @media (max-width: 992px){
      #sidebar-wrapper { margin-left:-250px; }
      #content-area { margin-left:0; }
      .toggled #sidebar-wrapper { margin-left:0; }
      .toggled #content-area { margin-left:250px; }
    }
    #menu-toggle{ display:none; }
    @media(max-width:992px){ #menu-toggle{ display:inline-block; } }
  </style>
</head>

<body>
<div id="wrapper">

  {{-- Sidebar --}}
  <div id="sidebar-wrapper" class="border-end">
    <div class="sidebar-heading text-center py-4 fs-4 fw-bold text-primary">
      Nurse Dashboard
    </div>

    <div class="list-group list-group-flush">
      <a href="{{ url('/nurse') }}" class="list-group-item list-group-item-action bg-light">Dashboard</a>
      <a href="{{ url('/nurse/patients') }}" class="list-group-item list-group-item-action bg-light">Patients</a>
      <a href="{{ url('/nurse/visits') }}" class="list-group-item list-group-item-action bg-light">Visits</a>
      <a href="{{ url('/nurse/reports') }}" class="list-group-item list-group-item-action bg-light">Reports</a>

      {{-- Logout --}}
      <form action="{{ url('/logout') }}" method="POST">
        @csrf
        <button class="list-group-item list-group-item-action bg-light border-0 text-start">Logout</button>
      </form>
    </div>
  </div>

  {{-- Content --}}
  <div id="content-area">
    
    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom position-fixed w-100" style="top:0; z-index:1030;">
      <div class="container-fluid">
        <button class="btn btn-outline-primary me-2" id="menu-toggle">☰</button>
        <span class="navbar-brand">@yield('page-title', 'Dashboard')</span>
      </div>
    </nav>

    <div class="container-fluid" style="padding:20px; margin-top:56px;">
      @yield('content')
    </div>

  </div>
</div>

<script src="{{ asset('Bootstrap5/js/bootstrap.bundle.min.js') }}"></script>

<script>
  const wrapper = document.getElementById('wrapper');
  const toggle = document.getElementById('menu-toggle');

  toggle.addEventListener('click', () => wrapper.classList.toggle('toggled'));
  window.addEventListener('resize', () => {
    if(window.innerWidth > 992) wrapper.classList.remove('toggled');
  });
</script>

</body>
</html>
