@extends('frontend.layouts.app')

@section('title', 'Prime - Built-in Kitchen Appliances')
@section('description', 'Shop premium built-in kitchen appliances at Prime')
@section('keywords', 'built-in kitchen, kitchen appliances, ovens, hobs, Prime')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Built-in Kitchen Appliances</li>
            </ol>
        </div>
    </nav>

    <section class="container py-5">
        <h1 class="h2 fw-bold mb-4">Built-in Kitchen Appliances</h1>
        <p class="text-muted mb-5">Transform your kitchen with our premium range of built-in appliances</p>

        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-fire display-4 text-danger mb-3"></i>
                        <h5 class="fw-bold">Built-in Ovens</h5>
                        <p class="text-muted small">Premium ovens for modern kitchens</p>
                        <a href="{{ route('products.category', 'Built-in Ovens') }}" class="btn btn-sm btn-outline-primary">View Products</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-stove display-4 text-danger mb-3"></i>
                        <h5 class="fw-bold">Kitchen Hobs</h5>
                        <p class="text-muted small">Gas and induction hobs</p>
                        <a href="{{ route('products.category', 'Kitchen Hobs') }}" class="btn btn-sm btn-outline-primary">View Products</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-fan display-4 text-primary mb-3"></i>
                        <h5 class="fw-bold">Kitchen Hoods</h5>
                        <p class="text-muted small">Extractors and ventilation</p>
                        <a href="{{ route('products.category', 'Kitchen Hoods') }}" class="btn btn-sm btn-outline-primary">View Products</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-grid-3x3-gap display-4 text-info mb-3"></i>
                        <h5 class="fw-bold">Dishwashers</h5>
                        <p class="text-muted small">Built-in dishwashers</p>
                        <a href="{{ route('products.category', 'Dishwashers') }}" class="btn btn-sm btn-outline-primary">View Products</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="h4 fw-bold mb-3">Why Choose Built-in Kitchen Appliances?</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Space-saving design</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Modern and sleek appearance</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Easy to clean and maintain</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Professional installation available</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Energy efficient models</li>
                                    <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Warranty and after-sales support</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="h4 fw-bold mb-4">Featured Products</h3>
        <div class="row g-4">
            @for($i = 1; $i <= 8; $i++)
                <div class="col-md-3 col-sm-6">
                    <x-product-card
                        name="Built-in Oven {{ $i }}"
                        price="120000"
                        oldPrice="150000"
                        discount="20"
                    />
                </div>
            @endfor
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('products.index') }}" class="btn btn-danger btn-lg">View All Products</a>
        </div>
    </section>
@endsection

