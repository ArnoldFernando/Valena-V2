@extends('layouts.admin')
@section('title', 'Edit Supplier')
@section('nav_suppliers', 'active')
@section('content')
    <div class="card shadow-sm" style="max-width:680px">
        <div class="card-body">
            <h6 class="fw-bold mb-4">Edit Supplier</h6>
            <form method="POST" action="{{ route('admin.suppliers.update', $supplier) }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                @include('admin.suppliers._form', ['supplier' => $supplier])
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-valena">Update</button>
                    <a href="{{ route('admin.suppliers.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
