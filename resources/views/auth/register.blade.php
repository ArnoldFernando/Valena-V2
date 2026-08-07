@extends('layouts.valena')
@section('title', 'Register')
@section('content')
    <div class="py-5" style="background:linear-gradient(135deg,#fdf6ec 0%,#f3e8d0 100%);min-height:100vh">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5">
                    <div class="text-center mb-4">
                        <div class="fs-1 mb-2">☕</div>
                        <h2 class="fw-bold" style="font-family:'Playfair Display',serif;color:var(--valena-brown)">Create
                            Account</h2>
                        <p class="text-muted small">Join the Valena coffee community</p>
                    </div>
                    <div class="card border-0 rounded-4 shadow-lg p-4 p-md-5">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="bi bi-person text-muted"></i></span>
                                    <input type="text" name="name"
                                        class="form-control border-start-0 ps-0 @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" placeholder="Juan dela Cruz" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="bi bi-envelope text-muted"></i></span>
                                    <input type="email" name="email"
                                        class="form-control border-start-0 ps-0 @error('email') is-invalid @enderror"
                                        value="{{ old('email') }}" placeholder="you@example.com" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label fw-semibold small">Phone</label>
                                    <input type="text" name="phone"
                                        class="form-control @error('phone') is-invalid @enderror"
                                        value="{{ old('phone') }}" placeholder="09xxxxxxxxx">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fw-semibold small">Address</label>
                                    <input type="text" name="address"
                                        class="form-control @error('address') is-invalid @enderror"
                                        value="{{ old('address') }}" placeholder="City, Province">
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="bi bi-lock text-muted"></i></span>
                                    <input type="password" name="password"
                                        class="form-control border-start-0 ps-0 @error('password') is-invalid @enderror"
                                        placeholder="Min. 6 characters" required>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold small">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i
                                            class="bi bi-lock-fill text-muted"></i></span>
                                    <input type="password" name="password_confirmation"
                                        class="form-control border-start-0 ps-0" placeholder="Repeat password" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-valena w-100 py-2 fs-6">Create Account</button>
                        </form>
                        <p class="text-center mt-4 mb-0 small text-muted">
                            Already have an account? <a href="{{ route('login') }}"
                                class="fw-semibold text-decoration-none" style="color:var(--valena-brown)">Sign in</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
