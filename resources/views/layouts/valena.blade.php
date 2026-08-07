<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Valena') – Valena</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --valena-brown: #6f3d1f;
            --valena-gold: #c9973a;
        }

        .navbar-brand {
            color: var(--valena-gold) !important;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .btn-valena {
            background: var(--valena-brown);
            color: #fff;
        }

        .btn-valena:hover {
            background: #4e2a12;
            color: #fff;
        }

        footer {
            background: var(--valena-brown);
            color: #f8e9d5;
        }

        .hero-section {
            background: linear-gradient(135deg, var(--valena-brown) 0%, #3d1f0a 100%);
        }
    </style>
    @stack('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background:var(--valena-brown)">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">&#9749; Valena</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('products.index') }}">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('facilities.index') }}">Facilities</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('tourist-spots.index') }}">Tourist Spots</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('news.index') }}">News</a></li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    @auth
                        <li class="nav-item"><a class="nav-link" href="{{ route('cart.index') }}"><i
                                    class="bi bi-cart3"></i> Cart</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('orders.index') }}">My Orders</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('messages.index') }}">Messages</a></li>
                        @if (auth()->user()->is_admin)
                            <li class="nav-item"><a class="nav-link text-warning" href="{{ route('admin.dashboard') }}"><i
                                        class="bi bi-gear-fill"></i> Admin</a></li>
                        @endif
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button class="btn btn-link nav-link text-white px-0">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @if (session('success'))
            <div class="container mt-3">
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="container mt-3">
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Valena &mdash; CSU Lal-lo Coffee Tourism Platform</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
