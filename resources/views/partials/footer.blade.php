@php
    $footerAddress = \App\Models\Setting::get('contact_address', '17-1, Jalan Bazaar P U8/P, Trivio Bukit Jelutong, 40150 Shah Alam, Selangor Darul Ehsan.');
    $footerEmail = \App\Models\Setting::get('contact_email', 'info@estgroup.com.my');
    $footerPhone = \App\Models\Setting::get('contact_phone', '+603 7734 1711');
    $footerPhoneTel = $footerPhone ? preg_replace('/[^\d+]/', '', $footerPhone) : '';
@endphp
<footer class="site-footer py-5" id="site-footer">
    <div class="container">
        <div class="row g-4 g-lg-5 footer-main">
            <div class="col-lg-4">
                <a href="{{ url('/') }}" class="d-inline-block mb-3">
                    <img src="{{ asset('estgroup-logo.png') }}" alt="{{ config('app.name', 'EST Group') }}" class="footer-logo">
                </a>
                <p class="footer-tagline mb-3">Building excellence through innovation and integrity.</p>
                <p class="footer-about mb-0">EST Group empowers sustainable technology — from renewable energy and solar development to EV charging solutions that support a cleaner future for Malaysia and beyond.</p>
            </div>
            <div class="col-md-6 col-lg-4">
                <h2 class="footer-heading">Contact Us</h2>
                <ul class="footer-contact-list list-unstyled mb-0">
                    @if ($footerAddress)
                    <li class="footer-contact-item">
                        <i class="bi bi-geo-alt-fill" aria-hidden="true"></i>
                        <span>{{ $footerAddress }}</span>
                    </li>
                    @endif
                    @if ($footerEmail)
                    <li class="footer-contact-item">
                        <i class="bi bi-envelope-fill" aria-hidden="true"></i>
                        <a href="mailto:{{ $footerEmail }}">{{ $footerEmail }}</a>
                    </li>
                    @endif
                    @if ($footerPhone)
                    <li class="footer-contact-item">
                        <i class="bi bi-telephone-fill" aria-hidden="true"></i>
                        <a href="tel:{{ $footerPhoneTel }}">{{ $footerPhone }}</a>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="col-md-6 col-lg-4">
                <h2 class="footer-heading">Our Focus</h2>
                <ul class="footer-focus-list list-unstyled mb-0">
                    <li>Renewable energy &amp; solar installation</li>
                    <li>EV charging infrastructure (NexTron)</li>
                    <li>Sustainable technology partnerships</li>
                    <li>Long-term value for communities &amp; businesses</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom row mt-4 pt-4 border-top border-secondary">
            <div class="col-12 text-start">
                <small class="opacity-75">&copy; {{ date('Y') }} {{ config('app.name', 'EST Group') }}. All rights reserved.</small>
            </div>
        </div>
    </div>
</footer>
