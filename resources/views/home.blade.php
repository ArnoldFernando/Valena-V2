@extends('layouts.valena')
@section('title', 'Welcome')
@section('nav_home', 'active')
@section('content')

    {{-- Hero --}}
    <section class="hero-section text-white py-5" style="min-height:88vh;display:flex;align-items:center">
        <div class="container position-relative" style="z-index:1">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <span class="section-eyebrow d-block mb-3">☕ CSU Lal-lo Coffee Tourism</span>
                    <h1 class="display-4 fw-bold text-white mb-4 lh-sm" style="font-family:'Playfair Display',serif">
                        Discover the Taste of<br>
                        <span style="color:var(--valena-gold)">Cagayan's Finest</span><br>
                        Coffee Culture
                    </h1>
                    <p class="lead mb-5" style="color:rgba(255,255,255,.75);max-width:480px">
                        Explore local tourist spots, campus facilities, and shop premium coffee products from the heart of
                        Cagayan.
                    </p>
                    <div class="d-flex flex-wrap gap-3">
                        <a href="{{ route('products.index') }}" class="btn btn-valena btn-lg px-4">Shop Coffee</a>
                        <a href="{{ route('tourist-spots.index') }}" class="btn btn-lg px-4"
                            style="border:2px solid rgba(255,255,255,.4);color:#fff;border-radius:10px">Explore Spots</a>
                    </div>
                    <div class="d-flex gap-4 mt-5">
                        <div>
                            <div class="fw-bold fs-4 text-white">100%</div>
                            <div class="small" style="color:rgba(255,255,255,.55)">Local Grown</div>
                        </div>
                        <div style="width:1px;background:rgba(255,255,255,.15)"></div>
                        <div>
                            <div class="fw-bold fs-4 text-white">3+</div>
                            <div class="small" style="color:rgba(255,255,255,.55)">Tourist Spots</div>
                        </div>
                        <div style="width:1px;background:rgba(255,255,255,.15)"></div>
                        <div>
                            <div class="fw-bold fs-4 text-white">CSU</div>
                            <div class="small" style="color:rgba(255,255,255,.55)">Lal-lo Campus</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-flex justify-content-end">
                    <div class="position-relative" style="width:420px;height:420px">
                        <div class="rounded-circle position-absolute"
                            style="inset:0;background:radial-gradient(circle,rgba(212,168,83,.15) 0%,transparent 70%)">
                        </div>
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <span style="font-size:14rem;line-height:1;opacity:.15">☕</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Featured Products --}}
    <section class="py-5 py-lg-6 bg-body">
        <div class="container">
            <div class="d-flex align-items-end justify-content-between mb-5 flex-wrap gap-3">
                <div>
                    <span class="section-eyebrow d-block mb-2">Our Selection</span>
                    <h2 class="section-title mb-0">Featured Products</h2>
                </div>
                <a href="{{ route('products.index') }}" class="btn btn-valena-outline">View All Products →</a>
            </div>
            <div class="row g-4">
                @forelse($products as $product)
                    <div class="col-sm-6 col-lg-3">
                        <div class="v-card card h-100">
                            <div class="card-img-wrap">
                                @if ($product->img)
                                    <img src="{{ asset('storage/images/' . $product->img) }}" alt="{{ $product->title }}">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100 home-placeholder"><i
                                            class="bi bi-cup-hot fs-1 text-muted"></i></div>
                                @endif
                            </div>
                            <div class="card-body d-flex flex-column p-4">
                                @if ($product->promo_status === 'Yes')
                                    <span class="badge-promo mb-2 d-inline-block">🔥 Promo</span>
                                @endif
                                <h6 class="fw-bold mb-1">{{ $product->title }}</h6>
                                <p class="text-muted small mb-3">{{ $product->slogan }}</p>
                                <div class="d-flex align-items-center justify-content-between mt-auto">
                                    <span class="price-tag">₱{{ number_format($product->price, 2) }}</span>
                                    <a href="{{ route('products.show', $product) }}"
                                        class="btn btn-valena btn-sm px-3">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No products yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Facilities --}}
    <section class="py-5 py-lg-6 home-facilities-section">
        <div class="container">
            <div class="d-flex align-items-end justify-content-between mb-5 flex-wrap gap-3">
                <div>
                    <span class="section-eyebrow d-block mb-2">Campus Life</span>
                    <h2 class="section-title mb-0">Our Facilities</h2>
                </div>
                <a href="{{ route('facilities.index') }}" class="btn btn-valena-outline">Explore Facilities →</a>
            </div>
            <div class="row g-4">
                @forelse($facilities as $fac)
                    <div class="col-md-4">
                        <div class="v-card card h-100">
                            <div class="card-img-wrap" style="height:200px">
                                @if ($fac->image)
                                    <img src="{{ asset('storage/images/' . $fac->image) }}" alt="{{ $fac->name }}">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100 home-placeholder"><i
                                            class="bi bi-building fs-1 text-muted"></i></div>
                                @endif
                            </div>
                            <div class="card-body p-4">
                                <h6 class="fw-bold mb-2">{{ $fac->name }}</h6>
                                <p class="text-muted small mb-0">{{ $fac->intro_description }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No facilities listed.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Tourist Spots strip --}}
    <section class="py-5" style="background:var(--valena-brown)">
        <div class="container text-center text-white">
            <span class="section-eyebrow d-block mb-2" style="color:var(--valena-gold)">Discover</span>
            <h2 class="mb-3" style="font-family:'Playfair Display',serif;font-size:clamp(1.5rem,3vw,2rem)">Explore Tourist
                Spots Near Campus</h2>
            <p class="mb-4" style="color:rgba(255,255,255,.7);max-width:520px;margin:0 auto">From scenic viewdecks to
                campus cafes — discover the best spots Lal-lo has to offer.</p>
            <a href="{{ route('tourist-spots.index') }}" class="btn px-5"
                style="background:var(--valena-gold);color:#1a0a02;font-weight:700;border-radius:10px">View All Spots</a>
        </div>
    </section>

    {{-- Latest News --}}
    <section class="py-5 py-lg-6 bg-body">
        <div class="container">
            <div class="d-flex align-items-end justify-content-between mb-5 flex-wrap gap-3">
                <div>
                    <span class="section-eyebrow d-block mb-2">Updates</span>
                    <h2 class="section-title mb-0">Latest News</h2>
                </div>
                <a href="{{ route('news.index') }}" class="btn btn-valena-outline">All Articles →</a>
            </div>
            <div class="row g-4">
                @forelse($news as $article)
                    <div class="col-md-4">
                        <div class="v-card card h-100">
                            <div class="card-img-wrap" style="height:180px">
                                @if ($article->image)
                                    <img src="{{ asset('storage/images/' . $article->image) }}"
                                        alt="{{ $article->name }}">
                                @else
                                    <div class="d-flex align-items-center justify-content-center h-100 home-placeholder"><i
                                            class="bi bi-newspaper fs-1 text-muted"></i></div>
                                @endif
                            </div>
                            <div class="card-body d-flex flex-column p-4">
                                <span class="small fw-semibold mb-2"
                                    style="color:var(--valena-gold)">{{ $article->date->format('M d, Y') }}</span>
                                <h6 class="fw-bold mb-2">{{ $article->name }}</h6>
                                <p class="text-muted small mb-3">{{ Str::limit($article->intro_description, 90) }}</p>
                                <a href="{{ route('news.show', $article) }}"
                                    class="mt-auto btn btn-sm btn-valena-outline">Read More</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No news yet.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
