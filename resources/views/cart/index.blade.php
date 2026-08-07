@extends('layouts.valena')
@section('title', 'My Cart')
@section('content')
    <div style="background:linear-gradient(135deg,var(--valena-dark) 0%,var(--valena-brown) 100%);padding:3.5rem 0 2rem">
        <div class="container text-white">
            <span class="section-eyebrow d-block mb-2">Shopping</span>
            <h1 class="mb-0" style="font-family:'Playfair Display',serif;font-size:2.4rem">My Cart</h1>
        </div>
    </div>

    <div class="container py-5">
        @if ($items->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-bag2 fs-1 mb-3 d-block text-muted"></i>
                <h5 class="fw-bold text-muted">Your cart is empty</h5>
                <p class="text-muted">Browse our products and add something you love.</p>
                <a href="{{ route('products.index') }}" class="btn btn-valena px-5">Browse Products</a>
            </div>
        @else
            <div class="row g-4 align-items-start">
                <div class="col-lg-8">
                    <div class="card border-0 rounded-4 shadow-sm overflow-hidden">
                        <div class="card-header bg-white border-0 px-4 pt-4 pb-2">
                            <h6 class="fw-bold mb-0">Cart Items ({{ $items->count() }})</h6>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover align-middle mb-0">
                                <thead style="background:#f9fafb">
                                    <tr>
                                        <th class="px-4 py-3">Product</th>
                                        <th class="py-3">Unit Price</th>
                                        <th class="py-3">Qty</th>
                                        <th class="py-3">Subtotal</th>
                                        <th class="py-3"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td class="px-4 py-3 fw-semibold">{{ $item->product_name }}</td>
                                            <td class="py-3">₱{{ number_format($item->price, 2) }}</td>
                                            <td class="py-3">
                                                <form method="POST" action="{{ route('cart.update', $item) }}"
                                                    class="d-flex align-items-center gap-1">
                                                    @csrf
                                                    <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                        min="1" class="form-control form-control-sm rounded-3"
                                                        style="width:65px">
                                                    <button class="btn btn-sm btn-light rounded-3" title="Update"><i
                                                            class="bi bi-arrow-repeat"></i></button>
                                                </form>
                                            </td>
                                            <td class="py-3 fw-bold" style="color:var(--valena-brown)">
                                                ₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                                            <td class="py-3">
                                                <form method="POST" action="{{ route('cart.destroy', $item) }}">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-sm btn-light text-danger rounded-3"
                                                        title="Remove">
                                                        <i class="bi bi-x-lg"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 rounded-4 shadow-sm p-4">
                        <h6 class="fw-bold mb-4">Order Summary</h6>
                        @php $total = $items->sum(fn($i) => $i->price * $i->quantity) @endphp
                        <div class="d-flex justify-content-between text-muted small mb-2">
                            <span>Subtotal ({{ $items->count() }} items)</span>
                            <span>₱{{ number_format($total, 2) }}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between fw-bold mb-4" style="font-size:1.15rem">
                            <span>Total</span>
                            <span style="color:var(--valena-brown)">₱{{ number_format($total, 2) }}</span>
                        </div>

                        <div class="p-3 rounded-3 mb-4"
                            style="background:var(--valena-cream);border:1.5px dashed var(--valena-gold)">
                            <p class="fw-semibold small mb-1">📎 Proof of Payment</p>
                            <p class="text-muted small mb-0">Upload your GCash / bank screenshot after paying.</p>
                        </div>

                        <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="file" name="proof_file"
                                    class="form-control rounded-3 @error('proof_file') is-invalid @enderror"
                                    accept=".jpg,.jpeg,.png">
                                @error('proof_file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button class="btn btn-valena w-100 py-2 fw-bold">Place Order →</button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
{{--  <h2 class="fw-bold mb-4" style="color:var(--valena-brown)">Shopping Cart</h2>

@if ($items->isEmpty())
    <div class="text-center py-5 text-muted">
        <i class="bi bi-cart3 fs-1"></i>
        <p class="mt-2">Your cart is empty. <a href="{{ route('products.index') }}">Browse products</a></p>
    </div>
@else
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th style="width:120px">Price</th>
                                <th style="width:120px">Qty</th>
                                <th style="width:100px">Subtotal</th>
                                <th style="width:60px"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td class="align-middle">{{ $item->product_name }}</td>
                                    <td class="align-middle">₱{{ number_format($item->price, 2) }}</td>
                                    <td class="align-middle">
                                        <form method="POST" action="{{ route('cart.update', $item) }}"
                                            class="d-flex align-items-center gap-1">
                                            @csrf
                                            <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                min="1" class="form-control form-control-sm" style="width:65px">
                                            <button class="btn btn-sm btn-outline-secondary">↺</button>
                                        </form>
                                    </td>
                                    <td class="align-middle fw-semibold">
                                        ₱{{ number_format($item->price * $item->quantity, 2) }}</td>
                                    <td class="align-middle">
                                        <form method="POST" action="{{ route('cart.destroy', $item) }}">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm btn-outline-danger"><i
                                                    class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Order Summary</h5>
                    @php $total = $items->sum(fn($i) => $i->price * $i->quantity) @endphp
                    <div class="d-flex justify-content-between mb-2">
                        <span>Items ({{ $items->count() }})</span>
                        <strong>₱{{ number_format($total, 2) }}</strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fw-bold fs-5 mb-3">
                        <span>Total</span>
                        <span>₱{{ number_format($total, 2) }}</span>
                    </div>
                    <h6 class="fw-semibold mb-2">Proof of Payment</h6>
                    <p class="small text-muted mb-2">Upload your GCash or bank transfer screenshot.</p>
                    <form method="POST" action="{{ route('orders.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="file" name="proof_file"
                                class="form-control @error('proof_file') is-invalid @enderror"
                                accept=".jpg,.jpeg,.png">
                            @error('proof_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button class="btn btn-valena w-100 fw-bold">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
</div>
@endsection  --}}
