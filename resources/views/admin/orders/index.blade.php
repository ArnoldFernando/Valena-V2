@extends('layouts.admin')
@section('title', 'Orders')
@section('nav_orders', 'active')
@section('content')
    <div style="margin-bottom: 2.5rem;">
        <h3 style="font-weight: 700; margin: 0 0 0.5rem 0; color: #1f2937; font-size: 1.5rem;">All Orders</h3>
        <p style="color: #6b7280; font-size: 0.9rem; margin: 0;">View and update customer order statuses</p>
    </div>

    <div class="card overflow-hidden">
        <div style="padding: 0; overflow-x: auto;">
            <table class="table" style="margin-bottom: 0;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>GCash Ref</th>
                        <th>Payment</th>
                        <th>Qty</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $o)
                        <tr>
                            <td style="font-weight: 500;">{{ $o->order_id }}</td>
                            <td>{{ $o->user?->name ?? '—' }}</td>
                            <td>{{ $o->title }}</td>
                            <td style="font-size: 0.875rem; color: #6b7280;">{{ $o->gcashPayment?->reference_number ?? '—' }}
                            </td>
                            <td>
                                @if ($o->gcashPayment?->status === 'received')
                                    <span class="badge badge-success">Verified</span>
                                @elseif($o->gcashPayment?->status === 'rejected')
                                    <span class="badge badge-danger">Rejected</span>
                                @else
                                    <span class="badge" style="background: #e5e7eb; color: #6b7280;">Pending</span>
                                @endif
                            </td>
                            <td>{{ $o->quantity }}</td>
                            <td style="font-weight: 500;">₱{{ number_format($o->trans_total, 2) }}</td>
                            <td>
                                @if ($o->status === 'closed')
                                    <span class="badge badge-success">Completed</span>
                                @elseif($o->status)
                                    <span class="badge badge-warning">{{ $o->status }}</span>
                                @else
                                    <span class="badge" style="background: #e5e7eb; color: #6b7280;">Pending</span>
                                @endif
                            </td>
                            <td style="font-size: 0.875rem; color: #6b7280; white-space: nowrap;">
                                {{ $o->date->format('M d, Y') }}</td>
                            <td style="text-align: right;">
                                <a href="{{ route('admin.orders.show', $o) }}" class="btn btn-ghost"
                                    style="font-size: 0.875rem; padding: 0.4rem 0.8rem;">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" style="text-align: center; color: #9ca3af; padding: 2rem;">No orders yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top: 1rem; display: flex; justify-content: center;">
        {{ $orders->links('pagination::tailwind') }}
    </div>
@endsection
