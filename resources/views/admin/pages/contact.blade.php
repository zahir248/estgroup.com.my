@extends('layouts.admin')

@section('title', 'Contact Page')

@section('content')
    <h1 class="page-title">Contact Page</h1>
    <p class="text-muted mb-4">Manage the left section content on the Contact page (Our Location, Quick Contact, Phone Number).</p>

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.pages.contact.update') }}">
                @csrf
                <div class="mb-3">
                    <label for="contact_address" class="form-label">Our Location</label>
                    <textarea class="form-control" id="contact_address" name="contact_address" rows="3" maxlength="500">{{ old('contact_address', $contactAddress) }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="contact_email" class="form-label">Quick Contact — Email</label>
                    <input type="email" class="form-control" id="contact_email" name="contact_email" value="{{ old('contact_email', $contactEmail) }}" required>
                    <div class="form-text">Shown on contact page and where contact form submissions are sent.</div>
                </div>
                <div class="mb-3">
                    <label for="contact_phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="contact_phone" name="contact_phone" value="{{ old('contact_phone', $contactPhone) }}" maxlength="50">
                </div>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </form>
        </div>
    </div>
@endsection
