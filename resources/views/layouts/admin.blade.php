<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') – Admin</title>
    <link rel="icon" href="{{ asset('estgroup-logo.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --sidebar-bg: #0d2137; --sidebar-width: 240px; --topbar-height: 56px; --primary-accent: #1a5f7a; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f0f2f5; min-height: 100vh; }
        .admin-wrapper { display: flex; min-height: 100vh; }
        .admin-sidebar { width: var(--sidebar-width); background: var(--sidebar-bg); color: rgba(255,255,255,0.9); position: fixed; top: 0; left: 0; bottom: 0; z-index: 1030; }
        .admin-sidebar .brand { padding: 1rem 1.25rem; border-bottom: 1px solid rgba(255,255,255,0.08); display: flex; align-items: center; gap: 0.5rem; }
        .admin-sidebar .brand img { height: 32px; }
        .admin-sidebar .brand span { font-weight: 700; font-size: 1.1rem; }
        .admin-sidebar .nav { padding: 0.75rem 0; }
        .admin-sidebar .nav-link { color: rgba(255,255,255,0.75); padding: 0.6rem 1.25rem; display: flex; align-items: center; gap: 0.6rem; border-left: 3px solid transparent; }
        .admin-sidebar .nav-link:hover { color: #fff; background: rgba(255,255,255,0.06); }
        .admin-sidebar .nav-link.active { color: #fff; background: rgba(26,95,122,0.25); border-left-color: var(--primary-accent); }
        .admin-sidebar .nav-link.nav-link-parent { cursor: pointer; width: 100%; justify-content: space-between; }
        .admin-sidebar .nav-link-parent .bi-chevron-down { transition: transform 0.2s; }
        .admin-sidebar .nav-link-parent[aria-expanded="true"] .bi-chevron-down { transform: rotate(-180deg); }
        .admin-sidebar .nav-submenu { list-style: none; padding: 0 0 0 0.5rem; margin: 0; border-left: 1px solid rgba(255,255,255,0.1); margin-left: 1.25rem; }
        .admin-sidebar .nav-submenu .nav-link { padding: 0.45rem 0.75rem; font-size: 0.9rem; }
        .admin-main { flex: 1; margin-left: var(--sidebar-width); display: flex; flex-direction: column; min-height: 100vh; }
        .admin-topbar { height: var(--topbar-height); background: #fff; border-bottom: 1px solid #e9ecef; display: flex; align-items: center; justify-content: flex-end; padding: 0 1.5rem; }
        .admin-content { flex: 1; padding: 1.5rem; }
        .admin-content .page-title { font-size: 1.5rem; font-weight: 700; color: #0d2137; margin-bottom: 1rem; }
        /* Toast */
        .admin-toast-container { position: fixed; top: 1rem; right: 1rem; z-index: 9999; display: flex; flex-direction: column; gap: 0.5rem; max-width: 360px; }
        .admin-toast { display: flex; align-items: flex-start; gap: 0.75rem; padding: 0.875rem 1rem; border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); animation: admin-toast-in 0.35s ease; background: #fff; border-left: 4px solid; }
        .admin-toast.admin-toast-success { border-left-color: #198754; }
        .admin-toast.admin-toast-success .admin-toast-icon { color: #198754; }
        .admin-toast.admin-toast-error { border-left-color: #dc3545; }
        .admin-toast.admin-toast-error .admin-toast-icon { color: #dc3545; }
        .admin-toast-icon { font-size: 1.25rem; flex-shrink: 0; margin-top: 0.1rem; }
        .admin-toast-body { flex: 1; font-size: 0.9rem; color: #1a1a1a; }
        .admin-toast-close { background: none; border: none; color: #6c757d; padding: 0 0.25rem; cursor: pointer; font-size: 1.1rem; line-height: 1; }
        .admin-toast-close:hover { color: #1a1a1a; }
        @keyframes admin-toast-in { from { opacity: 0; transform: translateX(100%); } to { opacity: 1; transform: translateX(0); } }
    </style>
    @stack('styles')
</head>
<body>
    <div class="admin-wrapper">
        <aside class="admin-sidebar">
            <div class="brand">
                <img src="{{ asset('estgroup-logo.png') }}" alt="EST Group">
                <span>EST Admin</span>
            </div>
            <nav class="nav flex-column">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                <a class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}" href="{{ route('admin.settings') }}"><i class="bi bi-gear"></i> Settings</a>
                <div class="nav-item">
                    <a class="nav-link nav-link-parent {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}" href="#" data-bs-toggle="collapse" data-bs-target="#pagesSubmenu" aria-expanded="{{ request()->routeIs('admin.pages.*') ? 'true' : 'false' }}"><i class="bi bi-file-earmark-text"></i> Pages <i class="bi bi-chevron-down ms-auto small"></i></a>
                    <ul class="nav flex-column nav-submenu collapse {{ request()->routeIs('admin.pages.*') ? 'show' : '' }}" id="pagesSubmenu">
                        <li><a class="nav-link {{ request()->routeIs('admin.pages.home') ? 'active' : '' }}" href="{{ route('admin.pages.home') }}"><i class="bi bi-house"></i> Home</a></li>
                        <li><a class="nav-link {{ request()->routeIs('admin.pages.about') ? 'active' : '' }}" href="{{ route('admin.pages.about') }}"><i class="bi bi-person-badge"></i> About</a></li>
                        <li><a class="nav-link {{ request()->routeIs('admin.pages.contact') ? 'active' : '' }}" href="{{ route('admin.pages.contact') }}"><i class="bi bi-envelope"></i> Contact</a></li>
                    </ul>
                </div>
                <a class="nav-link" href="{{ url('/') }}" target="_blank" rel="noopener"><i class="bi bi-box-arrow-up-right"></i> View Site</a>
            </nav>
        </aside>
        <div class="admin-main">
            <header class="admin-topbar">
                <div class="dropdown">
                    <button class="btn btn-link text-decoration-none text-dark dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown"><i class="bi bi-person-circle"></i><span>{{ auth()->user()->name ?? 'Admin' }}</span></button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <form action="{{ route('admin.logout') }}" method="POST">@csrf<button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</button></form>
                        </li>
                    </ul>
                </div>
            </header>
            <main class="admin-content">
                @yield('content')
            </main>
        </div>
    </div>
    <div class="admin-toast-container" id="adminToastContainer" aria-live="polite"
        @if(session('success')) data-flash-success="{{ e(session('success')) }}" @endif
        @if(session('error')) data-flash-error="{{ e(session('error')) }}" @endif></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function() {
            var container = document.getElementById('adminToastContainer');
            if (!container) return;
            function showToast(message, type) {
                type = type || 'success';
                var icon = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-circle-fill';
                var toast = document.createElement('div');
                toast.className = 'admin-toast admin-toast-' + type;
                toast.setAttribute('role', 'alert');
                toast.innerHTML = '<span class="admin-toast-icon bi ' + icon + '" aria-hidden="true"></span><span class="admin-toast-body"></span><button type="button" class="admin-toast-close" aria-label="Close" onclick="this.closest(\'.admin-toast\').remove()">&times;</button>';
                toast.querySelector('.admin-toast-body').textContent = message;
                container.appendChild(toast);
                setTimeout(function() {
                    if (toast.parentNode) {
                        toast.style.opacity = '0';
                        toast.style.transform = 'translateX(100%)';
                        toast.style.transition = 'opacity 0.3s, transform 0.3s';
                        setTimeout(function() { toast.remove(); }, 300);
                    }
                }, 4500);
            }
            var successMsg = container.getAttribute('data-flash-success');
            var errorMsg = container.getAttribute('data-flash-error');
            if (successMsg) showToast(successMsg, 'success');
            if (errorMsg) showToast(errorMsg, 'error');
        })();
    </script>
    @stack('scripts')
</body>
</html>
