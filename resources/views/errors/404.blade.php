@extends('layouts.minimal')

@section('title', 'Page Not Found – ' . config('app.name', 'EST Group'))

@push('styles')
<style>
    .hero { min-height: 100vh; }
    .hero .content-container { width: 100%; }
    .hero .error-code { font-size: clamp(4rem, 15vw, 8rem); font-weight: 800; line-height: 1; margin-bottom: 0.5rem; background: linear-gradient(to right, #fff, rgba(45, 139, 168, 0.9)); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: -0.02em; }
    .hero .error-title { font-size: clamp(1.25rem, 3vw, 1.75rem); font-weight: 700; color: #fff; margin-bottom: 1rem; letter-spacing: -0.02em; }
    .hero .error-message { font-size: 1.05rem; color: rgba(255, 255, 255, 0.85); margin-bottom: 2rem; max-width: 420px; margin-left: auto; margin-right: auto; line-height: 1.6; }
    .hero .btn-home { background: linear-gradient(90deg, var(--primary-accent), #f7931e); color: #fff; font-weight: 600; padding: 0.75rem 1.75rem; border-radius: 50px; border: none; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.3s ease; box-shadow: 0 4px 20px rgba(26, 95, 122, 0.4); }
    .hero .btn-home:hover { color: #fff; transform: translateY(-2px); box-shadow: 0 6px 25px rgba(247, 147, 30, 0.4); }
</style>
@endpush

@section('content')
    <section class="hero text-white text-center">
        @include('partials.hero-background', ['image' => 'images/hero-404.jpg'])
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
