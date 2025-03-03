<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" href="{{asset('gov.png')}}">    
    <title> Welcome to Notary Portal </title>
    <link rel="stylesheet" href="{{asset('smart.css')}}">  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Include Toastr CSS and JS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
   
    <style>
        .sidebar {
            min-height: 100vh;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            background-color: #1a237e !important;
            color: white;
            display: flex;
            flex-direction: column;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 1000;
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: -250px;
                position: fixed;
            }

            .sidebar.active {
                margin-left: 0;
            }

            .content {
                width: 100%;
                margin-left: 0 !important;
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

        .content {
            min-height: 100vh;
            transition: all 0.3s;
            margin-left: 250px;
        }

        .user-profile {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 15px;
            margin-top: auto;
            background-color: rgba(0, 0, 0, 0.1);
        }

        .nav-section {
            flex: 1;
        }

        .app-title {
            color: white;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .user-profile .text-muted {
            color: rgba(255, 255, 255, 0.6) !important;
        }

        .navy-divider {
            height: 30px;
            background-color: #1a237e;
            width: 100%;
            position: relative;
        }

        .hamburger-menu {
            display: none;
            cursor: pointer;
            font-size: 24px;
            color: white;
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1001;
        }

        @media (max-width: 768px) {
            .hamburger-menu {
                display: block;
            }
            
            .navy-divider {
                height: 40px;
                display: flex;
                align-items: center;
                padding-left: 50px;
            }
        }

        .greet {
            margin-top: 0px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar" style="width: 250px;" id="sidebar">
        <!-- Logo/Brand -->
        <div class="p-3 app-title">
            <h4 class="m-0">Welcome to Notary</h4>
        </div>

        <!-- Navigation Menu -->
        <div class="nav-section py-3">
            <a href="dashboard.html" class="sidebar-link active">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
            <a href="users.html" class="sidebar-link">
                <i class="bi bi-people"></i> Users
            </a>
            <a href="products.html" class="sidebar-link">
                <i class="bi bi-box"></i> Products
            </a>
            <a href="settings.html" class="sidebar-link">
                <i class="bi bi-gear"></i> Settings
            </a>
        </div>

        <!-- User Profile - Now at bottom -->
        <div class="user-profile">
            <div class="d-flex align-items-center">
                <img src="https://ui-avatars.com/api/?name=John+Doe&background=random" 
                     alt="Profile" 
                     class="rounded-circle me-2"
                     style="width: 40px; height: 40px;">
                <div>
                    <div class="fw-bold">John Doe</div>
                    <small class="text-muted">john@example.com</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content flex-grow-1 bg-light">
        <!-- Greeting Headers -->
        <div class="greet">
            <h4 align="center"><img src="{{asset('gov.png')}}" style="width:20px;height:20px;" /> গণপ্রজাতন্ত্রী বাংলাদেশ সরকার </h4> 
            <h1 align="center"> আইন,বিচার ও সংসদ বিষয়ক মন্ত্রণালয়  </h1> 
            <h2 align="center"> আইন ও বিচার বিভাগ  </h2>
            <h4 align="center"> Notary Portal   </h4>  
            <h4 align="center">     </h4>
        </div>

        <!-- Navy Blue Divider with Hamburger for mobile -->
        <div class="navy-divider">
            <!-- Hamburger Menu for Mobile -->
            <div class="hamburger-menu" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </div>
        </div>

        <!-- Page Content -->
        <div class="p-4">
            <h2>Dashboard</h2>
            <p>Welcome to your dashboard.</p>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sidebar Toggle
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const content = document.querySelector('.content');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });
    }

    // Close sidebar when clicking outside on mobile
    document.addEventListener('click', function(event) {
        if (window.innerWidth <= 768) {
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickInsideToggle = sidebarToggle.contains(event.target);

            if (!isClickInsideSidebar && !isClickInsideToggle && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        }
    });

    // Adjust sidebar on window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            sidebar.classList.remove('active');
        }
    });
});
</script>

</body>
</html>