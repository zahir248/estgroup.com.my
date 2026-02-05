@extends('layouts.app')

@section('title', 'Partner We Seek – ' . config('app.name', 'EST Group'))
@push('styles')
<style>
    /* Hero (same as home/about/what-we-do) */
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
    .partner-type-card { background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 8px 32px rgba(13, 33, 55, 0.08); transition: transform var(--transition-smooth), box-shadow var(--transition-smooth); height: 100%; display: flex; flex-direction: column; }
    .partner-type-card:hover { transform: translateY(-6px); box-shadow: 0 16px 48px rgba(13, 33, 55, 0.12); }
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
        .hero .gradient-sphere.sphere-1 { width: 60vw; height: 60vw; }
        .hero .gradient-sphere.sphere-2 { width: 65vw; height: 65vw; }
        .hero .grid-overlay { background-size: 24px 24px; }
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
})();
</script>
@endpush
