@extends('layouts.admin')
@section('title', 'Dashboard')
@section('nav_dashboard', 'active')
@section('content')
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card" style="background:linear-gradient(135deg,#5c2d0e,#8b4513)">
                <i class="bi bi-bag2 stat-icon"></i>
                <div class="small opacity-75 mb-1">Products</div>
                <div class="fs-2 fw-bold">{{ $productCount }}</div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card" style="background:linear-gradient(135deg,#065f46,#059669)">
                <i class="bi bi-receipt stat-icon"></i>
                <div class="small opacity-75 mb-1">Orders</div>
                <div class="fs-2 fw-bold">{{ $orderCount }}</div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card" style="background:linear-gradient(135deg,#92400e,#d97706)">
                <i class="bi bi-chat-dots stat-icon"></i>
                <div class="small opacity-75 mb-1">Unread Messages</div>
                <div class="fs-2 fw-bold">{{ $unreadMessageCount }}</div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="stat-card" style="background:linear-gradient(135deg,#1e3a5f,#2563eb)">
                <i class="bi bi-people stat-icon"></i>
                <div class="small opacity-75 mb-1">Customers</div>
                <div class="fs-2 fw-bold">{{ $userCount }}</div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-6">
            <div class="v-card h-100">
                <div class="card-header bg-white border-0 px-4 pt-4 pb-0 fw-semibold">Quick Actions</div>
                <div class="list-group list-group-flush rounded-4">
                    <a href="{{ route('admin.products.create') }}"
                        class="list-group-item list-group-item-action border-0 px-4 py-3">
                        <i class="bi bi-plus-circle me-2" style="color:var(--v-brown)"></i>Add Product
                    </a>
                    <a href="{{ route('admin.news.create') }}"
                        class="list-group-item list-group-item-action border-0 px-4 py-3">
                        <i class="bi bi-plus-circle me-2" style="color:var(--v-brown)"></i>Post News
                    </a>
                    <a href="{{ route('admin.facilities.create') }}"
                        class="list-group-item list-group-item-action border-0 px-4 py-3">
                        <i class="bi bi-plus-circle me-2" style="color:var(--v-brown)"></i>Add Facility
                    </a>
                    <a href="{{ route('admin.tourist-spots.create') }}"
                        class="list-group-item list-group-item-action border-0 px-4 py-3">
                        <i class="bi bi-plus-circle me-2" style="color:var(--v-brown)"></i>Add Tourist Spot
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="v-card h-100">
                <div class="card-header bg-white border-0 px-4 pt-4 pb-0 fw-semibold">Pending Actions</div>
                <div class="list-group list-group-flush rounded-4">
                    <a href="{{ route('admin.orders.index') }}"
                        class="list-group-item list-group-item-action border-0 px-4 py-3 d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-receipt me-2 text-muted"></i>View All Orders</span>
                        <span class="badge rounded-pill text-white"
                            style="background:var(--v-brown)">{{ $orderCount }}</span>
                    </a>
                    <a href="{{ route('admin.messages.index') }}"
                        class="list-group-item list-group-item-action border-0 px-4 py-3 d-flex justify-content-between align-items-center">
                        <span><i class="bi bi-chat-dots me-2 text-muted"></i>Unread Messages</span>
                        <span class="badge rounded-pill bg-warning text-dark">{{ $unreadMessageCount }}</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
{{--  <div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm text-white" style="background:var(--valena-brown)">
            <div class="card-body d-flex align-items-center gap-3">
                <i class="bi bi-bag fs-1 opacity-75"></i>
                <div>
                    <div class="fs-2 fw-bold">{{ $productCount }}</div>
                    <div class="small opacity-75">Products</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm text-white bg-success">
            <div class="card-body d-flex align-items-center gap-3">
                <i class="bi bi-receipt fs-1 opacity-75"></i>
                <div>
                    <div class="fs-2 fw-bold">{{ $orderCount }}</div>
                    <div class="small opacity-75">Orders</div>
                </div>
            </div>
        </div>
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
