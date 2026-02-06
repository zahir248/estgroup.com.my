@extends('layouts.admin')

@section('title', 'About Page')

@push('styles')
<style>
    .team-member-card { position: relative; }
    .team-member-card .card-actions {
        position: absolute;
        top: 0.35rem;
        right: 0.35rem;
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 0.35rem;
        z-index: 2;
    }
    .team-member-card .btn-remove-member,
    .team-member-card .btn-edit-member {
        width: 28px;
        height: 28px;
        padding: 0;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        transition: background 0.2s, color 0.2s, transform 0.2s;
        box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        flex-shrink: 0;
    }
    .team-member-card .btn-remove-member {
        background: #fff;
        color: #dc3545;
        border: 1px solid #dc3545;
    }
    .team-member-card .btn-remove-member:hover {
        background: #dc3545;
        color: #fff;
        transform: scale(1.08);
    }
    .team-member-card .btn-edit-member {
        background: #fff;
        color: #0d6efd;
        border: 1px solid #0d6efd;
    }
    .team-member-card .btn-edit-member:hover {
        background: #0d6efd;
        color: #fff;
        transform: scale(1.08);
    }
</style>
@endpush

@section('content')
    <h1 class="page-title">About Page</h1>
    <p class="text-muted mb-4">Manage the Management Team section — add or remove team members and their images.</p>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <h5 class="text-dark mb-3">Management Team members</h5>
            <div class="row g-4 mb-4">
                @foreach($members as $member)
                    <div class="col-12 col-md-6 col-lg-4 mb-2 mb-md-0">
                        <div class="team-member-card border rounded p-3 position-relative">
                            <div class="d-flex gap-3 align-items-start">
                                <img src="{{ str_starts_with($member->image, 'http') ? $member->image : (str_starts_with($member->image, 'storage/') ? route('team.image', ['path' => \Illuminate\Support\Str::after($member->image, 'storage/')]) : asset($member->image)) }}" alt="{{ $member->name }}" class="rounded flex-shrink-0" style="width: 80px; height: 80px; object-fit: cover;" onerror="this.onerror=null;this.src='{{ asset('placeholder-partner.svg') }}';">
                                <div class="min-w-0 flex-grow-1">
                                    <strong class="d-block text-dark">{{ $member->name }}</strong>
                                    @if($member->title)
                                        <small class="text-muted">{{ $member->title }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="card-actions">
                                <a href="{{ route('admin.pages.about.edit-member', $member) }}" class="btn btn-edit-member" title="Edit" aria-label="Edit"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.pages.about.destroy', $member) }}" method="POST" class="d-inline" onsubmit="return confirm('Remove this team member?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-remove-member" title="Remove" aria-label="Remove"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <form action="{{ route('admin.pages.about.store') }}" method="POST" enctype="multipart/form-data" class="border rounded p-3 bg-light">
                @csrf
                <h6 class="text-dark mb-3">Add team member</h6>
                <div class="row g-2">
                    <div class="col-md-4">
                        <label class="form-label small mb-0">Photo <span class="text-danger">*</span></label>
                        <input type="file" name="image" class="form-control form-control-sm" accept="image/*" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small mb-0">Name</label>
                        <input type="text" name="name" class="form-control form-control-sm" maxlength="255" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small mb-0">Title</label>
                        <input type="text" name="title" class="form-control form-control-sm" placeholder="e.g. Managing Director" maxlength="255">
                    </div>
                    <div class="col-12">
                        <label class="form-label small mb-0">Bio</label>
                        <textarea name="bio" class="form-control form-control-sm" rows="3" maxlength="5000" placeholder="Short biography (optional)"></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-sm">Add member</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
