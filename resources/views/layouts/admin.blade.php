<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') — Valena Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --v-brown: #5c2d0e;
            --v-brown-2: #3d1d08;
            --v-gold: #d4a853;
            --v-bg: #f0f2f5;
            --v-sidebar: 260px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--v-bg);
            margin: 0;
        }

        /* ── Sidebar ── */
        #sidebar {
            width: var(--v-sidebar);
            min-height: 100vh;
            background: linear-gradient(180deg, var(--v-brown-2) 0%, var(--v-brown) 100%);
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
            padding: 1.4rem 1.2rem 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--v-gold);
            letter-spacing: -.01em;
        }

        .sidebar-section {
            font-size: .68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .12em;
            color: rgba(255, 255, 255, .35);
            padding: 1.2rem 1.2rem .4rem;
        }

        #sidebar .nav-link {
            color: rgba(255, 255, 255, .72);
            padding: .52rem 1.1rem;
            border-radius: 8px;
            margin: 1px 8px;
            font-size: .875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: .55rem;
            transition: all .18s;
        }

        #sidebar .nav-link i {
            font-size: 1rem;
            opacity: .8;
        }

        #sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, .1);
        }

        #sidebar .nav-link.active {
            color: #fff;
            background: var(--v-gold);
        }

        #sidebar .nav-link.active i {
            opacity: 1;
        }

        #sidebar .sidebar-bottom {
            margin-top: auto;
            padding: 1rem;
            border-top: 1px solid rgba(255, 255, 255, .08);
        }

        /* ── Main area ── */
        #main-wrapper {
            margin-left: var(--v-sidebar);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* ── Topbar ── */
        #topbar {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: .75rem 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 900;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .05);
        }

        #topbar .breadcrumb {
            margin: 0;
            font-size: .82rem;
        }

        #topbar .breadcrumb-item.active {
            color: #374151;
            font-weight: 600;
        }

        .btn-valena {
            background: var(--v-brown);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: .875rem;
            transition: all .18s;
        }

        .btn-valena:hover {
            background: #7a3d14;
            color: #fff;
            box-shadow: 0 2px 8px rgba(92, 45, 14, .3);
        }

        /* ── Cards ── */
        .v-card {
            background: #fff;
            border-radius: 14px;
            border: none;
            box-shadow: 0 1px 8px rgba(0, 0, 0, .06);
        }

        .table th {
            font-size: .78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #6b7280;
            background: #f9fafb;
        }

        .table td {
            font-size: .875rem;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: #fdf6ec;
        }

        /* ── Stat cards ── */
        .stat-card {
            border-radius: 16px;
            border: none;
            padding: 1.4rem 1.4rem 1.2rem;
            color: #fff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0, 0, 0, .15);
        }

        .stat-card .stat-icon {
            position: absolute;
            right: 1rem;
            top: .75rem;
            font-size: 3rem;
            opacity: .15;
        }

        /* ── Form helpers ── */
        label.form-label {
            font-size: .82rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: .35rem;
        }

        .form-control,
        .form-select {
            font-size: .9rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--v-brown);
            box-shadow: 0 0 0 3px rgba(92, 45, 14, .12);
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
                background: rgba(0, 0, 0, .4);
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
        <nav class="nav flex-column">
            <a class="nav-link @yield('nav_dashboard')" href="{{ route('admin.dashboard') }}"><i
                    class="bi bi-speedometer2"></i>Dashboard</a>
            <a class="nav-link @yield('nav_products')" href="{{ route('admin.products.index') }}"><i
                    class="bi bi-bag2"></i>Products</a>
            <a class="nav-link @yield('nav_suppliers')" href="{{ route('admin.suppliers.index') }}"><i
                    class="bi bi-truck"></i>Suppliers</a>
            <a class="nav-link @yield('nav_facilities')" href="{{ route('admin.facilities.index') }}"><i
                    class="bi bi-building"></i>Facilities</a>
            <a class="nav-link @yield('nav_spots')" href="{{ route('admin.tourist-spots.index') }}"><i
                    class="bi bi-geo-alt"></i>Tourist Spots</a>
            <a class="nav-link @yield('nav_news')" href="{{ route('admin.news.index') }}"><i
                    class="bi bi-newspaper"></i>News</a>
        </nav>

        <div class="sidebar-section">Commerce</div>
        <nav class="nav flex-column">
            <a class="nav-link @yield('nav_users')" href="{{ route('admin.users.index') }}"><i
                    class="bi bi-people"></i>Users</a>
            <a class="nav-link @yield('nav_orders')" href="{{ route('admin.orders.index') }}"><i
                    class="bi bi-receipt"></i>Orders</a>
            <a class="nav-link @yield('nav_messages')" href="{{ route('admin.messages.index') }}"><i
                    class="bi bi-chat-dots"></i>Messages</a>
        </nav>

        <div class="sidebar-bottom">
            <a class="nav-link" href="{{ route('home') }}"><i class="bi bi-arrow-left-circle"></i>View Site</a>
            <form method="POST" action="{{ route('logout') }}" class="mt-1">
                @csrf
                <button class="nav-link w-100 text-start border-0 bg-transparent" style="color:rgba(255,255,255,.5)">
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
            <div class="d-flex align-items-center gap-3">
                <button id="sidebarToggle" onclick="toggleSidebar()"><i class="bi bi-list"></i></button>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                class="text-decoration-none text-muted">Admin</a></li>
                        <li class="breadcrumb-item active">@yield('title', 'Dashboard')</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span class="small text-muted d-none d-sm-inline">{{ auth()->user()->name ?? 'Admin' }}</span>
                <div class="rounded-circle bg-warning d-flex align-items-center justify-content-center fw-bold text-dark"
                    style="width:32px;height:32px;font-size:.8rem">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
            </div>
        </div>

        <div class="p-3 p-lg-4 flex-grow-1">
            @if (session('success'))
                <div class="alert border-0 d-flex align-items-center gap-2 mb-4"
                    style="background:#d1fae5;color:#065f46;border-left:4px solid #10b981 !important;border-radius:10px">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert border-0 mb-4"
                    style="background:#fee2e2;color:#991b1b;border-left:4px solid #ef4444 !important;border-radius:10px">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('show');
        }
    </script>
    @stack('scripts')
</body>

</html>
@stack('scripts')
</body>

</html>
