@extends('layouts.admin')
@section('title', 'Message #' . $message->message_id)
@section('nav_messages', 'active')
@section('content')
    <div style="max-width:680px">
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between mb-1">
                    <strong>{{ $message->user?->name ?? 'Unknown' }}</strong>
                    <small class="text-muted">{{ $message->message_date->format('M d, Y g:i A') }}</small>
                </div>
                <p class="mb-0">{{ $message->message }}</p>
            </div>
        </div>

        @if ($message->reply_message)
            <div class="card border-primary shadow-sm mb-4">
                <div class="card-header text-primary bg-primary-subtle fw-semibold small">Your Reply —
                    {{ $message->reply_date?->format('M d, Y g:i A') }}</div>
                <div class="card-body">{{ $message->reply_message }}</div>
            </div>
        @endif

        <div class="v-card"><div class="card-body p-4">
                <h6 class="fw-bold mb-3">{{ $message->reply_message ? 'Update Reply' : 'Reply' }}</h6>
                <form method="POST" action="{{ route('admin.messages.update', $message) }}">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <textarea name="reply_message" rows="4" class="form-control @error('reply_message') is-invalid @enderror"
                            placeholder="Type your reply…">{{ old('reply_message', $message->reply_message) }}</textarea>
                        @error('reply_message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-valena px-4">Send Reply</button>
                        <a href="{{ route('admin.messages.index') }}" class="btn btn-outline-secondary px-4 rounded-3">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
