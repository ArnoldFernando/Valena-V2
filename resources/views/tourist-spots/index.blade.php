@extends('layouts.valena')
@section('title', 'Tourist Spots')
@section('content')
    <div style="background:linear-gradient(135deg,var(--valena-dark) 0%,var(--valena-brown) 100%);padding:3.5rem 0 2rem">
        <div class="container text-white">
            <span class="section-eyebrow d-block mb-2">Explore</span>
            <h1 class="mb-0" style="font-family:'Playfair Display',serif;font-size:2.4rem">Tourist Spots</h1>
        </div>
    </div>
    <div class="container py-5">

        @php $grouped = $spots->groupBy('ts_id'); @endphp

        @forelse($grouped as $tsId => $images)
            @php $first = $images->first() @endphp
            <div class="card shadow-sm mb-5">
                <div class="card-body">
                    <h4 class="card-title fw-bold" style="color:var(--valena-brown)">{{ $first->name }}</h4>
                    <p class="text-muted">{{ $first->intro_description }}</p>
                    <p>{{ $first->full_description }}</p>
                    <div class="row g-2 mt-2">
                        @foreach ($images as $item)
                            @if ($item->image)
                                <div class="col-6 col-md-3">
                                    <img src="{{ asset('storage/images/' . $item->image) }}"
                                        class="img-fluid rounded gallery-thumb" data-bs-toggle="modal"
                                        data-bs-target="#galleryModal"
                                        data-src="{{ asset('storage/images/' . $item->image) }}"
                                        data-caption="{{ $item->name }}"
                                        style="height:140px;object-fit:cover;width:100%;cursor:pointer"
                                        alt="{{ $item->name }}">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No tourist spots listed yet.</p>
        @endforelse
    </div>

    <div class="modal fade" id="galleryModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content bg-dark text-white border-0">
                <div class="modal-header border-0">
                    <h6 class="modal-title" id="galleryCaption"></h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center p-0">
                    <img id="galleryImg" src="" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.querySelectorAll('.gallery-thumb').forEach(img => {
                img.addEventListener('click', () => {
                    document.getElementById('galleryImg').src = img.dataset.src;
                    document.getElementById('galleryCaption').textContent = img.dataset.caption;
                });
            });
        </script>
    @endpush
@endsection
