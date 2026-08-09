@extends('layouts.admin')
@section('title', 'Order #' . $order->order_id)
@section('nav_orders', 'active')
@section('content')
    <div style="max-width: 1000px; margin: 0 auto;">
        <div style="margin-bottom: 2.5rem; display: flex; justify-content: space-between; align-items: flex-start;">
            <div>
                <h3 style="font-weight: 700; margin: 0 0 0.5rem 0; color: #1f2937; font-size: 1.5rem;">Order
                    #{{ $order->order_id }}</h3>
                <p style="color: #6b7280; font-size: 0.9rem; margin: 0;">{{ $order->date->format('M d, Y g:i A') }}</p>
            </div>
            <div>
                @if ($order->status === 'closed')
                    <span class="badge badge-success">Completed</span>
                @elseif($order->status === 'shipped')
                    <span class="badge badge-warning">Shipped</span>
                @else
                    <span class="badge" style="background: #dbeafe; color: #2563eb;">{{ ucfirst($order->status) }}</span>
                @endif
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 350px; gap: 2rem;">
            <!-- Main Content -->
            <div>
                <!-- Order Details -->
                <div class="card" style="margin-bottom: 2rem;">
                    <div class="card-header"
                        style="display: flex; align-items: center; gap: 0.75rem; font-size: 1rem; font-weight: 700; color: #1f2937;">
                        <i class="bi bi-receipt" style="color: var(--v-brown);"></i>Order Details
                    </div>
                    <div style="padding: 2rem;">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                            <!-- Left Column -->
                            <div>
                                <div style="margin-bottom: 1.5rem;">
                                    <p
                                        style="margin: 0 0 0.5rem 0; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #9ca3af; letter-spacing: 0.05em;">
                                        Customer</p>
                                    <p style="margin: 0 0 0.25rem 0; font-weight: 600; color: #1f2937;">
                                        {{ $order->user?->name ?? 'Unknown' }}</p>
                                    <p style="margin: 0; font-size: 0.875rem; color: #6b7280;">
                                        {{ $order->user?->email ?? '—' }}</p>
                                </div>
                                <div>
                                    <p
                                        style="margin: 0 0 0.5rem 0; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #9ca3af; letter-spacing: 0.05em;">
                                        Product</p>
                                    <p style="margin: 0; font-weight: 600; color: #1f2937;">{{ $order->title }}</p>
                                </div>
                            </div>
                            <!-- Right Column -->
                            <div>
                                <div style="margin-bottom: 1.5rem;">
                                    <p
                                        style="margin: 0 0 0.5rem 0; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #9ca3af; letter-spacing: 0.05em;">
                                        Quantity</p>
                                    <p style="margin: 0; font-weight: 600; color: #1f2937;">{{ $order->quantity }}
                                        {{ $order->quantity > 1 ? 'units' : 'unit' }}</p>
                                </div>
                                <div>
                                    <p
                                        style="margin: 0 0 0.5rem 0; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #9ca3af; letter-spacing: 0.05em;">
                                        Unit Price</p>
                                    <p style="margin: 0; font-weight: 600; color: #1f2937;">
                                        ₱{{ number_format($order->price, 2) }}</p>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 2px solid #e5e7eb;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <p style="margin: 0; font-size: 0.875rem; color: #6b7280;">Total Amount</p>
                                <p style="margin: 0; font-size: 1.5rem; font-weight: 700; color: var(--v-brown);">
                                    ₱{{ number_format($order->trans_total, 2) }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- GCash Payment -->
                @if ($order->gcashPayment)
                    <div class="card">
                        <div class="card-header"
                            style="display: flex; align-items: center; gap: 0.75rem; font-size: 1rem; font-weight: 700; color: #1f2937;">
                            <i class="bi bi-qr-code" style="color: var(--v-brown);"></i>GCash Payment
                        </div>
                        <div style="padding: 2rem;">
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
                                <div>
                                    <p
                                        style="margin: 0 0 0.5rem 0; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #9ca3af; letter-spacing: 0.05em;">
                                        Reference No.</p>
                                    <p
                                        style="margin: 0; font-weight: 600; color: #1f2937; font-family: 'Courier New', monospace;">
                                        {{ $order->gcashPayment->reference_number }}</p>
                                </div>
                                <div>
                                    <p
                                        style="margin: 0 0 0.5rem 0; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #9ca3af; letter-spacing: 0.05em;">
                                        Paid Amount</p>
                                    <p style="margin: 0; font-weight: 600; color: var(--v-brown); font-size: 1.1rem;">
                                        ₱{{ number_format($order->gcashPayment->paid_amount, 2) }}</p>
                                </div>
                                <div>
                                    <p
                                        style="margin: 0 0 0.5rem 0; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #9ca3af; letter-spacing: 0.05em;">
                                        Sender Name</p>
                                    <p style="margin: 0; font-weight: 600; color: #1f2937;">
                                        {{ $order->gcashPayment->sender_name }}</p>
                                </div>
                                <div>
                                    <p
                                        style="margin: 0 0 0.5rem 0; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #9ca3af; letter-spacing: 0.05em;">
                                        Sender Number</p>
                                    <p style="margin: 0; font-weight: 600; color: #1f2937;">
                                        {{ $order->gcashPayment->sender_number ?: '—' }}</p>
                                </div>
                            </div>

                            <div
                                style="margin-bottom: 2rem; padding: 1.5rem; background: #f9fafb; border-radius: 8px; border-left: 4px solid var(--v-brown);">
                                <p
                                    style="margin: 0 0 0.5rem 0; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #9ca3af; letter-spacing: 0.05em;">
                                    Verification Status</p>
                                <div style="display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        @if ($order->gcashPayment->status === 'received')
                                            <span class="badge badge-success">✓ Verified</span>
                                        @elseif($order->gcashPayment->status === 'rejected')
                                            <span class="badge badge-danger">✗ Rejected</span>
                                        @else
                                            <span class="badge" style="background: #fef3c7; color: #92400e;">Pending
                                                Review</span>
                                        @endif
                                    </div>
                                    <div style="text-align: right;">
                                        <p style="margin: 0 0 0.25rem 0; font-size: 0.75rem; color: #9ca3af;">Verified by
                                        </p>
                                        <p style="margin: 0; font-size: 0.875rem; font-weight: 600; color: #1f2937;">
                                            {{ $order->gcashPayment->receiver?->name ?? '—' }}</p>
                                    </div>
                                </div>
                            </div>

                            @if ($order->gcashPayment->admin_note)
                                <div style="padding: 1.5rem; background: #f3f4f6; border-radius: 8px; margin-bottom: 2rem;">
                                    <p
                                        style="margin: 0 0 0.75rem 0; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #9ca3af; letter-spacing: 0.05em;">
                                        Admin Note</p>
                                    <p style="margin: 0; color: #374151; font-size: 0.875rem;">
                                        {{ $order->gcashPayment->admin_note }}</p>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('admin.orders.verify-payment', $order) }}">
                                @csrf @method('PATCH')
                                <div style="margin-bottom: 1.5rem;">
                                    <label
                                        style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.5rem;">Payment
                                        Decision</label>
                                    <select name="status"
                                        style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s; background-color: #fff;"
                                        onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';"
                                        onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                                        <option value="received">✓ Approve Payment</option>
                                        <option value="rejected">✗ Reject Payment</option>
                                    </select>
                                    @error('status')
                                        <div style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                                <div style="margin-bottom: 1.5rem;">
                                    <label
                                        style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.5rem;">Admin
                                        Note (Optional)</label>
                                    <textarea name="admin_note" rows="3"
                                        style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s; resize: vertical;"
                                        placeholder="Internal note for this payment"
                                        onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';"
                                        onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">{{ old('admin_note') }}</textarea>
                                    @error('admin_note')
                                        <div style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary" style="width: 100%;">Save Payment
                                    Decision</button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Status Card -->
                <div class="card" style="margin-bottom: 2rem;">
                    <div class="card-header" style="font-size: 1rem; font-weight: 700; color: #1f2937;">Update Status</div>
                    <form method="POST" action="{{ route('admin.orders.update', $order) }}">
                        @csrf @method('PUT')
                        <div style="padding: 2rem;">
                            <select name="status"
                                style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s; background-color: #fff; margin-bottom: 1rem;"
                                onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';"
                                onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                                @foreach (['pending' => 'Pending', 'processing' => 'Processing', 'shipped' => 'Shipped', 'closed' => 'Closed'] as $value => $label)
                                    <option value="{{ $value }}" @selected($order->status === $value)>{{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div style="color: #dc2626; font-size: 0.875rem; margin-bottom: 1rem;">{{ $message }}
                                </div>
                            @enderror
                            <button type="submit" class="btn btn-primary" style="width: 100%;">Update Status</button>
                        </div>
                    </form>
                </div>

                <!-- Timeline -->
                <div class="card">
                    <div class="card-header" style="font-size: 1rem; font-weight: 700; color: #1f2937;">Order Info</div>
                    <div style="padding: 2rem;">
                        <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
                            <div
                                style="width: 8px; height: 8px; border-radius: 50%; background: var(--v-brown); margin-top: 0.5rem; flex-shrink: 0;">
                            </div>
                            <div>
                                <p
                                    style="margin: 0 0 0.25rem 0; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #9ca3af;">
                                    Ordered</p>
                                <p style="margin: 0; font-size: 0.875rem; color: #374151;">
                                    {{ $order->date->format('M d, Y') }}</p>
                            </div>
                        </div>
                        @if ($order->gcashPayment?->received_at)
                            <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
                                <div
                                    style="width: 8px; height: 8px; border-radius: 50%; background: #10b981; margin-top: 0.5rem; flex-shrink: 0;">
                                </div>
                                <div>
                                    <p
                                        style="margin: 0 0 0.25rem 0; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; color: #9ca3af;">
                                        Payment Verified</p>
                                    <p style="margin: 0; font-size: 0.875rem; color: #374151;">
                                        {{ $order->gcashPayment->received_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <a href="{{ route('admin.orders.index') }}" class="btn btn-ghost"
                    style="width: 100%; margin-top: 2rem; text-align: center;"><i class="bi bi-arrow-left"
                        style="margin-right: 0.5rem;"></i>Back to Orders</a>
            </div>
        </div>
    </div>
@endsection
