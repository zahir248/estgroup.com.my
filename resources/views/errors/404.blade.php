@extends('layouts.minimal')

@section('title', 'Page Not Found – ' . config('app.name', 'EST Group'))

@push('styles')
<style>
    /* Hero (match other pages) */
    .hero { min-height: 100vh; position: relative; overflow: hidden; background-color: #0a1628; display: flex; align-items: center; justify-content: center; }
    .hero .gradient-background { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; overflow: hidden; }
    .hero .gradient-sphere { position: absolute; border-radius: 50%; filter: blur(60px); }
    .hero .sphere-1 { width: 40vw; height: 40vw; background: linear-gradient(40deg, rgba(13, 33, 55, 0.9), rgba(26, 95, 122, 0.5)); top: -10%; left: -10%; animation: hero-float-1 15s ease-in-out infinite alternate; }
    .hero .sphere-2 { width: 45vw; height: 45vw; background: linear-gradient(240deg, rgba(26, 95, 122, 0.7), rgba(45, 139, 168, 0.5)); bottom: -20%; right: -10%; animation: hero-float-2 18s ease-in-out infinite alternate; }
    .hero .sphere-3 { width: 30vw; height: 30vw; background: linear-gradient(120deg, rgba(245, 166, 35, 0.35), rgba(26, 95, 122, 0.4)); top: 60%; left: 20%; animation: hero-float-3 20s ease-in-out infinite alternate; }
    @keyframes hero-float-1 { 0% { transform: translate(0, 0) scale(1); } 100% { transform: translate(10%, 10%) scale(1.1); } }
    @keyframes hero-float-2 { 0% { transform: translate(0, 0) scale(1); } 100% { transform: translate(-10%, -5%) scale(1.15); } }
    @keyframes hero-float-3 { 0% { transform: translate(0, 0) scale(1); opacity: 0.3; } 100% { transform: translate(-5%, 10%) scale(1.05); opacity: 0.6; } }
    .hero .grid-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-size: 40px 40px; background-image: linear-gradient(to right, rgba(255,255,255,0.03) 1px, transparent 1px), linear-gradient(to bottom, rgba(255,255,255,0.03) 1px, transparent 1px); z-index: 2; }
    .hero .glow { position: absolute; width: 40vw; height: 40vh; background: radial-gradient(circle, rgba(26, 95, 122, 0.2), transparent 70%); top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 2; animation: hero-pulse 8s infinite alternate; filter: blur(30px); }
    @keyframes hero-pulse { 0% { opacity: 0.3; transform: translate(-50%, -50%) scale(0.9); } 100% { opacity: 0.7; transform: translate(-50%, -50%) scale(1.1); } }
    .hero .noise-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.05; z-index: 5; background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E"); }
    .hero .content-container { position: relative; z-index: 10; text-align: center; max-width: 100%; padding: 2rem 1.5rem; }
    .hero .error-code { font-size: clamp(4rem, 15vw, 8rem); font-weight: 800; line-height: 1; margin-bottom: 0.5rem; background: linear-gradient(to right, #fff, rgba(45, 139, 168, 0.9)); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: -0.02em; }
    .hero .error-title { font-size: clamp(1.25rem, 3vw, 1.75rem); font-weight: 700; color: #fff; margin-bottom: 1rem; letter-spacing: -0.02em; }
    .hero .error-message { font-size: 1.05rem; color: rgba(255, 255, 255, 0.85); margin-bottom: 2rem; max-width: 420px; margin-left: auto; margin-right: auto; line-height: 1.6; }
    .hero .btn-home { background: linear-gradient(90deg, var(--primary-accent), #f7931e); color: #fff; font-weight: 600; padding: 0.75rem 1.75rem; border-radius: 50px; border: none; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.3s ease; box-shadow: 0 4px 20px rgba(26, 95, 122, 0.4); }
    .hero .btn-home:hover { color: #fff; transform: translateY(-2px); box-shadow: 0 6px 25px rgba(247, 147, 30, 0.4); }
</style>
@endpush

@section('content')
    <section class="hero text-white text-center">
        <div class="gradient-background">
            <div class="gradient-sphere sphere-1"></div>
            <div class="gradient-sphere sphere-2"></div>
            <div class="gradient-sphere sphere-3"></div>
            <div class="glow"></div>
            <div class="grid-overlay"></div>
            <div class="noise-overlay"></div>
        </div>
        <div class="content-container">
            <h1 class="error-code">404</h1>
            <p class="error-title">Page Not Found</p>
            <p class="error-message">The page you're looking for doesn't exist or has been moved. Let's get you back on track.</p>
            <a href="{{ url('/') }}" class="btn-home">
                <i class="bi bi-house-door-fill"></i> Back to Home
            </a>
        </div>
    </section>
@endsection
