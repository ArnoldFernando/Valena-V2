<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin – @yield('title', 'Dashboard') | Valena</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --valena-brown: #6f3d1f;
            --valena-gold: #c9973a;
        }

        body {
            background: #f4f4f4;
        }

        #sidebar {
            min-height: 100vh;
            background: var(--valena-brown);
            width: 240px;
            flex-shrink: 0;
        }

        #sidebar .nav-link {
            color: rgba(255, 255, 255, .8);
            padding: .5rem 1rem;
        }

        #sidebar .nav-link:hover,
        #sidebar .nav-link.active {
            color: #fff;
            background: rgba(255, 255, 255, .12);
            border-radius: .375rem;
        }

        #sidebar .sidebar-heading {
            color: var(--valena-gold);
            font-size: .7rem;
            text-transform: uppercase;
            letter-spacing: .1em;
            padding: 1rem 1rem .25rem;
        }

        .topbar {
            background: #fff;
            border-bottom: 1px solid #dee2e6;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <div id="sidebar" class="p-2">
            <div class="px-2 py-3 mb-2">
                <span class="fs-5 fw-bold text-white">&#9749; Valena Admin</span>
            </div>
            <div class="sidebar-heading">Content</div>
            <nav class="nav flex-column gap-1">
                <a class="nav-link @yield('nav_dashboard')" href="{{ route('admin.dashboard') }}"><i
                        class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                <a class="nav-link @yield('nav_products')" href="{{ route('admin.products.index') }}"><i
                        class="bi bi-bag me-2"></i>Products</a>
                <a class="nav-link @yield('nav_suppliers')" href="{{ route('admin.suppliers.index') }}"><i
                        class="bi bi-truck me-2"></i>Suppliers</a>
                <a class="nav-link @yield('nav_facilities')" href="{{ route('admin.facilities.index') }}"><i
                        class="bi bi-building me-2"></i>Facilities</a>
                <a class="nav-link @yield('nav_spots')" href="{{ route('admin.tourist-spots.index') }}"><i
                        class="bi bi-geo-alt me-2"></i>Tourist Spots</a>
                <a class="nav-link @yield('nav_news')" href="{{ route('admin.news.index') }}"><i
                        class="bi bi-newspaper me-2"></i>News</a>
            </nav>
            <div class="sidebar-heading mt-2">Users & Commerce</div>
            <nav class="nav flex-column gap-1">
                <a class="nav-link @yield('nav_users')" href="{{ route('admin.users.index') }}"><i
                        class="bi bi-people me-2"></i>Users</a>
                <a class="nav-link @yield('nav_orders')" href="{{ route('admin.orders.index') }}"><i
                        class="bi bi-receipt me-2"></i>Orders</a>
                <a class="nav-link @yield('nav_messages')" href="{{ route('admin.messages.index') }}"><i
                        class="bi bi-chat-dots me-2"></i>Messages</a>
            </nav>
            <div class="mt-auto pt-4 px-1">
                <a class="nav-link text-white-50" href="{{ route('home') }}"><i class="bi bi-arrow-left me-2"></i>View
                    Site</a>
            </div>
        </div>

        <div class="flex-grow-1 d-flex flex-column">
            <div class="topbar px-4 py-2 d-flex align-items-center justify-content-between">
                <h6 class="mb-0 fw-semibold">@yield('title', 'Dashboard')</h6>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-sm btn-outline-secondary">Logout</button>
                </form>
            </div>

            <div class="p-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
