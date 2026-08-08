@extends('layouts.admin')
@section('title', 'Messages')
@section('nav_messages', 'active')
@section('content')
    <div style="margin-bottom: 2rem;">
        <h4 style="font-weight: 700; margin: 0 0 0.25rem 0; color: #1f2937;">Customer Messages</h4>
        <p style="color: #6b7280; font-size: 0.875rem; margin: 0;">Read and reply to customer support messages</p>
    </div>

    <div class="card overflow-hidden">
        <div style="padding: 0; overflow-x: auto;">
            <table class="table" style="margin-bottom: 0;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Read</th>
                        <th>Replied</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $m)
                        <tr @class(['unread' => !$m->is_read])>
                            <td style="font-weight: 500;">{{ $m->message_id }}</td>
                            <td>{{ $m->user?->name ?? '—' }}</td>
                            <td style="font-size: 0.875rem; color: #6b7280;">{{ Str::limit($m->message, 55) }}</td>
                            <td style="font-size: 0.875rem; color: #6b7280; white-space: nowrap;">
                                {{ $m->message_date->format('M d, Y') }}</td>
                            <td>
                                @if ($m->is_read)
                                    <i class="bi bi-check-circle-fill" style="color: #10b981; font-size: 1.1rem;"></i>
                                @else
                                    <i class="bi bi-circle" style="color: #9ca3af;"></i>
                                @endif
                            </td>
                            <td>
                                @if ($m->reply_message)
                                    <i class="bi bi-reply-fill" style="color: var(--v-brown); font-size: 1.1rem;"></i>
                                @else
                                    <span style="color: #9ca3af;">—</span>
                                @endif
                            </td>
                            <td style="text-align: right;">
                                <a href="{{ route('admin.messages.show', $m) }}" class="btn btn-ghost"
                                    style="font-size: 0.875rem; padding: 0.4rem 0.8rem;">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; color: #9ca3af; padding: 2rem;">No messages yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <style>
        tbody tr.unread {
            background: #fef3c7;
        }
    </style>

    <div style="margin-top: 1rem; display: flex; justify-content: center;">
        {{ $messages->links('pagination::tailwind') }}
    </div>
@endsection
