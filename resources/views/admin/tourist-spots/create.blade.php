@extends('layouts.admin')
@section('title', 'Add Tourist Spot')
@section('nav_spots', 'active')
@section('content')
    <div style="max-width: 700px; margin: 0 auto;">
        <div style="margin-bottom: 2.5rem;">
            <h3 style="font-weight: 700; margin: 0 0 0.5rem 0; color: #1f2937; font-size: 1.5rem;">Add Tourist Spot</h3>
            <p style="color: #6b7280; font-size: 0.9rem; margin: 0;">Add a new tourist destination with images</p>
        </div>
        
        <div class="card">
            <form method="POST" action="{{ route('admin.tourist-spots.store') }}" enctype="multipart/form-data">
                @csrf
                <div style="padding: 2rem;">
                    @include('admin._gallery_form', [
                        'item' => null,
                        'idField' => 'ts_id',
                        'idLabel' => 'Spot Group ID',
                    ])
                </div>
                <div style="padding: 2rem; border-top: 1px solid #e5e7eb; display: flex; gap: 1rem; justify-content: flex-end;">
                    <a href="{{ route('admin.tourist-spots.index') }}" class="btn btn-ghost">Cancel</a>
                    <button type="submit" class="btn btn-primary">Add Spot</button>
                </div>
            </form>
        </div>
    </div>
@endsection
