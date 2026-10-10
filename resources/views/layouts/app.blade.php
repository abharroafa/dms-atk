<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ArsipNota')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --brown: #A98B76;
            --brown-dark: #92745F;
            --cream: #F3E4C9;
            --text: #493D34;
            --muted: #817367;
            --bg: #F8F5F0;
            --border: #E9DED2;
            --sidebar: #493D34;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--bg);
            color: var(--text);
            font-family: Arial, Helvetica, sans-serif;
        }

        .sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            width: 260px;
            padding: 24px 16px;
            overflow-y: auto;
            background: var(--sidebar);
            color: white;
            transition: transform .25s ease, width .25s ease;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 4px 8px 35px;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: var(--brown);
            font-size: 24px;
            font-weight: bold;
        }

        .brand-name {
            font-size: 21px;
            font-weight: bold;
            white-space: nowrap;
        }

        .brand-subtitle {
            color: #D8C8BA;
            font-size: 12px;
        }

        .menu-label {
            margin: 0 12px 12px;
            color: #C6B5A7;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1.3px;
            text-transform: uppercase;
        }

        .sidebar nav {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .sidebar .nav-link {
            min-height: 46px;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 12px 14px;
            border-radius: 9px;
            color: #F0E7DF;
            font-size: 14px;
            text-decoration: none;
        }

        .sidebar .nav-link i {
            width: 22px;
            flex-shrink: 0;
            font-size: 18px;
            text-align: center;
        }

        .sidebar .nav-link:hover {
            background: #665244;
            color: white;
        }

        .sidebar .nav-link.active {
            background: var(--brown);
            color: white;
            font-weight: 600;
        }

        .sidebar-bottom {
            margin-top: auto;
            padding-top: 24px;
        }

        .sidebar-divider {
            height: 1px;
            margin-bottom: 17px;
            background: rgba(255,255,255,.15);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 8px;
            min-width: 0;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: var(--cream);
            color: var(--text);
        }

        .user-info { min-width: 0; }

        .user-name {
            overflow: hidden;
            font-size: 13px;
            font-weight: 600;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .user-role {
            margin-top: 3px;
            color: #D8C8BA;
            font-size: 11px;
        }

        .main-content {
            min-width: 0;
            min-height: 100vh;
            margin-left: 260px;
            padding: 30px 34px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 30px;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 13px;
            min-width: 0;
        }

        .page-title {
            margin: 0;
            font-size: 27px;
            font-weight: 700;
        }

        .page-subtitle {
            margin: 6px 0 0;
            color: var(--muted);
            font-size: 13px;
        }

        .topbar-date {
            color: var(--muted);
            font-size: 12px;
            white-space: nowrap;
        }

        .mobile-menu-button {
            display: none;
            width: 40px;
            height: 40px;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border);
            border-radius: 9px;
            background: white;
            color: var(--text);
            font-size: 20px;
        }

        .btn-primary {
            background: var(--brown);
            border-color: var(--brown);
            color: white;
            border-radius: 9px;
        }

        .btn-primary:hover {
            background: var(--brown-dark);
            border-color: var(--brown-dark);
            color: white;
        }

        .stat-card,
        .content-card {
            background: white;
            border: 1px solid var(--border);
            border-radius: 14px;
        }

        .stat-card {
            height: 100%;
            padding: 22px;
        }

        .stat-label {
            color: var(--muted);
            font-size: 13px;
        }

        .stat-value {
            margin-top: 12px;
            font-size: 28px;
            font-weight: bold;
        }

        .stat-icon {
            width: 43px;
            height: 43px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 11px;
            background: #F3E8DD;
            color: var(--brown-dark);
            font-size: 20px;
        }

        .content-card { overflow: hidden; }

        .content-card-header {
            padding: 21px 22px;
            border-bottom: 1px solid #F0E8E0;
        }

        .content-card-title {
            margin: 0;
            font-size: 16px;
            font-weight: 700;
        }

        .content-card-body { padding: 22px; }

        .table thead th {
            padding: 15px;
            background: #F8F1E9;
            color: #746353;
            font-size: 12px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
        }

        .sidebar-overlay { display: none; }

        @media (max-width: 900px) {
            .sidebar { width: 76px; padding: 20px 9px; }
            .brand { justify-content: center; margin: 5px 0 30px; }
            .brand-text, .menu-label, .nav-text, .user-info { display: none; }
            .sidebar .nav-link { justify-content: center; padding: 14px 5px; }
            .sidebar-user { justify-content: center; }
            .main-content { margin-left: 76px; padding: 25px 18px; }
            .page-title { font-size: 24px; }
        }

        @media (max-width: 600px) {
            .sidebar {
                width: 260px;
                transform: translateX(-100%);
            }

            .sidebar.mobile-open { transform: translateX(0); }

            .sidebar.mobile-open .brand {
                justify-content: flex-start;
                margin: 4px 8px 35px;
            }

            .sidebar.mobile-open .brand-text,
            .sidebar.mobile-open .menu-label,
            .sidebar.mobile-open .nav-text,
            .sidebar.mobile-open .user-info {
                display: block;
            }

            .sidebar.mobile-open .nav-link { justify-content: flex-start; }
            .sidebar.mobile-open .sidebar-user { justify-content: flex-start; }

            .sidebar-overlay.visible {
                display: block;
                position: fixed;
                inset: 0;
                z-index: 999;
                background: rgba(30,24,20,.4);
            }

            .main-content { margin-left: 0; padding: 20px 14px; }
            .mobile-menu-button { display: flex; flex-shrink: 0; }
            .page-title { font-size: 21px; }
            .topbar-date { display: none; }
        }
    </style>

    @stack('styles')
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay"></div>

<aside class="sidebar" id="sidebar">
    <div class="brand">
        <div class="brand-icon">A</div>
        <div class="brand-text">
            <div class="brand-name">ArsipNota</div>
            <div class="brand-subtitle">Toko alat tulis</div>
        </div>
    </div>

    <div class="menu-label">Menu utama</div>

    <nav aria-label="Navigasi utama">
        <a href="{{ route('dashboard') }}"
           class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i>
            <span class="nav-text">Dashboard</span>
        </a>

        <a href="{{ route('nota.upload') }}"
           class="nav-link {{ request()->routeIs('nota.upload') ? 'active' : '' }}">
            <i class="bi bi-cloud-arrow-up"></i>
            <span class="nav-text">Unggah nota</span>
        </a>

        <a href="{{ route('nota.index') }}"
           class="nav-link {{ request()->routeIs('nota.index') ? 'active' : '' }}">
            <i class="bi bi-archive"></i>
            <span class="nav-text">Arsip nota</span>
        </a>

        <a href="{{ route('rekap.index') }}"
           class="nav-link {{ request()->routeIs('rekap.index') ? 'active' : '' }}">
            <i class="bi bi-bar-chart-line"></i>
            <span class="nav-text">Rekap</span>
        </a>

        <a href="{{ route('audit.index') }}"
           class="nav-link {{ request()->routeIs('audit.index') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i>
            <span class="nav-text">Log audit</span>
        </a>
    </nav>

    <div class="sidebar-bottom">
        <div class="sidebar-divider"></div>

        <div class="sidebar-user">
            <div class="user-avatar">
                <i class="bi bi-person"></i>
            </div>
            <div class="user-info">
                <div class="user-name">
                    {{ auth()->user()->name ?? 'Pengguna' }}
                </div>
                <div class="user-role">
                    {{ ucfirst(auth()->user()->role ?? 'Pengguna') }}
                </div>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                    class="nav-link w-100 border-0 text-start"
                    style="background: transparent;">
                <i class="bi bi-box-arrow-left"></i>
                <span class="nav-text">Keluar</span>
            </button>
        </form>
    </div>
</aside>

<main class="main-content">
    <header class="topbar">
        <div class="topbar-left">
            <button type="button"
                    class="mobile-menu-button"
                    id="mobileMenuButton"
                    aria-label="Buka menu navigasi"
                    aria-expanded="false">
                <i class="bi bi-list"></i>
            </button>

            <div>
                @hasSection('header')
                    @yield('header')
                @else
                    <h1 class="page-title">
                        @yield('page-title', 'Dashboard')
                    </h1>
                    <p class="page-subtitle">
                        @yield('page-subtitle', 'Selamat datang di ArsipNota.')
                    </p>
                @endif
            </div>
        </div>

        <div class="topbar-date">
            <i class="bi bi-calendar3"></i>
            {{ now()->translatedFormat('d F Y') }}
        </div>
    </header>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const button = document.getElementById('mobileMenuButton');

    function closeSidebar() {
        sidebar.classList.remove('mobile-open');
        overlay.classList.remove('visible');
        button.setAttribute('aria-expanded', 'false');
    }

    button.addEventListener('click', function () {
        const isOpen = sidebar.classList.toggle('mobile-open');
        overlay.classList.toggle('visible', isOpen);
        button.setAttribute('aria-expanded', String(isOpen));
    });

    overlay.addEventListener('click', closeSidebar);

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') closeSidebar();
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 600) closeSidebar();
    });
});
</script>

@stack('scripts')
</body>
</html>