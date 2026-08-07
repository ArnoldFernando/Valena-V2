@extends('layouts.valena')
@section('title', 'Messages')
@section('content')
    <div class="container py-5" style="max-width:760px">
        <h2 class="fw-bold mb-4" style="color:var(--valena-brown)">Messages</h2>

        {{-- New message form --}}
        <div class="card shadow-sm mb-5">
            <div class="card-body">
                <h6 class="fw-semibold mb-3">Send a Message</h6>
                <form method="POST" action="{{ route('messages.store') }}">
                    @csrf
                    <div class="mb-3">
                        <textarea name="message" rows="4" class="form-control @error('message') is-invalid @enderror"
                            placeholder="Type your message here…">{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button class="btn btn-valena">Send</button>
                </form>
            </div>
        </div>

        {{-- Thread --}}
        @forelse($messages as $msg)
            <div class="card mb-3 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between mb-1">
                        <strong>You</strong>
                        <small class="text-muted">{{ $msg->message_date->format('M d, Y g:i A') }}</small>
                    </div>
                    <p class="mb-2">{{ $msg->message }}</p>
                    @if ($msg->reply_message)
                        <div class="bg-light rounded p-3 border-start border-3 border-warning mt-2">
                            <div class="d-flex justify-content-between mb-1">
                                <strong class="text-warning-emphasis">Admin Reply</strong>
                                <small class="text-muted">{{ $msg->reply_date?->format('M d, Y g:i A') }}</small>
                            </div>
                            <p class="mb-0">{{ $msg->reply_message }}</p>
                        </div>
                    @else
                        <p class="text-muted small mb-0 fst-italic">Awaiting reply…</p>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-muted">No messages yet.</p>
        @endforelse
    </div>
@endsection
