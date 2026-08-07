@extends('layouts.admin')
@section('title', 'Post News')
@section('nav_news', 'active')
@section('content')
    <div class="v-card p-4" style="max-width:680px">
        <div class="card-body">
            <h6 class="fw-bold mb-4">New Article</h6>
            <form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
                @csrf
                @include('admin.news._form', ['news' => null])
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-valena px-4">Publish</button>
                    <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary px-4 rounded-3">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
