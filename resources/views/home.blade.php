@extends('layouts.app')

@section('title', config('app.name', 'EST Group'))

@push('styles')
<style>
    /* Scroll reveal */
    .reveal { opacity: 0; transform: translateY(28px); transition: opacity 0.7s var(--transition-smooth), transform 0.7s var(--transition-smooth); }
    .reveal.reveal-active { opacity: 1; transform: translateY(0); }
    .reveal-delay-1 { transition-delay: 0.1s; }
    .reveal-delay-2 { transition-delay: 0.2s; }
    .reveal-delay-3 { transition-delay: 0.3s; }
    .reveal-delay-4 { transition-delay: 0.4s; }
    .hero {
        min-height: 65vh;
        position: relative;
        overflow: hidden;
        background-color: #0a1628;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .hero .gradient-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        overflow: hidden;
    }
    .hero .gradient-sphere {
        position: absolute;
        border-radius: 50%;
        filter: blur(60px);
    }
    .hero .sphere-1 {
        width: 40vw;
        height: 40vw;
        background: linear-gradient(40deg, rgba(13, 33, 55, 0.9), rgba(26, 95, 122, 0.5));
        top: -10%;
        left: -10%;
        animation: hero-float-1 15s ease-in-out infinite alternate;
    }
    .hero .sphere-2 {
        width: 45vw;
        height: 45vw;
        background: linear-gradient(240deg, rgba(26, 95, 122, 0.7), rgba(45, 139, 168, 0.5));
        bottom: -20%;
        right: -10%;
        animation: hero-float-2 18s ease-in-out infinite alternate;
    }
    .hero .sphere-3 {
        width: 30vw;
        height: 30vw;
        background: linear-gradient(120deg, rgba(245, 166, 35, 0.35), rgba(26, 95, 122, 0.4));
        top: 60%;
        left: 20%;
        animation: hero-float-3 20s ease-in-out infinite alternate;
    }
    @keyframes hero-float-1 {
        0% { transform: translate(0, 0) scale(1); }
        100% { transform: translate(10%, 10%) scale(1.1); }
    }
    @keyframes hero-float-2 {
        0% { transform: translate(0, 0) scale(1); }
        100% { transform: translate(-10%, -5%) scale(1.15); }
    }
    @keyframes hero-float-3 {
        0% { transform: translate(0, 0) scale(1); opacity: 0.3; }
        100% { transform: translate(-5%, 10%) scale(1.05); opacity: 0.6; }
    }
    .hero .grid-overlay {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background-size: 40px 40px;
        background-image:
            linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
            linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
        z-index: 2;
    }
    .hero .glow {
        position: absolute;
        width: 40vw;
        height: 40vh;
        background: radial-gradient(circle, rgba(26, 95, 122, 0.2), transparent 70%);
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        animation: hero-pulse 8s infinite alternate;
        filter: blur(30px);
    }
    @keyframes hero-pulse {
        0% { opacity: 0.3; transform: translate(-50%, -50%) scale(0.9); }
        100% { opacity: 0.7; transform: translate(-50%, -50%) scale(1.1); }
    }
    .hero .noise-overlay {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        opacity: 0.05;
        z-index: 5;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
    }
    .hero .particles-container {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        z-index: 3;
        pointer-events: none;
    }
    .hero .particle {
        position: absolute;
        background: white;
        border-radius: 50%;
        opacity: 0;
        pointer-events: none;
    }
    .hero .content-container {
        position: relative;
        z-index: 10;
        text-align: center;
        max-width: 100%;
        padding: 2rem 1.5rem;
        width: 100%;
    }
    .hero .content-container h1 {
        font-size: clamp(1.35rem, 4.2vw, 3.5rem);
        font-weight: 800;
        margin-bottom: 1.5rem;
        white-space: nowrap;
        background: linear-gradient(to right, #fff, rgba(45, 139, 168, 0.9));
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    @media (max-width: 767px) {
        .hero .content-container h1 { white-space: normal; line-height: 1.25; }
    }
    .hero .content-container .lead {
        font-size: 1.2rem;
        line-height: 1.6;
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 2rem;
    }
    .hero .btn-hero {
        background: linear-gradient(90deg, var(--primary-accent), #f7931e);
        color: white;
        font-weight: 600;
        font-size: 1rem;
        padding: 0.8rem 2rem;
        border: none;
        border-radius: 50px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        box-shadow: 0 4px 20px rgba(26, 95, 122, 0.4);
    }
    .hero .btn-hero:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 25px rgba(247, 147, 30, 0.4);
    }
    .section-label { font-size: 0.75rem; font-weight: 600; letter-spacing: 0.15em; color: var(--primary-accent); text-transform: uppercase; margin-bottom: 0.5rem; }
    .section-title { color: var(--primary-dark); font-weight: 700; letter-spacing: -0.02em; font-size: 2rem; margin-bottom: 0; }
    .section-header { margin-bottom: 2.5rem; }
    .section-header.section-header-lg { margin-bottom: 3rem; }
    .section-label-light { color: rgba(255,255,255,0.85); }
    .section-title-light { color: #fff; }
    .card { border: none; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.06); transition: transform var(--transition-smooth), box-shadow var(--transition-smooth); }
    .card:hover { transform: translateY(-6px); box-shadow: 0 16px 40px rgba(0,0,0,0.12); }
    .icon-box { width: 56px; height: 56px; border-radius: 12px; background: rgba(26, 95, 122, 0.12); color: var(--primary-accent); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
    .stat-number { font-size: 2.5rem; font-weight: 700; color: var(--primary-accent); line-height: 1.2; }
    .btn-primary-custom { background: var(--primary-accent); border-color: var(--primary-accent); color: #fff; padding: 0.75rem 1.75rem; border-radius: 8px; font-weight: 600; }
    .btn-primary-custom:hover { background: var(--primary-light); border-color: var(--primary-light); color: #fff; }
    .btn-outline-light-custom { border: 2px solid rgba(255,255,255,0.6); color: #fff; padding: 0.75rem 1.75rem; border-radius: 8px; font-weight: 600; }
    .btn-outline-light-custom:hover { background: rgba(255,255,255,0.15); border-color: #fff; color: #fff; }
    .card-feature { border: none; border-radius: 16px; box-shadow: 0 8px 32px rgba(13, 33, 55, 0.08); overflow: hidden; transition: transform var(--transition-smooth), box-shadow var(--transition-smooth); }
    .card-feature:hover { transform: translateY(-8px); box-shadow: 0 20px 48px rgba(13, 33, 55, 0.14); }
    .card-feature .card-img-wrap { overflow: hidden; position: relative; }
    .card-feature .card-img-top { height: 240px; object-fit: cover; transition: transform var(--transition-smooth); }
    .card-feature:hover .card-img-top { transform: scale(1.06); }
    .card-feature .card-body { padding: 1.5rem 1.5rem 1.75rem; text-align: center; }
    .card-feature .card-title { font-weight: 700; color: var(--primary-dark); font-size: 1.15rem; margin-bottom: 0.5rem; transition: color 0.25s ease; }
    .card-feature:hover .card-title { color: var(--primary-accent); }
    .card-feature .card-text { color: #5a5a5a; font-size: 0.95rem; margin-bottom: 1rem; text-align: center; }
    .card-feature .card-body .btn-learn-more { display: inline-flex; }
    .btn-learn-more { background: linear-gradient(135deg, var(--accent-gold) 0%, #f7931e 100%); border: none; color: #fff; font-weight: 600; padding: 0.6rem 1.5rem; border-radius: 8px; transition: all var(--transition-smooth); display: inline-flex; align-items: center; gap: 0.4rem; }
    .btn-learn-more:hover { background: linear-gradient(135deg, #f7931e 0%, #e88519 100%); color: #fff; transform: translateX(4px); }
    .section-est-sun { background: linear-gradient(180deg, #f8f9fa 0%, #f0f2f5 100%); }
    .section-est-sun .content-block { background: #fff; border-radius: 16px; box-shadow: 0 8px 40px rgba(13, 33, 55, 0.08); overflow: hidden; border-left: 4px solid var(--primary-accent); transition: box-shadow var(--transition-smooth); }
    .section-est-sun .content-block:hover { box-shadow: 0 12px 48px rgba(13, 33, 55, 0.12); }
    .section-est-sun .content-block img { width: 100%; height: 100%; object-fit: cover; min-height: 380px; transition: transform var(--transition-smooth); }
    .section-est-sun .content-block:hover img { transform: scale(1.02); }
    .section-est-sun .est-sun-tag { color: #f7931e; font-weight: 700; font-size: 0.8rem; letter-spacing: 0.12em; }
    .section-est-sun .est-sun-heading { color: var(--primary-dark); font-weight: 700; letter-spacing: -0.02em; }
    .section-est-sun .est-sun-body { color: #5a5a5a; line-height: 1.65; text-align: justify; }
    .section-est-sun .stat-item { padding: 1.25rem 1.5rem; border-right: 1px solid #e9ecef; border-bottom: 1px solid #e9ecef; transition: background 0.25s ease; }
    .section-est-sun .stat-item:hover { background: rgba(26, 95, 122, 0.04); }
    .section-est-sun .stat-item:nth-child(2n) { border-right: none; }
    .section-est-sun .stat-item:nth-last-child(-n+2) { border-bottom: none; }
    .section-est-sun .stat-number { font-size: 1.85rem; font-weight: 700; color: var(--primary-accent); line-height: 1.2; }
    .section-est-sun .stat-label { font-size: 0.8rem; color: #6c757d; margin-top: 0.25rem; }
    .section-financial { background: linear-gradient(135deg, var(--primary-dark) 0%, #1a3d5c 100%); color: #fff; padding: 3.5rem 0; position: relative; overflow: hidden; }
    .section-financial::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M0 0h40v40H0z'/%3E%3C/g%3E%3C/svg%3E"); opacity: 0.5; pointer-events: none; }
    .section-financial .financial-heading { font-weight: 700; color: #fff; letter-spacing: -0.02em; margin-bottom: 0.75rem; position: relative; }
    .section-financial .financial-text { color: rgba(255,255,255,0.88); margin-bottom: 0; max-width: 640px; line-height: 1.6; position: relative; text-align: justify; }
    .section-financial .btn-more { background: #fff; color: var(--primary-dark); font-weight: 600; padding: 0.75rem 1.75rem; border-radius: 50px; border: none; white-space: nowrap; transition: all var(--transition-smooth); display: inline-flex; align-items: center; gap: 0.5rem; }
    .section-financial .btn-more:hover { background: var(--accent-gold); color: #1a1a1a; transform: translateX(4px); }
    .section-financial .btn-more i { transition: transform 0.25s ease; }
    .section-financial .btn-more:hover i { transform: translateX(4px); }
    .section-advantages { background: #fff; padding: 4.5rem 0; }
    .section-advantages .section-header { margin-bottom: 2.5rem; }
    .section-advantages .card-advantage { border: none; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.06); transition: transform var(--transition-smooth), box-shadow var(--transition-smooth); }
    .section-advantages .card-advantage:hover { transform: translateY(-8px); box-shadow: 0 16px 40px rgba(13, 33, 55, 0.12); }
    .section-advantages .card-advantage .card-img-wrap { overflow: hidden; }
    .section-advantages .card-advantage .card-img-top { height: 200px; object-fit: cover; transition: transform var(--transition-smooth); }
    .section-advantages .card-advantage:hover .card-img-top { transform: scale(1.08); }
    .section-advantages .card-advantage .card-body { padding: 1.5rem; background: #fff; }
    .section-advantages .card-advantage .card-title { font-weight: 700; color: var(--primary-dark); font-size: 1rem; margin-bottom: 0; transition: color 0.25s ease; }
    .section-advantages .card-advantage:hover .card-title { color: var(--primary-accent); }
    .section-accreditation { background: #f8f9fa; padding: 4rem 0; }
    .section-accreditation .section-header { margin-bottom: 2.5rem; }
    .section-accreditation .logo-box { background: transparent; border: none; border-radius: 0; padding: 1rem; height: 120px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: transform var(--transition-smooth), opacity 0.25s ease; }
    .section-accreditation .accreditation-track .partner-item:hover .logo-box { transform: scale(1.05); opacity: 0.9; }
    .section-accreditation .logo-box img { max-width: 100%; max-height: 80px; object-fit: contain; transition: filter 0.25s ease; }
    .section-accreditation .accreditation-track .partner-item:hover .logo-box img { filter: brightness(1.05); }
    .section-accreditation .logo-label { font-size: 0.7rem; color: #6c757d; text-align: center; margin-top: 0.5rem; }
    .section-accreditation .accreditation-track-wrap { overflow: hidden; width: 100%; }
    .section-accreditation .accreditation-track { display: flex; gap: 1rem; width: max-content; animation: accreditation-scroll 30s linear infinite; }
    .section-accreditation .accreditation-track:hover { animation-play-state: paused; }
    .section-accreditation .accreditation-track .partner-item { flex: 0 0 200px; }
    @keyframes accreditation-scroll { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }
    .section-strategic-partners { background: #fff; padding: 4rem 0; }
    .section-strategic-partners .section-header { margin-bottom: 2.5rem; }
    .section-strategic-partners .partners-grid { display: flex; flex-wrap: wrap; justify-content: center; gap: 1rem; }
    .section-strategic-partners .partners-grid .partner-logo-box { width: calc((100% - 4 * 1rem) / 5); }
    @media (max-width: 992px) { .section-strategic-partners .partners-grid .partner-logo-box { width: calc((100% - 2 * 1rem) / 3); } }
    @media (max-width: 576px) { .section-strategic-partners .partners-grid .partner-logo-box { width: calc((100% - 1 * 1rem) / 2); } }
    .section-strategic-partners .partner-logo-box { background: transparent; border: none; border-radius: 0; padding: 1rem; height: 100px; display: flex; align-items: center; justify-content: center; transition: transform var(--transition-smooth), opacity 0.25s ease; cursor: default; box-sizing: border-box; }
    .section-strategic-partners .partner-logo-box:hover { transform: scale(1.05); opacity: 0.9; }
    .section-strategic-partners .partner-logo-box img { max-width: 100%; max-height: 60px; object-fit: contain; transition: filter 0.25s ease; }
    .section-strategic-partners .partner-logo-box:hover img { filter: brightness(1.08); }
    .section-strategic-partners .partner-logo-box .partner-name { font-size: 0.7rem; color: #6c757d; text-align: center; }
    .section-financial-partners { background: #f8f9fa; padding: 4rem 0; }
    .section-financial-partners .section-header { margin-bottom: 2.5rem; }
    .section-financial-partners .financial-partners-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; max-width: 600px; margin: 0 auto; }
    .section-financial-partners .partner-logo-box { background: transparent; border: none; border-radius: 0; padding: 1rem; height: 120px; display: flex; align-items: center; justify-content: center; transition: transform var(--transition-smooth), opacity 0.25s ease; }
    .section-financial-partners .partner-logo-box:hover { transform: scale(1.04); opacity: 0.9; }
    .section-financial-partners .partner-logo-box img { max-width: 100%; max-height: 70px; object-fit: contain; }
    .section-our-product { background: #fff; padding: 4rem 0; }
    .section-our-product .product-banner { background: #fff; padding: 0; text-align: center; }
    .section-our-product .section-header { margin-bottom: 2.5rem; }
    .section-our-product .section-label { font-size: 0.9rem; }
    .section-our-product .section-title { font-size: 2.35rem; }
    .section-our-product .product-banner .container { text-align: center; }
    .section-our-product .dana-tenaga-card { background: transparent; border: none; border-radius: 0; padding: 2rem; max-width: 400px; margin: 0 auto; display: inline-block; transition: transform var(--transition-smooth), opacity 0.25s ease; }
    .section-our-product .dana-tenaga-card:hover { transform: scale(1.03); opacity: 0.9; }
    .section-our-product .dana-tenaga-card .logo-wrap { display: block; line-height: 0; }
    .section-our-product .dana-tenaga-card .logo-wrap img { max-width: 100%; height: auto; display: block; vertical-align: middle; }
    @media (prefers-reduced-motion: reduce) {
        .reveal { opacity: 1; transform: none; transition: none; }
        .card-feature .card-img-top, .section-advantages .card-img-top, .section-est-sun .content-block img { transition: none; }
    }

    /* ========== Responsive: smaller screens (tablet & mobile) ========== */
    @media (max-width: 991px) {
        .hero { min-height: 55vh; }
        .hero .content-container { padding: 1.5rem 1rem; }
        .hero .content-container .lead { font-size: 1.05rem; margin-bottom: 1.5rem; }
        .hero .btn-hero { padding: 0.7rem 1.5rem; font-size: 0.9rem; }
        .section-title { font-size: 1.65rem; }
        .section-header { margin-bottom: 2rem; }
        .section-header.section-header-lg { margin-bottom: 2.5rem; }
        .card-feature .card-img-top { height: 200px; }
        .card-feature .card-body { padding: 1.25rem 1.25rem 1.5rem; }
        .card-feature .card-title { font-size: 1.05rem; }
        .section-est-sun .content-block img { min-height: 280px; }
        .section-est-sun .est-sun-heading { font-size: 1.35rem; }
        .section-est-sun .est-sun-body { font-size: 0.9rem; text-align: justify !important; }
        .section-est-sun .stat-item { padding: 1rem 1rem; }
        .section-est-sun .stat-number { font-size: 1.5rem; }
        .section-est-sun .stat-label { font-size: 0.75rem; }
        .section-financial { padding: 2.5rem 0; }
        .section-financial .financial-heading { font-size: 1.5rem; }
        .section-financial .financial-text { font-size: 0.95rem; text-align: justify !important; }
        .card-feature .card-text { text-align: center !important; }
        .section-est-sun .est-sun-tag { text-align: center !important; }
        .section-est-sun .est-sun-heading { text-align: center !important; }
        .section-advantages { padding: 3rem 0; }
        .section-advantages .card-advantage .card-img-top { height: 160px; }
        .section-advantages .card-advantage .card-body { padding: 1.25rem; }
        .section-advantages .card-advantage .card-title { font-size: 0.95rem; }
        .section-accreditation { padding: 3rem 0; }
        .section-accreditation .logo-box { height: 100px; padding: 1rem; }
        .section-accreditation .logo-box img { max-height: 60px; }
        .section-accreditation .accreditation-track .partner-item { flex: 0 0 160px; }
        .section-strategic-partners { padding: 3rem 0; }
        .section-strategic-partners .partner-logo-box { height: 90px; padding: 1rem; }
        .section-strategic-partners .partner-logo-box img { max-height: 50px; }
        .section-financial-partners { padding: 3rem 0; }
        .section-financial-partners .partner-logo-box { height: 100px; padding: 1.25rem; }
        .section-our-product { padding: 3rem 0; }
        .section-our-product .section-title { font-size: 1.75rem; }
        .section-our-product .dana-tenaga-card { padding: 1.5rem; }
    }

    @media (max-width: 767px) {
        .hero { min-height: 50vh; }
        .hero .content-container { padding: 1.25rem 0.75rem; }
        .hero .content-container h1 { margin-bottom: 1rem; }
        .hero .content-container .lead { font-size: 0.95rem; margin-bottom: 1.25rem; line-height: 1.5; }
        .hero .btn-hero { padding: 0.65rem 1.25rem; font-size: 0.85rem; }
        .hero .gradient-sphere.sphere-1 { width: 60vw; height: 60vw; }
        .hero .gradient-sphere.sphere-2 { width: 65vw; height: 65vw; }
        .hero .grid-overlay { background-size: 24px 24px; }
        .py-5 { padding-top: 2rem !important; padding-bottom: 2rem !important; }
        .py-lg-6 { padding-top: 2.5rem !important; padding-bottom: 2.5rem !important; }
        .section-label { font-size: 0.7rem; }
        .section-title { font-size: 1.45rem; }
        .section-header { margin-bottom: 1.5rem; }
        .card-feature .card-img-top { height: 180px; }
        .card-feature .card-body { padding: 1rem 1rem 1.25rem; }
        .card-feature .card-title { font-size: 1rem; }
        .card-feature .card-text { font-size: 0.9rem; }
        .icon-box { width: 48px; height: 48px; font-size: 1.25rem; }
        .stat-number { font-size: 2rem; }
        .section-est-sun .content-block { border-left-width: 3px; }
        .section-est-sun .content-block img { min-height: 220px; }
        .section-est-sun .est-sun-tag { font-size: 0.7rem; }
        .section-est-sun .est-sun-heading { font-size: 1.2rem; margin-bottom: 0.75rem; }
        .section-est-sun .est-sun-body { font-size: 0.85rem; margin-bottom: 1rem; text-align: justify !important; }
        .section-est-sun .est-sun-body,
        .section-est-sun .col-lg-6.d-flex { padding-left: 1rem !important; padding-right: 1rem !important; padding-bottom: 1rem !important; }
        .section-est-sun .stat-item { padding: 0.75rem 0.5rem; border-right: none; border-bottom: 1px solid #e9ecef; }
        .section-est-sun .stat-item:nth-last-child(-n+2) { border-bottom: none; }
        .section-est-sun .stat-item:nth-child(odd) { border-right: 1px solid #e9ecef; }
        .section-est-sun .stat-number { font-size: 1.35rem; }
        .section-est-sun .stat-label { font-size: 0.7rem; }
        .section-financial { padding: 2rem 0; }
        .section-financial .section-header { margin-bottom: 1rem; }
        .section-financial .financial-heading { font-size: 1.35rem; }
        .section-financial .financial-text { font-size: 0.9rem; margin-bottom: 1rem; text-align: justify !important; }
        .section-financial .col-lg-4 { text-align: center !important; }
        .card-feature .card-text { text-align: center !important; }
        .section-est-sun .est-sun-tag { text-align: center !important; }
        .section-est-sun .est-sun-heading { text-align: center !important; }
        .section-financial .btn-more { width: 100%; justify-content: center; }
        .section-advantages { padding: 2.5rem 0; }
        .section-advantages .card-advantage .card-img-top { height: 140px; }
        .section-advantages .card-advantage .card-title { font-size: 0.9rem; }
        .section-accreditation { padding: 2.5rem 0; }
        .section-accreditation .section-title { font-size: 1.35rem; }
        .section-accreditation .logo-box { height: 90px; padding: 0.75rem; }
        .section-accreditation .logo-box img { max-height: 50px; }
        .section-accreditation .accreditation-track .partner-item { flex: 0 0 140px; }
        .section-strategic-partners { padding: 2.5rem 0; }
        .section-strategic-partners .section-title { font-size: 1.35rem; }
        .section-strategic-partners .partner-logo-box { height: 80px; padding: 0.75rem; }
        .section-strategic-partners .partner-logo-box img { max-height: 44px; }
        .section-strategic-partners .partner-logo-box .partner-name { font-size: 0.65rem; }
        .section-financial-partners { padding: 2.5rem 0; }
        .section-financial-partners .section-title { font-size: 1.35rem; }
        .section-financial-partners .financial-partners-grid { gap: 1rem; }
        .section-financial-partners .partner-logo-box { height: 90px; padding: 1rem; }
        .section-financial-partners .partner-logo-box img { max-height: 55px; }
        .section-our-product { padding: 2.5rem 0; }
        .section-our-product .section-title { font-size: 1.45rem; }
        .section-our-product .dana-tenaga-card { padding: 1.25rem; max-width: 100%; }
    }

    @media (max-width: 575px) {
        .hero { min-height: 45vh; }
        .hero .content-container h1 { font-size: clamp(1.15rem, 5vw, 1.5rem); }
        .section-title { font-size: 1.3rem; }
        .section-est-sun .content-block img { min-height: 200px; }
        .section-est-sun .stat-item { padding: 0.6rem 0.4rem; }
        .section-est-sun .stat-number { font-size: 1.2rem; }
        .section-accreditation .accreditation-track .partner-item { flex: 0 0 120px; }
        .section-strategic-partners .partners-grid .partner-logo-box { width: 100%; max-width: 160px; margin: 0 auto; }
        .row.g-4 { --bs-gutter-x: 0.75rem; --bs-gutter-y: 0.75rem; }
        .row.g-4.g-lg-5 { --bs-gutter-x: 0.75rem; --bs-gutter-y: 0.75rem; }
    }
</style>
@endpush

@section('content')
    <!-- Hero -->
    <section class="hero text-white text-center" id="home">
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
            <h1>Empowering Sustainable Technology</h1>
            <p class="lead">Today's Resource is for a Brighter Tomorrow, Furthermore a Future.</p>
        </div>
    </section>

    @include('partials.home-sections')
@endsection

@push('scripts')
<script>
(function () {
    // Scroll reveal
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

    // Count-up animation for EST Sun stats
    var statsSection = document.getElementById('est-sun-stats');
    var statNumbers = statsSection ? statsSection.querySelectorAll('.stat-number[data-to]') : [];
    if (statsSection && statNumbers.length && typeof IntersectionObserver !== 'undefined') {
        function easeOutQuad(t) { return t * (2 - t); }
        function animateValue(el, start, end, suffix, duration) {
            var startTime = null;
            function step(timestamp) {
                if (!startTime) startTime = timestamp;
                var elapsed = timestamp - startTime;
                var progress = Math.min(elapsed / duration, 1);
                var eased = easeOutQuad(progress);
                var current = Math.floor(start + (end - start) * eased);
                el.textContent = current + suffix;
                if (progress < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
        }
        var statsObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                statsObserver.disconnect();
                statNumbers.forEach(function (el, i) {
                    var target = parseInt(el.getAttribute('data-to'), 10) || 0;
                    var suffix = el.getAttribute('data-suffix') || '';
                    setTimeout(function () { animateValue(el, 0, target, suffix, 1800); }, i * 120);
                });
            });
        }, { threshold: 0.3, rootMargin: '0px' });
        statsObserver.observe(statsSection);
    } else if (statsSection && statNumbers.length) {
        statNumbers.forEach(function (el) {
            el.textContent = (el.getAttribute('data-to') || 0) + (el.getAttribute('data-suffix') || '');
        });
    }

    // Hero gradient particles
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
