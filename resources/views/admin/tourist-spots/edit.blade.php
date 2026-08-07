@extends('layouts.admin')
@section('title', 'Edit Tourist Spot')
@section('nav_spots', 'active')
@section('content')
    <div class="v-card p-4" style="max-width:640px">
        <div class="card-body">
            <h6 class="fw-bold mb-4">Edit Tourist Spot</h6>
            <form method="POST" action="{{ route('admin.tourist-spots.update', $spot) }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                @include('admin._gallery_form', [
                    'item' => $spot,
                    'idField' => 'ts_id',
                    'idLabel' => 'Spot Group ID',
                ])
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-valena px-4">Update</button>
                    <a href="{{ route('admin.tourist-spots.index') }}" class="btn btn-outline-secondary px-4 rounded-3">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
