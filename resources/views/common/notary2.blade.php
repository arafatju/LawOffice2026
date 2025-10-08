<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="{{asset('gov.png')}}">    
    <title>Welcome to Store Management</title>
    <link rel="stylesheet" href="{{asset('smart.css')}}">  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Bootstrap CSS - Load FIRST -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        .sidebar {
            width: 250px;
            flex-shrink: 0;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            background-color: #1a237e !important;
            color: white;
            display: flex;
            flex-direction: column;
            z-index: 1030;
        }

        .content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin-left: 250px;
        }

        .main-content {
            flex: 1;
            min-height: calc(100vh - 56px - 60px);
        }

        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
            }

            .sidebar.active {
                left: 0;
            }

            .content-wrapper {
                margin-left: 0;
                width: 100%;
            }
        }

        .sidebar-link {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            padding: 12px 15px;
            display: block;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .sidebar-link:hover,
        .sidebar-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            border-left: 3px solid #fff;
        }

        .sidebar-link i {
            margin-right: 10px;
        }

        .nav-section {
            flex: 1;
        }

        .app-title {
            color: white;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar {
            height: 56px;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            border-top: 1px solid #dee2e6;
            height: 60px;
            color: green;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
        }

        .table-border {
            border: 1px solid #dee2e6;
        }

        .user-profile .text-muted {
            color: rgba(255, 255, 255, 0.6) !important;
        }

        .user-actions {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 10px;
            padding-top: 10px;
        }

        .user-actions .sidebar-link {
            padding: 8px 15px;
        }

        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1025;
        }

        @media (max-width: 768px) {
            .sidebar-overlay.active {
                display: block;
            }
        }

        /* Ensure modals appear above everything */
        .modal-backdrop {
            z-index: 1040;
        }

        .modal {
            z-index: 1050;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <!-- Logo/Brand -->
        <div class="p-3 app-title text-center">
            <img src="{{asset('gov.png')}}" alt="Government Logo" class="img-fluid mb-2" style="max-height: 60px;">
            <h4 class="m-0">Store Management</h4>
        </div>

        <!-- Navigation Menu -->
        <div class="nav-section py-3">
            <a href="{{route('StoreDashboard')}}" class="sidebar-link">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
            <a href="{{route('user11')}}" class="sidebar-link">
                <i class="bi bi-people"></i> User Management  
            </a>
            <a href="{{route('product')}}" class="sidebar-link">
                <i class="bi bi-box"></i> Product Management
            </a>
            <a href="{{route('transactions.index')}}" class="sidebar-link">
                <i class="bi bi-check-circle"></i> Transaction list 
            </a>
            <a href="{{route('lots.index')}}" class="sidebar-link">
                <i class="bi bi-clock-history"></i> Lot  list 
            </a>
            <a href="{{route('loginfo.index')}}" class="sidebar-link">
                <i class="bi bi-file-earmark-text"></i> Loginfo  
            </a>
            <a href="#" class="sidebar-link">
                <i class="bi bi-person"></i> Profile
            </a>
            <a href="{{route('signout')}}" class="sidebar-link">
                <i class="bi bi-box-arrow-right"></i> Logout 
            </a>
        </div>
    </div>

    <!-- Sidebar Overlay for mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Main Content Wrapper -->
    <div class="content-wrapper">
        <!-- Top Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
            <div class="container-fluid">
                <!-- Sidebar Toggle Button -->
                <button class="btn btn-link d-md-none" id="sidebarToggle">
                    <i class="bi bi-list fs-5"></i>
                </button>

                <!-- Breadcrumbs -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('StoreDashboard')}}">
                                <i class="bi bi-house-door"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{$bread11 ?? 'Dashboard'}}</li>
                    </ol>
                </nav>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="main-content bg-light mb-4 pb-2">
            <div class="container-fluid p-4">
                @yield('content')
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 text-md-start">
                        <p class="mb-0">© 2025 Law and Justice Division, MOLJPA. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <p class="mb-0">Contact: support@notarycompany.com</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- JavaScript Libraries - Load at the END of body -->
    
    <!-- Bootstrap Bundle (includes Popper) - MUST COME FIRST -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    
    <!-- Laravel App JS (if needed) -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Sidebar Toggle Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sidebar Toggle
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                sidebarOverlay.classList.toggle('active');
            });
        }

        // Close sidebar when clicking on overlay
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', function() {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
            });
        }

        // Adjust sidebar on window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('active');
                sidebarOverlay.classList.remove('active');
            }
        });

        // Clean up any stuck modals on page load
        document.body.classList.remove('modal-open');
        const backdrops = document.querySelectorAll('.modal-backdrop');
        backdrops.forEach(backdrop => backdrop.remove());
        document.body.style.overflow = '';
        document.body.style.paddingRight = '';
    });
    </script>

</body>
</html>