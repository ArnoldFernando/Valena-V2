@extends('layouts.admin')
@section('title', 'Add Facility')
@section('nav_facilities', 'active')
@section('content')
    <div style="max-width: 700px; margin: 0 auto;">
        <div style="margin-bottom: 2.5rem;">
            <h3 style="font-weight: 700; margin: 0 0 0.5rem 0; color: #1f2937; font-size: 1.5rem;">Add Facility</h3>
            <p style="color: #6b7280; font-size: 0.9rem; margin: 0;">Add a new facility with images and details</p>
        </div>
        
        <div class="card">
            <form method="POST" action="{{ route('admin.facilities.store') }}" enctype="multipart/form-data">
                @csrf
                <div style="padding: 2rem;">
                    @include('admin._gallery_form', [
                        'item' => null,
                        'idField' => 'fac_id',
                        'idLabel' => 'Facility Group ID',
                    ])
                </div>
                <div style="padding: 2rem; border-top: 1px solid #e5e7eb; display: flex; gap: 1rem; justify-content: flex-end;">
                    <a href="{{ route('admin.facilities.index') }}" class="btn btn-ghost">Cancel</a>
                    <button type="submit" class="btn btn-primary">Add Facility</button>
                </div>
            </form>
        </div>
    </div>
@endsection
