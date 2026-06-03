@extends('layouts.app')

@section('title', 'Our Services – ' . config('app.name', 'EST Group'))

@push('styles')
<style>
    /* Hero title override */
    .hero .content-container h1 { margin-bottom: 0; }

    /* Section headers (match About page) */
    .section-label { font-size: 0.75rem; font-weight: 600; letter-spacing: 0.15em; color: #1a5f7a; text-transform: uppercase; margin-bottom: 0.5rem; }
    .section-title { color: #0d2137; font-weight: 700; letter-spacing: -0.02em; font-size: 2rem; margin-bottom: 0; }
    .section-header { margin-bottom: 2.5rem; }

    /* Scroll reveal (same as Home/About) */
    .reveal { opacity: 0; transform: translateY(28px); transition: opacity 0.7s var(--transition-smooth), transform 0.7s var(--transition-smooth); }
    .reveal.reveal-active { opacity: 1; transform: translateY(0); }
    .reveal-delay-1 { transition-delay: 0.1s; }
    .reveal-delay-2 { transition-delay: 0.2s; }
    .reveal-delay-3 { transition-delay: 0.3s; }
    .reveal-delay-4 { transition-delay: 0.4s; }

    /* What we do section (based on provided screenshot) */
    .whatwedo { background: #f8f9fa; }
    .whatwedo .whatwedo-ornament { display: inline-flex; align-items: center; gap: 14px; margin-top: 1rem; margin-bottom: 1.25rem; }
    .whatwedo .whatwedo-line { width: 54px; height: 4px; background: #f5a623; border-radius: 999px; }
    .whatwedo .whatwedo-diamond { width: 14px; height: 14px; background: #f5a623; transform: rotate(45deg); border-radius: 2px; }
    .whatwedo .whatwedo-intro { color: #5a5a5a; max-width: 980px; margin: 0 auto 2.5rem; line-height: 1.7; font-size: 1.05rem; text-align: center; }

    .whatwedo-gallery { margin: 0 0 2.5rem; width: 100%; }
    .whatwedo-gallery .gallery-card { border-radius: 10px; overflow: hidden; box-shadow: 0 12px 40px rgba(13, 33, 55, 0.18); transition: transform var(--transition-smooth), box-shadow var(--transition-smooth); background: #e9ecef; }
    .whatwedo-gallery .gallery-card:hover { transform: translateY(-8px); box-shadow: 0 24px 56px rgba(13, 33, 55, 0.26); }
    .whatwedo-gallery .gallery-card-inner { position: relative; width: 100%; aspect-ratio: 4/3; overflow: hidden; }
    .whatwedo-gallery .gallery-img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; transition: transform var(--transition-smooth); }
    .whatwedo-gallery .gallery-card:hover .gallery-img { transform: scale(1.06); }

    .services-panel { background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 14px 42px rgba(13, 33, 55, 0.18); }
    .services-tabs { background: #0b4aa2; padding: 20px 18px; }
    .services-tabs .tab-btn { width: 100%; border: 0; background: rgba(255, 255, 255, 0.18); color: #fff; font-weight: 700; border-radius: 8px; padding: 18px 16px; text-align: center; line-height: 1.3; cursor: default; }
    .services-tabs .tab-btn + .tab-btn { margin-top: 14px; }
    .services-tabs .tab-btn.is-active { background: #ffffff; color: #0d2137; }

    .services-content { padding: 28px 30px; }
    .services-content p { color: #5a5a5a; line-height: 1.7; margin-bottom: 1.25rem; }
    .services-content ul { margin: 0; padding-left: 1.1rem; }
    .services-content li { color: #5a5a5a; line-height: 1.8; }

    /* Our Product (card style – match Home page) */
    .section-our-product { background: #fff; }
    .section-our-product .product-banner { background: #fff; padding: 0; text-align: center; }
    .section-our-product .dana-tenaga-card { background: transparent; border: none; border-radius: 0; padding: 2rem; max-width: 400px; margin: 0 auto; display: inline-block; transition: transform var(--transition-smooth), opacity 0.25s ease; }
    .section-our-product .dana-tenaga-card:hover { transform: scale(1.03); opacity: 0.9; }
    .section-our-product .dana-tenaga-card .logo-wrap { display: block; line-height: 0; }
    .section-our-product .dana-tenaga-card .logo-wrap img { max-width: 100%; height: auto; display: block; vertical-align: middle; }

    @media (prefers-reduced-motion: reduce) {
        .reveal { opacity: 1; transform: none; transition: none; }
        .whatwedo-gallery .gallery-img { transition: none; }
    }

    /* ========== Responsive: tablet & mobile ========== */
    @media (max-width: 991px) {
        .hero { min-height: 55vh; }
        .hero .content-container { padding: 1.5rem 1rem; }
        .section-title { font-size: 1.65rem; }
        .section-header { margin-bottom: 2rem; }
        .whatwedo { padding-top: 3rem !important; padding-bottom: 3rem !important; }
        .whatwedo .whatwedo-intro { font-size: 0.95rem; margin-bottom: 2rem; }
        .whatwedo-gallery { margin-bottom: 2rem; }
        .whatwedo-gallery .gallery-card-inner { aspect-ratio: 16/10; }
        .services-tabs { padding: 16px; }
        .services-tabs .tab-btn { padding: 14px 12px; font-size: 0.9rem; }
        .services-tabs .tab-btn + .tab-btn { margin-top: 10px; }
        .services-content { padding: 22px; }
        .services-content p { font-size: 0.95rem; }
        .section-our-product { padding-top: 3rem !important; padding-bottom: 3rem !important; }
        .section-our-product .section-title { font-size: 1.75rem; }
        .section-our-product .dana-tenaga-card { padding: 1.5rem; }
    }

    @media (max-width: 767px) {
        .hero { min-height: 50vh; }
        .hero .content-container { padding: 1.25rem 0.75rem; }
        .section-title { font-size: 1.45rem; }
        .section-header { margin-bottom: 1.5rem; }
        .whatwedo { padding-top: 2rem !important; padding-bottom: 2rem !important; }
        .whatwedo .whatwedo-ornament { margin-top: 0.75rem; margin-bottom: 1rem; }
        .whatwedo .whatwedo-intro { font-size: 0.9rem; margin-bottom: 1.5rem; line-height: 1.6; }
        .whatwedo-gallery { margin-bottom: 1.5rem; }
        .whatwedo-gallery .row.g-3 { --bs-gutter-y: 0.75rem; }
        .whatwedo-gallery .gallery-card-inner { aspect-ratio: 4/3; }
        .services-panel .row { flex-direction: column; }
        .services-panel .col-lg-4 { max-width: 100%; }
        .services-panel .col-lg-8 { max-width: 100%; }
        .services-tabs { padding: 12px 14px; flex-direction: row !important; flex-wrap: wrap; gap: 8px; justify-content: center; }
        .services-tabs .tab-btn { margin-top: 0 !important; flex: 1 1 auto; min-width: 140px; padding: 12px 10px; font-size: 0.8rem; line-height: 1.25; }
        .services-content { padding: 1.25rem 1rem; }
        .services-content p { font-size: 0.9rem; margin-bottom: 1rem; text-align: justify; }
        .services-content ul { padding-left: 1rem; }
        .services-content li { font-size: 0.9rem; }
        .section-our-product { padding-top: 2.5rem !important; padding-bottom: 2.5rem !important; }
        .section-our-product .section-title { font-size: 1.45rem; }
        .section-our-product .dana-tenaga-card { padding: 1.25rem; max-width: 100%; }
    }

    @media (max-width: 575px) {
        .hero { min-height: 45vh; }
        .hero .content-container h1 { font-size: clamp(1.15rem, 5vw, 1.5rem); }
        .section-title { font-size: 1.3rem; }
        .whatwedo .whatwedo-intro { font-size: 0.85rem; }
        .whatwedo-gallery .col-md-4 { flex: 0 0 100%; max-width: 100%; }
        .services-tabs .tab-btn { min-width: 100%; }
        .section-our-product .section-title { font-size: 1.3rem; }
        .row.g-3 { --bs-gutter-x: 0.5rem; --bs-gutter-y: 0.5rem; }
    }
</style>
@endpush

@section('content')
    <!-- Hero -->
    <section class="hero text-white text-center">
        @include('partials.hero-background', ['image' => 'images/hero-services.jpg'])
        <div class="content-container">
            <h1>Our Services</h1>
        </div>
    </section>

    <!-- What We Do (content based on screenshot) -->
    <section class="whatwedo py-5 py-lg-6 reveal">
        <div class="container">
            <div class="text-center">
                <div class="section-header text-center reveal">
                    <p class="section-label">Our Services</p>
                    <h2 class="section-title">What We Do</h2>
                </div>
                <p class="whatwedo-intro reveal reveal-delay-1">
                    We have the experience and capacity to support solar projects from inception, throughout the development and construction stages and for the complete lifetime cycle of the solar plant.
                </p>
            </div>

            <div class="whatwedo-gallery reveal reveal-delay-2">
                <div class="row g-3">
                    <div class="col-md-4 reveal reveal-delay-1">
                        <div class="gallery-card">
                            <div class="gallery-card-inner">
                                <img class="gallery-img" src="{{ asset('our assets-1.png') }}" alt="Our assets">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 reveal reveal-delay-2">
                        <div class="gallery-card">
                            <div class="gallery-card-inner">
                                <img class="gallery-img" src="{{ asset('about us-2.jpg') }}" alt="About us">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 reveal reveal-delay-3">
                        <div class="gallery-card">
                            <div class="gallery-card-inner">
                                <img class="gallery-img" src="{{ asset('about us-3.jpg') }}" alt="About us">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="services-panel reveal reveal-delay-3">
                <div class="row g-0">
                    <div class="col-lg-4">
                        <div class="services-tabs h-100 d-flex flex-column justify-content-center">
                            <div class="tab-btn">
                                Solar Energy<br>Installation &amp;<br>Development
                            </div>
                            <div class="tab-btn">
                                Engineering,<br>Procurement &amp;<br>Construction
                            </div>
                            <div class="tab-btn">
                                Operation &amp;<br>Maintenance
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="services-content">
                            <div class="service-pane" data-service-pane="solar-dev">
                                <p>
                                    Based on our project development experience, we electively target project development opportunities. We aim to add high value through a collaborative approach with locals and international developers and investor.
                                </p>
                                <ul>
                                    <li>Site identifications and assessment</li>
                                    <li>Energy yield studies &amp; optimization</li>
                                    <li>Environmental permits</li>
                                    <li>Electricity grid connections</li>
                                    <li>Planning and building plan permits</li>
                                    <li>Project Development agreements</li>
                                    <li>Financial feasibility studies</li>
                                    <li>Power Purchase Agreement (PPA) Analysis</li>
                                </ul>
                            </div>

                            <div class="service-pane d-none" data-service-pane="epc">
                                <p>
                                    Content for Engineering, Procurement &amp; Construction will be added soon.
                                </p>
                            </div>

                            <div class="service-pane d-none" data-service-pane="om">
                                <p>
                                    Content for Operation &amp; Maintenance will be added soon.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Product (card style – match Home page) -->
    <section class="section-our-product py-5 py-lg-6 reveal" id="our-product">
        <div class="product-banner">
            <div class="container">
                <div class="section-header text-center reveal">
                    <p class="section-label">Our Services</p>
                    <h2 class="section-title">Our Product</h2>
                </div>
                <div class="dana-tenaga-card reveal reveal-delay-1">
                    <div class="logo-wrap">
                        <img src="{{ asset('products-dana-tenaga.png') }}" alt="Dana Tenaga Sustainable Solutions">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
(function () {
    // Scroll reveal (same as Home/About)
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
