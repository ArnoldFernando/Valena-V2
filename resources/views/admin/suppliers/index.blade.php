@extends('layouts.admin')
@section('title', 'Suppliers')
@section('nav_suppliers', 'active')
@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h4 style="font-weight: 700; margin: 0 0 0.25rem 0; color: #1f2937;">Suppliers</h4>
            <p style="color: #6b7280; font-size: 0.875rem; margin: 0;">Manage product suppliers</p>
        </div>
        <a href="{{ route('admin.suppliers.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg" style="margin-right: 0.5rem;"></i>Add Supplier
        </a>
    </div>

    <div class="card overflow-hidden">
        <div style="padding: 0; overflow-x: auto;">
            <table class="table" style="margin-bottom: 0;">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suppliers as $s)
                        <tr>
                            <td>
                                @if ($s->image)
                                    <img src="{{ asset('storage/images/' . $s->image) }}" width="45" height="45"
                                        style="border-radius: 8px; object-fit: cover;" alt="">
                                @else
                                    <span style="color: #9ca3af;">—</span>
                                @endif
                            </td>
                            <td style="font-weight: 500;">{{ $s->title }}</td>
                            <td style="font-size: 0.875rem; color: #6b7280;">{{ $s->email }}</td>
                            <td style="font-size: 0.875rem; color: #6b7280;">{{ $s->phone }}</td>
                            <td style="text-align: right;">
                                <a href="{{ route('admin.suppliers.edit', $s) }}" class="btn btn-ghost"
                                    style="font-size: 0.875rem; padding: 0.4rem 0.8rem;">Edit</a>
                                <form method="POST" action="{{ route('admin.suppliers.destroy', $s) }}"
                                    style="display: inline;" onsubmit="return confirm('Delete supplier?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-ghost"
                                        style="font-size: 0.875rem; padding: 0.4rem 0.8rem; color: #ef4444;">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: #9ca3af; padding: 2rem;">No suppliers yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top: 1rem; display: flex; justify-content: center;">
        {{ $suppliers->links('pagination::tailwind') }}
    </div>
@endsection
