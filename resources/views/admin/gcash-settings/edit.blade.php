@extends('layouts.admin')
@section('title', 'GCash QR Settings')
@section('nav_gcash_settings', 'active')
@section('content')
    <div class="row g-4" style="max-width: 900px;">
        <div class="col-lg-6">
            <div class="v-card">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-2">Upload GCash QR</h5>
                    <p class="text-muted small mb-4">This QR code is shown in user checkout so they can pay quickly before
                        entering their reference number.</p>

                    <form method="POST" action="{{ route('admin.gcash-settings.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="qr_image" class="form-label">QR Image</label>
                            <input id="qr_image" type="file" name="qr_image"
                                class="form-control @error('qr_image') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp"
                                required>
                            @error('qr_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-valena w-100">Save QR Image</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="v-card">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Current QR Preview</h6>
                    @if ($setting->qr_image_path)
                        <img src="{{ asset('storage/' . $setting->qr_image_path) }}" alt="GCash QR"
                            class="img-fluid rounded-3 border" style="max-height: 420px; object-fit: contain; width: 100%;">
                    @else
                        <div class="alert alert-warning mb-0">
                            No QR image uploaded yet.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
