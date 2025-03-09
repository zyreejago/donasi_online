<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  
  <title>@yield('title') - Yayasan Donasi</title>
  
  <!-- Favicon -->
  <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
  
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  
  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  
  <style>
      body {
          font-family: 'Poppins', sans-serif;
          background-color: #f8f9fa;
      }
      
      .sidebar {
          position: fixed;
          top: 0;
          left: 0;
          bottom: 0;
          width: 250px;
          background-color: #fff;
          box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
          z-index: 1000;
          transition: all 0.3s;
      }
      
      .sidebar-header {
          padding: 1.5rem 1rem;
          border-bottom: 1px solid #e9ecef;
      }
      
      .sidebar-menu {
          padding: 1rem 0;
      }
      
      .sidebar-menu .nav-link {
          padding: 0.75rem 1.5rem;
          color: #495057;
          font-weight: 500;
          display: flex;
          align-items: center;
      }
      
      .sidebar-menu .nav-link i {
          margin-right: 0.75rem;
          font-size: 1.25rem;
      }
      
      .sidebar-menu .nav-link.active {
          color: #0d6efd;
          background-color: rgba(13, 110, 253, 0.1);
      }
      
      .sidebar-menu .nav-link:hover {
          background-color: rgba(0, 0, 0, 0.05);
      }
      
      .main-content {
          margin-left: 250px;
          transition: all 0.3s;
      }
      
      .navbar {
          background-color: #fff;
          box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
      }
      
      .navbar-toggler {
          padding: 0.25rem;
      }
      
      .dropdown-menu {
          border: none;
          box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
      }
      
      @media (max-width: 991.98px) {
          .sidebar {
              transform: translateX(-100%);
          }
          
          .sidebar.show {
              transform: translateX(0);
          }
          
          .main-content {
              margin-left: 0;
          }
      }
  </style>
  
  @stack('styles')
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
      <div class="sidebar-header">
          <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-decoration-none">
              <img src="{{ asset('images/logo.png') }}" alt="Yayasan Donasi" height="40">
          </a>
      </div>
      
      <div class="sidebar-menu">
          <ul class="nav flex-column">
              <li class="nav-item">
                  <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                      <i class="bi bi-house"></i> Dashboard
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('donasi') }}" class="nav-link {{ request()->routeIs('donasi') ? 'active' : '' }}">
                      <i class="bi bi-heart"></i> Donasi
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('layanan') }}" class="nav-link {{ request()->routeIs('layanan') ? 'active' : '' }}">
                      <i class="bi bi-grid"></i> Layanan
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('transparansi') }}" class="nav-link {{ request()->routeIs('transparansi') ? 'active' : '' }}">
                      <i class="bi bi-graph-up"></i> Transparansi
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('riwayat') }}" class="nav-link {{ request()->routeIs('riwayat') ? 'active' : '' }}">
                      <i class="bi bi-clock-history"></i> Riwayat Donasi
                  </a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                      <i class="bi bi-person"></i> Profil
                  </a>
              </li>
              <li class="nav-item mt-4">
                  <a href="#" class="nav-link text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      <i class="bi bi-box-arrow-right"></i> Logout
                  </a>
              </li>
          </ul>
      </div>
  </div>
  
  <!-- Main Content -->
  <div class="main-content">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-light sticky-top">
          <div class="container-fluid">
              <button class="navbar-toggler border-0" type="button" id="sidebarToggle">
                  <span class="navbar-toggler-icon"></span>
              </button>
              
              <div class="d-flex align-items-center ms-auto">
                  <div class="dropdown">
                      <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                          <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                              <i class="bi bi-person-fill"></i>
                          </div>
                          <span>{{ Auth::user()->name }}</span>
                      </a>
                      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                          <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i> Profil</a></li>
                          <li><a class="dropdown-item" href="{{ route('riwayat') }}"><i class="bi bi-clock-history me-2"></i> Riwayat Donasi</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li>
                              <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                  <i class="bi bi-box-arrow-right me-2"></i> Logout
                              </a>
                          </li>
                      </ul>
                  </div>
              </div>
          </div>
      </nav>
      
      <!-- Content -->
      <main>
          @if(session('success'))
          <div class="container-fluid py-2">
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          </div>
          @endif
          
          @if(session('error'))
          <div class="container-fluid py-2">
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ session('error') }}
                  <button type="button" class="btn-close" data-bs-dismiss('alert') aria-label="Close"></button>
              </div>
          </div>
          @endif
          
          @yield('content')
      </main>
  </div>
  
  <!-- Logout Form -->
  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
  </form>

  <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- Custom JavaScript -->
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          // Sidebar Toggle
          const sidebarToggle = document.getElementById('sidebarToggle');
          const sidebar = document.getElementById('sidebar');
          
          sidebarToggle.addEventListener('click', function() {
              sidebar.classList.toggle('show');
          });
          
          // Close sidebar when clicking outside on mobile
          document.addEventListener('click', function(event) {
              if (window.innerWidth < 992 && !sidebar.contains(event.target) && !sidebarToggle.contains(event.target)) {
                  sidebar.classList.remove('show');
              }
          });
          
          // Resize handler
          window.addEventListener('resize', function() {
              if (window.innerWidth >= 992) {
                  sidebar.classList.remove('show');
              }
          });
      });
  </script>
  
  @stack('scripts')
</body>
</html>

