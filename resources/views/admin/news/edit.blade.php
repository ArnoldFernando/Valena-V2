@extends('layouts.admin')
@section('title', 'Edit Article')
@section('nav_news', 'active')
@section('content')
    <div class="card shadow-sm" style="max-width:680px">
        <div class="card-body">
            <h6 class="fw-bold mb-4">Edit Article</h6>
            <form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data">
                @csrf @method('PUT')
                @include('admin.news._form', ['news' => $news])
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-valena">Update</button>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
