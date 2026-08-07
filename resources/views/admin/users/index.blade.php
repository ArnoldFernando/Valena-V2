@extends('layouts.admin')
@section('title', 'Users')
@section('nav_users', 'active')
@section('content')
    <div class="mb-4">
        <h5 class="fw-bold mb-0">Customers &amp; Users</h5>
        <p class="text-muted small mb-0">Manage account status and admin access</p>
    </div>
    <div class="v-card overflow-hidden">
        <div class="card-body p-0">
            <table class="table table-hover mb-0 align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Admin</th>
                        <th>Joined</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $u)
                        <tr>
                            <td>{{ $u->id }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->phone ?? '—' }}</td>
                            <td>{!! $u->status
                                ? '<span class="badge bg-success">Active</span>'
                                : '<span class="badge bg-danger">Inactive</span>' !!}</td>
                            <td>{!! $u->is_admin
                                ? '<span class="badge bg-primary">Yes</span>'
                                : '<span class="badge bg-light text-muted border">No</span>' !!}</td>
                            <td>{{ $u->created_at?->format('M d, Y') }}</td>
                            <td>
                                <a href="{{ route('admin.users.edit', $u) }}"
                                    class="btn btn-sm btn-outline-secondary">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No users yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="mt-3">{{ $users->links() }}</div>
@endsection
