    <!-- Feature cards / What We Do -->
    <section class="py-5 py-lg-6 bg-white reveal" id="what-we-do">
        <div class="container">
            <div class="section-header">
                <p class="section-label text-center">What We Do</p>
                <h2 class="section-title text-center">Our Solutions</h2>
            </div>
            <div class="row g-4 g-lg-5">
                <div class="col-md-6 reveal reveal-delay-1">
                    <div class="card card-feature h-100">
                        <div class="card-img-wrap">
                            <img src="{{ asset('est sun energy.jpg') }}" class="card-img-top" alt="EST Sun Energy - Solar solutions">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Est Sun Energy contribution to renewable energy</h3>
                            <p class="card-text">Solar Energy Installation & Development</p>
                            <a href="{{ route('what-we-do') }}" class="btn btn-learn-more">Learn more</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 reveal reveal-delay-2">
                    <div class="card card-feature h-100">
                        <div class="card-img-wrap">
                            <img src="{{ asset('nextron.jpg') }}" class="card-img-top" alt="NexTron EV charging solution">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Explore your NexTron charging solution</h3>
                            <p class="card-text">Powered by 100% Renewable Energy</p>
                            <a href="https://www.nextron.my/" target="_blank" rel="noopener noreferrer" class="btn btn-learn-more">Learn more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- EST Sun Energy section / About -->
    <section class="section-est-sun py-5 py-lg-6 reveal" id="about">
        <div class="container">
            <div class="section-header">
                <p class="section-label text-center">About</p>
                <h2 class="section-title text-center">The Energy of the Future</h2>
            </div>
            <div class="content-block">
                <div class="row g-0">
                    <div class="col-lg-6">
                        <img src="{{ asset('est sun energy.jpg') }}" alt="EST Sun Energy - Sustainable solar solutions">
                    </div>
                    <div class="col-lg-6 d-flex flex-column justify-content-center p-4 p-lg-5">
                        <p class="est-sun-tag mb-2">EST SUN ENERGY</p>
                        <h3 class="est-sun-heading mb-3">Quality turnkey Solar PV solutions</h3>
                        <p class="est-sun-body mb-4">We provide quality turnkey Solar Photovoltaic (PV) Solutions - Engineering, Procurement, Construction, & Commissioning (EPCC) for Residential, Commercial, Industrial, and Large Scale Solar (LSS).</p>
                        @php
                            $energyStatsJson = \App\Models\Setting::get('home_energy_stats');
                            $energyStats = $energyStatsJson ? (json_decode($energyStatsJson, true) ?: null) : null;
                            if (!$energyStats || count($energyStats) !== 4) {
                                $energyStats = [
                                    ['number' => '20', 'suffix' => '+', 'label' => 'Successfully Project Finished'],
                                    ['number' => '5', 'suffix' => '+', 'label' => 'Year of experience with Proud'],
                                    ['number' => '30', 'suffix' => '+', 'label' => 'Revenue (Million) & Investment'],
                                    ['number' => '50', 'suffix' => '', 'label' => 'Colleagues and Counting'],
                                ];
                            }
                        @endphp
                        <div class="row g-0" id="est-sun-stats">
                            @foreach($energyStats as $stat)
                            <div class="col-6 stat-item">
                                <div class="stat-number" data-to="{{ e($stat['number'] ?? '0') }}" data-suffix="{{ e($stat['suffix'] ?? '') }}">0</div>
                                <div class="stat-label">{{ e($stat['label'] ?? '') }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Financial & Superior Services banner -->
    <section class="section-financial reveal">
        <div class="container position-relative">
            <div class="section-header mb-4">
                <h2 class="section-title section-title-light">We Offer Financial & Superior Services</h2>
            </div>
            <div class="row align-items-center justify-content-between g-4">
                <div class="col-lg-8">
                    <p class="financial-text mb-0">EST SUN ENERGY has support and financial backing necessary to undertake the largest solar projects from private investor to reputable banking institutions.</p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('partner-we-seek') }}" class="btn btn-more">MORE <i class="bi bi-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Competitive Advantages -->
    <section class="section-advantages reveal">
        <div class="container">
            <div class="section-header">
                <p class="section-label text-center">Why Choose Us</p>
                <h2 class="section-title text-center">Our Competitive Advantages</h2>
            </div>
            <div class="row g-4">
                <div class="col-sm-6 col-lg-3 reveal reveal-delay-1">
                    <div class="card card-advantage h-100">
                        <div class="card-img-wrap">
                            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=400&h=200&fit=crop" class="card-img-top" alt="Experts in project execution">
                        </div>
                        <div class="card-body text-center">
                            <h3 class="card-title">Experts in Project Execution</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 reveal reveal-delay-2">
                    <div class="card card-advantage h-100">
                        <div class="card-img-wrap">
                            <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=400&h=200&fit=crop" class="card-img-top" alt="Engineering capability">
                        </div>
                        <div class="card-body text-center">
                            <h3 class="card-title">Engineering Capability</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 reveal reveal-delay-3">
                    <div class="card card-advantage h-100">
                        <div class="card-img-wrap">
                            <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=400&h=200&fit=crop" class="card-img-top" alt="Financial capabilities">
                        </div>
                        <div class="card-body text-center">
                            <h3 class="card-title">Financial Capabilities</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3 reveal reveal-delay-4">
                    <div class="card card-advantage h-100">
                        <div class="card-img-wrap">
                            <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=400&h=200&fit=crop" class="card-img-top" alt="Reliable partner">
                        </div>
                        <div class="card-body text-center">
                            <h3 class="card-title">Reliable Partner</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php
                            $accreditationLogos = \App\Models\PartnerLogo::where('section', 'accreditation')->orderBy('sort_order')->orderBy('id')->get();
                            $strategicLogos = \App\Models\PartnerLogo::where('section', 'strategic')->orderBy('sort_order')->orderBy('id')->get();
                            $financialLogos = \App\Models\PartnerLogo::where('section', 'financial')->orderBy('sort_order')->orderBy('id')->get();
                            $partnerImageUrl = function ($logo) {
                                if (str_starts_with($logo->image, 'http')) {
                                    return $logo->image;
                                }
                                // Use route so images work without public/storage symlink (e.g. on cPanel)
                                if (str_starts_with($logo->image, 'storage/')) {
                                    return route('partner.image', ['path' => \Illuminate\Support\Str::after($logo->image, 'storage/')]);
                                }
                                return asset($logo->image);
                            };
                        @endphp
    <!-- Accreditation Partner -->
    <section class="section-accreditation reveal" id="partner-we-seek">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center">Accreditation Partner</h2>
            </div>
            @if($accreditationLogos->isNotEmpty())
            <div class="accreditation-track-wrap">
                <div class="accreditation-track">
                    @foreach($accreditationLogos->concat($accreditationLogos) as $logo)
                    <div class="partner-item">
                        <div class="logo-box"><img src="{{ $partnerImageUrl($logo) }}" alt="{{ e($logo->alt) }}" onerror="this.onerror=null;this.src='{{ asset('placeholder-partner.svg') }}';"></div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </section>

    <!-- Strategic & Technology Partners -->
    <section class="section-strategic-partners reveal">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center">Strategic & Technology Partners</h2>
            </div>
            @if($strategicLogos->isNotEmpty())
            <div class="partners-grid">
                @foreach($strategicLogos as $logo)
                <div class="partner-logo-box"><img src="{{ $partnerImageUrl($logo) }}" alt="{{ e($logo->alt) }}" onerror="this.onerror=null;this.src='{{ asset('placeholder-partner.svg') }}';"></div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    <!-- Financial Partners -->
    <section class="section-financial-partners reveal">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-center">Financial Partners</h2>
            </div>
            @if($financialLogos->isNotEmpty())
            <div class="financial-partners-grid">
                @foreach($financialLogos as $logo)
                <div class="partner-logo-box"><img src="{{ $partnerImageUrl($logo) }}" alt="{{ e($logo->alt) }}" onerror="this.onerror=null;this.src='{{ asset('placeholder-partner.svg') }}';"></div>
                @endforeach
            </div>
            @endif
        </div>
    </section>

    <!-- Our Product -->
    <section class="section-our-product reveal">
        <div class="product-banner">
            <div class="container">
                <div class="section-header">
                    <p class="section-label text-center">What We Offer</p>
                    <h2 class="section-title text-center">Our Product</h2>
                </div>
                <div class="dana-tenaga-card">
                    <div class="logo-wrap">
                        <img src="{{ asset('products-dana-tenaga.png') }}" alt="Dana Tenaga">
                    </div>
                </div>
            </div>
        </div>
    </section>
