@extends('layouts.admin')
@section('title', 'GCash QR Settings')
@section('nav_gcash_settings', 'active')
@section('content')
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 2rem; max-width: 900px;">
        <div class="card">
            <div style="padding: 2rem;">
                <h5 style="font-weight: 700; margin: 0 0 0.5rem 0; color: #1f2937;">Upload GCash QR</h5>
                <p style="color: #6b7280; font-size: 0.875rem; margin-bottom: 1.5rem;">This QR code is shown in user checkout
                    so they can pay quickly before entering their reference number.</p>

                <form method="POST" action="{{ route('admin.gcash-settings.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div style="margin-bottom: 1.5rem;">
                        <label for="qr_image" class="form-label">QR Image</label>
                        <input id="qr_image" type="file" name="qr_image"
                            class="form-control @error('qr_image') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp"
                            required>
                        @error('qr_image')
                            <div style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Save QR Image</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div style="padding: 2rem;">
                <h6 style="font-weight: 700; margin: 0 0 1rem 0; color: #1f2937;">Current QR Preview</h6>
                @if ($setting->qr_image_path)
                    <img src="{{ asset('storage/' . $setting->qr_image_path) }}" alt="GCash QR"
                        style="max-height: 420px; object-fit: contain; width: 100%; border-radius: 8px; border: 1px solid #e5e7eb;">
                @else
                    <div
                        style="background: #fef3c7; color: #78350f; border: 1px solid #fcd34d; border-radius: 8px; padding: 1rem; margin: 0;">
                        No QR image uploaded yet.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
