@extends('layouts.admin')
@section('title', 'Tourist Spots')
@section('nav_spots', 'active')
@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h4 style="font-weight: 700; margin: 0; color: #1f2937;">Tourist Spots</h4>
        <a href="{{ route('admin.tourist-spots.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg" style="margin-right: 0.5rem;"></i>Add
        </a>
    </div>

    <div class="card overflow-hidden">
        <div style="padding: 0; overflow-x: auto;">
            <table class="table" style="margin-bottom: 0;">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Spot ID</th>
                        <th>Name</th>
                        <th>Short Description</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($spots as $s)
                        <tr>
                            <td>
                                @if ($s->image)
                                    <img src="{{ asset('storage/images/' . $s->image) }}" width="55" height="45"
                                        style="border-radius: 8px; object-fit: cover;">
                                @else
                                    <span style="color: #9ca3af;">—</span>
                                @endif
                            </td>
                            <td style="font-weight: 500;">{{ $s->ts_id }}</td>
                            <td>{{ $s->name }}</td>
                            <td style="font-size: 0.875rem; color: #6b7280;">{{ Str::limit($s->intro_description, 60) }}
                            </td>
                            <td style="text-align: right;">
                                <a href="{{ route('admin.tourist-spots.edit', $s) }}" class="btn btn-ghost"
                                    style="font-size: 0.875rem; padding: 0.4rem 0.8rem;">Edit</a>
                                <form method="POST" action="{{ route('admin.tourist-spots.destroy', $s) }}"
                                    style="display: inline;" onsubmit="return confirm('Delete?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-ghost"
                                        style="font-size: 0.875rem; padding: 0.4rem 0.8rem; color: #ef4444;">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; color: #9ca3af; padding: 2rem;">No tourist spots
                                yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top: 1rem; display: flex; justify-content: center;">
        {{ $spots->links('pagination::tailwind') }}
    </div>
@endsection
