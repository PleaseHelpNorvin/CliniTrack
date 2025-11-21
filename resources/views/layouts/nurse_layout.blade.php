<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Nurse Panel')</title>

  <link rel="stylesheet" href="{{ asset('Bootstrap5/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('Select2_4.0.13/dist/css/select2.min.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('bootstrap-icons/font/bootstrap-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('App/css/custom-card.css') }}">

  <style>
    .list-group-item.active {
      background-color: #0d6efd !important; /* Bootstrap primary blue */
      color: #fff !important;
      font-weight: 600;
    }

    body { overflow-x: hidden; }
    .table-responsive {
        overflow-x: auto !important;
    }

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
      <a href="{{ route('nurse.dashboard') }}" 
        class="list-group-item list-group-item-action bg-light {{ request()->routeIs('nurse.dashboard') ? 'active' : '' }}">
        Dashboard
      </a>

      <a href="{{ route('nurse.students.index') }}" 
        class="list-group-item list-group-item-action bg-light {{ request()->routeIs('nurse.students.*') ? 'active' : '' }}">
        Students
      </a>

      <a href="{{ route('nurse.visits.index') }}" 
        class="list-group-item list-group-item-action bg-light {{ request()->routeIs('nurse.visits.*') ? 'active' : '' }}">
        Visits
      </a>

      <a href="{{ route('nurse.reports.index') }}" 
        class="list-group-item list-group-item-action bg-light {{ request()->routeIs('nurse.reports.*') ? 'active' : '' }}">
        Reports
      </a>
      <a href="{{ route('nurse.referral.index') }}" 
        class="list-group-item list-group-item-action bg-light {{ request()->routeIs('nurse.referral.*') ? 'active' : '' }}">
        referrals
      </a>
        <a href="{{ route('nurse.diagnosis.index', ['visit' => $latestVisit->id ?? 1]) }}" 
            class="list-group-item list-group-item-action bg-light {{ request()->routeIs('nurse.diagnosis.*') ? 'active' : '' }}">
            Diagnosis
        </a>
      {{-- Logout --}}
      <form action="{{ Route('logout') }}" method="POST">
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
<script src="{{ asset('Jquery-3.7.1/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('Bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('Select2_4.0.13/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('Chartjs/Chartjs4.5.1/chart.umd.min.js') }}"></script>
<script src="{{ asset('App/js/chart.js') }}"></script>
<script src="{{ asset('App/js/select.js') }}"></script>
<script src="{{ asset('App/js/popover.js') }}"></script>


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
