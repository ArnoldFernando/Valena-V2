@extends('layouts.admin')
@section('title', 'Edit User')
@section('nav_users', 'active')
@section('content')
    <div class="v-card p-4" style="max-width:480px">
        <div class="card-body">
            <h6 class="fw-bold mb-1">{{ $user->name }}</h6>
            <p class="text-muted small mb-4">{{ $user->email }}</p>
            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Account Status</label>
                    <select name="status" class="form-select rounded-3">
                        <option value="1" @selected($user->status)>Active</option>
                        <option value="0" @selected(!$user->status)>Inactive</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Admin Access</label>
                    <select name="is_admin" class="form-select rounded-3">
                        <option value="0" @selected(!$user->is_admin)>No</option>
                        <option value="1" @selected($user->is_admin)>Yes</option>
                    </select>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-valena px-4">Save</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary px-4 rounded-3">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
