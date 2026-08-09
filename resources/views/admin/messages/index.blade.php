@extends('layouts.admin')
@section('title', 'Messages')
@section('nav_messages', 'active')
@section('content')
    <div style="margin-bottom: 2rem;">
        <h4 style="font-weight: 700; margin: 0 0 0.25rem 0; color: #1f2937;">Customer Messages</h4>
        <p style="color: #6b7280; font-size: 0.875rem; margin: 0;">Read and reply to customer support conversations</p>
    </div>

    <div class="card">
        @if ($conversations->count() > 0)
            <div style="padding: 0; overflow-x: auto;">
                <table class="table" style="margin-bottom: 0;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Latest Message</th>
                            <th>Last Activity</th>
                            <th>Unread</th>
                            <th style="text-align: right;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($conversations as $conversation)
                            @php
                                $latestMessage = $conversation->latestMessage;
                                $unreadCount = $conversation->messages()->whereNull('read_at')->count();
                            @endphp
                            <tr @class(['unread' => $unreadCount > 0])>
                                <td style="font-weight: 500;">{{ $conversation->conversation_id }}</td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                                        <div
                                            style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #5c2d0e 0%, #7a3d14 100%); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 600; font-size: 0.75rem;">
                                            {{ strtoupper(substr($conversation->user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <p style="margin: 0; font-weight: 600; color: #1f2937; font-size: 0.875rem;">
                                                {{ $conversation->user->name }}</p>
                                            <p style="margin: 0; font-size: 0.75rem; color: #9ca3af;">
                                                {{ $conversation->user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td
                                    style="font-size: 0.875rem; color: #6b7280; max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    @if ($latestMessage)
                                        @if ($latestMessage->sender_id === $conversation->user_id)
                                            <span style="color: #1f2937; font-weight: 500;">{{ $conversation->user->name }}:
                                            </span>
                                        @else
                                            <span style="color: var(--v-brown); font-weight: 600;">You: </span>
                                        @endif
                                        {{ $latestMessage->body }}
                                    @endif
                                </td>
                                <td style="font-size: 0.875rem; color: #6b7280; white-space: nowrap;">
                                    {{ $conversation->last_message_at->diffForHumans() }}
                                </td>
                                <td>
                                    @if ($unreadCount > 0)
                                        <span class="badge badge-primary">{{ $unreadCount }}</span>
                                    @else
                                        <span style="color: #10b981;">
                                            <i class="bi bi-check-circle-fill"></i>
                                        </span>
                                    @endif
                                </td>
                                <td style="text-align: right;">
                                    <a href="{{ route('admin.messages.show', $conversation) }}" class="btn btn-ghost"
                                        style="font-size: 0.875rem; padding: 0.4rem 0.8rem;">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="text-align: center; color: #9ca3af; padding: 2rem;">No
                                    conversations yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 1rem; display: flex; justify-content: center;">
                {{ $conversations->links('pagination::tailwind') }}
            </div>
        @else
            <div style="padding: 3rem; text-align: center; background: #f9fafb;">
                <i class="bi bi-chat-dots"
                    style="font-size: 2.5rem; color: #d1d5db; margin-bottom: 1rem; display: block;"></i>
                <p style="color: #9ca3af; margin: 0;">No customer messages yet.</p>
            </div>
        @endif
    </div>

    <style>
        tbody tr.unread {
            background: #fef3c7;
        }
    </style>
@endsection
