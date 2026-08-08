@extends('layouts.admin')
@section('title', 'Edit Facility')
@section('nav_facilities', 'active')
@section('content')
    <div style="max-width: 700px; margin: 0 auto;">
        <div style="margin-bottom: 2.5rem;">
            <h3 style="font-weight: 700; margin: 0 0 0.5rem 0; color: #1f2937; font-size: 1.5rem;">Edit Facility</h3>
            <p style="color: #6b7280; font-size: 0.9rem; margin: 0;">Update facility details and images</p>
        </div>

        <div class="card">
            <form method="POST" action="{{ route('admin.facilities.update', $facility) }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div style="padding: 2rem;">
                    @include('admin._gallery_form', [
                        'item' => $facility,
                        'idField' => 'fac_id',
                        'idLabel' => 'Facility Group ID',
                    ])
                </div>
                <div
                    style="padding: 2rem; border-top: 1px solid #e5e7eb; display: flex; gap: 1rem; justify-content: flex-end;">
                    <a href="{{ route('admin.facilities.index') }}" class="btn btn-ghost">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Facility</button>
                </div>
            </form>
        </div>
    </div>
@endsection
