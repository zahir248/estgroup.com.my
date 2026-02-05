<footer class="py-5" id="contact">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-auto">
                <a href="{{ url('/') }}" class="d-inline-block">
                    <img src="{{ asset('estgroup logo.png') }}" alt="{{ config('app.name', 'EST Group') }}" class="footer-logo">
                </a>
            </div>
            <div class="col-auto">
                <nav class="d-flex flex-wrap gap-3 gap-md-4 justify-content-center">
                    <a href="{{ url('/') }}">Home</a>
                    <a href="{{ route('about') }}">About</a>
                    <a href="{{ route('what-we-do') }}">What We Do</a>
                    <a href="{{ route('partner-we-seek') }}">Partner We Seek</a>
                    <a href="{{ route('contact') }}">Contact</a>
                </nav>
            </div>
        </div>
        <div class="row mt-4 pt-4 border-top border-secondary">
            <div class="col-12 text-center text-md-start">
                <small class="opacity-75">&copy; {{ date('Y') }} {{ config('app.name', 'EST Group') }}. All rights reserved.</small>
            </div>
        </div>
    </div>
</footer>
