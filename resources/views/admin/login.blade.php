@extends('layouts.minimal')

@section('title', 'Admin Site – ' . config('app.name', 'EST Group'))

@push('styles')
<style>
    body { background: #fff; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem; }
    .admin-login-card { background: #fff; border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,0.12), 0 2px 8px rgba(0,0,0,0.08); border: 1px solid #e9ecef; overflow: hidden; max-width: 400px; width: 100%; }
    .admin-login-header { background: #0d2137; color: #fff; padding: 1.5rem 2rem; text-align: center; }
    .admin-login-header img { height: 40px; width: auto; margin-bottom: 0.5rem; }
    .admin-login-header h1 { font-size: 1.25rem; font-weight: 700; margin: 0; }
    .admin-login-header p { font-size: 0.85rem; color: rgba(255,255,255,0.8); margin: 0.25rem 0 0; }
    .admin-login-body { padding: 2rem; }
    .admin-login-body .form-label { font-weight: 600; color: #0d2137; }
    .admin-login-body .form-control { border-radius: 8px; padding: 0.6rem 0.9rem; border: 1px solid #dee2e6; }
    .admin-login-body .form-control:focus { border-color: #1a5f7a; box-shadow: 0 0 0 0.2rem rgba(26, 95, 122, 0.2); }
    .admin-login-body .btn-login { background: linear-gradient(135deg, #1a5f7a, #2d8ba8); color: #fff; font-weight: 600; padding: 0.65rem 1.5rem; border: none; border-radius: 8px; width: 100%; }
    .admin-login-body .btn-login:hover { color: #fff; opacity: 0.95; }
    /* Toast (same as admin layout) */
    .admin-toast-container { position: fixed; top: 1rem; right: 1rem; z-index: 9999; display: flex; flex-direction: column; gap: 0.5rem; max-width: 360px; }
    .admin-toast { display: flex; align-items: flex-start; gap: 0.75rem; padding: 0.875rem 1rem; border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,0.15); animation: admin-toast-in 0.35s ease; background: #fff; border-left: 4px solid; }
    .admin-toast.admin-toast-error { border-left-color: #dc3545; }
    .admin-toast.admin-toast-error .admin-toast-icon { color: #dc3545; }
    .admin-toast-icon { font-size: 1.25rem; flex-shrink: 0; margin-top: 0.1rem; }
    .admin-toast-body { flex: 1; font-size: 0.9rem; color: #1a1a1a; }
    .admin-toast-close { background: none; border: none; color: #6c757d; padding: 0 0.25rem; cursor: pointer; font-size: 1.1rem; line-height: 1; }
    .admin-toast-close:hover { color: #1a1a1a; }
    @keyframes admin-toast-in { from { opacity: 0; transform: translateX(100%); } to { opacity: 1; transform: translateX(0); } }
</style>
@endpush

@section('content')
    <div class="admin-toast-container" id="adminToastContainer" aria-live="polite"></div>
    <div class="admin-login-card">
        <div class="admin-login-header">
            <img src="{{ asset('estgroup logo.png') }}" alt="{{ config('app.name') }}">
            <h1>Admin Site</h1>
            <p>EST Group</p>
        </div>
        <div class="admin-login-body">
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <button type="submit" class="btn btn-login">Sign in</button>
            </form>
        </div>
    </div>
    @if($errors->any())
    <script>
        (function() {
            var container = document.getElementById('adminToastContainer');
            var messages = @json($errors->all());
            if (!container || !messages.length) return;
            var message = messages.length === 1 ? messages[0] : messages.join(' ');
            var toast = document.createElement('div');
            toast.className = 'admin-toast admin-toast-error';
            toast.setAttribute('role', 'alert');
            toast.innerHTML = '<span class="admin-toast-icon bi bi-exclamation-circle-fill" aria-hidden="true"></span><span class="admin-toast-body"></span><button type="button" class="admin-toast-close" aria-label="Close">&times;</button>';
            toast.querySelector('.admin-toast-body').textContent = message;
            toast.querySelector('.admin-toast-close').onclick = function() { toast.remove(); };
            container.appendChild(toast);
            setTimeout(function() {
                if (toast.parentNode) {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateX(100%)';
                    toast.style.transition = 'opacity 0.3s, transform 0.3s';
                    setTimeout(function() { toast.remove(); }, 300);
                }
            }, 4500);
        })();
    </script>
    @endif
@endsection
