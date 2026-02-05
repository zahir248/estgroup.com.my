@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="page-title">Dashboard</h1>
    <p class="text-muted mb-4">Welcome back, {{ auth()->user()->name }}.</p>

    <div class="row g-3">
        <div class="col-sm-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-3 bg-primary bg-opacity-10 p-3 text-primary">
                            <i class="bi bi-globe fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small text-uppercase">Site</h6>
                            <a href="{{ url('/') }}" target="_blank" rel="noopener" class="text-decoration-none fw-600 text-dark">View website</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-3 bg-success bg-opacity-10 p-3 text-success">
                            <i class="bi bi-envelope fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small text-uppercase">Contact</h6>
                            <span class="fw-600">Inquiries go to email</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-3 bg-warning bg-opacity-10 p-3 text-warning">
                            <i class="bi bi-person fs-4"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small text-uppercase">Logged in as</h6>
                            <span class="fw-600">{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
