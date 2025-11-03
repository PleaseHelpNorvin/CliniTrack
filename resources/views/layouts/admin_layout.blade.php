<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'School Clinic System')</title>

  <link rel="stylesheet" href="{{ asset('Bootstrap5/css/bootstrap.min.css') }}">

  <style>
    body {
      overflow-x: hidden;
    }

    /* Layout Wrapper */
    #wrapper {
      display: flex;
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
      flex-grow: 1;
            transition: all 0.3s ease;

      margin-left: 250px;
    }

    /* Navbar */
    nav.navbar {
      transition: all 0.3s ease;
      /* margin-left: 250px; */
    }

    /* Toggled (Collapsed Sidebar) */
    .toggled #sidebar-wrapper {
      /* margin-left: -250px; */
    }

    .toggled #content-area {
      margin-left: 0;
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
        <a href="{{ url('/') }}" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <a href="{{ url('/students') }}" class="list-group-item list-group-item-action bg-light">Students</a>
        <a href="{{ url('/visits') }}" class="list-group-item list-group-item-action bg-light">Visits</a>
        <a href="{{ url('/notifications') }}" class="list-group-item list-group-item-action bg-light">Notifications</a>
        <a href="{{ url('/logout') }}" class="list-group-item list-group-item-action bg-light">Logout</a>
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
