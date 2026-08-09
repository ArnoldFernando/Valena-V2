<!doctype html>
<html lang="en" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Valena') – Valena</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --valena-brown: #5c2d0e;
            --valena-brown-light: #7a3d14;
            --valena-gold: #d4a853;
            --valena-gold-light: #f0c878;
            --valena-cream: #fdf6ec;
            --valena-dark: #1a0a02;
            --valena-body-bg: #fafafa;
            --valena-body-text: #1a1a2e;
            --valena-surface: #ffffff;
            --valena-surface-text: #1a1a2e;
            --valena-muted: #6b7280;
            --valena-border-soft: rgba(0, 0, 0, .08);
            --valena-footer-bg: #1a0a02;
            --valena-footer-text: rgba(255, 255, 255, .7);
            --valena-footer-strong: #ffffff;
            --valena-input-bg: #ffffff;
            --valena-input-text: #1a1a2e;
            --valena-placeholder-bg: #f3f4f6;
            --valena-placeholder-icon: #6b7280;
        }

        html[data-theme="dark"] {
            --valena-body-bg: #0f1115;
            --valena-body-text: #e5e7eb;
            --valena-surface: #171a21;
            --valena-surface-text: #e5e7eb;
            --valena-muted: #9ca3af;
            --valena-cream: #151922;
            --valena-border-soft: rgba(255, 255, 255, .12);
            --valena-footer-bg: #090b0f;
            --valena-footer-text: rgba(229, 231, 235, .75);
            --valena-footer-strong: #f3f4f6;
            --valena-input-bg: #111827;
            --valena-input-text: #e5e7eb;
            --valena-placeholder-bg: #1f2937;
            --valena-placeholder-icon: #cbd5e1;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--valena-body-bg);
            color: var(--valena-body-text);
            transition: background-color .2s ease, color .2s ease;
        }

        h1,
        h2,
        h3,
        .font-display {
            font-family: 'Playfair Display', serif;
        }

        /* ── Navbar ── */
        .valena-nav {
            background: rgba(92, 45, 14, 0.97);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(212, 168, 83, .2);
            padding: .75rem 0;
            position: sticky;
            top: 0;
            z-index: 1030;
            transition: box-shadow .3s;
        }

        .valena-nav.scrolled {
            box-shadow: 0 4px 24px rgba(0, 0, 0, .25);
        }

        .navbar-brand {
            color: var(--valena-gold) !important;
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: -.02em;
        }

        .valena-nav .nav-link {
            color: rgba(255, 255, 255, .82) !important;
            font-size: .875rem;
            font-weight: 500;
            padding: .45rem .9rem !important;
            border-radius: 6px;
            transition: background .2s, color .2s;
        }

        .valena-nav .nav-link:hover {
            color: #fff !important;
            background: rgba(255, 255, 255, .1);
        }

        .valena-nav .nav-link.active {
            color: var(--valena-gold) !important;
        }

        .btn-nav-outline {
            border: 1.5px solid rgba(255, 255, 255, .35);
            color: #fff !important;
            border-radius: 8px;
            font-size: .85rem;
            padding: .35rem .9rem;
            transition: all .2s;
        }

        .btn-nav-outline:hover {
            background: rgba(255, 255, 255, .12);
            border-color: rgba(255, 255, 255, .7);
        }

        .btn-nav-gold {
            background: var(--valena-gold);
            color: var(--valena-dark) !important;
            font-weight: 600;
            border-radius: 8px;
            font-size: .85rem;
            padding: .35rem .9rem;
            transition: all .2s;
        }

        .btn-nav-gold:hover {
            background: var(--valena-gold-light);
        }

        /* ── Buttons ── */
        .btn-valena {
            background: var(--valena-brown);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            letter-spacing: .01em;
            transition: all .2s;
            box-shadow: 0 2px 8px rgba(92, 45, 14, .25);
        }

        .btn-valena:hover {
            background: var(--valena-brown-light);
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(92, 45, 14, .35);
        }

        .btn-valena-outline {
            border: 2px solid var(--valena-brown);
            color: var(--valena-brown);
            background: transparent;
            border-radius: 10px;
            font-weight: 600;
            transition: all .2s;
        }

        .btn-valena-outline:hover {
            background: var(--valena-brown);
            color: #fff;
        }

        /* ── Cards ── */
        .v-card {
            border: none;
            border-radius: 16px;
            background: var(--valena-surface);
            color: var(--valena-surface-text);
            box-shadow: 0 2px 16px rgba(0, 0, 0, .07);
            overflow: hidden;
            transition: transform .25s, box-shadow .25s;
        }

        .v-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, .12);
        }

        .v-card .card-img-wrap {
            overflow: hidden;
            height: 210px;
        }

        .v-card .card-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .4s ease;
        }

        .v-card:hover .card-img-wrap img {
            transform: scale(1.05);
        }

        /* ── Section headings ── */
        .section-eyebrow {
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .12em;
            color: var(--valena-gold);
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(1.7rem, 4vw, 2.4rem);
            color: var(--valena-surface-text);
            line-height: 1.2;
        }

        /* ── Badge ── */
        .badge-promo {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: #fff;
            font-size: .7rem;
            border-radius: 20px;
            padding: .3em .7em;
        }

        /* ── Price tag ── */
        .price-tag {
            color: var(--valena-brown);
            font-weight: 700;
            font-size: 1.1rem;
        }

        /* ── Alerts ── */
        .toast-success {
            background: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
            border-radius: 10px;
            padding: .85rem 1.1rem;
        }

        .toast-error {
            background: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
            border-radius: 10px;
        }

        /* ── Footer ── */
        footer {
            background: var(--valena-footer-bg);
            color: var(--valena-footer-text);
            border-top: 3px solid var(--valena-gold);
        }

        footer a {
            color: var(--valena-gold);
            text-decoration: none;
        }

        footer a:hover {
            color: var(--valena-gold-light);
        }

        /* ── Hero ── */
        .hero-section {
            background: linear-gradient(135deg, var(--valena-dark) 0%, var(--valena-brown) 60%, #8b4513 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .theme-toggle-btn {
            border: 1.5px solid rgba(255, 255, 255, .35);
            color: #fff !important;
            border-radius: 8px;
            font-size: .85rem;
            padding: .35rem .9rem;
            transition: all .2s;
            min-width: 104px;
        }

        .theme-toggle-btn:hover {
            background: rgba(255, 255, 255, .12);
            border-color: rgba(255, 255, 255, .7);
        }

        .theme-toggle-btn:focus-visible {
            box-shadow: 0 0 0 .2rem rgba(212, 168, 83, .35);
        }

        html[data-theme="dark"] .dropdown-menu {
            background: var(--valena-surface);
            color: var(--valena-surface-text);
            border: 1px solid var(--valena-border-soft);
        }

        html[data-theme="dark"] .dropdown-item {
            color: var(--valena-surface-text);
        }

        html[data-theme="dark"] .dropdown-item:hover,
        html[data-theme="dark"] .dropdown-item:focus {
            background: rgba(255, 255, 255, .08);
        }

        html[data-theme="dark"] .dropdown-divider {
            border-color: var(--valena-border-soft);
        }

        html[data-theme="dark"] .text-muted {
            color: var(--valena-muted) !important;
        }

        html[data-theme="dark"] .text-dark {
            color: var(--valena-body-text) !important;
        }

        html[data-theme="dark"] .text-white {
            color: var(--valena-footer-strong) !important;
        }

        html[data-theme="dark"] .form-control,
        html[data-theme="dark"] .form-select {
            background-color: var(--valena-input-bg);
            border-color: var(--valena-border-soft);
            color: var(--valena-input-text);
        }

        html[data-theme="dark"] .form-control:focus,
        html[data-theme="dark"] .form-select:focus {
            background-color: var(--valena-input-bg);
            color: var(--valena-input-text);
            border-color: var(--valena-gold);
            box-shadow: 0 0 0 .2rem rgba(212, 168, 83, .25);
        }

        html[data-theme="dark"] .card,
        html[data-theme="dark"] .modal-content,
        html[data-theme="dark"] .table {
            background: var(--valena-surface);
            color: var(--valena-surface-text);
        }

        .home-facilities-section {
            background: var(--valena-cream);
        }

        .home-placeholder {
            background: var(--valena-placeholder-bg);
        }

        .home-placeholder i {
            color: var(--valena-placeholder-icon) !important;
        }
        /* ── Gallery thumb ── */
        .gallery-thumb {
            cursor: pointer;
            border-radius: 10px;
            transition: opacity .2s, transform .2s;
        }

        .gallery-thumb:hover {
            opacity: .85;
            transform: scale(1.02);
        }

        /* ── Responsive tweaks ── */
        @media (max-width: 576px) {
            .hero-section {
                padding: 3rem 0;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <nav class="valena-nav navbar navbar-expand-lg" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">☕ Valena</a>
            <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navMain">
                <i class="bi bi-list fs-4"></i>
            </button>
            <div class="collapse navbar-collapse" id="navMain">
                <ul class="navbar-nav mx-auto gap-1">
                    <li class="nav-item"><a class="nav-link @yield('nav_home')" href="{{ route('home') }}">Home</a></li>
                    <li class="nav-item"><a class="nav-link @yield('nav_products')"
                            href="{{ route('products.index') }}">Products</a></li>
                    <li class="nav-item"><a class="nav-link @yield('nav_facilities')"
                            href="{{ route('facilities.index') }}">Facilities</a></li>
                    <li class="nav-item"><a class="nav-link @yield('nav_spots')"
                            href="{{ route('tourist-spots.index') }}">Tourist Spots</a></li>
                    <li class="nav-item"><a class="nav-link @yield('nav_news')" href="{{ route('news.index') }}">News</a>
                    </li>
                </ul>
                <ul class="navbar-nav align-items-lg-center gap-2 mt-2 mt-lg-0">
                    <li class="nav-item">
                        <button class="theme-toggle-btn btn d-inline-flex align-items-center justify-content-center gap-1"
                            id="themeToggleButton" type="button" aria-label="Toggle color theme">
                            <i class="bi bi-moon-stars-fill" id="themeToggleIcon"></i>
                            <span id="themeToggleLabel">Dark</span>
                        </button>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="btn-nav-outline btn" href="{{ route('cart.index') }}">
                                <i class="bi bi-bag2 me-1"></i>Cart
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="btn-nav-gold btn dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-1">
                                <li><a class="dropdown-item" href="{{ route('orders.index') }}"><i
                                            class="bi bi-receipt me-2 text-muted"></i>My Orders</a></li>
                                <li><a class="dropdown-item" href="{{ route('messages.index') }}"><i
                                            class="bi bi-chat-dots me-2 text-muted"></i>Messages</a></li>
                                @if (auth()->user()->is_admin)
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item text-warning fw-semibold"
                                            href="{{ route('admin.dashboard') }}"><i
                                                class="bi bi-shield-lock me-2"></i>Admin Panel</a></li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item text-danger"><i
                                                class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="btn-nav-outline btn" href="{{ route('login') }}">Login</a></li>
                        <li class="nav-item"><a class="btn-nav-gold btn" href="{{ route('register') }}">Get Started</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @if (session('success'))
            <div class="container mt-4">
                <div class="toast-success d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <span>{{ session('success') }}</span>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="container mt-4">
                <div class="toast-error p-3 rounded-3 border-start border-danger border-4">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="py-5 mt-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="fw-bold fs-5 mb-2"
                        style="font-family:'Playfair Display',serif;color:var(--valena-gold)">☕ Valena</div>
                    <p class="small mb-0">CSU Lal-lo Coffee Tourism &amp; E-Commerce Platform. Bringing the best of
                        Cagayan's coffee culture to you.</p>
                </div>
                <div class="col-md-4">
                    <p class="fw-semibold mb-2 text-white">Explore</p>
                    <ul class="list-unstyled small mb-0">
                        <li><a href="{{ route('products.index') }}">Products</a></li>
                        <li><a href="{{ route('facilities.index') }}">Facilities</a></li>
                        <li><a href="{{ route('tourist-spots.index') }}">Tourist Spots</a></li>
                        <li><a href="{{ route('news.index') }}">News</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <p class="fw-semibold mb-2 text-white">Account</p>
                    <ul class="list-unstyled small mb-0">
                        @auth
                            <li><a href="{{ route('cart.index') }}">My Cart</a></li>
                            <li><a href="{{ route('orders.index') }}">My Orders</a></li>
                            <li><a href="{{ route('messages.index') }}">Messages</a></li>
                        @else
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
            <hr class="mt-4" style="border-color:rgba(255,255,255,.1)">
            <p class="text-center small mb-0">&copy; {{ date('Y') }} Valena — CSU Lal-lo. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (() => {
            const storageKey = 'valena-theme';
            const root = document.documentElement;
            const button = document.getElementById('themeToggleButton');
            const label = document.getElementById('themeToggleLabel');
            const icon = document.getElementById('themeToggleIcon');

            const getSystemTheme = () => window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';

            const updateThemeToggleUI = (theme) => {
                const nextTheme = theme === 'dark' ? 'light' : 'dark';
                label.textContent = nextTheme === 'dark' ? 'Dark' : 'Light';
                icon.className = nextTheme === 'dark' ? 'bi bi-moon-stars-fill' : 'bi bi-sun-fill';
                button.setAttribute('aria-label', `Switch to ${nextTheme} mode`);
            };

            const applyTheme = (theme) => {
                root.setAttribute('data-theme', theme);
                updateThemeToggleUI(theme);
            };

            const storedTheme = localStorage.getItem(storageKey);
            const initialTheme = storedTheme === 'light' || storedTheme === 'dark' ? storedTheme : getSystemTheme();
            applyTheme(initialTheme);

            if (button) {
                button.addEventListener('click', () => {
                    const currentTheme = root.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
                    const nextTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    localStorage.setItem(storageKey, nextTheme);
                    applyTheme(nextTheme);
                });
            }
        })();

        // Add scrolled class to navbar for shadow effect
        window.addEventListener('scroll', () => {
            document.getElementById('mainNav').classList.toggle('scrolled', window.scrollY > 20);
        });
    </script>
    @stack('scripts')
</body>

</html>
