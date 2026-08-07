@extends('layouts.admin')
@section('title', 'Tourist Spots')
@section('nav_spots', 'active')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Tourist Spots</h5>
        <a href="{{ route('admin.tourist-spots.create') }}" class="btn btn-sm btn-valena"><i
                class="bi bi-plus-lg me-1"></i>Add</a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>Spot ID</th>
                        <th>Name</th>
                        <th>Short Description</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($spots as $s)
                        <tr>
                            <td>
                                @if ($s->image)
                                    <img src="{{ asset('storage/images/' . $s->image) }}" width="55" height="45"
                                        class="rounded object-fit-cover">
                                @else
                                    —
                                @endif
                            </td>
                            <td>{{ $s->ts_id }}</td>
                            <td>{{ $s->name }}</td>
                            <td>{{ Str::limit($s->intro_description, 60) }}</td>
                            <td>
                                <a href="{{ route('admin.tourist-spots.edit', $s) }}"
                                    class="btn btn-sm btn-outline-secondary me-1">Edit</a>
                                <form method="POST" action="{{ route('admin.tourist-spots.destroy', $s) }}"
                                    class="d-inline" onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No tourist spots yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $spots->links() }}</div>
@endsection
