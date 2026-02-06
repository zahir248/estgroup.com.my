@extends('layouts.admin')

@section('title', 'Home Page')

@push('styles')
<style>
    .partner-logo-card { position: relative; }
    .partner-logo-card .btn-remove-logo {
        position: absolute;
        top: 0.35rem;
        right: 0.35rem;
        width: 28px;
        height: 28px;
        padding: 0;
        border-radius: 50%;
        background: #fff;
        color: #dc3545;
        border: 1px solid #dc3545;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        transition: background 0.2s, color 0.2s, transform 0.2s;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
    }
    .partner-logo-card .btn-remove-logo:hover {
        background: #dc3545;
        color: #fff;
        transform: scale(1.08);
    }
</style>
@endpush

@section('content')
    <h1 class="page-title">Home Page</h1>
    <p class="text-muted mb-4">Manage content for the home page — stats and partner logos.</p>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pages.home.update') }}">
                @csrf
                <h5 class="text-dark mb-3">The Energy of the Future — Stats</h5>
                <p class="text-muted small mb-4">Edit the four number facts shown in the section. Use <strong>Number</strong> for the value (e.g. 20, 5, 30, 50) and <strong>Suffix</strong> for a symbol after it (e.g. + or leave empty).</p>

                @foreach($stats as $index => $stat)
                    <div class="border rounded p-3 mb-3 bg-light">
                        <label class="form-label fw-600 small text-muted">Stat #{{ $index + 1 }}</label>
                        <div class="row g-2">
                            <div class="col-md-2">
                                <label for="stats_{{ $index }}_number" class="form-label small">Number</label>
                                <input type="text" class="form-control form-control-sm" id="stats_{{ $index }}_number" name="stats[{{ $index }}][number]" value="{{ old("stats.{$index}.number", $stat['number'] ?? '') }}" maxlength="20" required>
                            </div>
                            <div class="col-md-2">
                                <label for="stats_{{ $index }}_suffix" class="form-label small">Suffix</label>
                                <input type="text" class="form-control form-control-sm" id="stats_{{ $index }}_suffix" name="stats[{{ $index }}][suffix]" value="{{ old("stats.{$index}.suffix", $stat['suffix'] ?? '') }}" maxlength="10" placeholder="e.g. +">
                            </div>
                            <div class="col-md-8">
                                <label for="stats_{{ $index }}_label" class="form-label small">Label</label>
                                <input type="text" class="form-control form-control-sm" id="stats_{{ $index }}_label" name="stats[{{ $index }}][label]" value="{{ old("stats.{$index}.label", $stat['label'] ?? '') }}" maxlength="255" required>
                            </div>
                        </div>
                    </div>
                @endforeach

                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
        </div>
    </div>

    <h5 class="text-dark mb-3 mt-4">Partner logos</h5>
    <p class="text-muted small mb-3">Manage Accreditation, Strategic & Technology, and Financial partner logos shown on the home page.</p>

    @foreach($sections as $sectionKey => $sectionLabel)
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="text-dark mb-3">{{ $sectionLabel }}</h6>
                <div class="row g-3 mb-4">
                    @foreach($partners[$sectionKey] ?? [] as $partner)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="partner-logo-card border rounded p-2 d-flex align-items-center justify-content-center" style="min-height: 80px;">
                                <img src="{{ str_starts_with($partner->image, 'http') ? $partner->image : (str_starts_with($partner->image, 'storage/') ? route('partner.image', ['path' => \Illuminate\Support\Str::after($partner->image, 'storage/')]) : asset($partner->image)) }}" alt="{{ $partner->alt ?? '' }}" class="img-fluid" style="max-height: 60px; object-fit: contain;" onerror="this.onerror=null;this.src='{{ asset('placeholder-partner.svg') }}';">
                                <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" class="position-absolute top-0 end-0 m-1" onsubmit="return confirm('Remove this logo?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-remove-logo" title="Remove logo" aria-label="Remove logo"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                            @if($partner->alt)
                                <small class="text-muted d-block mt-1">{{ \Illuminate\Support\Str::limit($partner->alt, 25) }}</small>
                            @endif
                        </div>
                    @endforeach
                </div>
                <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data" class="row g-2 align-items-end">
                    @csrf
                    <input type="hidden" name="section" value="{{ $sectionKey }}">
                    <div class="col-auto">
                        <label class="form-label small mb-0">Add logo</label>
                        <input type="file" name="image" class="form-control form-control-sm" accept="image/*" required>
                    </div>
                    <div class="col-auto">
                        <label class="form-label small mb-0">Alt text (optional)</label>
                        <input type="text" name="alt" class="form-control form-control-sm" placeholder="Partner name" maxlength="255">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-sm">Add</button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection
