@extends('layouts.admin')
@section('title', 'Order #' . $order->order_id)
@section('nav_orders', 'active')
@section('content')
    <div class="row g-4" style="max-width:860px">
        <div class="col-md-7">
            <div class="v-card">
                <div class="card-body p-4">
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
            <div class="v-card mt-3">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">GCash Payment</h6>
                    @if ($order->gcashPayment)
                        <dl class="row mb-3">
                            <dt class="col-sm-5">Reference No.</dt>
                            <dd class="col-sm-7">{{ $order->gcashPayment->reference_number }}</dd>
                            <dt class="col-sm-5">Sender</dt>
                            <dd class="col-sm-7">{{ $order->gcashPayment->sender_name }}</dd>
                            <dt class="col-sm-5">Sender Number</dt>
                            <dd class="col-sm-7">{{ $order->gcashPayment->sender_number ?: '—' }}</dd>
                            <dt class="col-sm-5">Paid Amount</dt>
                            <dd class="col-sm-7">₱{{ number_format($order->gcashPayment->paid_amount, 2) }}</dd>
                            <dt class="col-sm-5">Verification</dt>
                            <dd class="col-sm-7">
                                @if ($order->gcashPayment->status === 'received')
                                    <span class="badge bg-success">Verified</span>
                                @elseif($order->gcashPayment->status === 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-secondary">Pending</span>
                                @endif
                            </dd>
                            <dt class="col-sm-5">Verified By</dt>
                            <dd class="col-sm-7">{{ $order->gcashPayment->receiver?->name ?? '—' }}</dd>
                            <dt class="col-sm-5">Verified At</dt>
                            <dd class="col-sm-7">{{ $order->gcashPayment->received_at?->format('M d, Y g:i A') ?? '—' }}
                            </dd>
                            <dt class="col-sm-5">Admin Note</dt>
                            <dd class="col-sm-7">{{ $order->gcashPayment->admin_note ?: '—' }}</dd>
                        </dl>

                        <form method="POST" action="{{ route('admin.orders.verify-payment', $order) }}">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Payment Decision</label>
                                <select name="status" class="form-select rounded-3 @error('status') is-invalid @enderror">
                                    <option value="received">Received</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-semibold">Admin Note (Optional)</label>
                                <textarea name="admin_note" rows="3" class="form-control rounded-3 @error('admin_note') is-invalid @enderror"
                                    placeholder="Internal note for this payment">{{ old('admin_note') }}</textarea>
                                @error('admin_note')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button class="btn btn-outline-primary w-100">Save Payment Decision</button>
                        </form>
                    @else
                        <p class="text-muted mb-0">No GCash payment information linked to this order.</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="v-card">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Update Status</h6>
                    <form method="POST" action="{{ route('admin.orders.update', $order) }}">
                        @csrf @method('PUT')
                        <div class="mb-3">
                            <select name="status" class="form-select rounded-3 @error('status') is-invalid @enderror">
                                @foreach (['pending', 'processing', 'shipped', 'closed'] as $status)
                                    <option value="{{ $status }}" @selected($order->status === $status)>
                                        {{ ucfirst($status) }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
