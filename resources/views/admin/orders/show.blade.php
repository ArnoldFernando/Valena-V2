@extends('layouts.admin')
@section('title', 'Order #' . $order->order_id)
@section('nav_orders', 'active')
@section('content')
    <div class="row g-4" style="max-width:860px">
        <div class="col-md-7">
            <div class="v-card"><div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Order Details</h6>
                    <dl class="row mb-0">
                        <dt class="col-sm-4">Order #</dt>
                        <dd class="col-sm-8">{{ $order->order_id }}</dd>
                        <dt class="col-sm-4">Customer</dt>
                        <dd class="col-sm-8">{{ $order->user?->name }} ({{ $order->user?->email }})</dd>
                        <dt class="col-sm-4">Product</dt>
                        <dd class="col-sm-8">{{ $order->title }}</dd>
                        <dt class="col-sm-4">Quantity</dt>
                        <dd class="col-sm-8">{{ $order->quantity }}</dd>
                        <dt class="col-sm-4">Price</dt>
                        <dd class="col-sm-8">₱{{ number_format($order->price, 2) }}</dd>
                        <dt class="col-sm-4">Total</dt>
                        <dd class="col-sm-8 fw-bold">₱{{ number_format($order->trans_total, 2) }}</dd>
                        <dt class="col-sm-4">Date</dt>
                        <dd class="col-sm-8">{{ $order->date->format('M d, Y g:i A') }}</dd>
                    </dl>
                </div>
            </div>
            @if ($order->proof_file)
                <div class="card shadow-sm mt-3">
                    <div class="card-body">
                        <h6 class="fw-bold mb-2">Proof of Payment</h6>
                        <img src="{{ asset('storage/proofs/' . $order->proof_file) }}" class="img-fluid rounded"
                            style="max-height:280px" alt="Proof">
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-5">
            <div class="v-card"><div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Update Status</h6>
                    <form method="POST" action="{{ route('admin.orders.update', $order) }}">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <select name="status" class="form-select rounded-3">
                                @foreach (['pending', 'processing', 'shipped', 'closed'] as $status)
                                    <option value="{{ $status }}" @selected($order->status === $status)>
                                        {{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-valena w-100">Save Status</button>
                    </form>
                </div>
            </div>
            <div class="mt-3">
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary w-100"><i
                        class="bi bi-arrow-left me-1"></i>Back to Orders</a>
            </div>
        </div>
    </div>
@endsection
