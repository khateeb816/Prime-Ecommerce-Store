@extends('frontend.layouts.app')

@section('title', 'Prime - My Wishlist')
@section('description', 'View and manage your wishlist items')
@section('keywords', 'wishlist, favorites, Prime')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="text-decoration-none">My Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
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
                    <a href="{{ route('user.orders') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-bag-check me-2"></i>My Orders
                    </a>
                    <a href="{{ route('user.profile') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-person me-2"></i>Profile
                    </a>
                    <a href="{{ route('user.wishlist') }}" class="list-group-item list-group-item-action active">
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
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h3 fw-bold mb-0">My Wishlist</h2>
                    <span class="text-muted">12 items</span>
                </div>

                @if(true) {{-- Check if wishlist has items --}}
                    <div class="row g-4">
                        @for($i = 1; $i <= 12; $i++)
                            <div class="col-md-4 col-sm-6">
                                <div class="product-card p-3 text-center position-relative">
                                    <button class="btn btn-sm btn-outline-danger position-absolute top-0 end-0 m-2" style="z-index: 10;" title="Remove from wishlist">
                                        <i class="bi bi-heart-fill"></i>
                                    </button>
                                    <div class="product-image-placeholder mb-3">
                                        <i class="bi bi-box"></i>
                                    </div>
                                    <h6 class="text-truncate">Wishlist Product {{ $i }}</h6>
                                    <div class="text-warning mb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                        <small class="text-muted">({{ 10 + $i }})</small>
                                    </div>
                                    <div class="mb-2">
                                        <span class="old-price">Rs. {{ number_format(50000 + ($i * 5000)) }}</span>
                                        <span class="new-price ms-2">Rs. {{ number_format(40000 + ($i * 5000)) }}</span>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('cart.index') }}" class="btn btn-danger btn-sm flex-fill">
                                            <i class="bi bi-cart-plus me-1"></i>Add to Cart
                                        </a>
                                        <a href="{{ route('products.show', 'product-' . $i) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <div class="mt-4 d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                                <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                            </a>
                        </div>
                        <button class="btn btn-danger">
                            <i class="bi bi-cart-plus me-2"></i>Add All to Cart
                        </button>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Page navigation" class="mt-5">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                @else
                    <div class="card text-center py-5">
                        <div class="card-body">
                            <i class="bi bi-heart display-1 text-muted mb-3"></i>
                            <h4 class="mb-3">Your Wishlist is Empty</h4>
                            <p class="text-muted mb-4">Start adding products you love to your wishlist!</p>
                            <a href="{{ route('products.index') }}" class="btn btn-danger btn-lg">
                                <i class="bi bi-arrow-left me-2"></i>Start Shopping
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

