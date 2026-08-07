@extends('layouts.valena')
@section('title', 'News')
@section('nav_news', 'active')
@section('content')
    <div style="background:linear-gradient(135deg,var(--valena-dark) 0%,var(--valena-brown) 100%);padding:3.5rem 0 2rem">
        <div class="container text-white">
            <span class="section-eyebrow d-block mb-2">Updates</span>
            <h1 class="mb-0" style="font-family:'Playfair Display',serif;font-size:2.4rem">News &amp; Articles</h1>
        </div>
    </div>
    <div class="container py-5">
        @forelse($news as $article)
            <div class="card mb-4 border-0 rounded-4 shadow-sm">
                <div class="row g-0">
                    @if ($article->image)
                        <div class="col-md-3">
                            <img src="{{ asset('storage/images/' . $article->image) }}"
                                class="img-fluid rounded-start h-100 object-fit-cover" style="max-height:180px"
                                alt="{{ $article->name }}">
                        </div>
                    @endif
                    <div class="col">
                        <div class="card-body">
                            <p class="text-muted small mb-1">{{ $article->date->format('F d, Y') }}</p>
                            <h5 class="card-title">{{ $article->name }}</h5>
                            <p class="card-text">{{ $article->intro_description }}</p>
                            <a href="{{ route('news.show', $article) }}" class="btn btn-sm btn-valena">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No news articles yet.</p>
        @endforelse
        <div class="mt-3">{{ $news->links() }}</div>
    </div>
@endsection
