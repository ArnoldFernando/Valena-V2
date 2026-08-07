@extends('layouts.valena')
@section('title', $product->title)
@section('content')
    <div class="container py-5">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                <li class="breadcrumb-item active">{{ $product->title }}</li>
            </ol>
        </nav>
        <div class="row g-4 align-items-start">
            <div class="col-md-5">
                @if ($product->img)
                    <img src="{{ asset('storage/images/' . $product->img) }}" class="img-fluid rounded shadow"
                        alt="{{ $product->title }}">
                @else
                    <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height:300px"><i
                            class="bi bi-image fs-1 text-muted"></i></div>
                @endif
            </div>
            <div class="col-md-7">
                <h2 class="fw-bold" style="color:var(--valena-brown)">{{ $product->title }}</h2>
                <p class="text-muted">{{ $product->slogan }}</p>
                @if ($product->promo_status === 'Yes')
                    <span class="badge bg-warning text-dark">Promo</span>
                @endif
                <h3 class="mt-3 fw-bold">₱{{ number_format($product->price, 2) }}</h3>
                <p class="text-muted small">Stock: {{ $product->stocks }}</p>
                @if ($product->supplier)
                    <p class="small"><strong>Supplier:</strong> {{ $product->supplier->title }}</p>
                @endif

                @if ($product->stocks > 0)
                    @auth
                        <form method="POST" action="{{ route('cart.store') }}" class="mt-3 d-flex align-items-center gap-2">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stocks }}"
                                class="form-control" style="width:80px">
                            <button class="btn btn-valena">Add to Cart</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-valena mt-3">Login to Purchase</a>
                    @endauth
                @else
                    <p class="text-danger fw-bold mt-3">Out of Stock</p>
                @endif
            </div>
        </div>
    </div>
@endsection
