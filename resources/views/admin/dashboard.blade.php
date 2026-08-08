@extends('layouts.admin')
@section('title', 'Dashboard')
@section('nav_dashboard', 'active')
@section('content')
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
        <div class="stat-card gradient-brown">
            <i class="bi bi-bag2 stat-icon"></i>
            <div>
                <div style="font-size: 0.9rem; opacity: 0.95; margin-bottom: 0.75rem; font-weight: 600;">Total Products</div>
                <div style="font-size: 2.5rem; font-weight: 700;">{{ $productCount }}</div>
            </div>
        </div>
        <div class="stat-card gradient-green">
            <i class="bi bi-receipt stat-icon"></i>
            <div>
                <div style="font-size: 0.9rem; opacity: 0.95; margin-bottom: 0.75rem; font-weight: 600;">Total Orders</div>
                <div style="font-size: 2.5rem; font-weight: 700;">{{ $orderCount }}</div>
            </div>
        </div>
        <div class="stat-card gradient-amber">
            <i class="bi bi-chat-dots stat-icon"></i>
            <div>
                <div style="font-size: 0.9rem; opacity: 0.95; margin-bottom: 0.75rem; font-weight: 600;">Unread Messages
                </div>
                <div style="font-size: 2.5rem; font-weight: 700;">{{ $unreadMessageCount }}</div>
            </div>
        </div>
        <div class="stat-card gradient-blue">
            <i class="bi bi-people stat-icon"></i>
            <div>
                <div style="font-size: 0.9rem; opacity: 0.95; margin-bottom: 0.75rem; font-weight: 600;">Total Customers
                </div>
                <div style="font-size: 2.5rem; font-weight: 700;">{{ $userCount }}</div>
            </div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 2rem;">
        <div class="card">
            <div class="card-header" style="font-size: 1.1rem; font-weight: 700; color: #1f2937;">
                <i class="bi bi-lightning-charge" style="color: var(--v-brown); margin-right: 0.75rem;"></i>Quick Actions
            </div>
            <div style="padding: 1.75rem;">
                <div class="list-group">
                    <a href="{{ route('admin.products.create') }}" class="list-group-item-action"
                        style="display: flex; align-items: center; gap: 1rem; padding: 1rem 0; text-decoration: none; color: #374151; font-weight: 500;">
                        <div
                            style="width: 40px; height: 40px; border-radius: 10px; background: #fef3c7; display: flex; align-items: center; justify-content: center; color: var(--v-brown);">
                            <i class="bi bi-plus-circle" style="font-size: 1.25rem;"></i>
                        </div>
                        <span>Add New Product</span>
                    </a>
                    <a href="{{ route('admin.news.create') }}" class="list-group-item-action"
                        style="display: flex; align-items: center; gap: 1rem; padding: 1rem 0; text-decoration: none; color: #374151; font-weight: 500;">
                        <div
                            style="width: 40px; height: 40px; border-radius: 10px; background: #dbeafe; display: flex; align-items: center; justify-content: center; color: #2563eb;">
                            <i class="bi bi-newspaper" style="font-size: 1.25rem;"></i>
                        </div>
                        <span>Post News Article</span>
                    </a>
                    <a href="{{ route('admin.facilities.create') }}" class="list-group-item-action"
                        style="display: flex; align-items: center; gap: 1rem; padding: 1rem 0; text-decoration: none; color: #374151; font-weight: 500;">
                        <div
                            style="width: 40px; height: 40px; border-radius: 10px; background: #dcfce7; display: flex; align-items: center; justify-content: center; color: #16a34a;">
                            <i class="bi bi-building" style="font-size: 1.25rem;"></i>
                        </div>
                        <span>Add Facility</span>
                    </a>
                    <a href="{{ route('admin.tourist-spots.create') }}" class="list-group-item-action"
                        style="display: flex; align-items: center; gap: 1rem; padding: 1rem 0; text-decoration: none; color: #374151; font-weight: 500;">
                        <div
                            style="width: 40px; height: 40px; border-radius: 10px; background: #fecaca; display: flex; align-items: center; justify-content: center; color: #dc2626;">
                            <i class="bi bi-geo-alt" style="font-size: 1.25rem;"></i>
                        </div>
                        <span>Add Tourist Spot</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header" style="font-size: 1.1rem; font-weight: 700; color: #1f2937;">
                <i class="bi bi-inbox" style="color: var(--v-brown); margin-right: 0.75rem;"></i>Pending Items
            </div>
            <div style="padding: 1.75rem;">
                <div class="list-group">
                    <a href="{{ route('admin.orders.index') }}" class="list-group-item-action"
                        style="display: flex; justify-content: space-between; align-items: center; padding: 1rem 0; text-decoration: none; color: #374151; font-weight: 500;">
                        <span style="display: flex; align-items: center; gap: 0.75rem;">
                            <i class="bi bi-receipt" style="color: #6b7280; font-size: 1.1rem;"></i>Orders to Process
                        </span>
                        <span class="badge badge-primary">{{ $orderCount }}</span>
                    </a>
                    <a href="{{ route('admin.messages.index') }}" class="list-group-item-action"
                        style="display: flex; justify-content: space-between; align-items: center; padding: 1rem 0; text-decoration: none; color: #374151; font-weight: 500;">
                        <span style="display: flex; align-items: center; gap: 0.75rem;">
                            <i class="bi bi-chat-dots" style="color: #6b7280; font-size: 1.1rem;"></i>Unread Messages
                        </span>
                        <span class="badge badge-warning">{{ $unreadMessageCount }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--  </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm text-white bg-warning">
            <div class="card-body d-flex align-items-center gap-3">
                <i class="bi bi-chat-dots fs-1 opacity-75"></i>
                <div>
                    <div class="fs-2 fw-bold">{{ $unreadMessageCount }}</div>
                    <div class="small opacity-75">Unread Messages</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm text-white bg-info">
            <div class="card-body d-flex align-items-center gap-3">
                <i class="bi bi-people fs-1 opacity-75"></i>
                <div>
                    <div class="fs-2 fw-bold">{{ $userCount }}</div>
                    <div class="small opacity-75">Customers</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header fw-semibold">Quick Links</div>
            <div class="list-group list-group-flush">
                <a href="{{ route('admin.products.create') }}" class="list-group-item list-group-item-action"><i
                        class="bi bi-plus-circle me-2"></i>Add Product</a>
                <a href="{{ route('admin.news.create') }}" class="list-group-item list-group-item-action"><i
                        class="bi bi-plus-circle me-2"></i>Post News</a>
                <a href="{{ route('admin.facilities.create') }}" class="list-group-item list-group-item-action"><i
                        class="bi bi-plus-circle me-2"></i>Add Facility</a>
                <a href="{{ route('admin.tourist-spots.create') }}" class="list-group-item list-group-item-action"><i
                        class="bi bi-plus-circle me-2"></i>Add Tourist Spot</a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm h-100">
            <div class="card-header fw-semibold">Pending Actions</div>
            <div class="list-group list-group-flush">
                <a href="{{ route('admin.orders.index') }}"
                    class="list-group-item list-group-item-action d-flex justify-content-between">
                    <span><i class="bi bi-receipt me-2"></i>View Orders</span>
                    <span class="badge bg-success rounded-pill">{{ $orderCount }}</span>
                </a>
                <a href="{{ route('admin.messages.index') }}"
                    class="list-group-item list-group-item-action d-flex justify-content-between">
                    <span><i class="bi bi-chat-dots me-2"></i>Unread Messages</span>
                    <span class="badge bg-warning text-dark rounded-pill">{{ $unreadMessageCount }}</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection  --}}
