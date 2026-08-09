@extends('layouts.admin')
@section('title', 'Edit User')
@section('nav_users', 'active')
@section('content')
    <div style="max-width: 600px; margin: 0 auto;">
        <div style="margin-bottom: 2.5rem;">
            <h3 style="font-weight: 700; margin: 0 0 0.5rem 0; color: #1f2937; font-size: 1.5rem;">Edit User</h3>
            <p style="color: #6b7280; font-size: 0.9rem; margin: 0;">Manage user account and permissions</p>
        </div>

        <!-- User Info Card -->
        <div class="card" style="margin-bottom: 2rem;">
            <div style="padding: 2rem; display: flex; align-items: center; gap: 1.5rem; border-bottom: 1px solid #e5e7eb;">
                <div
                    style="width: 60px; height: 60px; border-radius: 50%; background: linear-gradient(135deg, #5c2d0e 0%, #7a3d14 100%); display: flex; align-items: center; justify-content: center; font-size: 1.75rem; font-weight: 700; color: #fff;">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <h4 style="margin: 0 0 0.5rem 0; font-weight: 700; color: #1f2937; font-size: 1.1rem;">
                        {{ $user->name }}</h4>
                    <p style="margin: 0; color: #6b7280; font-size: 0.875rem;">{{ $user->email }}</p>
                </div>
                <div style="margin-left: auto;">
                    @if ($user->status)
                        <span class="badge badge-success">Active</span>
                    @else
                        <span class="badge" style="background: #f3f4f6; color: #6b7280;">Inactive</span>
                    @endif
                </div>
            </div>

            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                @csrf @method('PUT')
                <div style="padding: 2rem;">
                    <div style="margin-bottom: 1.5rem;">
                        <label
                            style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.75rem;">Account
                            Status</label>
                        <select name="status"
                            style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s; background-color: #fff;"
                            onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';"
                            onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                            <option value="1" @selected($user->status)>✓ Active</option>
                            <option value="0" @selected(!$user->status)>✗ Inactive</option>
                        </select>
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label
                            style="display: block; font-weight: 600; font-size: 0.875rem; color: #1f2937; margin-bottom: 0.75rem;">Administrator
                            Access</label>
                        <select name="is_admin"
                            style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 0.875rem; color: #1f2937; font-family: inherit; transition: all 0.2s; background-color: #fff;"
                            onfocus="this.style.borderColor='#5c2d0e'; this.style.boxShadow='0 0 0 3px rgba(92, 45, 14, 0.1)';"
                            onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                            <option value="0" @selected(!$user->is_admin)>No Access</option>
                            <option value="1" @selected($user->is_admin)>Admin Access</option>
                        </select>
                        <p style="font-size: 0.8rem; color: #6b7280; margin-top: 0.5rem; margin-bottom: 0;">Admin users can
                            manage all platform content and settings</p>
                    </div>
                </div>

                <div
                    style="padding: 2rem; border-top: 1px solid #e5e7eb; display: flex; gap: 1rem; justify-content: flex-end;">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-ghost">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection
