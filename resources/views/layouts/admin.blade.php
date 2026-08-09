<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') — Valena Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    @vite(['resources/css/app.css'])
    <style>
        :root {
            --v-brown: #5c2d0e;
            --v-brown-2: #3d1d08;
            --v-gold: #d4a853;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f9fafb;
            margin: 0;
        }

        /* ── Sidebar ── */
        #sidebar {
            width: 260px;
            min-height: 100vh;
            background: #ffffff;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            transition: transform .3s;
        }

        #sidebar .brand {
            padding: 1.5rem 1.2rem;
            border-bottom: 1px solid #f3f4f6;
            font-size: 1rem;
            font-weight: 700;
            color: var(--v-brown);
            letter-spacing: -.01em;
        }

        .sidebar-section {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .12em;
            color: #9ca3af;
            padding: 1.2rem 1.2rem 0.6rem;
        }

        .sidebar-section.commerce-section {
            margin-top: 0.5rem;
            padding-top: 1rem;
            border-top: 1px solid #f3f4f6;
        }

        #sidebar .nav-link {
            color: #6b7280;
            padding: 0.6rem 1rem;
            border-radius: 8px;
            margin: 0 8px;
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            transition: all .18s;
            text-decoration: none;
            border: none;
            background: transparent;
        }

        #sidebar .nav-link i {
            font-size: 1rem;
            opacity: 0.6;
        }

        #sidebar .nav-link:hover {
            color: var(--v-brown);
            background: #fef3c7;
        }

        #sidebar .nav-link.active {
            color: #fff;
            background: var(--v-brown);
            font-weight: 600;
        }

        #sidebar .nav-link.active i {
            opacity: 1;
        }

        /* Commerce section enhanced styling */
        #sidebar .nav-link.commerce-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            margin: 0.4rem 8px;
            background: transparent;
            border-radius: 8px;
            transition: all .2s;
            position: relative;
        }

        #sidebar .nav-link.commerce-link i {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            opacity: 1;
            background: #f3f4f6;
            color: var(--v-brown);
            flex-shrink: 0;
        }

        #sidebar .nav-link.commerce-link:hover {
            background: #f9fafb;
            color: var(--v-brown);
        }

        #sidebar .nav-link.commerce-link:hover i {
            background: #fef3c7;
            box-shadow: 0 2px 8px rgba(92, 45, 14, 0.15);
        }

        #sidebar .nav-link.commerce-link.active {
            background: linear-gradient(135deg, rgba(92, 45, 14, 0.08) 0%, rgba(92, 45, 14, 0.04) 100%);
            color: var(--v-brown);
            font-weight: 600;
        }

        #sidebar .nav-link.commerce-link.active i {
            background: var(--v-brown);
            color: #fff;
            box-shadow: 0 2px 8px rgba(92, 45, 14, 0.25);
        }

        #sidebar .sidebar-bottom {
            margin-top: auto;
            padding: 1rem;
            border-top: 1px solid #f3f4f6;
        }

        /* ── Main area ── */
        #main-wrapper {
            margin-left: 260px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── Topbar ── */
        #topbar {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 900;
        }

        #topbar .breadcrumb {
            margin: 0;
            font-size: 0.875rem;
        }

        #topbar .breadcrumb-item {
            color: #6b7280;
        }

        #topbar .breadcrumb-item.active {
            color: #1f2937;
            font-weight: 600;
        }

        /* ── Buttons ── */
        .btn {
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.875rem;
            transition: all .2s;
            border: none;
            padding: 0.7rem 1.2rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
        }

        .btn:active {
            transform: translateY(1px);
        }

        .btn-primary {
            background: var(--v-brown);
            color: #fff;
            box-shadow: 0 2px 6px rgba(92, 45, 14, 0.2);
        }

        .btn-primary:hover {
            background: #4a2308;
            box-shadow: 0 4px 14px rgba(92, 45, 14, 0.35);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #d1d5db;
            color: #1f2937;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .btn-secondary:hover {
            background: #b4b8c0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
            transform: translateY(-1px);
        }

        .btn-ghost {
            background: transparent;
            color: #6b7280;
            border: 1px solid #d1d5db;
            box-shadow: none;
        }

        .btn-ghost:hover {
            background: #f3f4f6;
            border-color: #9ca3af;
            color: #1f2937;
        }

        .btn.btn-sm {
            padding: 0.5rem 0.9rem;
            font-size: 0.8125rem;
        }

        /* ── Cards ── */
        .card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
            transition: all .2s;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
            border-color: #d1d5db;
        }

        .card-header {
            background: #ffffff;
            border-bottom: 1px solid #f3f4f6;
            padding: 1.75rem;
            font-weight: 700;
            color: #1f2937;
            font-size: 1rem;
        }

        .card-body {
            padding: 1.75rem;
        }

        /* ── Tables ── */
        .table {
            font-size: 0.875rem;
            margin-bottom: 0;
            width: 100%;
        }

        .table thead th {
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.75rem;
            color: #4b5563;
            background: #f3f4f6;
            border-bottom: 2px solid #e5e7eb;
            padding: 1.25rem 1rem;
            text-align: left;
        }

        .table tbody tr {
            transition: all .15s;
            border-bottom: 1px solid #f3f4f6;
        }

        .table tbody td {
            padding: 1.25rem 1rem;
            vertical-align: middle;
            color: #374151;
        }

        .table tbody tr:hover {
            background: #f9fafb;
            border-bottom-color: #e5e7eb;
        }

        .table tbody tr:last-child {
            border-bottom: 1px solid #e5e7eb;
        }

        /* ── Stat cards ── */
        .stat-card {
            border-radius: 12px;
            border: none;
            padding: 2rem;
            background: #ffffff;
            position: relative;
            overflow: hidden;
            transition: all .2s;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .stat-card:hover {
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }

        .stat-card.gradient-brown {
            background: linear-gradient(135deg, #5c2d0e 0%, #7a3d14 100%);
            border: none;
            color: #fff;
            box-shadow: 0 4px 15px rgba(92, 45, 14, 0.25);
        }

        .stat-card.gradient-brown:hover {
            box-shadow: 0 8px 25px rgba(92, 45, 14, 0.35);
        }

        .stat-card.gradient-green {
            background: linear-gradient(135deg, #059669 0%, #10b981 100%);
            border: none;
            color: #fff;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.25);
        }

        .stat-card.gradient-green:hover {
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.35);
        }

        .stat-card.gradient-amber {
            background: linear-gradient(135deg, #d97706 0%, #f59e0b 100%);
            border: none;
            color: #fff;
            box-shadow: 0 4px 15px rgba(217, 119, 6, 0.25);
        }

        .stat-card.gradient-amber:hover {
            box-shadow: 0 8px 25px rgba(217, 119, 6, 0.35);
        }

        .stat-card.gradient-blue {
            background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            border: none;
            color: #fff;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.25);
        }

        .stat-card.gradient-blue:hover {
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.35);
        }

        .stat-card .stat-icon {
            position: absolute;
            right: 1.5rem;
            top: 1rem;
            font-size: 3rem;
            opacity: 0.1;
        }

        /* ── Form helpers ── */
        label.form-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            font-size: 0.875rem;
            background: #fff;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 0.6rem 0.875rem;
            transition: all .18s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--v-brown);
            box-shadow: 0 0 0 3px rgba(92, 45, 14, 0.1);
            outline: none;
        }

        /* ── List group ── */
        .list-group {
            border-radius: 0;
            border: none;
            overflow: visible;
        }

        .list-group-item {
            border: none;
            border-bottom: 1px solid #f3f4f6;
            padding: 1.25rem 0;
            font-size: 0.875rem;
            transition: all .15s;
            background: transparent;
        }

        .list-group-item:last-child {
            border-bottom: none;
        }

        .list-group-item-action {
            background: transparent;
            color: #374151;
            text-decoration: none;
            cursor: pointer;
        }

        .list-group-item-action:hover {
            background: transparent;
            color: var(--v-brown);
            padding-left: 0.75rem;
        }

        /* ── Badges ── */
        .badge {
            font-weight: 700;
            border-radius: 8px;
            padding: 0.5rem 0.8rem;
            font-size: 0.75rem;
            display: inline-block;
            letter-spacing: 0.01em;
            text-transform: uppercase;
        }

        .badge-primary {
            background: var(--v-brown);
            color: #fff;
        }

        .badge-success {
            background: #d1fae5;
            color: #047857;
            font-weight: 700;
        }

        .badge-warning {
            background: #fde047;
            color: #92400e;
            font-weight: 700;
        }

        .badge-danger {
            background: #fecaca;
            color: #991b1b;
            font-weight: 700;
        }

        /* ── Sidebar mobile toggle ── */
        #sidebarToggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.4rem;
            color: #374151;
            cursor: pointer;
        }

        @media (max-width: 991px) {
            #sidebar {
                transform: translateX(-100%);
            }

            #sidebar.open {
                transform: translateX(0);
            }

            #main-wrapper {
                margin-left: 0;
            }

            #sidebarToggle {
                display: block;
            }

            #sidebarOverlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.4);
                z-index: 999;
            }

            #sidebarOverlay.show {
                display: block;
            }

            #sidebar {
                z-index: 1050;
            }
        }
    </style>
</head>

<body>

    {{-- Sidebar --}}
    <div id="sidebar">
        <div class="brand">☕ Valena Admin</div>

        <div class="sidebar-section">Content</div>
        <nav>
            <a class="nav-link @yield('nav_dashboard')" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i>Dashboard
            </a>
            <a class="nav-link @yield('nav_products')" href="{{ route('admin.products.index') }}">
                <i class="bi bi-bag2"></i>Products
            </a>
            <a class="nav-link @yield('nav_suppliers')" href="{{ route('admin.suppliers.index') }}">
                <i class="bi bi-truck"></i>Suppliers
            </a>
            <a class="nav-link @yield('nav_facilities')" href="{{ route('admin.facilities.index') }}">
                <i class="bi bi-building"></i>Facilities
            </a>
            <a class="nav-link @yield('nav_spots')" href="{{ route('admin.tourist-spots.index') }}">
                <i class="bi bi-geo-alt"></i>Tourist Spots
            </a>
            <a class="nav-link @yield('nav_news')" href="{{ route('admin.news.index') }}">
                <i class="bi bi-newspaper"></i>News
            </a>
        </nav>

        <div class="sidebar-section commerce-section">Commerce</div>
        <nav>
            <a class="nav-link commerce-link @yield('nav_users')" href="{{ route('admin.users.index') }}">
                <i class="bi bi-people"></i><span>Users</span>
            </a>
            <a class="nav-link commerce-link @yield('nav_orders')" href="{{ route('admin.orders.index') }}">
                <i class="bi bi-receipt"></i><span>Orders</span>
            </a>
            <a class="nav-link commerce-link @yield('nav_gcash_settings')" href="{{ route('admin.gcash-settings.edit') }}">
                <i class="bi bi-qr-code-scan"></i><span>GCash QR</span>
            </a>
            <a class="nav-link commerce-link @yield('nav_messages')" href="{{ route('admin.messages.index') }}">
                <i class="bi bi-chat-dots"></i><span>Messages</span>
            </a>
        </nav>

        <div class="sidebar-bottom">
            <a class="nav-link" href="{{ route('home') }}" style="color: #6b7280;">
                <i class="bi bi-arrow-left-circle"></i>View Site
            </a>
            <form method="POST" action="{{ route('logout') }}" style="margin-top: 0.5rem;">
                @csrf
                <button type="submit" class="nav-link w-100"
                    style="text-align: left; color: #9ca3af; border: none; background: transparent; padding: 0.6rem 1rem;">
                    <i class="bi bi-box-arrow-left"></i>Logout
                </button>
            </form>
        </div>
    </div>

    {{-- Overlay for mobile --}}
    <div id="sidebarOverlay" onclick="toggleSidebar()"></div>

    {{-- Main --}}
    <div id="main-wrapper">
        <div id="topbar">
            <div style="display: flex; align-items: center; gap: 1rem;">
                <button id="sidebarToggle" onclick="toggleSidebar()" style="padding: 0;">
                    <i class="bi bi-list"></i>
                </button>
                <nav>
                    <ol style="margin: 0; padding: 0; list-style: none; display: flex; font-size: 0.875rem;">
                        <li style="color: #9ca3af;">
                            <a href="{{ route('admin.dashboard') }}"
                                style="text-decoration: none; color: #9ca3af;">Admin</a>
                        </li>
                        <li style="color: #9ca3af; margin: 0 0.5rem;">/</li>
                        <li style="color: #1f2937; font-weight: 600;">@yield('title', 'Dashboard')</li>
                    </ol>
                </nav>
            </div>
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <span style="font-size: 0.875rem; color: #6b7280; display: none;" class="d-none d-sm-inline">
                    {{ auth()->user()->name ?? 'Admin' }}
                </span>
                <div
                    style="width: 32px; height: 32px; border-radius: 50%; background: var(--v-gold); display: flex; align-items: center; justify-content: center; font-weight: 700; color: #fff; font-size: 0.875rem;">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
            </div>
        </div>

        <div style="padding: 2rem; flex-grow: 1; max-width: 100%;">
            <div style="max-width: 1600px; margin: 0 auto;">
                @if (session('success'))
                    <div
                        style="background: #d1fae5; color: #065f46; border-left: 4px solid #10b981; border-radius: 10px; padding: 1.25rem; margin-bottom: 2rem; display: flex; align-items: center; gap: 0.75rem;">
                        <i class="bi bi-check-circle-fill"></i>
                        <span style="font-weight: 500;">{{ session('success') }}</span>
                        <button type="button" onclick="this.parentElement.remove()"
                            style="margin-left: auto; background: none; border: none; cursor: pointer; color: #065f46;">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                @endif
                @if ($errors->any())
                    <div
                        style="background: #fee2e2; color: #991b1b; border-left: 4px solid #ef4444; border-radius: 10px; padding: 1.25rem; margin-bottom: 2rem;">
                        <ul style="margin: 0; padding-left: 1.5rem;">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }
    </script>
</body>

</html>
