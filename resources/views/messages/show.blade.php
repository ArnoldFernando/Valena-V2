@extends('layouts.valena')
@section('title', 'Conversation')
@section('content')
    <div style="background:linear-gradient(135deg,var(--valena-dark) 0%,var(--valena-brown) 100%);padding:3.5rem 0 2rem">
        <div class="container text-white">
            <span class="section-eyebrow d-block mb-2">Support</span>
            <h1 class="mb-0" style="font-family:'Playfair Display',serif;font-size:2.4rem">Conversation</h1>
        </div>
    </div>

    <div class="container py-5" style="max-width:900px">
        <div style="margin-bottom: 2rem;">
            <a href="{{ route('messages.index') }}"
                style="text-decoration: none; color: var(--v-brown); font-weight: 600; display: inline-flex; align-items: center; gap: 0.5rem;">
                <i class="bi bi-arrow-left"></i>Back to Messages
            </a>
        </div>

        <!-- Chat Container -->
        <div class="card" style="margin-bottom: 2rem; overflow: hidden;">
            <div
                style="padding: 2rem; background: #f9fafb; height: 500px; overflow-y: auto; display: flex; flex-direction: column; gap: 1.5rem;">
                @forelse ($conversation->messages as $message)
                    @if ($message->sender_id === auth()->id())
                        <!-- User Message (Right) -->
                        <div style="display: flex; justify-content: flex-end;">
                            <div style="max-width: 70%;">
                                <div
                                    style="display: flex; align-items: flex-end; gap: 0.75rem; flex-direction: row-reverse;">
                                    <div
                                        style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 600; font-size: 0.875rem; flex-shrink: 0;">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div
                                            style="background: #e0e7ff; border-radius: 12px; padding: 1rem; margin-bottom: 0.5rem; word-wrap: break-word;">
                                            <p style="margin: 0; color: #1e293b; font-size: 0.925rem; line-height: 1.5;">
                                                {{ $message->body }}</p>
                                        </div>
                                        <p style="margin: 0; font-size: 0.75rem; color: #9ca3af; text-align: right;">
                                            {{ $message->created_at->format('M d, Y g:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Admin Message (Left) -->
                        <div style="display: flex; justify-content: flex-start;">
                            <div style="max-width: 70%;">
                                <div style="display: flex; align-items: flex-end; gap: 0.75rem;">
                                    <div
                                        style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #5c2d0e 0%, #7a3d14 100%); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 600; font-size: 0.875rem; flex-shrink: 0;">
                                        A
                                    </div>
                                    <div>
                                        <div
                                            style="background: linear-gradient(135deg, #fef3c7 0%, #fde047 100%); border-radius: 12px; padding: 1rem; margin-bottom: 0.5rem; word-wrap: break-word;">
                                            <p style="margin: 0; color: #374151; font-size: 0.925rem; line-height: 1.5;">
                                                {{ $message->body }}</p>
                                        </div>
                                        <p style="margin: 0; font-size: 0.75rem; color: #9ca3af;">
                                            {{ $message->created_at->format('M d, Y g:i A') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <div style="text-align: center; padding: 3rem; color: #9ca3af;">
                        <p>No messages in this conversation yet.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Reply Form -->
        <div class="card">
            <div class="card-header" style="font-size: 1rem; font-weight: 700; color: #1f2937; padding: 2rem;">
                <i class="bi bi-chat-left-quote" style="color: var(--v-brown); margin-right: 0.75rem;"></i>Send a Reply
            </div>
            <form method="POST" action="{{ route('messages.reply', $conversation) }}">
                @csrf
                <div style="padding: 2rem;">
                    <textarea name="body" rows="4"
                        style="width: 100%; padding: 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s; resize: vertical;"
                        placeholder="Type your message here…"
                        onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';
                        nextElementSibling.style.display='block';"
                        onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">{{ old('body') }}</textarea>
                    @error('body')
                        <div style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
                    @enderror
                </div>
                <div
                    style="padding: 2rem; border-top: 1px solid #e5e7eb; display: flex; gap: 1rem; justify-content: flex-end;">
                    <a href="{{ route('messages.index') }}" class="btn btn-ghost">Back to Messages</a>
                    <button type="submit" class="btn btn-primary">Send Reply</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Auto-scroll to bottom
        const chatContainer = document.querySelector('[style*="height: 500px"]');
        if (chatContainer) {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }
    </script>
@endsection
