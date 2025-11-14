<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'School Clinic System')</title>

  <link rel="stylesheet" href="{{ asset('Bootstrap5/css/bootstrap.min.css') }}">

  <style>
    .list-group-item.active {
        background-color: #0d6efd !important; /* Bootstrap Primary Blue */
        color: white !important;
        font-weight: bold;
        border-color: #0d6efd !important;
    }
    html, body {
      height: 100%;
    }
    
    body {
      overflow-x: hidden;
    }

    footer {
      margin-top: auto;
    }

    /* Layout Wrapper */
    #wrapper {
      display: flex;
      min-height: 100vh;
      width: 100%;
      transition: all 0.3s ease;
    }

    /* Sidebar */
    #sidebar-wrapper {
      width: 250px;
      height: 100vh;
      transition: all 0.3s ease;
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1040;
    }

    /* Page Content Area */
    #content-area {
      min-height: calc(100vh - 56px);
      margin-left: 250px;
      display: flex;
      flex-direction: column;
      transition: all 0.3s ease;
    }

    /* Navbar */
    nav.navbar {
      transition: all 0.3s ease;
      /* margin-left: 250px; */
    }

    /* Toggled (Collapsed Sidebar) */
    /* .toggled #sidebar-wrapper {
      margin-left: -250px;
    } */

    .toggled #content-area {
      /* margin-left: 0; //current */
      margin-left: 250px; /* pushes content when sidebar shows */

    }

    .toggled nav.navbar {
      margin-left: 0;
    }

    /* For small screens (mobile/tablet) */
    @media (max-width: 992px) {
      #sidebar-wrapper {
        margin-left: -250px;
      }

      #content-area {
        margin-left: 0;
      }

      nav.navbar {
        margin-left: 0;
      }

      .toggled #sidebar-wrapper {
        margin-left: 0;
      }

      .toggled #content-area {
        margin-left: 250px;
      }


      /* .toggled nav.navbar {
        margin-left: 250px;
      } */
    }
    #menu-toggle {
        display: none;
    }

    @media (max-width: 992px) {
        #menu-toggle {
            display: inline-block;
        }
    }

  </style>
</head>

<body>
  <div id="wrapper">
    {{-- Sidebar --}}
    <div class="bg-light border-end" id="sidebar-wrapper">
      <div class="sidebar-heading text-center py-4 fs-4 fw-bold text-primary">
        CliniTrack
      </div>
      <div class="list-group list-group-flush">
        <a href="{{ route('admin.dashboard') }}" 
          class="list-group-item list-group-item-action bg-light {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          Dashboard
        </a>

        <a href="{{ route('admin.users.index') }}" 
          class="list-group-item list-group-item-action bg-light {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
          User Management
        </a>

        <a href="{{ route('admin.students.index') }}" 
          class="list-group-item list-group-item-action bg-light {{ request()->routeIs('admin.students.*') ? 'active' : '' }}">
          Students Module
        </a>

        <a href="{{ route('admin.reports.index') }}" 
          class="list-group-item list-group-item-action bg-light {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
          Clinic Reports
        </a>

        <a href="{{ route('admin.logs.index') }}" 
          class="list-group-item list-group-item-action bg-light {{ request()->routeIs('admin.logs.*') ? 'active' : '' }}">
          Activity Logs
        </a>

        <a href="{{ route('admin.settings.index') }}" 
          class="list-group-item list-group-item-action bg-light {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
          Profile / Settings
        </a>

          <form action="{{ Route('logout') }}" method="POST">
            @csrf
            <button class="list-group-item list-group-item-action bg-light">Logout</button>
          </form>
      </div>
    </div>

    {{-- Content Wrapper --}}
    <div id="content-area" class="w-100">
      {{-- Top Navbar --}}
      <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom position-fixed w-100" style="top:0; z-index:1030;">
        <div class="container-fluid d-flex justify-content-between align-items-center">
          <div class="d-flex align-items-center">
            <button class="btn btn-outline-primary me-2" id="menu-toggle">☰</button>
            <span class="navbar-brand mb-0">@yield('page-title', 'Dashboard')</span>
          </div>

          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="#">Hello, Guest</a>
            </li>
          </ul>
        </div>
      </nav>

      {{-- Main Content --}}
      <div class="container-fluid" style="padding:20px; margin-top:56px; margin-right:auto">
        @yield('content')
      </div>

      {{-- Footer --}}
      <footer class="bg-light py-3 mt-auto border-top text-center">
        <div class="container">
          <small>&copy; {{ date('Y') }} School Clinic System. All rights reserved.</small>
        </div>
      </footer>
    </div>
  </div>

  <script src="{{ asset('Bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('Chartjs/Chartjs4.5.1/chart.umd.min.js') }}"></script>
  <script src="{{ asset('App/js/chart.js') }}"></script>
  <script src="{{ asset('App/js/copyclipboard.js')}}"></script>

  <script>
    const menuToggle = document.getElementById('menu-toggle');
    const wrapper = document.getElementById('wrapper');

    menuToggle.addEventListener('click', () => {
      wrapper.classList.toggle('toggled');
    });

    window.addEventListener('resize', () => {
        if (window.innerWidth > 992) {
            wrapper.classList.remove('toggled');
        }
    });
  </script>
</body>
</html>
