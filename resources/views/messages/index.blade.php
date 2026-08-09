@extends('layouts.valena')
@section('title', 'Messages')
@section('content')
    <div style="background:linear-gradient(135deg,var(--valena-dark) 0%,var(--valena-brown) 100%);padding:3.5rem 0 2rem">
        <div class="container text-white">
            <span class="section-eyebrow d-block mb-2">Support</span>
            <h1 class="mb-0" style="font-family:'Playfair Display',serif;font-size:2.4rem">Messages</h1>
        </div>
    </div>
    <div class="container py-5" style="max-width:900px">
        <div style="margin-bottom: 2.5rem; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h2 style="font-weight: 700; margin: 0 0 0.5rem 0; color: #1f2937; font-size: 1.75rem;">Your Messages</h2>
                <p style="color: #6b7280; font-size: 0.9rem; margin: 0;">View and manage your conversations with our support
                    team</p>
            </div>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newMessageModal">
                <i class="bi bi-plus-lg" style="margin-right: 0.5rem;"></i>New Message
            </button>
        </div>

        @if ($conversations->count() > 0)
            <div style="display: grid; gap: 1rem;">
                @foreach ($conversations as $conversation)
                    @php
                        $lastMessage = $conversation->latestMessage;
                        $isUnread =
                            $lastMessage && $lastMessage->read_at === null && $lastMessage->sender_id !== auth()->id();
                    @endphp
                    <a href="{{ route('messages.show', $conversation) }}" style="text-decoration: none;">
                        <div class="card"
                            style="padding: 1.5rem; cursor: pointer; transition: all 0.2s; border: 1px solid #e5e7eb; background: #fff; border-radius: 12px; display: flex; justify-content: space-between; align-items: center;"
                            onmouseover="this.style.boxShadow='0 4px 12px rgba(92, 45, 14, 0.1)'; this.style.transform='translateY(-2px)';"
                            onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)';">
                            <div style="flex: 1;">
                                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.75rem;">
                                    <div
                                        style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #5c2d0e 0%, #7a3d14 100%); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 600; font-size: 1rem;">
                                        {{ strtoupper(substr($conversation->user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <h4 style="margin: 0; font-weight: 600; color: #1f2937; font-size: 1rem;">
                                            {{ $conversation->user->name }}</h4>
                                        <p style="margin: 0; font-size: 0.8rem; color: #9ca3af;">
                                            {{ $conversation->user->email }}</p>
                                    </div>
                                </div>
                                <p
                                    style="margin: 0; color: #374151; font-size: 0.875rem; max-width: 400px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    @if ($lastMessage)
                                        @if ($lastMessage->sender_id === auth()->id())
                                            <span style="color: #6b7280;">You: </span>
                                        @else
                                            <span style="font-weight: 600; color: var(--v-brown);">Admin: </span>
                                        @endif
                                        {{ $lastMessage->body }}
                                    @else
                                        No messages yet
                                    @endif
                                </p>
                            </div>
                            <div style="text-align: right;">
                                <p style="margin: 0; font-size: 0.8rem; color: #9ca3af;">
                                    {{ $lastMessage?->created_at?->diffForHumans() ?? 'Just now' }}</p>
                                @if ($isUnread)
                                    <span class="badge badge-primary" style="margin-top: 0.5rem;">New</span>
                                @endif
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="card" style="padding: 3rem; text-align: center; background: #f9fafb; border: 2px dashed #e5e7eb;">
                <i class="bi bi-chat-dots" style="font-size: 3rem; color: #d1d5db; margin-bottom: 1rem;"></i>
                <h4 style="color: #6b7280; font-weight: 600; margin-bottom: 0.5rem;">No conversations yet</h4>
                <p style="color: #9ca3af; margin-bottom: 1.5rem;">Start a conversation with our support team</p>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newMessageModal">
                    <i class="bi bi-plus-lg" style="margin-right: 0.5rem;"></i>Send a Message
                </button>
            </div>
        @endif
    </div>

    <!-- New Message Modal -->
    <div class="modal fade" id="newMessageModal" tabindex="-1">
        <div class="modal-dialog" style="max-width: 600px;">
            <div class="modal-content"
                style="border: none; border-radius: 12px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);">
                <div style="padding: 2rem; border-bottom: 1px solid #e5e7eb;">
                    <h5 class="modal-title" style="font-weight: 700; color: #1f2937;">Send a Message</h5>
                </div>
                <form method="POST" action="{{ route('messages.store') }}">
                    @csrf
                    <div style="padding: 2rem;">
                        <textarea name="body" rows="5"
                            style="width: 100%; padding: 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s; resize: vertical;"
                            placeholder="Type your message here…"
                            onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';"
                            onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">{{ old('body') }}</textarea>
                        @error('body')
                            <div style="color: #dc2626; font-size: 0.875rem; margin-top: 0.5rem;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div
                        style="padding: 2rem; border-top: 1px solid #e5e7eb; display: flex; gap: 1rem; justify-content: flex-end;">
                        <button type="button" class="btn btn-ghost" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
