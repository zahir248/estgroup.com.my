<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="EST Group – Building excellence through innovation and integrity.">
    <title>@yield('title', config('app.name', 'EST Group'))</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('estgroup logo.png') }}" type="image/png">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bs-body-font-family: 'Plus Jakarta Sans', sans-serif;
            --primary-dark: #0d2137;
            --primary-accent: #1a5f7a;
            --primary-light: #2d8ba8;
            --accent-gold: #f5a623;
            --transition-smooth: 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }
        body { font-family: var(--bs-body-font-family); overflow-x: hidden; }
        .navbar { transition: transform 0.35s ease, background-color 0.3s ease, box-shadow 0.3s ease; }
        .navbar.scrolled { background-color: rgba(13, 33, 55, 0.98) !important; box-shadow: 0 2px 20px rgba(0,0,0,0.1); }
        .navbar.navbar-hidden { transform: translateY(-100%) !important; }
        .navbar-brand img { height: 40px; width: auto; }
        .nav-link { transition: opacity 0.25s ease; }
        .nav-link:hover { opacity: 0.9; }
        .nav-link.active { color: #fff !important; font-weight: 600; }
        footer { background: var(--primary-dark); color: rgba(255,255,255,0.85); }
        footer a { color: rgba(255,255,255,0.8); text-decoration: none; transition: color 0.25s ease, opacity 0.25s ease; }
        footer a:hover { color: #fff; opacity: 1; }
        .footer-logo { height: 36px; width: auto; }

        /* Navbar responsive: tablet & mobile */
        @media (max-width: 991px) {
            .navbar .container { max-width: 100%; }
            .navbar-brand img { height: 36px; }
            .navbar-collapse { background: rgba(13, 33, 55, 0.98); margin: 0.5rem -0.75rem -0.5rem; padding: 1rem 0.75rem 1.25rem; border-radius: 0 0 12px 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.15); }
            .navbar-collapse .navbar-nav { gap: 0 !important; }
            .navbar-collapse .nav-item { border-bottom: 1px solid rgba(255,255,255,0.08); }
            .navbar-collapse .nav-item:last-child { border-bottom: none; }
            .navbar-collapse .nav-link { padding: 0.75rem 0.5rem !important; display: block; text-align: center; }
            .navbar-collapse .nav-item .btn { margin: 0.5rem 0 0 !important; display: block; text-align: center; }
        }
        @media (max-width: 767px) {
            .navbar { padding-top: 0.6rem !important; padding-bottom: 0.6rem !important; }
            .navbar-brand img { height: 32px; }
            .navbar-toggler { padding: 0.35rem 0.5rem; }
            .navbar-toggler-icon { width: 1.25em; height: 1.25em; }
            .navbar-collapse { margin: 0.5rem -0.5rem -0.5rem; padding: 0.75rem 0.5rem 1rem; }
            .navbar-collapse .nav-link { padding: 0.65rem 0.5rem !important; font-size: 0.95rem; }
        }

        /* Footer responsive: tablet & mobile */
        @media (max-width: 991px) {
            footer { padding-top: 2.5rem !important; padding-bottom: 2.5rem !important; }
            footer .row.align-items-center { flex-direction: column; gap: 1.5rem; text-align: center; }
            footer .row.align-items-center .col-auto:first-child { order: 1; }
            footer .row.align-items-center .col-auto:last-child { order: 2; }
            footer nav { justify-content: center; }
            footer .row.mt-4 { margin-top: 1.5rem !important; padding-top: 1.5rem !important; }
            footer .row.mt-4 small { font-size: 0.8rem; }
        }
        @media (max-width: 767px) {
            footer { padding-top: 2rem !important; padding-bottom: 2rem !important; }
            .footer-logo { height: 30px; }
            footer nav { gap: 0.75rem !important; flex-wrap: wrap; justify-content: center; }
            footer nav a { font-size: 0.9rem; }
            footer .row.mt-4 { margin-top: 1.25rem !important; padding-top: 1.25rem !important; }
            footer .row.mt-4 small { font-size: 0.75rem; }
        }

        /* Center section headers and titles on tablet and mobile */
        @media (max-width: 991px) {
            .section-header { text-align: center !important; }
            .section-header .section-label,
            .section-header .section-title { text-align: center !important; }
            .section-title { text-align: center !important; }
        }
    </style>
    @stack('styles')
</head>
<body>
    @include('partials.navbar')

    @yield('content')

    @include('partials.footer')

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            var nav = document.getElementById('mainNav');
            if (!nav) return;
            var lastScrollY = window.scrollY;
            var scrollThreshold = 60;
            var scrollDelta = 5;
            function updateNav() {
                var scrollY = window.scrollY;
                if (scrollY > 50) {
                    nav.classList.add('scrolled');
                    if (scrollY > scrollThreshold) {
                        if (scrollY - lastScrollY > scrollDelta) nav.classList.add('navbar-hidden');
                        else if (lastScrollY - scrollY > scrollDelta) nav.classList.remove('navbar-hidden');
                    } else {
                        nav.classList.remove('navbar-hidden');
                    }
                } else {
                    nav.classList.remove('scrolled', 'navbar-hidden');
                }
                lastScrollY = scrollY;
            }
            window.addEventListener('scroll', updateNav, { passive: true });
            updateNav();

            document.querySelectorAll('a[href^="#"]').forEach(function (a) {
                a.addEventListener('click', function (e) {
                    var id = this.getAttribute('href');
                    if (id === '#') return;
                    e.preventDefault();
                    var el = document.querySelector(id);
                    if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
                });
            });
        })();
    </script>
    @stack('scripts')
</body>
</html>
