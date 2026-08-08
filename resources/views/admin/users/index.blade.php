@extends('layouts.admin')
@section('title', 'Users')
@section('nav_users', 'active')
@section('content')
    <div style="margin-bottom: 2rem;">
        <h4 style="font-weight: 700; margin: 0 0 0.25rem 0; color: #1f2937;">Customers &amp; Users</h4>
        <p style="color: #6b7280; font-size: 0.875rem; margin: 0;">Manage account status and admin access</p>
    </div>

    <div class="card overflow-hidden">
        <div style="padding: 0; overflow-x: auto;">
            <table class="table" style="margin-bottom: 0;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Admin</th>
                        <th>Joined</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $u)
                        <tr>
                            <td style="font-weight: 500;">{{ $u->id }}</td>
                            <td>{{ $u->name }}</td>
                            <td style="font-size: 0.875rem; color: #6b7280;">{{ $u->email }}</td>
                            <td style="font-size: 0.875rem; color: #6b7280;">{{ $u->phone ?? '—' }}</td>
                            <td>
                                @if ($u->status)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                @if ($u->is_admin)
                                    <span class="badge badge-primary">Yes</span>
                                @else
                                    <span class="badge" style="background: #f3f4f6; color: #6b7280;">No</span>
                                @endif
                            </td>
                            <td style="font-size: 0.875rem; color: #6b7280;">{{ $u->created_at?->format('M d, Y') }}</td>
                            <td style="text-align: right;">
                                <a href="{{ route('admin.users.edit', $u) }}" class="btn btn-ghost"
                                    style="font-size: 0.875rem; padding: 0.4rem 0.8rem;">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center; color: #9ca3af; padding: 2rem;">No users yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top: 1rem; display: flex; justify-content: center;">
        {{ $users->links('pagination::tailwind') }}
    </div>
@endsection
