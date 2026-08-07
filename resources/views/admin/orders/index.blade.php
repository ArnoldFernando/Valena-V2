@extends('layouts.admin')
@section('title', 'Orders')
@section('nav_orders', 'active')
@section('content')
    <div class="mb-4">
        <h5 class="fw-bold mb-0">All Orders</h5>
        <p class="text-muted small mb-0">View and update customer order statuses</p>
    </div>
    <div class="v-card overflow-hidden">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
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
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $o)
                        <tr>
                            <td>{{ $o->order_id }}</td>
                            <td>{{ $o->user?->name ?? '—' }}</td>
                            <td>{{ $o->title }}</td>
                            <td>{{ $o->gcashPayment?->reference_number ?? '—' }}</td>
                            <td>
                                @if ($o->gcashPayment?->status === 'received')
                                    <span class="badge bg-success">Verified</span>
                                @elseif($o->gcashPayment?->status === 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-secondary">Pending</span>
                                @endif
                            </td>
                            <td>{{ $o->quantity }}</td>
                            <td>₱{{ number_format($o->trans_total, 2) }}</td>
                            <td>
                                @if ($o->status === 'closed')
                                    <span class="badge bg-success">Completed</span>
                                @elseif($o->status)
                                    <span class="badge bg-warning text-dark">{{ $o->status }}</span>
                                @else
                                    <span class="badge bg-secondary">Pending</span>
                                @endif
                            </td>
                            <td class="text-nowrap">{{ $o->date->format('M d, Y') }}</td>
                            <td><a href="{{ route('admin.orders.show', $o) }}"
                                    class="btn btn-sm btn-outline-secondary">View</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">No orders yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $orders->links() }}</div>
@endsection
