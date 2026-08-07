@extends('layouts.valena')
@section('title', 'My Cart')
@section('content')
    <div class="container py-5">
        <h2 class="fw-bold mb-4" style="color:var(--valena-brown)">Shopping Cart</h2>

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
                                                        min="1" class="form-control form-control-sm"
                                                        style="width:65px">
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
@endsection
