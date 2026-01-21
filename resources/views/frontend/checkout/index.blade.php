@extends('frontend.layouts.app')

@section('title', 'Prime - Checkout')
@section('description', 'Complete your order at Prime.')
@section('keywords', 'checkout, order, Prime')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('cart.index') }}" class="text-decoration-none">Cart</a></li>
                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
            </ol>
        </div>
    </nav>

    <!-- Checkout Section -->
    <section class="container py-5">
        <h1 class="h2 fw-bold mb-4">Checkout</h1>

        <div class="row">
            <div class="col-lg-8">
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <!-- Delivery Information -->
                    <div class="card mb-4">
                        <div class="card-header bg-brand-blue text-white">
                            <h5 class="mb-0">Delivery Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">First Name *</label>
                                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name', auth()->user()->name) }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Last Name *</label>
                                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone Number *</label>
                                <input type="tel" name="phone" class="form-control" value="{{ old('phone', auth()->user()->phone) }}" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address *</label>
                                <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">City *</label>
                                    <select name="city" class="form-select" required>
                                        <option value="">Select City</option>
                                        <option value="Karachi">Karachi</option>
                                        <option value="Lahore">Lahore</option>
                                        <option value="Islamabad">Islamabad</option>
                                        <option value="Rawalpindi">Rawalpindi</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="card mb-4">
                        <div class="card-header bg-brand-blue text-white">
                            <h5 class="mb-0">Payment Method</h5>
                        </div>
                        <div class="card-body">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="cod" value="cod" checked>
                                <label class="form-check-label" for="cod">
                                    <strong>Cash on Delivery</strong>
                                    <small class="d-block text-muted">Pay when you receive the order</small>
                                </label>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="card" value="card">
                                <label class="form-check-label" for="card">
                                    <strong>Credit/Debit Card</strong>
                                    <small class="d-block text-muted">Secure payment via card</small>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="bank" value="bank">
                                <label class="form-check-label" for="bank">
                                    <strong>Bank Transfer</strong>
                                    <small class="d-block text-muted">Direct bank transfer</small>
                                </label>
                            </div>
                        </div>
                    </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-brand-blue text-white">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        @foreach($cart as $item)
                        <div class="d-flex justify-content-between mb-2">
                            <span class="small">{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                            <span class="small fw-bold">Rs. {{ number_format($item['price'] * $item['quantity']) }}</span>
                        </div>
                        @endforeach
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <strong>Rs. {{ number_format($total) }}</strong>
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
                            <strong class="h5 mb-0 text-danger">Rs. {{ number_format($total) }}</strong>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 btn-lg">
                            Place Order
                        </button>
                    </form>
                        <div class="mt-3 text-center">
                            <small class="text-muted">
                                <i class="bi bi-shield-check me-1"></i>
                                Your information is secure
                            </small>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h6 class="fw-bold mb-3">Need Help?</h6>
                        <p class="small mb-2"><i class="bi bi-telephone me-2"></i>Call us: +92 300 1234567</p>
                        <p class="small mb-0"><i class="bi bi-envelope me-2"></i>Email: support@prime.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

