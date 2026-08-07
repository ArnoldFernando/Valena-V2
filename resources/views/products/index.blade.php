@extends('layouts.valena')
@section('title', 'Products')
@section('content')
    <div class="container py-5">
        <h2 class="fw-bold mb-4" style="color:var(--valena-brown)">Our Products</h2>
        <div class="row g-3">
            @forelse($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3">
                    <div class="card h-100 shadow-sm">
                        @if ($product->img)
                            <img src="{{ asset('storage/images/' . $product->img) }}" class="card-img-top object-fit-cover"
                                style="height:210px" alt="{{ $product->title }}">
                        @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="height:210px"><i
                                    class="bi bi-image fs-2 text-muted"></i></div>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title mb-1">{{ $product->title }}</h6>
                            <p class="text-muted small mb-1">{{ $product->slogan }}</p>
                            @if ($product->promo_status === 'Yes')
                                <span class="badge bg-warning text-dark mb-2">Promo</span>
                            @endif
                            <p class="fw-bold mt-auto mb-2">₱{{ number_format($product->price, 2) }}</p>
                            <p class="small text-muted mb-2">Stock: {{ $product->stocks }}</p>
                            <div class="d-flex gap-2">
                                <a href="{{ route('products.show', $product) }}"
                                    class="btn btn-sm btn-outline-secondary flex-fill">Details</a>
                                @auth
                                    <form method="POST" action="{{ route('cart.store') }}" class="flex-fill">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button class="btn btn-sm btn-valena w-100"
                                            @if ($product->stocks < 1) disabled @endif>Add to Cart</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-sm btn-valena flex-fill">Add to Cart</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">No products available.</p>
            @endforelse
        </div>
        <div class="mt-4">{{ $products->links() }}</div>
    </div>
@endsection
