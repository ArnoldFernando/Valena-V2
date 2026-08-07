@extends('layouts.valena')
@section('title', 'Products')
@section('nav_products', 'active')
@section('content')

    {{-- Page header --}}
    <div style="background:linear-gradient(135deg,var(--valena-dark) 0%,var(--valena-brown) 100%);padding:3.5rem 0 2rem">
        <div class="container text-white">
            <span class="section-eyebrow d-block mb-2">Our Selection</span>
            <h1 class="mb-0" style="font-family:'Playfair Display',serif;font-size:2.4rem">Coffee Products</h1>
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-4">
            @forelse($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="v-card card h-100">
                        <div class="card-img-wrap">
                            @if ($product->img)
                                <img src="{{ asset('storage/images/' . $product->img) }}" alt="{{ $product->title }}">
                            @else
                                <div class="d-flex align-items-center justify-content-center h-100"
                                    style="background:var(--valena-cream)">
                                    <i class="bi bi-cup-hot fs-1" style="color:var(--valena-gold)"></i>
                                </div>
                            @endif
                            @if ($product->promo_status === 'Yes')
                                <span class="badge-promo position-absolute top-0 start-0 m-2">🔥 Promo</span>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column p-4">
                            <h6 class="fw-bold mb-1">{{ $product->title }}</h6>
                            <p class="text-muted small mb-auto">{{ $product->slogan }}</p>
                            <div class="d-flex align-items-center justify-content-between mt-3">
                                <span class="price-tag">₱{{ number_format($product->price, 2) }}</span>
                                <span class="small text-muted">{{ $product->stocks }} left</span>
                            </div>
                            <div class="d-flex gap-2 mt-3">
                                <a href="{{ route('products.show', $product) }}"
                                    class="btn btn-sm btn-valena-outline flex-fill">Details</a>
                                @auth
                                    <form method="POST" action="{{ route('cart.store') }}" class="flex-fill">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="btn btn-sm btn-valena w-100" @disabled($product->stocks < 1)>
                                            <i class="bi bi-bag-plus me-1"></i>Add
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-sm btn-valena flex-fill text-center"><i
                                            class="bi bi-bag-plus me-1"></i>Add</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <i class="bi bi-cup-hot fs-1 mb-3 d-block"></i>
                    <p>No products available yet.</p>
                </div>
            @endforelse
        </div>
        <div class="mt-5 d-flex justify-content-center">{{ $products->links() }}</div>
    </div>
@endsection
