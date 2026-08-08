@extends('layouts.admin')
@section('title', 'Products')
@section('nav_products', 'active')
@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;">
        <div>
            <h3 style="font-weight: 700; margin: 0 0 0.5rem 0; color: #1f2937; font-size: 1.5rem;">Products</h3>
            <p style="color: #6b7280; font-size: 0.9rem; margin: 0;">Manage your coffee product catalogue</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i>Add Product
        </a>
    </div>

    <div class="card overflow-hidden">
        <div style="padding: 0; overflow-x: auto;">
            <table class="table" style="margin-bottom: 0;">
                <thead>
                    <tr>
                        <th style="width: 80px;">Image</th>
                        <th>Product Name</th>
                        <th>Supplier</th>
                        <th style="width: 120px;">Price</th>
                        <th style="width: 80px;">Stock</th>
                        <th style="width: 100px;">Promo</th>
                        <th style="width: 180px; text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $p)
                        <tr>
                            <td>
                                @if ($p->img)
                                    <img src="{{ asset('storage/images/' . $p->img) }}" width="60" height="60"
                                        style="border-radius: 10px; object-fit: cover;" alt="">
                                @else
                                    <div
                                        style="width: 60px; height: 60px; border-radius: 10px; background: #f3f4f6; display: flex; align-items: center; justify-content: center; color: #9ca3af;">
                                        <i class="bi bi-image" style="font-size: 1.5rem;"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div style="font-weight: 600; color: #1f2937; font-size: 0.95rem;">{{ $p->title }}</div>
                                <div style="font-size: 0.8rem; color: #9ca3af; margin-top: 0.25rem;">{{ $p->slogan }}
                                </div>
                            </td>
                            <td style="color: #6b7280;">{{ $p->supplier?->title ?? '—' }}</td>
                            <td style="font-weight: 700; color: var(--v-brown); font-size: 0.95rem;">
                                ₱{{ number_format($p->price, 2) }}</td>
                            <td style="font-weight: 600; color: #1f2937;">{{ $p->stocks }}</td>
                            <td>
                                @if ($p->promo_status === 'Yes')
                                    <span class="badge badge-warning">Active</span>
                                @else
                                    <span class="badge" style="background: #f3f4f6; color: #6b7280;">—</span>
                                @endif
                            </td>
                            <td style="text-align: right;">
                                <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-ghost btn-sm">Edit</a>
                                <form method="POST" action="{{ route('admin.products.destroy', $p) }}"
                                    style="display: inline;" onsubmit="return confirm('Delete this product?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-ghost btn-sm"
                                        style="color: #ef4444;">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; color: #9ca3af; padding: 3rem 1rem;">
                                <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 0.75rem;"></i>
                                No products found. <a href="{{ route('admin.products.create') }}"
                                    style="color: var(--v-brown); font-weight: 600; text-decoration: none;">Create one</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top: 2rem; display: flex; justify-content: center;">
        {{ $products->links('pagination::tailwind') }}
    </div>
@endsection
