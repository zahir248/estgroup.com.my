@extends('layouts.app')

@section('title', 'Contact – ' . config('app.name', 'EST Group'))

@push('styles')
<style>
    /* Hero (same as other pages) */
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

    /* Section headers (match About / What We Do) */
    .section-label { font-size: 0.75rem; font-weight: 600; letter-spacing: 0.15em; color: #1a5f7a; text-transform: uppercase; margin-bottom: 0.5rem; }
    .section-title { color: #0d2137; font-weight: 700; letter-spacing: -0.02em; font-size: 2rem; margin-bottom: 0; }
    .section-header { margin-bottom: 2.5rem; }

    /* Scroll reveal (same as other pages) */
    .reveal { opacity: 0; transform: translateY(28px); transition: opacity 0.7s var(--transition-smooth), transform 0.7s var(--transition-smooth); }
    .reveal.reveal-active { opacity: 1; transform: translateY(0); }
    .reveal-delay-1 { transition-delay: 0.1s; }
    .reveal-delay-2 { transition-delay: 0.2s; }
    .reveal-delay-3 { transition-delay: 0.3s; }
    .reveal-delay-4 { transition-delay: 0.4s; }

    /* Let's Talk section */
    .section-contact { background: #f8f9fa; padding: 4rem 0 5rem; }
    .section-contact .contact-tagline { color: #5a5a5a; font-size: 1.05rem; text-align: center; margin-bottom: 2.5rem; max-width: 560px; margin-left: auto; margin-right: auto; }
    .section-contact .form-label { font-weight: 600; color: #0d2137; margin-bottom: 0.4rem; }
    .section-contact .form-label .text-danger { color: #c0392b; }
    .section-contact .form-control, .section-contact .form-select { border: 1px solid #dee2e6; border-radius: 8px; padding: 0.65rem 0.9rem; }
    .section-contact .form-control:focus { border-color: #1a5f7a; box-shadow: 0 0 0 0.2rem rgba(26, 95, 122, 0.2); }
    .section-contact textarea.form-control { min-height: 140px; resize: vertical; }
    .section-contact .btn-send { background: linear-gradient(135deg, #f5a623 0%, #f7931e 100%); border: none; color: #fff; font-weight: 600; padding: 0.75rem 2rem; border-radius: 8px; width: 100%; max-width: 200px; transition: all var(--transition-smooth); }
    .section-contact .btn-send:hover { background: linear-gradient(135deg, #f7931e 0%, #e88519 100%); color: #fff; transform: translateY(-2px); }
    .section-contact .contact-info-card { padding: 0.75rem 0; margin-bottom: 0.5rem; }
    .section-contact .contact-info-icon { width: 44px; height: 44px; color: #1a5f7a; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; flex-shrink: 0; }
    .section-contact .contact-info-title { font-weight: 700; color: #0d2137; font-size: 1rem; margin-bottom: 0.4rem; }
    .section-contact .contact-info-text { color: #5a5a5a; font-size: 0.95rem; line-height: 1.6; margin-bottom: 0; }
    .section-contact .contact-map-wrap { border-radius: 12px; overflow: hidden; border: 1px solid #e9ecef; background: #e9ecef; height: 100%; min-height: 280px; }
    .section-contact .contact-map-wrap iframe { width: 100%; height: 100%; min-height: 280px; border: 0; display: block; }
    /* Contact form (separate section) */
    .section-contact-form { background: #fff; padding: 4rem 0 5rem; }
    .section-contact-form .contact-form-inner { max-width: 640px; margin-left: auto; margin-right: auto; background: #fff; border-radius: 12px; border: 1px solid #e9ecef; box-shadow: 0 8px 32px rgba(13, 33, 55, 0.08); padding: 2rem 2.25rem; }
    .section-contact-form .form-label { font-weight: 600; color: #0d2137; margin-bottom: 0.4rem; }
    .section-contact-form .form-label .text-danger { color: #c0392b; }
    .section-contact-form .form-control { border: 1px solid #dee2e6; border-radius: 8px; padding: 0.65rem 0.9rem; }
    .section-contact-form .form-control:focus { border-color: #1a5f7a; box-shadow: 0 0 0 0.2rem rgba(26, 95, 122, 0.2); }
    .section-contact-form textarea.form-control { min-height: 140px; resize: vertical; }
    .section-contact-form .btn-send { background: linear-gradient(135deg, #f5a623 0%, #f7931e 100%); border: none; color: #fff; font-weight: 600; padding: 0.75rem 2rem; border-radius: 8px; width: 100%; transition: all var(--transition-smooth); }
    .section-contact-form .btn-send:hover { background: linear-gradient(135deg, #f7931e 0%, #e88519 100%); color: #fff; transform: translateY(-2px); }

    @media (prefers-reduced-motion: reduce) {
        .reveal { opacity: 1; transform: none; transition: none; }
    }

    /* ========== Responsive: tablet & mobile ========== */
    @media (max-width: 991px) {
        .hero { min-height: 55vh; }
        .hero .content-container { padding: 1.5rem 1rem; }
        .section-title { font-size: 1.65rem; }
        .section-header { margin-bottom: 2rem; }
        .section-contact { padding: 3rem 0 4rem; }
        .section-contact .contact-tagline { font-size: 0.95rem; margin-bottom: 2rem; }
        .section-contact .contact-info-title { font-size: 0.95rem; }
        .section-contact .contact-info-text { font-size: 0.9rem; }
        .section-contact .contact-info-icon { width: 40px; height: 40px; font-size: 1.1rem; }
        .section-contact .contact-map-wrap { min-height: 260px; }
        .section-contact .contact-map-wrap iframe { min-height: 260px; }
        .section-contact-form { padding: 3rem 0 4rem; }
        .section-contact-form .contact-form-inner { padding: 1.75rem 1.5rem; }
    }

    @media (max-width: 767px) {
        .hero { min-height: 50vh; }
        .hero .content-container { padding: 1.25rem 0.75rem; }
        .hero .gradient-sphere.sphere-1 { width: 60vw; height: 60vw; }
        .hero .gradient-sphere.sphere-2 { width: 65vw; height: 65vw; }
        .hero .grid-overlay { background-size: 24px 24px; }
        .section-title { font-size: 1.45rem; }
        .section-header { margin-bottom: 1.5rem; }
        .section-contact { padding: 2rem 0 2.5rem; }
        .section-contact .contact-tagline { font-size: 0.9rem; margin-bottom: 1.5rem; }
        .section-contact .row { flex-direction: column; }
        .section-contact .col-lg-5 { order: 1; }
        .section-contact .col-lg-7 { order: 2; }
        .section-contact .contact-info-card { padding: 0.5rem 0; margin-bottom: 0.25rem; }
        .section-contact .contact-info-icon { width: 38px; height: 38px; font-size: 1rem; }
        .section-contact .contact-info-title { font-size: 0.9rem; }
        .section-contact .contact-info-text { font-size: 0.85rem; }
        .section-contact .contact-map-wrap { min-height: 220px; border-radius: 10px; }
        .section-contact .contact-map-wrap iframe { min-height: 220px; }
        .section-contact-form { padding: 2rem 0 2.5rem; }
        .section-contact-form .contact-form-inner { padding: 1.25rem 1rem; border-radius: 10px; }
        .section-contact-form .form-control { padding: 0.6rem 0.8rem; }
        .section-contact-form textarea.form-control { min-height: 120px; }
        .section-contact-form .btn-send { padding: 0.65rem 1.5rem; }
        .section-contact .btn-send { padding: 0.65rem 1.5rem; }
        .row.g-4.g-lg-5 { --bs-gutter-x: 0.75rem; --bs-gutter-y: 0.75rem; }
    }

    @media (max-width: 575px) {
        .hero { min-height: 45vh; }
        .hero .content-container h1 { font-size: clamp(1.15rem, 5vw, 1.5rem); }
        .section-title { font-size: 1.3rem; }
        .section-contact .contact-tagline { font-size: 0.85rem; }
        .section-contact .contact-map-wrap { min-height: 200px; }
        .section-contact .contact-map-wrap iframe { min-height: 200px; }
        .section-contact-form .contact-form-inner { padding: 1rem 0.75rem; }
        .row.g-4.g-lg-5 { --bs-gutter-y: 0.5rem; }
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
            <h1>Contact</h1>
        </div>
    </section>

    <!-- Let's Talk -->
    <section class="section-contact reveal" id="lets-talk">
        <div class="container">
            <div class="section-header text-center reveal">
                <h2 class="section-title">Let's Talk!</h2>
            </div>
            <p class="contact-tagline reveal reveal-delay-1">Get in touch with us using the enquiry form or contact details below.</p>

            <div class="row g-4 g-lg-5 align-items-stretch">
                @php
                    $contactAddress = \App\Models\Setting::get('contact_address', '17-1, Jalan Bazaar P U8/P, Trivio Bukit Jelutong, 40150 Shah Alam, Selangor Darul Ehsan.');
                    $contactEmailDisplay = \App\Models\Setting::get('contact_email', 'info@estgroup.com.my');
                    $contactPhoneDisplay = \App\Models\Setting::get('contact_phone', '+603 7734 1711');
                @endphp
                <div class="col-lg-5 reveal reveal-delay-1">
                    <div class="d-flex flex-column gap-3">
                        <div class="contact-info-card d-flex gap-3">
                            <div class="contact-info-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div>
                                <h3 class="contact-info-title">Our Location</h3>
                                <p class="contact-info-text">{{ $contactAddress ? e($contactAddress) : '—' }}</p>
                            </div>
                        </div>
                        <div class="contact-info-card d-flex gap-3">
                            <div class="contact-info-icon">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div>
                                <h3 class="contact-info-title">Quick Contact</h3>
                                <p class="contact-info-text">Email: {{ e($contactEmailDisplay) }}</p>
                            </div>
                        </div>
                        <div class="contact-info-card d-flex gap-3">
                            <div class="contact-info-icon">
                                <i class="bi bi-telephone-fill"></i>
                            </div>
                            <div>
                                <h3 class="contact-info-title">Phone Number</h3>
                                <p class="contact-info-text">{{ $contactPhoneDisplay ? e($contactPhoneDisplay) : '—' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 reveal reveal-delay-2">
                    <div class="contact-map-wrap">
                        <iframe src="https://maps.google.com/maps?q=17-1+Jalan+Bazaar+P+U8+P+Trivio+Bukit+Jelutong+40150+Shah+Alam+Selangor&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=&amp;output=embed" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="EST Group location - Trivio Bukit Jelutong, Shah Alam"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact form (separate section) -->
    <section class="section-contact-form reveal" id="contact-form">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show text-center mb-4" role="alert" style="max-width: 640px; margin-left: auto; margin-right: auto;">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show text-center mb-4" role="alert" style="max-width: 640px; margin-left: auto; margin-right: auto;">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert" style="max-width: 640px; margin-left: auto; margin-right: auto;">
                    <ul class="mb-0 list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="contact-form-inner reveal reveal-delay-1">
                <form action="{{ route('contact.store') }}" method="post" class="contact-form">
                    @csrf
                    <div class="mb-3">
                        <label for="contact-name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="contact-name" name="name" value="{{ old('name') }}" placeholder="Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact-email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="contact-email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact-subject" class="form-label">Subject <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="contact-subject" name="subject" placeholder="Subject" required>
                    </div>
                    <div class="mb-4">
                        <label for="contact-message" class="form-label">Message <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="contact-message" name="message" placeholder="Message" rows="5" required>{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-send">Send</button>
                </form>
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
