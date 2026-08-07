@extends('layouts.admin')
@section('title', 'Messages')
@section('nav_messages', 'active')
@section('content')
    <div class="mb-4">
        <h5 class="fw-bold mb-0">Customer Messages</h5>
        <p class="text-muted small mb-0">Read and reply to customer support messages</p>
    </div>
    <div class="v-card overflow-hidden">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Read</th>
                        <th>Replied</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $m)
                        <tr @class(['table-warning' => !$m->is_read])>
                            <td>{{ $m->message_id }}</td>
                            <td>{{ $m->user?->name ?? '—' }}</td>
                            <td>{{ Str::limit($m->message, 55) }}</td>
                            <td class="text-nowrap">{{ $m->message_date->format('M d, Y') }}</td>
                            <td>{!! $m->is_read
                                ? '<i class="bi bi-check-circle-fill text-success"></i>'
                                : '<i class="bi bi-circle text-muted"></i>' !!}</td>
                            <td>{!! $m->reply_message ? '<i class="bi bi-reply-fill text-primary"></i>' : '—' !!}</td>
                            <td><a href="{{ route('admin.messages.show', $m) }}"
                                    class="btn btn-sm btn-outline-secondary">View</a></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No messages yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $messages->links() }}</div>
@endsection
