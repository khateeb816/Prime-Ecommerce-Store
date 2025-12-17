@extends('layouts.app')

@section('title', 'Prime - My Account')
@section('description', 'Manage your Prime account')
@section('keywords', 'account, dashboard, Prime')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div>
    </nav>

    <section class="container py-5">
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="list-group">
                    <a href="{{ route('user.dashboard') }}" class="list-group-item list-group-item-action active">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                    <a href="{{ route('user.orders') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-bag-check me-2"></i>My Orders
                    </a>
                    <a href="{{ route('user.profile') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-person me-2"></i>Profile
                    </a>
                    <a href="{{ route('user.wishlist') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-heart me-2"></i>Wishlist
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="bi bi-gear me-2"></i>Settings
                    </a>
                    <a href="#" class="list-group-item list-group-item-action text-danger">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </a>
                </div>
            </div>
            <div class="col-md-9">
                <h2 class="h3 fw-bold mb-4">Dashboard</h2>

                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <i class="bi bi-bag-check display-4 text-primary"></i>
                                <h3 class="mt-3">5</h3>
                                <p class="text-muted mb-0">Total Orders</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <i class="bi bi-heart display-4 text-danger"></i>
                                <h3 class="mt-3">12</h3>
                                <p class="text-muted mb-0">Wishlist Items</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <i class="bi bi-star display-4 text-warning"></i>
                                <h3 class="mt-3">4.5</h3>
                                <p class="text-muted mb-0">Average Rating</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-brand-blue text-white">
                        <h5 class="mb-0">Recent Orders</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i = 1; $i <= 3; $i++)
                                        <tr>
                                            <td>#ORD-00{{ $i }}</td>
                                            <td>{{ now()->subDays($i)->format('M d, Y') }}</td>
                                            <td><span class="badge bg-success">Delivered</span></td>
                                            <td>Rs. {{ 50000 + ($i * 10000) }}</td>
                                            <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center mt-3">
                            <a href="{{ route('user.orders') }}" class="btn btn-outline-primary">View All Orders</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

