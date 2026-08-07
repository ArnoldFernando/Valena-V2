@extends('layouts.valena')
@section('title', $product->title)
@section('nav_products', 'active')
@section('content')

    <div style="background:linear-gradient(135deg,var(--valena-dark) 0%,var(--valena-brown) 100%);padding:2.5rem 0 1.5rem">
        <div class="container text-white">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0" style="--bs-breadcrumb-divider-color:rgba(255,255,255,.4)">
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}"
                            class="text-white-50 text-decoration-none">Products</a></li>
                    <li class="breadcrumb-item active text-white">{{ $product->title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-5 align-items-start">
            <div class="col-md-5">
                <div class="rounded-4 overflow-hidden shadow-lg" style="aspect-ratio:1/1">
                    @if ($product->img)
                        <img src="{{ asset('storage/images/' . $product->img) }}" class="w-100 h-100 object-fit-cover"
                            alt="{{ $product->title }}">
                    @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center"
                            style="background:var(--valena-cream)">
                            <i class="bi bi-cup-hot" style="font-size:5rem;color:var(--valena-gold)"></i>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-7">
                @if ($product->promo_status === 'Yes')
                    <span class="badge-promo mb-3 d-inline-block">🔥 Promo</span>
                @endif
                <h1 class="fw-bold mb-2"
                    style="font-family:'Playfair Display',serif;color:var(--valena-dark);font-size:clamp(1.6rem,4vw,2.2rem)">
                    {{ $product->title }}
                </h1>
                <p class="text-muted mb-4">{{ $product->slogan }}</p>

                <div class="d-flex align-items-baseline gap-3 mb-4">
                    <span class="fw-bold"
                        style="font-size:2rem;color:var(--valena-brown)">₱{{ number_format($product->price, 2) }}</span>
                </div>

                <div class="d-flex flex-wrap gap-3 mb-4 small text-muted">
                    <span><i class="bi bi-box-seam me-1"></i>{{ $product->stocks }} in stock</span>
                    @if ($product->supplier)
                        <span><i class="bi bi-truck me-1"></i>{{ $product->supplier->title }}</span>
                    @endif
                </div>

                <hr style="border-color:#e5e7eb">

                @if ($product->stocks > 0)
                    @auth
                        <form method="POST" action="{{ route('cart.store') }}" class="mt-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="d-flex align-items-center gap-3 flex-wrap">
                                <div class="d-flex align-items-center gap-2">
                                    <label class="fw-semibold small">Qty</label>
                                    <input type="number" name="quantity" value="1" min="1"
                                        max="{{ $product->stocks }}" class="form-control rounded-3 text-center fw-bold"
                                        style="width:80px">
                                </div>
                                <button class="btn btn-valena px-5 py-2">
                                    <i class="bi bi-bag-plus me-2"></i>Add to Cart
                                </button>
                            </div>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-valena px-5 py-2 mt-4">
                            <i class="bi bi-person me-2"></i>Login to Purchase
                        </a>
                    @endauth
                @else
                    <div class="mt-4 d-inline-flex align-items-center gap-2 px-4 py-2 rounded-3"
                        style="background:#fee2e2;color:#991b1b">
                        <i class="bi bi-x-circle"></i> Out of Stock
                    </div>
                @endif

                <a href="{{ route('products.index') }}" class="btn btn-valena-outline px-4 py-2 mt-3 ms-2">
                    ← Back
                </a>
            </div>
        </div>
    </div>
@endsection
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
