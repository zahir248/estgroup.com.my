@extends('layouts.app')

@section('title', 'Partner We Seek – ' . config('app.name', 'EST Group'))
@push('styles')
<style>
    /* Hero title override */
    .hero .content-container h1 { margin-bottom: 0; }

    /* Section headers (match other pages) */
    .section-label { font-size: 0.75rem; font-weight: 600; letter-spacing: 0.15em; color: #1a5f7a; text-transform: uppercase; margin-bottom: 0.5rem; }
    .section-title { color: #0d2137; font-weight: 700; letter-spacing: -0.02em; font-size: 2rem; margin-bottom: 0; }
    .section-header { margin-bottom: 2.5rem; }

    /* Scroll reveal */
    .reveal { opacity: 0; transform: translateY(28px); transition: opacity 0.7s var(--transition-smooth), transform 0.7s var(--transition-smooth); }
    .reveal.reveal-active { opacity: 1; transform: translateY(0); }
    .reveal-delay-1 { transition-delay: 0.1s; }
    .reveal-delay-2 { transition-delay: 0.2s; }
    .reveal-delay-3 { transition-delay: 0.3s; }
    .reveal-delay-4 { transition-delay: 0.4s; }

    /* Partner type cards (2x2 grid) */
    .section-partner-types { background: #f8f9fa; padding: 4rem 0; }
    .section-partner-types .section-header { margin-bottom: 2.5rem; }
    .partner-type-card { background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 12px 40px rgba(13, 33, 55, 0.18); transition: transform var(--transition-smooth), box-shadow var(--transition-smooth); height: 100%; display: flex; flex-direction: column; }
    .partner-type-card:hover { transform: translateY(-6px); box-shadow: 0 22px 52px rgba(13, 33, 55, 0.26); }
    .partner-type-card .card-img-wrap { overflow: hidden; aspect-ratio: 16/10; background: #e9ecef; }
    .partner-type-card .card-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform var(--transition-smooth); }
    .partner-type-card:hover .card-img-wrap img { transform: scale(1.04); }
    .partner-type-card .card-body { padding: 1.5rem 1.75rem; flex: 1; display: flex; flex-direction: column; }
    .partner-type-card .card-title { font-weight: 700; color: #0d2137; font-size: 1.15rem; margin-bottom: 0.75rem; text-align: center; }
    .partner-type-card .card-text { color: #5a5a5a; font-size: 0.95rem; line-height: 1.65; margin-bottom: 0; text-align: justify; }
    @media (prefers-reduced-motion: reduce) {
        .reveal { opacity: 1; transform: none; transition: none; }
        .partner-type-card .card-img-wrap img { transition: none; }
    }

    /* ========== Responsive: tablet & mobile ========== */
    @media (max-width: 991px) {
        .hero { min-height: 55vh; }
        .hero .content-container { padding: 1.5rem 1rem; }
        .section-title { font-size: 1.65rem; }
        .section-header { margin-bottom: 2rem; }
        .section-partner-types { padding: 3rem 0; }
        .section-partner-types .section-header { margin-bottom: 2rem; }
        .partner-type-card .card-img-wrap { aspect-ratio: 16/9; }
        .partner-type-card .card-body { padding: 1.25rem 1.5rem; }
        .partner-type-card .card-title { font-size: 1.05rem; margin-bottom: 0.6rem; }
        .partner-type-card .card-text { font-size: 0.9rem; text-align: justify !important; }
    }

    @media (max-width: 767px) {
        .hero { min-height: 50vh; }
        .hero .content-container { padding: 1.25rem 0.75rem; }
        .section-title { font-size: 1.45rem; }
        .section-header { margin-bottom: 1.5rem; }
        .section-partner-types { padding: 2.5rem 0; }
        .section-partner-types .section-header { margin-bottom: 1.5rem; }
        .section-partner-types .section-title { font-size: 1.35rem; }
        .partner-type-card .card-img-wrap { aspect-ratio: 4/3; }
        .partner-type-card .card-body { padding: 1rem 1.25rem; }
        .partner-type-card .card-title { font-size: 1rem; margin-bottom: 0.5rem; }
        .partner-type-card .card-text { font-size: 0.85rem; line-height: 1.6; text-align: justify !important; }
        .row.g-4.g-lg-5 { --bs-gutter-x: 0.75rem; --bs-gutter-y: 0.75rem; }
    }

    @media (max-width: 575px) {
        .hero { min-height: 45vh; }
        .hero .content-container h1 { font-size: clamp(1.15rem, 5vw, 1.5rem); }
        .section-title { font-size: 1.3rem; }
        .section-partner-types .section-title { font-size: 1.25rem; }
        .partner-type-card .card-title { font-size: 0.95rem; }
        .partner-type-card .card-text { font-size: 0.8rem; }
        .row.g-4.g-lg-5 { --bs-gutter-x: 0.5rem; --bs-gutter-y: 0.5rem; }
    }
</style>
@endpush

@section('content')
    <!-- Hero -->
    <section class="hero text-white text-center">
        @include('partials.hero-background', ['image' => 'images/hero-partners.jpg'])
        <div class="content-container">
            <h1>Partner We Seek</h1>
        </div>
    </section>

    <!-- Partner types (2x2 cards) -->
    <section class="section-partner-types reveal" id="partner-types">
        <div class="container">
            <div class="section-header text-center">
                <p class="section-label">Partnership</p>
                <h2 class="section-title">Who We Work With</h2>
            </div>
            <div class="row g-4 g-lg-5">
                <div class="col-md-6 reveal reveal-delay-1">
                    <div class="partner-type-card">
                        <div class="card-img-wrap">
                            <img src="{{ asset('partner-1.jpg') }}" alt="Investor - investment and partnership">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">You are INVESTOR</h3>
                            <p class="card-text">We provide investment opportunities from early stage of project development to fully connected PV Power Plants. Furthermore O&amp;M and Asset Management Services to secure long-term profits of your investment.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 reveal reveal-delay-2">
                    <div class="partner-type-card">
                        <div class="card-img-wrap">
                            <img src="{{ asset('partner-2.jpg') }}" alt="Project developer - technical assistance">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">You are PROJECT DEVELOPER</h3>
                            <p class="card-text">We can partner up with you from early stage of developments and provide technical assistance along the way or purchase your fully developed projects.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 reveal reveal-delay-3">
                    <div class="partner-type-card">
                        <div class="card-img-wrap">
                            <img src="{{ asset('partner-3.jpg') }}" alt="Off-taker - clean electricity">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">You are OFF-TAKER</h3>
                            <p class="card-text">You are an industrial or energy trading company and want to purchase clean and inexpensive electricity. We provide PV electricity so that you, your clients and the society benefit from your decision.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 reveal reveal-delay-4">
                    <div class="partner-type-card">
                        <div class="card-img-wrap">
                            <img src="{{ asset('partner-4.jpg') }}" alt="All in one - full PV solution">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">You are ALL IN ONE</h3>
                            <p class="card-text">Investor &amp; Developer &amp; Off-taker? We can simply design and build the most reliable and care-free PV system for you. A full package including Operations and Maintenance Service. So, you can concentrate your efforts on your core business.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
(function () {
    // Scroll reveal (same as other pages)
    var revealEls = document.querySelectorAll('.reveal');
    if (typeof IntersectionObserver !== 'undefined') {
        var revealObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) entry.target.classList.add('reveal-active');
            });
        }, { rootMargin: '0px 0px -60px 0px', threshold: 0.1 });
        revealEls.forEach(function (el) { revealObserver.observe(el); });
    } else {
        revealEls.forEach(function (el) { el.classList.add('reveal-active'); });
    }

})();
</script>
@endpush
