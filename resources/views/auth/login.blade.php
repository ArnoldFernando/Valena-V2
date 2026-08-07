@extends('layouts.valena')
@section('title', 'Login')
@section('content')
    <div class="container py-5" style="max-width:420px">
        <div class="card shadow">
            <div class="card-body p-4">
                <h4 class="fw-bold text-center mb-4" style="color:var(--valena-brown)">&#9749; Sign In</h4>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-valena w-100">Login</button>
                </form>
                <p class="text-center mt-3 mb-0 small">Don't have an account? <a href="{{ route('register') }}">Register</a>
                </p>
            </div>
        </div>
    </div>
@endsection
