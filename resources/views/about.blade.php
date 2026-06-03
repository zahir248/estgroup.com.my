@extends('layouts.app')

@section('title', 'About – ' . config('app.name', 'EST Group'))

@push('styles')
<style>
    /* Hero title override */
    .hero .content-container h1 { margin-bottom: 0; }
    /* Section headers – same as home (exact colors from layout) */
    .section-label { font-size: 0.75rem; font-weight: 600; letter-spacing: 0.15em; color: #1a5f7a; text-transform: uppercase; margin-bottom: 0.5rem; }
    .section-title { color: #0d2137; font-weight: 700; letter-spacing: -0.02em; font-size: 2rem; margin-bottom: 0; }
    .section-header { margin-bottom: 2.5rem; }
    /* About main content */
    .section-about-content { background: #fff; padding: 4rem 0 5rem; }
    .section-about-content .section-header { margin-bottom: 1.5rem; }
    @media (min-width: 992px) {
        .section-about-content .col-lg-6:first-child { order: 2; }
        .section-about-content .col-lg-6:last-child { order: 1; }
    }
    .about-body {
        color: #5a5a5a;
        line-height: 1.75;
        font-size: 1rem;
        margin-bottom: 1.25rem;
        text-align: justify;
    }
    .about-body strong { color: #5a5a5a; }
    .about-subheading {
        font-weight: 700;
        color: var(--primary-dark);
        letter-spacing: -0.02em;
        font-size: 1.15rem;
        margin-top: 2rem;
        margin-bottom: 0.75rem;
        text-align: left;
    }
    .about-content-img-wrap {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 12px 40px rgba(13, 33, 55, 0.2);
        min-height: 320px;
        background: #f0f2f5;
        transition: box-shadow var(--transition-smooth);
    }
    .about-content-img-wrap:hover { box-shadow: 0 18px 56px rgba(13, 33, 55, 0.26); }
    .about-content-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform var(--transition-smooth);
    }
    .about-content-img-wrap:hover img { transform: scale(1.02); }
    .reveal { opacity: 0; transform: translateY(28px); transition: opacity 0.7s var(--transition-smooth), transform 0.7s var(--transition-smooth); }
    .reveal.reveal-active { opacity: 1; transform: translateY(0); }
    .reveal-delay-1 { transition-delay: 0.1s; }
    .reveal-delay-2 { transition-delay: 0.2s; }
    .reveal-delay-3 { transition-delay: 0.3s; }
    .reveal-delay-4 { transition-delay: 0.4s; }
    /* Our Value / Our History blocks */
    .section-about-block {
        background: #f8f9fa;
        padding: 4rem 0;
        position: relative;
    }
    .section-about-block .about-block-inner {
        position: relative;
        z-index: 1;
        text-align: center;
        max-width: 720px;
        margin: 0 auto;
    }
    .section-about-block .about-block-bg-word {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: clamp(6rem, 18vw, 12rem);
        font-weight: 800;
        color: #e9ecef;
        opacity: 0.5;
        white-space: nowrap;
        pointer-events: none;
        z-index: 0;
        letter-spacing: -0.02em;
    }
    .section-about-block .about-block-inner .section-title { margin-bottom: 1.25rem; }
    .section-about-block .about-block-text {
        color: #5a5a5a;
        line-height: 1.75;
        font-size: 1rem;
        margin-bottom: 0;
        text-align: justify;
    }
    .section-about-block .about-block-text strong { color: #5a5a5a; }
    /* Business Strategy – different color section, no background word */
    .section-about-strategy {
        background: #fff;
        padding: 4rem 0;
    }
    .section-about-strategy .about-block-inner { position: relative; text-align: center; max-width: 720px; margin: 0 auto; margin-bottom: 0; }
    .section-about-strategy .about-block-inner .section-title { margin-bottom: 1.25rem; }
    .section-about-strategy .about-block-text { color: #5a5a5a; line-height: 1.75; font-size: 1rem; margin-bottom: 0; text-align: center; }
    .section-about-strategy .about-block-text strong { color: #5a5a5a; }
    .section-about-strategy .strategy-cols { position: relative; margin-top: 2.5rem; }
    .section-about-strategy .strategy-col { transition: background 0.25s ease; border-radius: 12px; }
    .section-about-strategy .strategy-col:hover { background: rgba(26, 95, 122, 0.04); }
    .section-about-strategy .strategy-col .section-label { text-align: left; margin-bottom: 0.5rem; }
    .section-about-strategy .strategy-col .about-block-text { text-align: justify; margin-bottom: 0; }
    /* Management Team */
    .section-management-team {
        background: #f8f9fa;
        padding: 4rem 0;
        position: relative;
    }
    .section-management-team .team-header { position: relative; z-index: 1; text-align: center; margin-bottom: 2.5rem; }
    /* Single card wrapping both image and text */
    .section-management-team .team-profile {
        position: relative;
        z-index: 1;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 8px 32px rgba(13, 33, 55, 0.14);
        overflow: hidden;
        transition: transform var(--transition-smooth), box-shadow var(--transition-smooth);
        margin-bottom: 2rem;
    }
    .section-management-team .team-profile:last-child {
        margin-bottom: 0;
    }
    .section-management-team .team-profile:hover {
        transform: translateY(-6px);
        box-shadow: 0 22px 52px rgba(13, 33, 55, 0.24);
    }
    .section-management-team .team-profile .row { align-items: stretch; }
    /* Image sits inside card – no separate box/shadow so it’s one card */
    .section-management-team .team-profile-img-wrap {
        height: 100%;
        min-height: 280px;
        overflow: hidden;
        background: #fff;
    }
    .section-management-team .team-profile-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center top;
        display: block;
        transition: transform var(--transition-smooth);
    }
    .section-management-team .team-profile:hover .team-profile-img-wrap img {
        transform: scale(1.02);
    }
    .section-management-team .team-profile-body {
        padding: 1.5rem 1.75rem 2rem;
        background: #fff;
        border-left: 1px solid #e9ecef;
    }
    .section-management-team .team-name { font-size: 1.35rem; font-weight: 700; color: #0d2137; letter-spacing: -0.02em; margin-bottom: 0.25rem; text-align: left; }
    .section-management-team .team-title { font-size: 0.75rem; font-weight: 600; letter-spacing: 0.15em; color: #1a5f7a; text-transform: uppercase; margin-bottom: 1.25rem; text-align: left; }
    .section-management-team .team-bio { color: #5a5a5a; line-height: 1.75; font-size: 1rem; margin-bottom: 1rem; text-align: justify; }
    .section-management-team .team-bio:last-child { margin-bottom: 0; }
    @media (prefers-reduced-motion: reduce) {
        .reveal { opacity: 1; transform: none; transition: none; }
        .about-content-img-wrap img,
        .section-management-team .team-profile-img-wrap img { transition: none; }
    }

    /* ========== Responsive: tablet & mobile ========== */
    @media (max-width: 991px) {
        .hero { min-height: 55vh; }
        .hero .content-container { padding: 1.5rem 1rem; }
        .section-title { font-size: 1.65rem; }
        .section-header { margin-bottom: 2rem; }
        .section-about-content { padding: 3rem 0 4rem; }
        .section-about-content .section-header { margin-bottom: 1.25rem; }
        .about-body { font-size: 0.95rem; text-align: justify !important; }
        .about-subheading { font-size: 1.05rem; margin-top: 1.5rem; margin-bottom: 0.5rem; text-align: center; }
        .about-content-img-wrap { min-height: 280px; }
        .section-about-block { padding: 3rem 0; }
        .section-about-block .about-block-bg-word { font-size: clamp(4rem, 14vw, 8rem); }
        .section-about-block .about-block-inner .section-title { margin-bottom: 1rem; }
        .section-about-block .about-block-text { font-size: 0.95rem; text-align: justify !important; }
        .section-about-strategy { padding: 3rem 0; }
        .section-about-strategy .about-block-inner .section-title { margin-bottom: 1rem; }
        .section-about-strategy .strategy-cols { margin-top: 2rem; }
        .section-about-strategy .about-block-text { font-size: 0.95rem; text-align: justify !important; }
        .section-about-strategy .strategy-col .about-block-text { text-align: justify !important; }
        .section-about-strategy .strategy-col .section-label { text-align: center !important; }
        .section-management-team { padding: 3rem 0; }
        .section-management-team .team-header { margin-bottom: 2rem; }
        .section-management-team .team-profile-img-wrap { min-height: 260px; }
        .section-management-team .team-profile-body { padding: 1.25rem 1.5rem 1.75rem; }
        .section-management-team .team-name { font-size: 1.2rem; text-align: center; }
        .section-management-team .team-title { text-align: center; }
        .section-management-team .team-bio { text-align: justify !important; }
    }

    @media (max-width: 767px) {
        .hero { min-height: 50vh; }
        .hero .content-container { padding: 1.25rem 0.75rem; }
        .section-title { font-size: 1.45rem; }
        .section-header { margin-bottom: 1.5rem; }
        .section-about-content { padding: 2rem 0 2.5rem; }
        .section-about-content .row { flex-direction: column; }
        .section-about-content .col-lg-6:first-child { order: 1; }
        .section-about-content .col-lg-6:last-child { order: 2; }
        .section-about-content .section-header { margin-bottom: 1rem; }
        .about-body { font-size: 0.9rem; margin-bottom: 1rem; text-align: justify !important; }
        .about-subheading { font-size: 1rem; margin-top: 1.25rem; margin-bottom: 0.5rem; text-align: center; }
        .about-content-img-wrap { min-height: 220px; border-radius: 10px; }
        .section-about-block { padding: 2.5rem 0; }
        .section-about-block .about-block-bg-word { font-size: clamp(3rem, 20vw, 5rem); opacity: 0.4; }
        .section-about-block .about-block-inner .section-title { margin-bottom: 0.75rem; font-size: 1.35rem; }
        .section-about-block .about-block-text { font-size: 0.9rem; text-align: justify !important; }
        .section-about-strategy { padding: 2.5rem 0; }
        .section-about-strategy .about-block-inner .section-title { margin-bottom: 0.75rem; font-size: 1.35rem; }
        .section-about-strategy .about-block-text { font-size: 0.9rem; text-align: justify !important; }
        .section-about-strategy .strategy-col .about-block-text { text-align: justify !important; }
        .section-about-strategy .strategy-col .section-label { text-align: center !important; }
        .section-about-strategy .strategy-cols { margin-top: 1.5rem; }
        .section-about-strategy .strategy-col { margin-bottom: 0.5rem; }
        .section-management-team { padding: 2.5rem 0; }
        .section-management-team .team-header { margin-bottom: 1.5rem; }
        .section-management-team .team-header .section-title { font-size: 1.35rem; }
        .section-management-team .team-profile { margin-bottom: 1.5rem; }
        .section-management-team .team-profile .row { flex-direction: column; }
        .section-management-team .team-profile .col-md-4 { max-width: 100%; flex: 0 0 100%; }
        .section-management-team .team-profile .col-md-8 { max-width: 100%; flex: 0 0 100%; }
        .section-management-team .team-profile-img-wrap { min-height: 240px; }
        .section-management-team .team-profile-body { padding: 1.25rem 1.25rem 1.5rem; border-left: none; border-top: 1px solid #e9ecef; }
        .section-management-team .team-name { font-size: 1.15rem; text-align: center; }
        .section-management-team .team-title { font-size: 0.7rem; margin-bottom: 1rem; text-align: center; }
        .section-management-team .team-bio { font-size: 0.9rem; margin-bottom: 0.75rem; text-align: justify !important; }
    }

    @media (max-width: 575px) {
        .hero { min-height: 45vh; }
        .hero .content-container h1 { font-size: clamp(1.15rem, 5vw, 1.5rem); }
        .section-about-content { padding: 1.75rem 0 2rem; }
        .section-label { font-size: 0.7rem; }
        .section-title { font-size: 1.3rem; }
        .about-content-img-wrap { min-height: 200px; }
        .section-about-block .about-block-bg-word { font-size: 2.5rem; }
        .section-about-block .about-block-inner .section-title { font-size: 1.2rem; }
        .section-about-strategy .about-block-inner .section-title { font-size: 1.2rem; }
        .section-management-team .team-profile-img-wrap { min-height: 220px; }
        .section-management-team .team-name { font-size: 1.1rem; }
        .row.g-4, .row.g-4.g-lg-5 { --bs-gutter-x: 0.75rem; --bs-gutter-y: 0.75rem; }
    }
</style>
@endpush

@section('content')
    <!-- Hero (same as home) -->
    <section class="hero text-white text-center" id="about-hero">
        @include('partials.hero-background', ['image' => 'images/hero-about.jpg'])
        <div class="content-container">
            <h1>About Us</h1>
        </div>
    </section>

    <!-- Main content: About Company -->
    <section class="section-about-content reveal">
        <div class="container">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-6 reveal reveal-delay-1">
                    <div class="section-header">
                        <p class="section-label">Empowering Sustainable Technology</p>
                        <h2 class="section-title">About Company</h2>
                    </div>
                    <p class="about-body">
                        <strong>EST SUN ENERGY</strong> is progressing into renewable energy sector, contributing to environment and educating the society by reducing the carbon foot print. Fossil fuels are increasingly more expensive and are gradually depleted in the future. Each solar powered system installed decrease the amount of fossil fuel required to generate electricity in which will reduce the pollutants contributing to world global warming.
                    </p>
                    <h3 class="about-subheading">Our Vision</h3>
                    <p class="about-body">
                        <strong>EST SUN ENERGY</strong> is envisioned becoming a premier provider of solar energy solutions and solar energy products that will contribute to a significant decrease of world's dependence to fossil fuels and fossil fuel technology.
                    </p>
                    <p class="about-body">
                        <strong>EST SUN ENERGY</strong> is dedicated to renewable energy as an independent provider and integrator aggressively strive to achieve our vision.
                    </p>
                    <h3 class="about-subheading">Our Mission</h3>
                    <p class="about-body">
                        Our mission is to be recognized as the top solar solutions provider and preferred partner in the solar energy industry.
                    </p>
                    <p class="about-body mb-0">
                        To utilizes innovative technology and solutions in providing practical, cost effective inexhaustible clean energy to all.
                    </p>
                </div>
                <div class="col-lg-6 reveal reveal-delay-2">
                    <div class="about-content-img-wrap">
                        <img src="{{ asset('handshake.jpg') }}" alt="EST Sun Energy – partnership and sustainable solutions">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Value -->
    <section class="section-about-block reveal">
        <div class="container">
            <div class="about-block-inner">
                <p class="section-label">Our Value</p>
                <h2 class="section-title">Years of Journey</h2>
                <p class="about-block-text">
                    To have faith, belief and trust within the solar energy solution and solar products. Ownership the responsibilities and aiming for project excellences. Integrity and customer satisfactory are paramount.
                </p>
            </div>
        </div>
    </section>

    <!-- Our History / Brief -->
    <section class="section-about-block reveal">
        <div class="container">
            <div class="about-block-inner">
                <p class="section-label">Our History</p>
                <h2 class="section-title">Brief</h2>
                <p class="about-block-text">
                    <strong>EST SUN ENERGY</strong> is a 100% Bumiputra owned Malaysian company, an Investor, EPCC Contractor and O&M provider for solar power projects. Building on the foundation of their extensive experiences of small, medium-large scale solar projects. The company is positioned to meet the expectations and challenges of the rapid growing global solar market. With a strong in-house engineering and marketing capability, local and global responsiveness is unmatched.
                </p>
            </div>
        </div>
    </section>

    <!-- Business Strategy / Total Solutions / Our Clients (same style as Our Value / Our History) -->
    <section class="section-about-strategy reveal">
        <div class="container">
            <div class="about-block-inner">
                <h2 class="section-title">Business Strategy</h2>
                <p class="about-block-text">
                    To have sustainable and profitable growth with innovative formulation, implementation and evaluation, and analysis.
                </p>
            </div>
            <div class="strategy-cols">
                <div class="row g-4 g-lg-5">
                    <div class="col-md-6 strategy-col reveal reveal-delay-1">
                        <p class="section-label">Total Solutions</p>
                        <p class="about-block-text">
                            <strong>EST SUN ENERGY</strong> is expert across full range of solar power applications, ranging from a residential house to a stand-alone solar parks or complex projects with integrated solar energy solutions. Within the domain of electrical infrastructure, we have significant experience and engineering capability essential for the successful integration of solar power to the grid.
                        </p>
                    </div>
                    <div class="col-md-6 strategy-col reveal reveal-delay-2">
                        <p class="section-label">Our Clients</p>
                        <p class="about-block-text">
                            <strong>EST SUN ENERGY</strong> is strongly focused on serving clients in the solar power sector, with a customer portfolio which includes small holders and some leading renewables investor locally. We aim to develop long-term partnerships with our clients, supporting their growth by consistently delivering quality solar power projects.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Management Team -->
    @php
        $teamMembers = \App\Models\TeamMember::orderBy('sort_order')->orderBy('id')->get();
    @endphp
    <section class="section-management-team reveal">
        <div class="container">
            <div class="team-header section-header">
                <p class="section-label">Team Members</p>
                <h2 class="section-title">Management Team</h2>
            </div>
            @foreach($teamMembers as $index => $member)
            <div class="team-profile reveal {{ $index > 0 ? 'reveal-delay-' . min($index, 4) : 'reveal-delay-1' }}">
                <div class="row g-0">
                    <div class="col-md-4">
                        <div class="team-profile-img-wrap">
                            <img src="{{ str_starts_with($member->image, 'http') ? $member->image : (str_starts_with($member->image, 'storage/') ? route('team.image', ['path' => \Illuminate\Support\Str::after($member->image, 'storage/')]) : asset($member->image)) }}" alt="{{ e($member->name) }}" onerror="this.onerror=null;this.src='{{ asset('placeholder-partner.svg') }}';">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="team-profile-body">
                            <h3 class="team-name">{{ e($member->name) }}</h3>
                            @if($member->title)
                                <p class="team-title">{{ e($member->title) }}</p>
                            @endif
                            @if($member->bio)
                                @foreach(explode("\n\n", $member->bio) as $para)
                                    @if(trim($para))
                                        <p class="team-bio">{{ e(trim($para)) }}</p>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
@endsection

@push('scripts')
<script>
(function () {
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
