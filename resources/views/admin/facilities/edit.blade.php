@extends('layouts.admin')
@section('title', 'Edit Facility')
@section('nav_facilities', 'active')
@section('content')
    <div class="v-card p-4" style="max-width:640px">
        <div class="card-body">
            <h6 class="fw-bold mb-4">Edit Facility</h6>
            <form method="POST" action="{{ route('admin.facilities.update', $facility) }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                @include('admin._gallery_form', [
                    'item' => $facility,
                    'idField' => 'fac_id',
                    'idLabel' => 'Facility Group ID',
                ])
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-valena px-4">Update</button>
                    <a href="{{ route('admin.facilities.index') }}" class="btn btn-outline-secondary px-4 rounded-3">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
