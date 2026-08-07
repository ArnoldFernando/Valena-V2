@extends('layouts.admin')
@section('title', 'Products')
@section('nav_products', 'active')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Products</h5>
        <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-valena"><i class="bi bi-plus-lg me-1"></i>Add
            Product</a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Supplier</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Promo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $p)
                        <tr>
                            <td>
                                @if ($p->img)
                                    <img src="{{ asset('storage/images/' . $p->img) }}" width="50" height="50"
                                        class="rounded object-fit-cover" alt="">
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>{{ $p->title }}<br><small class="text-muted">{{ $p->slogan }}</small></td>
                            <td>{{ $p->supplier?->title ?? '—' }}</td>
                            <td>₱{{ number_format($p->price, 2) }}</td>
                            <td>{{ $p->stocks }}</td>
                            <td>{!! $p->promo_status === 'Yes'
                                ? '<span class="badge bg-warning text-dark">Yes</span>'
                                : '<span class="badge bg-light text-muted border">No</span>' !!}</td>
                            <td>
                                <a href="{{ route('admin.products.edit', $p) }}"
                                    class="btn btn-sm btn-outline-secondary me-1">Edit</a>
                                <form method="POST" action="{{ route('admin.products.destroy', $p) }}" class="d-inline"
                                    onsubmit="return confirm('Delete this product?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No products yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $products->links() }}</div>
@endsection
