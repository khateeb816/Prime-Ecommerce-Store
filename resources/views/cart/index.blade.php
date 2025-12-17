@extends('layouts.app')

@section('title', 'Prime - Shopping Cart')
@section('description', 'View and manage your shopping cart at Prime.')
@section('keywords', 'cart, shopping cart, Prime')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </div>
    </nav>

    <!-- Cart Section -->
    <section class="container py-5">
        <h1 class="h2 fw-bold mb-4">Shopping Cart</h1>

        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i = 1; $i <= 3; $i++)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="product-image-placeholder border rounded" style="width: 80px; height: 80px;">
                                                        <div class="d-flex align-items-center justify-content-center h-100">
                                                            <i class="bi bi-image" style="font-size: 30px; color: #ddd;"></i>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-1">Product Name {{ $i }}</h6>
                                                        <small class="text-muted">SKU: PRD-00{{ $i }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <span class="text-muted text-decoration-line-through">Rs. {{ 50000 + ($i * 5000) }}</span>
                                                    <div class="fw-bold text-danger">Rs. {{ 40000 + ($i * 5000) }}</div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="input-group" style="width: 120px;">
                                                    <button class="btn btn-outline-secondary btn-sm" type="button">-</button>
                                                    <input type="number" class="form-control form-control-sm text-center" value="{{ $i }}" min="1">
                                                    <button class="btn btn-outline-secondary btn-sm" type="button">+</button>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>Rs. {{ (40000 + ($i * 5000)) * $i }}</strong>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                        <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                    </a>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-brand-blue text-white">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <strong>Rs. 150,000</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Delivery:</span>
                            <strong class="text-success">FREE</strong>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax:</span>
                            <strong>Rs. 0</strong>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="h5 mb-0">Total:</span>
                            <strong class="h5 mb-0 text-danger">Rs. 150,000</strong>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="btn btn-danger w-100 btn-lg">
                            Proceed to Checkout
                        </a>
                        <div class="mt-3 text-center">
                            <small class="text-muted">
                                <i class="bi bi-shield-check me-1"></i>
                                Secure Checkout
                            </small>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Delivery Information</h6>
                        <p class="small mb-2"><i class="bi bi-truck me-2"></i>Free delivery on orders above Rs. 10,000</p>
                        <p class="small mb-2"><i class="bi bi-clock me-2"></i>Estimated delivery: 3-5 business days</p>
                        <p class="small mb-0"><i class="bi bi-geo-alt me-2"></i>Available all over Pakistan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

