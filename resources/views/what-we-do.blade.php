@extends('layouts.app')

@section('title', 'Our Services – ' . config('app.name', 'EST Group'))

@push('styles')
<style>
    /* Hero (same as home/about) */
    .hero { min-height: 65vh; position: relative; overflow: hidden; background-color: #0a1628; display: flex; align-items: center; justify-content: center; }
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
    .hero .particles-container { position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 3; pointer-events: none; }
    .hero .particle { position: absolute; background: white; border-radius: 50%; opacity: 0; pointer-events: none; }
    .hero .content-container { position: relative; z-index: 10; text-align: center; max-width: 100%; padding: 2rem 1.5rem; width: 100%; }
    .hero .content-container h1 { font-size: clamp(1.35rem, 4.2vw, 3.5rem); font-weight: 800; margin-bottom: 0; white-space: nowrap; background: linear-gradient(to right, #fff, rgba(45, 139, 168, 0.9)); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent; }
    @media (max-width: 767px) { .hero .content-container h1 { white-space: normal; line-height: 1.25; } }

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
    .whatwedo-gallery .gallery-card { border-radius: 10px; overflow: hidden; box-shadow: 0 8px 32px rgba(13, 33, 55, 0.08); transition: transform var(--transition-smooth), box-shadow var(--transition-smooth); background: #e9ecef; }
    .whatwedo-gallery .gallery-card:hover { transform: translateY(-8px); box-shadow: 0 20px 48px rgba(13, 33, 55, 0.14); }
    .whatwedo-gallery .gallery-card-inner { position: relative; width: 100%; aspect-ratio: 4/3; overflow: hidden; }
    .whatwedo-gallery .gallery-img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; object-position: center; display: block; transition: transform var(--transition-smooth); }
    .whatwedo-gallery .gallery-card:hover .gallery-img { transform: scale(1.06); }

    .services-panel { background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 10px 30px rgba(13, 33, 55, 0.08); }
    .services-tabs { background: #0b4aa2; padding: 20px 18px; }
    .services-tabs .tab-btn { width: 100%; border: 0; background: rgba(255, 255, 255, 0.18); color: #fff; font-weight: 700; border-radius: 8px; padding: 18px 16px; text-align: center; line-height: 1.3; transition: background 0.2s ease, transform 0.2s ease; }
    .services-tabs .tab-btn + .tab-btn { margin-top: 14px; }
    .services-tabs .tab-btn:hover { background: rgba(255, 255, 255, 0.28); transform: translateY(-1px); }
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
        .hero .gradient-sphere.sphere-1 { width: 60vw; height: 60vw; }
        .hero .gradient-sphere.sphere-2 { width: 65vw; height: 65vw; }
        .hero .grid-overlay { background-size: 24px 24px; }
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
        <div class="gradient-background">
            <div class="gradient-sphere sphere-1"></div>
            <div class="gradient-sphere sphere-2"></div>
            <div class="gradient-sphere sphere-3"></div>
            <div class="glow"></div>
            <div class="grid-overlay"></div>
            <div class="noise-overlay"></div>
            <div class="particles-container" id="particles-container"></div>
        </div>
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
                            <button type="button" class="tab-btn is-active" data-service-tab="solar-dev">
                                Solar Energy<br>Installation &amp;<br>Development
                            </button>
                            <button type="button" class="tab-btn" data-service-tab="epc">
                                Engineering,<br>Procurement &amp;<br>Construction
                            </button>
                            <button type="button" class="tab-btn" data-service-tab="om">
                                Operation &amp;<br>Maintenance
                            </button>
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

    var particlesContainer = document.getElementById('particles-container');
    if (particlesContainer) {
        for (var i = 0; i < 80; i++) {
            (function () {
                var particle = document.createElement('div');
                particle.className = 'particle';
                var size = Math.random() * 3 + 1;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.opacity = '0';
                particlesContainer.appendChild(particle);
                function animateParticle() {
                    var startX = Math.random() * 100;
                    var startY = Math.random() * 100;
                    particle.style.left = startX + '%';
                    particle.style.top = startY + '%';
                    particle.style.opacity = '0';
                    var duration = Math.random() * 10 + 10;
                    var delay = Math.random() * 5;
                    setTimeout(function() {
                        particle.style.transition = 'all ' + duration + 's linear';
                        particle.style.opacity = (Math.random() * 0.3 + 0.1).toString();
                        particle.style.left = (startX + (Math.random() * 20 - 10)) + '%';
                        particle.style.top = (startY - Math.random() * 30) + '%';
                        setTimeout(animateParticle, duration * 1000);
                    }, delay * 1000);
                }
                animateParticle();
            })();
        }
        document.addEventListener('mousemove', function(e) {
            var mouseX = (e.clientX / window.innerWidth) * 100;
            var mouseY = (e.clientY / window.innerHeight) * 100;
            var particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.width = (Math.random() * 4 + 2) + 'px';
            particle.style.height = particle.style.width;
            particle.style.left = mouseX + '%';
            particle.style.top = mouseY + '%';
            particle.style.opacity = '0.6';
            particlesContainer.appendChild(particle);
            setTimeout(function() {
                particle.style.transition = 'all 2s ease-out';
                particle.style.left = (mouseX + (Math.random() * 10 - 5)) + '%';
                particle.style.top = (mouseY + (Math.random() * 10 - 5)) + '%';
                particle.style.opacity = '0';
                setTimeout(function() { particle.remove(); }, 2000);
            }, 10);
            var spheres = document.querySelectorAll('.gradient-sphere');
            var moveX = (e.clientX / window.innerWidth - 0.5) * 5;
            var moveY = (e.clientY / window.innerHeight - 0.5) * 5;
            spheres.forEach(function(sphere) { sphere.style.transform = 'translate(' + moveX + 'px, ' + moveY + 'px)'; });
        });
    }

    // Service tabs (What We Do section)
    var tabBtns = document.querySelectorAll('[data-service-tab]');
    var panes = document.querySelectorAll('[data-service-pane]');
    if (tabBtns.length && panes.length) {
        tabBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                var target = btn.getAttribute('data-service-tab');
                tabBtns.forEach(function (b) { b.classList.toggle('is-active', b === btn); });
                panes.forEach(function (p) { p.classList.toggle('d-none', p.getAttribute('data-service-pane') !== target); });
            });
        });
    }
})();
</script>
@endpush
