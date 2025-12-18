@extends('frontend.layouts.app')

@section('title', 'Prime - Store Locations')
@section('description', 'Find Prime store locations near you')
@section('keywords', 'store location, store, Prime, Pakistan')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Store Location</li>
            </ol>
        </div>
    </nav>

    <section class="container py-5">
        <h1 class="h2 fw-bold mb-4 text-center">Our Store Locations</h1>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-brand-blue text-white">
                        <h5 class="mb-0"><i class="bi bi-geo-alt me-2"></i>Karachi - Main Branch</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-2"><strong>Address:</strong></p>
                        <p class="mb-3">123 Main Boulevard, Block A, Karachi, Pakistan</p>
                        <p class="mb-2"><strong>Phone:</strong></p>
                        <p class="mb-3">+92 300 1234567</p>
                        <p class="mb-2"><strong>Hours:</strong></p>
                        <p class="mb-0">Monday - Saturday: 10:00 AM - 8:00 PM<br>Sunday: 12:00 PM - 6:00 PM</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-brand-blue text-white">
                        <h5 class="mb-0"><i class="bi bi-geo-alt me-2"></i>Lahore - Branch</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-2"><strong>Address:</strong></p>
                        <p class="mb-3">456 Mall Road, Lahore, Pakistan</p>
                        <p class="mb-2"><strong>Phone:</strong></p>
                        <p class="mb-3">+92 300 1234568</p>
                        <p class="mb-2"><strong>Hours:</strong></p>
                        <p class="mb-0">Monday - Saturday: 10:00 AM - 8:00 PM<br>Sunday: 12:00 PM - 6:00 PM</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-brand-blue text-white">
                        <h5 class="mb-0"><i class="bi bi-geo-alt me-2"></i>Islamabad - Branch</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-2"><strong>Address:</strong></p>
                        <p class="mb-3">789 Blue Area, Islamabad, Pakistan</p>
                        <p class="mb-2"><strong>Phone:</strong></p>
                        <p class="mb-3">+92 300 1234569</p>
                        <p class="mb-2"><strong>Hours:</strong></p>
                        <p class="mb-0">Monday - Saturday: 10:00 AM - 8:00 PM<br>Sunday: 12:00 PM - 6:00 PM</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="card h-100">
                    <div class="card-header bg-brand-blue text-white">
                        <h5 class="mb-0"><i class="bi bi-geo-alt me-2"></i>Rawalpindi - Branch</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-2"><strong>Address:</strong></p>
                        <p class="mb-3">321 Saddar Road, Rawalpindi, Pakistan</p>
                        <p class="mb-2"><strong>Phone:</strong></p>
                        <p class="mb-3">+92 300 1234570</p>
                        <p class="mb-2"><strong>Hours:</strong></p>
                        <p class="mb-0">Monday - Saturday: 10:00 AM - 8:00 PM<br>Sunday: 12:00 PM - 6:00 PM</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body text-center">
                <h4 class="mb-3">Can't Find a Store Near You?</h4>
                <p class="mb-3">No worries! We deliver all over Pakistan. Shop online and get free delivery on orders above Rs. 10,000.</p>
                <a href="{{ route('products.index') }}" class="btn btn-danger btn-lg">Shop Online Now</a>
            </div>
        </div>
    </section>
@endsection

