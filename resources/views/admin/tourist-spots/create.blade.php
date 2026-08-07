@extends('layouts.admin')
@section('title', 'Add Tourist Spot')
@section('nav_spots', 'active')
@section('content')
    <div class="card shadow-sm" style="max-width:640px">
        <div class="card-body">
            <h6 class="fw-bold mb-4">Add Tourist Spot</h6>
            <form method="POST" action="{{ route('admin.tourist-spots.store') }}" enctype="multipart/form-data">
                @csrf
                @include('admin._gallery_form', [
                    'item' => null,
                    'idField' => 'ts_id',
                    'idLabel' => 'Spot Group ID',
                ])
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-valena">Save</button>
                    <a href="{{ route('admin.tourist-spots.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
