@extends('frontend.layouts.app')

@section('title', 'Prime - Corporate Sales')
@section('description', 'Corporate sales and bulk orders at Prime')
@section('keywords', 'corporate sales, bulk orders, business, Prime')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Corporate Sales</li>
            </ol>
        </div>
    </nav>

    <section class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1 class="h2 fw-bold mb-4 text-center">Corporate Sales</h1>

                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="h4 fw-bold mb-3">Bulk Orders & Corporate Solutions</h3>
                        <p>Prime offers special pricing and services for businesses, organizations, and bulk orders. Whether you're furnishing an office, hotel, restaurant, or any commercial space, we have the solutions you need.</p>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="h4 fw-bold mb-3">Benefits of Corporate Sales</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i><strong>Special Pricing:</strong> Competitive rates for bulk orders</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i><strong>Flexible Payment:</strong> Customized payment plans for businesses</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i><strong>Priority Support:</strong> Dedicated account manager for corporate clients</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i><strong>Installation Services:</strong> Professional installation and setup</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i><strong>Warranty Support:</strong> Extended warranty options available</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i><strong>After-Sales Service:</strong> Comprehensive maintenance and support</li>
                        </ul>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="h4 fw-bold mb-3">Products Available for Corporate Sales</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <ul>
                                    <li>Air Conditioners</li>
                                    <li>Refrigerators</li>
                                    <li>Deep Freezers</li>
                                    <li>Water Dispensers</li>
                                    <li>LED TVs</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <li>Washing Machines</li>
                                    <li>Kitchen Appliances</li>
                                    <li>Built-in Ovens & Hobs</li>
                                    <li>Kitchen Hoods</li>
                                    <li>And much more...</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-brand-blue text-white">
                        <h5 class="mb-0">Request a Quote</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Company Name *</label>
                                    <input type="text" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Contact Person *</label>
                                    <input type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Email *</label>
                                    <input type="email" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Phone *</label>
                                    <input type="tel" class="form-control" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Products Required</label>
                                <textarea class="form-control" rows="4" placeholder="Please specify the products and quantities you need..."></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Additional Requirements</label>
                                <textarea class="form-control" rows="3" placeholder="Any special requirements or notes..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger btn-lg w-100">Submit Request</button>
                        </form>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body text-center">
                        <h5 class="mb-3">Contact Our Corporate Sales Team</h5>
                        <p class="mb-2"><i class="bi bi-telephone me-2"></i><strong>Phone:</strong> +92 300 1234567</p>
                        <p class="mb-0"><i class="bi bi-envelope me-2"></i><strong>Email:</strong> corporate@prime.com</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

