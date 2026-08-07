@extends('layouts.valena')
@section('title', 'My Orders')
@section('content')<div
        style="background:linear-gradient(135deg,var(--valena-dark) 0%,var(--valena-brown) 100%);padding:3.5rem 0 2rem">
        <div class="container text-white">
            <span class="section-eyebrow d-block mb-2">Account</span>
            <h1 class="mb-0" style="font-family:'Playfair Display',serif;font-size:2.4rem">My Orders</h1>
        </div>
    </div>
    <div class="container py-5">
        <h2 class="fw-bold mb-4" style="color:var(--valena-brown)">My Orders</h2>
        @if ($orders->isEmpty())
            <p class="text-muted">No orders yet. <a href="{{ route('products.index') }}">Start shopping</a>.</p>
        @else
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Proof</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->order_id }}</td>
                                    <td>{{ $order->title }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>₱{{ number_format($order->price, 2) }}</td>
                                    <td>₱{{ number_format($order->trans_total, 2) }}</td>
                                    <td>
                                        @if ($order->status === 'closed')
                                            <span class="badge bg-success">Completed</span>
                                        @elseif($order->status)
                                            <span class="badge bg-warning text-dark">{{ $order->status }}</span>
                                        @else
                                            <span class="badge bg-secondary">Pending</span>
                                        @endif
                                    </td>
                                    <td>{{ $order->date->format('M d, Y') }}</td>
                                    <td>
                                        @if ($order->proof_file)
                                            <a href="{{ asset('storage/proofs/' . $order->proof_file) }}" target="_blank"
                                                class="btn btn-sm btn-outline-secondary"><i class="bi bi-image"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection
