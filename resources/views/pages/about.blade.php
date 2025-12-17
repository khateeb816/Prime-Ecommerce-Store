@extends('layouts.app')

@section('title', 'Prime - About Us')
@section('description', 'Learn more about Prime - Your trusted electronics store in Pakistan')
@section('keywords', 'about us, Prime, electronics store, Pakistan')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">About Us</li>
            </ol>
        </div>
    </nav>

    <section class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1 class="h2 fw-bold mb-4 text-center">About Prime</h1>

                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="h4 fw-bold mb-3">Who We Are</h3>
                        <p>Prime is Pakistan's leading electronics and home appliances retailer, committed to providing high-quality products at the best prices. With years of experience in the industry, we have established ourselves as a trusted name in the market.</p>
                        <p>We offer a wide range of products including air conditioners, refrigerators, washing machines, LED TVs, kitchen appliances, and much more from top brands like Haier, LG, Samsung, Dawlance, and many others.</p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="h4 fw-bold mb-3">Our Mission</h3>
                        <p>Our mission is to make quality electronics and home appliances accessible to everyone in Pakistan. We strive to provide exceptional customer service, competitive prices, and genuine products with warranty support.</p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="h4 fw-bold mb-3">Why Choose Prime?</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i><strong>Genuine Products:</strong> All products are 100% authentic with manufacturer warranty</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i><strong>Best Prices:</strong> Competitive pricing with regular discounts and offers</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i><strong>Free Delivery:</strong> Free delivery on orders above Rs. 10,000 all over Pakistan</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i><strong>Easy Payment:</strong> Multiple payment options including cash on delivery</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i><strong>Customer Support:</strong> 24/7 customer support for all your queries</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i><strong>Installation Service:</strong> Professional installation services available</li>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h3 class="h4 fw-bold mb-3">Contact Us</h3>
                        <p class="mb-2"><i class="bi bi-telephone me-2"></i><strong>Phone:</strong> +92 300 1234567</p>
                        <p class="mb-2"><i class="bi bi-envelope me-2"></i><strong>Email:</strong> info@prime.com</p>
                        <p class="mb-0"><i class="bi bi-geo-alt me-2"></i><strong>Address:</strong> Main Boulevard, Karachi, Pakistan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

