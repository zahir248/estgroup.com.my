@extends('layouts.minimal')

@section('title', 'Under Maintenance – ' . config('app.name', 'EST Group'))

@push('styles')
<style>
    .hero { min-height: 100vh; }
    .hero .content-container { width: 100%; }
    .hero .maint-icon { font-size: clamp(3rem, 12vw, 5rem); margin-bottom: 0.5rem; opacity: 0.9; }
    .hero .maint-title { font-size: clamp(1.35rem, 4vw, 2rem); font-weight: 700; color: #fff; margin-bottom: 1rem; letter-spacing: -0.02em; }
    .hero .maint-message { font-size: 1.05rem; color: rgba(255, 255, 255, 0.85); max-width: 420px; margin-left: auto; margin-right: auto; line-height: 1.6; }
</style>
@endpush

@section('content')
    <section class="hero text-white text-center">
        @include('partials.hero-background', ['image' => 'images/hero-maintenance.jpg'])
        <div class="content-container">
            <div class="maint-icon"><i class="bi bi-tools"></i></div>
            <p class="maint-title">Under Maintenance</p>
            <p class="maint-message">We're making some improvements. Please check back soon.</p>
        </div>
    </section>
@endsection
