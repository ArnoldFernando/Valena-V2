@extends('layouts.valena')
@section('title', 'Login')
@section('content')
    <div class="min-vh-100 d-flex align-items-center" style="background:linear-gradient(135deg,#fdf6ec 0%,#f3e8d0 100%)">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-7 col-lg-5 col-xl-4">
                    <div class="text-center mb-4">
                        <div class="fs-1 mb-2">☕</div>
                        <h2 class="fw-bold" style="font-family:'Playfair Display',serif;color:var(--valena-brown)">Welcome
                            Back</h2>
                        <p class="text-muted small">Sign in to your Valena account</p>
                    </div>
                    <div class="card border-0 rounded-4 shadow-lg p-4 p-md-5">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="bi bi-envelope text-muted"></i></span>
                                    <input type="email" name="email"
                                        class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="you@example.com" required autofocus>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold small">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="bi bi-lock text-muted"></i></span>
                                    <input type="password" name="password" class="form-control border-start-0 ps-0"
                                        placeholder="••••••••" required>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                    <label class="form-check-label small" for="remember">Remember me</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-valena w-100 py-2 fs-6">Sign In</button>
                        </form>
                        <p class="text-center mt-4 mb-0 small text-muted">
                            Don't have an account? <a href="{{ route('register') }}"
                                class="fw-semibold text-decoration-none" style="color:var(--valena-brown)">Create one</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
