@extends('layouts.admin')
@section('title', 'Suppliers')
@section('nav_suppliers', 'active')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="fw-bold mb-0">Suppliers</h5>
            <p class="text-muted small mb-0">Manage product suppliers</p>
        </div>
        <a href="{{ route('admin.suppliers.create') }}" class="btn btn-valena"><i class="bi bi-plus-lg me-1"></i>Add
            Supplier</a>
    </div>
    <div class="v-card overflow-hidden">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $s)
                        <tr>
                            <td>
                                @if ($s->image)
                                    <img src="{{ asset('storage/images/' . $s->image) }}" width="45" height="45"
                                        class="rounded object-fit-cover" alt="">
                                @else
                                    —
                                @endif
                            </td>
                            <td>{{ $s->title }}</td>
                            <td>{{ $s->email }}</td>
                            <td>{{ $s->phone }}</td>
                            <td>
                                <a href="{{ route('admin.suppliers.edit', $s) }}"
                                    class="btn btn-sm btn-outline-secondary rounded-3 me-1">Edit</a>
                                <form method="POST" action="{{ route('admin.suppliers.destroy', $s) }}" class="d-inline"
                                    onsubmit="return confirm('Delete supplier?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-3">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No suppliers yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $suppliers->links() }}</div>
@endsection
