@extends('layouts.admin')
@section('title', 'Add Product')
@section('nav_products', 'active')
@section('content')
    <div class="v-card p-4" style="max-width:640px">
        <div class="card-body">
            <h6 class="fw-bold mb-4">New Product</h6>
            <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                @csrf
                @include('admin.products._form', ['product' => null])
                <div class="d-flex gap-2 mt-4">
                    <button class="btn btn-valena px-4">Save</button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary px-4 rounded-3">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
