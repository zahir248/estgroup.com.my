@extends('layouts.admin')

@section('title', 'Edit Team Member')

@section('content')
    <h1 class="page-title">Edit Team Member</h1>
    <p class="text-muted mb-4">
        <a href="{{ route('admin.pages.about') }}" class="text-decoration-none"><i class="bi bi-arrow-left me-1"></i>Back to About page</a>
    </p>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('admin.pages.about.update', $member) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Photo</label>
                        <div class="mb-2">
                            <img src="{{ str_starts_with($member->image, 'http') ? $member->image : (str_starts_with($member->image, 'storage/') ? route('team.image', ['path' => \Illuminate\Support\Str::after($member->image, 'storage/')]) : asset($member->image)) }}" alt="{{ $member->name }}" class="rounded" style="width: 100px; height: 100px; object-fit: cover;" onerror="this.onerror=null;this.src='{{ asset('placeholder-partner.svg') }}';">
                        </div>
                        <input type="file" name="image" class="form-control form-control-sm" accept="image/*">
                        <small class="text-muted">Leave empty to keep current photo.</small>
                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-8">
                        <div class="row g-2">
                            <div class="col-12">
                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $member->name) }}" maxlength="255" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $member->title) }}" placeholder="e.g. Managing Director" maxlength="255">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label">Bio</label>
                                <textarea name="bio" class="form-control @error('bio') is-invalid @enderror" rows="3" maxlength="5000" placeholder="Short biography (optional)">{{ old('bio', $member->bio) }}</textarea>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <a href="{{ route('admin.pages.about') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
