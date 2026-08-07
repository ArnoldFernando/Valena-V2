@extends('layouts.valena')
@section('title', 'Welcome')
@section('content')

    {{-- Hero --}}
    <section class="hero-section text-white py-5">
        <div class="container text-center py-4">
            <h1 class="display-4 fw-bold">&#9749; Welcome to Valena</h1>
            <p class="lead">CSU Lal-lo's Coffee Tourism &amp; E-Commerce Platform</p>
            <a href="{{ route('products.index') }}" class="btn btn-lg btn-valena me-2">Shop Now</a>
            <a href="{{ route('facilities.index') }}" class="btn btn-lg btn-outline-light">Explore</a>
        </div>
    </section>

    {{-- Featured Products --}}
    <section class="py-5">
        <div class="container">
            <h2 class="fw-bold mb-4" style="color:var(--valena-brown)">Featured Products</h2>
            <div class="row g-3">
                @forelse($products as $product)
                    <div class="col-sm-6 col-md-3">
                        <div class="card h-100 shadow-sm">
                            @if ($product->img)
                                <img src="{{ asset('storage/images/' . $product->img) }}"
                                    class="card-img-top object-fit-cover" style="height:200px" alt="{{ $product->title }}">
                            @else
                                <div class="bg-secondary text-white d-flex align-items-center justify-content-center"
                                    style="height:200px"><i class="bi bi-image fs-1"></i></div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title">{{ $product->title }}</h6>
                                <p class="text-muted small">{{ $product->slogan }}</p>
                                <p class="fw-bold mt-auto">₱{{ number_format($product->price, 2) }}</p>
                                <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-valena mt-1">View</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No products yet.</p>
                @endforelse
            </div>
            <div class="text-center mt-4"><a href="{{ route('products.index') }}" class="btn btn-valena">All Products</a>
            </div>
        </div>
    </section>

    {{-- Facilities --}}
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="fw-bold mb-4" style="color:var(--valena-brown)">Our Facilities</h2>
            <div class="row g-3">
                @forelse($facilities as $fac)
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            @if ($fac->image)
                                <img src="{{ asset('storage/images/' . $fac->image) }}" class="card-img-top object-fit-cover"
                                    style="height:200px" alt="{{ $fac->name }}">
                            @endif
                            <div class="card-body">
                                <h6 class="card-title">{{ $fac->name }}</h6>
                                <p class="card-text small text-muted">{{ $fac->intro_description }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No facilities listed.</p>
                @endforelse
            </div>
            <div class="text-center mt-4"><a href="{{ route('facilities.index') }}" class="btn btn-valena">All
                    Facilities</a></div>
        </div>
    </section>

    {{-- Latest News --}}
    <section class="py-5">
        <div class="container">
            <h2 class="fw-bold mb-4" style="color:var(--valena-brown)">Latest News</h2>
            <div class="row g-3">
                @forelse($news as $article)
                    <div class="col-md-4">
                        <div class="card h-100 shadow-sm">
                            @if ($article->image)
                                <img src="{{ asset('storage/images/' . $article->image) }}"
                                    class="card-img-top object-fit-cover" style="height:180px" alt="{{ $article->name }}">
                            @endif
                            <div class="card-body">
                                <p class="text-muted small">{{ $article->date->format('M d, Y') }}</p>
                                <h6 class="card-title">{{ $article->name }}</h6>
                                <p class="card-text small">{{ $article->intro_description }}</p>
                                <a href="{{ route('news.show', $article) }}" class="btn btn-sm btn-outline-secondary">Read
                                    More</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No news yet.</p>
                @endforelse
            </div>
            <div class="text-center mt-4"><a href="{{ route('news.index') }}" class="btn btn-valena">All News</a></div>
        </div>
    </section>
@endsection
