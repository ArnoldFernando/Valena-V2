@extends('layouts.admin')
@section('title', 'Facilities')
@section('nav_facilities', 'active')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Facilities</h5>
        <a href="{{ route('admin.facilities.create') }}" class="btn btn-valena"><i class="bi bi-plus-lg me-1"></i>Add
            Image</a>
    </div>
    <div class="v-card overflow-hidden"><div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>Facility ID</th>
                        <th>Name</th>
                        <th>Short Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($facilities as $f)
                        <tr>
                            <td>
                                @if ($f->image)
                                    <img src="{{ asset('storage/images/' . $f->image) }}" width="55" height="45"
                                        class="rounded object-fit-cover">
                                @else
                                    —
                                @endif
                            </td>
                            <td>{{ $f->fac_id }}</td>
                            <td>{{ $f->name }}</td>
                            <td>{{ Str::limit($f->intro_description, 60) }}</td>
                            <td>
                                <a href="{{ route('admin.facilities.edit', $f) }}"
                                    class="btn btn-sm btn-outline-secondary rounded-3 me-1">Edit</a>
                                <form method="POST" action="{{ route('admin.facilities.destroy', $f) }}" class="d-inline"
                                    onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger rounded-3">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No facilities yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $facilities->links() }}</div>
@endsection
