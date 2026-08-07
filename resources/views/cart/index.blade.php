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
                            <p class="fw-semibold small mb-1">GCash Payment Details</p>
                            <p class="text-muted small mb-0">Scan the QR to pay first, then enter your GCash reference
                                number below for admin verification.</p>
                        </div>

                        @if ($gcashSetting?->qr_image_path)
                            <div class="text-center mb-4">
                                <img src="{{ asset('storage/' . $gcashSetting->qr_image_path) }}" alt="GCash QR"
                                    class="img-fluid rounded-3 border" style="max-height: 320px; object-fit: contain;">
                                <p class="small text-muted mt-2 mb-0">Use this official QR code to pay your total amount.
                                </p>
                            </div>
                        @else
                            <div class="alert alert-warning small" role="alert">
                                GCash QR is not available yet. Please contact admin before placing your order.
                            </div>
                        @endif

                        <form method="POST" action="{{ route('orders.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">GCash Reference Number</label>
                                <input type="text" name="reference_number" value="{{ old('reference_number') }}"
                                    class="form-control rounded-3 @error('reference_number') is-invalid @enderror"
                                    placeholder="e.g. 123456789012">
                                @error('reference_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Sender Name</label>
                                <input type="text" name="sender_name" value="{{ old('sender_name') }}"
                                    class="form-control rounded-3 @error('sender_name') is-invalid @enderror"
                                    placeholder="Name used in GCash">
                                @error('sender_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Sender GCash Number (Optional)</label>
                                <input type="text" name="sender_number" value="{{ old('sender_number') }}"
                                    class="form-control rounded-3 @error('sender_number') is-invalid @enderror"
                                    placeholder="09XXXXXXXXX">
                                @error('sender_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button class="btn btn-valena w-100 py-2 fw-bold" @disabled(!$gcashSetting?->qr_image_path)>
                                Place Order →
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
