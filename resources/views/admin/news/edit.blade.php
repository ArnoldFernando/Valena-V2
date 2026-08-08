@extends('layouts.admin')
@section('title', 'Edit Article')
@section('nav_news', 'active')
@section('content')
    <div style="max-width: 800px; margin: 0 auto;">
        <div style="margin-bottom: 2.5rem;">
            <h3 style="font-weight: 700; margin: 0 0 0.5rem 0; color: #1f2937; font-size: 1.5rem;">Edit Article</h3>
            <p style="color: #6b7280; font-size: 0.9rem; margin: 0;">Update article content</p>
        </div>
        
        <div class="card">
            <form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                <div style="padding: 2rem;">
                    @include('admin.news._form', ['news' => $news])
                </div>
                <div style="padding: 2rem; border-top: 1px solid #e5e7eb; display: flex; gap: 1rem; justify-content: flex-end;">
                    <a href="{{ route('admin.news.index') }}" class="btn btn-ghost">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Article</button>
                </div>
            </form>
        </div>
    </div>
@endsection
