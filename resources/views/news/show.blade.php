@extends('layouts.valena')
@section('title', $news->name)
@section('nav_news', 'active')
@section('content')

    @if ($news->image)
        <div class="w-100 overflow-hidden" style="max-height:440px">
            <img src="{{ asset('storage/images/' . $news->image) }}" class="w-100 object-fit-cover" style="max-height:440px"
                alt="{{ $news->name }}">
        </div>
    @endif

    <div class="container py-5" style="max-width:780px">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb" style="--bs-breadcrumb-divider-color:#9ca3af">
                <li class="breadcrumb-item"><a href="{{ route('news.index') }}" class="text-decoration-none"
                        style="color:var(--valena-brown)">News</a></li>
                <li class="breadcrumb-item active text-muted">{{ Str::limit($news->name, 50) }}</li>
            </ol>
        </nav>

        <span class="fw-semibold small" style="color:var(--valena-gold)">
            <i class="bi bi-calendar3 me-1"></i>{{ $news->date->format('F d, Y') }}
        </span>

        <h1 class="mt-2 mb-4 fw-bold lh-sm"
            style="font-family:'Playfair Display',serif;font-size:clamp(1.7rem,4vw,2.4rem);color:var(--valena-dark)">
            {{ $news->name }}
        </h1>

        <p class="lead mb-4" style="color:#4b5563">{{ $news->intro_description }}</p>

        <hr style="border-color:#e5e7eb;margin:2rem 0">

        <div class="fs-6 lh-lg" style="color:#374151">{!! nl2br(e($news->full_description)) !!}</div>

        <div class="mt-5">
            <a href="{{ route('news.index') }}" class="btn btn-valena-outline px-4">
                <i class="bi bi-arrow-left me-2"></i>Back to News
            </a>
        </div>
    </div>
@endsection
