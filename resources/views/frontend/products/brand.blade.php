@extends('frontend.layouts.app')

@section('title', $brandName . ' - Prime')
@section('description', 'Browse ' . $brandName . ' products at Prime. Find the latest and most searched products.')
@section('keywords', $brandName . ', products, Prime')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $brandName }}</li>
            </ol>
        </div>
    </nav>

    <!-- Brand Header -->
    <section class="container py-4">
        <div class="row">
            <div class="col-12">
                <h1 class="h2 fw-bold mb-2">{{ $brandName }}</h1>
                <p class="text-muted">Explore our collection of {{ $brandName }} products</p>
            </div>
        </div>
    </section>

    <!-- Most Searched Products Section -->
    <section class="container py-4">
        <h2 class="section-title mb-4">Most Searched Products</h2>
        <div class="row g-4">
            @foreach($mostSearchedProducts as $product)
                <div class="col-md-3 col-sm-6">
                    <x-product-card
                        name="{{ $product['name'] }}"
                        price="{{ $product['price'] }}"
                        oldPrice="{{ $product['old_price'] ?? null }}"
                        discount="{{ $product['discount'] ?? null }}"
                        rating="{{ $product['rating'] }}"
                        reviews="{{ $product['reviews'] }}"
                        slug="{{ $product['slug'] }}"
                    />
                </div>
            @endforeach
        </div>
    </section>

    <!-- Latest Products Section -->
    <section class="container py-4">
        <h2 class="section-title mb-4">Latest Products</h2>
        <div class="row g-4">
            @foreach($latestProducts as $product)
                <div class="col-md-3 col-sm-6">
                    <x-product-card
                        name="{{ $product['name'] }}"
                        price="{{ $product['price'] }}"
                        oldPrice="{{ $product['old_price'] ?? null }}"
                        discount="{{ $product['discount'] ?? null }}"
                        rating="{{ $product['rating'] }}"
                        reviews="{{ $product['reviews'] }}"
                        slug="{{ $product['slug'] }}"
                    />
                </div>
            @endforeach
        </div>
    </section>
@endsection

