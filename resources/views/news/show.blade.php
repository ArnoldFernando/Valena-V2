@extends('layouts.valena')
@section('title', $news->name)
@section('content')
    <div class="container py-5" style="max-width:800px">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('news.index') }}">News</a></li>
                <li class="breadcrumb-item active">{{ $news->name }}</li>
            </ol>
        </nav>
        @if ($news->image)
            <img src="{{ asset('storage/images/' . $news->image) }}" class="img-fluid rounded mb-4 w-100 object-fit-cover"
                style="max-height:400px" alt="{{ $news->name }}">
        @endif
        <p class="text-muted small">{{ $news->date->format('F d, Y') }}</p>
        <h1 class="fw-bold mb-3" style="color:var(--valena-brown)">{{ $news->name }}</h1>
        <p class="lead">{{ $news->intro_description }}</p>
        <hr>
        <div>{!! nl2br(e($news->full_description)) !!}</div>
        <a href="{{ route('news.index') }}" class="btn btn-outline-secondary mt-4"><i class="bi bi-arrow-left me-1"></i>Back
            to News</a>
    </div>
@endsection
