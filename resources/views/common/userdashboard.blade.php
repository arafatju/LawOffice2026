<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Welcome to Store Management</title>

    <link rel="shortcut icon" href="{{ asset('gov.png') }}">
    <link rel="stylesheet" href="{{ asset('smart.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;500;600;700&family=Noto+Sans+Bengali:wght@400;600&display=swap" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
        :root {
            --navy: #1a237e;
            --navy-deep: #121a5c;
            --ink: #1c2333;
            --muted: #667085;
            --paper: #f3f5f9;
            --surface: #ffffff;
            --line: #dde2ec;
            --sidebar-w: 256px;
            --topbar-h: 58px;
        }

        * { box-sizing: border-box; }

        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            background: var(--paper);
            color: var(--ink);
            font-family: 'Source Sans 3', 'Noto Sans Bengali', system-ui, -apple-system, 'Segoe UI', sans-serif;
        }

        /* ---------- Sidebar ---------- */
        .sidebar {
            width: var(--sidebar-w);
            flex-shrink: 0;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(180deg, var(--navy) 0%, var(--navy-deep) 100%) !important;
            color: #fff;
            z-index: 1030;
            transition: left .25s ease;
        }

        .app-title {
            padding: 22px 20px 18px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, .12);
        }

        .app-title img {
            max-height: 58px;
            margin-bottom: 10px;
        }

        .app-title h4 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
            letter-spacing: .2px;
        }

        .nav-section {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            padding: 16px 12px;
            gap: 4px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 8px;
            color: rgba(255, 255, 255, .78);
            text-decoration: none;
            font-weight: 500;
            transition: background .2s, color .2s;
        }

        .sidebar-link i { font-size: 1.05rem; width: 20px; text-align: center; }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, .08);
            color: #fff;
        }

        .sidebar-link.active {
            background: #fff;
            color: var(--navy);
            font-weight: 600;
        }

        .sidebar-link.logout:hover { background: rgba(245, 101, 101, .18); color: #fff; }

        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 20, 50, .55);
            z-index: 1025;
        }

        /* ---------- Content ---------- */
        .content-wrapper {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin-left: var(--sidebar-w);
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 1020;
            height: var(--topbar-h);
            background: var(--surface);
            border-bottom: 1px solid var(--line);
            display: flex;
            align-items: center;
            padding: 0 24px;
            gap: 12px;
        }

        .breadcrumb { margin: 0; font-size: .95rem; }
        .breadcrumb-item + .breadcrumb-item::before { content: ">"; }
        .breadcrumb-item a { color: var(--navy); }
        .breadcrumb-item.active { color: var(--ink); font-weight: 600; }

        .main-content { flex: 1; padding: 0 0 2rem; }

        @media (max-width: 768px) {
            .sidebar { left: calc(var(--sidebar-w) * -1); }
            .sidebar.active { left: 0; }
            .sidebar-overlay.active { display: block; }
            .content-wrapper { margin-left: 0; width: 100%; }
            .topbar { padding: 0 12px; }
        }

        .table-border { border: 1px solid #dee2e6; }
    </style>

    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="app-title">
            <img src="{{ asset('gov.png') }}" alt="Government Logo" class="img-fluid">
            <h4>Store Management</h4>
        </div>

        <nav class="nav-section">
            <a href="{{ route('userdash') }}" class="sidebar-link {{ request()->routeIs('userdash') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i> Dashboard
            </a>
            <a href="{{ route('userapprovedlist') }}" class="sidebar-link {{ request()->routeIs('userapprovedlist') ? 'active' : '' }}">
                <i class="bi bi-check2-square"></i> Approved List
            </a>
            <a href="{{ route('userprofile') }}" class="sidebar-link {{ request()->routeIs('userprofile') ? 'active' : '' }}">
                <i class="bi bi-person-circle"></i> Profile
            </a>

            <a href="{{ route('signout') }}" class="sidebar-link logout">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </nav>
    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Main -->
    <div class="content-wrapper">
        <header class="topbar">
            <button class="btn btn-link p-0 d-md-none" id="sidebarToggle" aria-label="Open menu">
                <i class="bi bi-list fs-3"></i>
            </button>

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('userdash') }}"><i class="bi bi-house-door"></i></a>
                    </li>
                    <li class="breadcrumb-item active">{{ $bread11 ?? '' }}</li>
                </ol>
            </nav>
        </header>

        <main class="main-content">
            <div class="container-fluid p-3 p-md-4">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const toggle  = document.getElementById('sidebarToggle');

        const closeSidebar = () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        };

        if (toggle) {
            toggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });
        }
        overlay.addEventListener('click', closeSidebar);
        window.addEventListener('resize', () => { if (window.innerWidth > 768) closeSidebar(); });
    });
    </script>

    @stack('scripts')
</body>
</html>