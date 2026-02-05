@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
    <h1 class="page-title">Settings</h1>
    <p class="text-muted mb-4">Manage site and maintenance settings.</p>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.settings.update') }}">
                @csrf
                <div class="mb-4">
                    <h5 class="text-dark mb-3">Site</h5>
                    <div class="mb-3">
                        <label for="site_name" class="form-label">Site name</label>
                        <input type="text" class="form-control" id="site_name" name="site_name" value="{{ old('site_name', $siteName) }}" maxlength="255" required>
                        <div class="form-text">Used in page titles and branding.</div>
                    </div>
                </div>
                <div class="mb-4">
                    <h5 class="text-dark mb-3">Maintenance</h5>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="maintenance_mode" value="1" id="maintenance_mode" {{ old('maintenance_mode', $maintenanceMode) ? 'checked' : '' }}>
                        <label class="form-check-label" for="maintenance_mode">Enable maintenance mode</label>
                    </div>
                    <div class="form-text">When enabled, visitors see a maintenance page. Admin area remains accessible.</div>
                </div>
                <button type="submit" class="btn btn-primary">Save settings</button>
            </form>
        </div>
    </div>
@endsection
