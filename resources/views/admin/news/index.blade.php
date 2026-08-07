@extends('layouts.admin')
@section('title', 'News')
@section('nav_news', 'active')
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">News &amp; Updates</h5>
        <a href="{{ route('admin.news.create') }}" class="btn btn-sm btn-valena"><i class="bi bi-plus-lg me-1"></i>Post
            News</a>
    </div>
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Intro</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($news as $n)
                        <tr>
                            <td>
                                @if ($n->image)
                                    <img src="{{ asset('storage/images/' . $n->image) }}" width="55" height="45"
                                        class="rounded object-fit-cover">
                                @else
                                    —
                                @endif
                            </td>
                            <td class="text-nowrap">{{ $n->date->format('M d, Y') }}</td>
                            <td>{{ $n->name }}</td>
                            <td>{{ Str::limit($n->intro_description, 60) }}</td>
                            <td>
                                <a href="{{ route('admin.news.edit', $n) }}"
                                    class="btn btn-sm btn-outline-secondary me-1">Edit</a>
                                <form method="POST" action="{{ route('admin.news.destroy', $n) }}" class="d-inline"
                                    onsubmit="return confirm('Delete article?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">No articles yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $news->links() }}</div>
@endsection
