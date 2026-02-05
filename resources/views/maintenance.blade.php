@extends('layouts.minimal')

@section('title', 'Under Maintenance – ' . config('app.name', 'EST Group'))

@push('styles')
<style>
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
    .hero .maint-icon { font-size: clamp(3rem, 12vw, 5rem); margin-bottom: 0.5rem; opacity: 0.9; }
    .hero .maint-title { font-size: clamp(1.35rem, 4vw, 2rem); font-weight: 700; color: #fff; margin-bottom: 1rem; letter-spacing: -0.02em; }
    .hero .maint-message { font-size: 1.05rem; color: rgba(255, 255, 255, 0.85); max-width: 420px; margin-left: auto; margin-right: auto; line-height: 1.6; }
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
            <div class="maint-icon"><i class="bi bi-tools"></i></div>
            <p class="maint-title">Under Maintenance</p>
            <p class="maint-message">We're making some improvements. Please check back soon.</p>
        </div>
    </section>
@endsection
