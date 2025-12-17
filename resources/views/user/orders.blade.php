@extends('layouts.app')

@section('title', 'Prime - My Orders')
@section('description', 'View your order history')
@section('keywords', 'orders, order history, Prime')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="text-decoration-none">My Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Orders</li>
            </ol>
        </div>
    </nav>

    <section class="container py-5">
        <div class="row">
            <div class="col-md-3 mb-4">
                <div class="list-group">
                    <a href="{{ route('user.dashboard') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                    <a href="{{ route('user.orders') }}" class="list-group-item list-group-item-action active">
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
                <h2 class="h3 fw-bold mb-4">My Orders</h2>

                @for($i = 1; $i <= 5; $i++)
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Order #ORD-00{{ $i }}</strong>
                                <span class="text-muted ms-2">{{ now()->subDays($i)->format('M d, Y') }}</span>
                            </div>
                            <span class="badge bg-success">Delivered</span>
                        </div>
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <div class="product-image-placeholder border rounded" style="width: 100%; height: 100px;">
                                        <div class="d-flex align-items-center justify-content-center h-100">
                                            <i class="bi bi-image" style="font-size: 40px; color: #ddd;"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="mb-1">Product Name {{ $i }}</h6>
                                    <small class="text-muted">Quantity: {{ $i }}</small>
                                </div>
                                <div class="col-md-2 text-center">
                                    <strong class="text-danger">Rs. {{ 50000 + ($i * 10000) }}</strong>
                                </div>
                                <div class="col-md-2 text-end">
                                    <a href="#" class="btn btn-sm btn-outline-primary">View Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor

                <nav aria-label="Page navigation" class="mt-4">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
@endsection

