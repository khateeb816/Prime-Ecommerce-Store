@extends('frontend.layouts.app')

@section('title', 'Prime - Home')
@section('description', 'Prime - Your trusted electronics store. Shop the latest home appliances, kitchen electronics, and more at the best prices in Pakistan.')
@section('keywords', 'electronics, home appliances, kitchen appliances, Prime, online shopping, Pakistan')

@section('content')
    <!-- Hero Banner Section -->
    <section class="hero-banner" aria-label="Hero banner with sale information">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 py-5">
                    <h4 class="mb-2 text-white fw-normal">SAB SE BARI</h4>
                    <h1 class="display-2 fw-bold fst-italic hero-sale-text mb-3">ASLI SALE</h1>
                    <h3 class="text-white mb-2">ANNUAL SALE UPTO</h3>
                    <div class="mb-3">
                        <span class="text-warning display-3 fw-bold">33%</span>
                        <span class="text-white fs-3"> OFF</span>
                    </div>
                    <p class="lead mb-4 text-white">25 NOV - 25 DEC</p>
                    <a href="{{ route('products.index') }}" class="btn btn-danger btn-lg rounded-pill px-5 py-3 fw-bold" aria-label="Shop now button">
                        SHOP NOW <i class="bi bi-arrow-right ms-2" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="col-md-6 text-end d-none d-md-block">
                    <div class="hero-image-placeholder">
                        <i class="bi bi-person-circle hero-icon" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- All Categories Section -->
    <section class="container-fluid py-5" aria-label="Product categories">
        <h2 class="section-title">ALL CATEGORIES</h2>
        <div class="row text-center g-4">
            <x-category-item name="Air Conditioners" icon="bi-snow" />
            <x-category-item name="LED TVs" icon="bi-tv" />
            <x-category-item name="Built In Ovens" icon="bi-fire" />
            <x-category-item name="Refrigerators" icon="bi-box" />
            <x-category-item name="Washing Machines" icon="bi-droplet" />
            <x-category-item name="Water Dispensers" icon="bi-cup-straw" />
            <x-category-item name="Air Coolers" icon="bi-wind" />
            <x-category-item name="Air Fryers" icon="bi-thermometer-half" />
            <x-category-item name="Deep Freezers" icon="bi-box-seam" />
            <x-category-item name="Kitchen Hoods" icon="bi-fan" />
            <x-category-item name="Kitchen Hobs" icon="bi-stove" />
            <x-category-item name="Kitchen Appliances" icon="bi-grid-3x3-gap" />
        </div>
    </section>

    <!-- Sale Products Section -->
    <section class="container-fluid py-5 bg-white" aria-label="Sale products">
        <h2 class="section-title">SAB SE BARI ASLI SALE</h2>
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <x-product-card
                    name="Royal Fans Deluxe Model"
                    oldPrice="12000"
                    newPrice="8500"
                    discount="33"
                    icon="bi-fan"
                    :showCart="true"
                />
            </div>
            <div class="col-6 col-md-3">
                <x-product-card
                    name="T3 1.5 Ton Inverter AC"
                    oldPrice="150000"
                    newPrice="120000"
                    discount="20"
                    icon="bi-snow"
                    :showCart="true"
                />
            </div>
            <div class="col-6 col-md-3">
                <x-product-card
                    name="Philips Hair Dryer"
                    oldPrice="8000"
                    newPrice="6800"
                    discount="15"
                    icon="bi-scissors"
                    :showCart="true"
                />
            </div>
            <div class="col-6 col-md-3">
                <x-product-card
                    name="Panasonic Steam Iron"
                    oldPrice="12000"
                    newPrice="9000"
                    discount="25"
                    icon="bi-lightning"
                    :showCart="true"
                />
            </div>
        </div>
    </section>

    <!-- Refrigerators Section -->
    <section class="container-fluid py-5" aria-label="Refrigerators">
        <h2 class="section-title">Refrigerators</h2>
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <div class="product-card p-3 text-center">
                    <x-discount-badge discount="-5%" />
                    <div class="product-image-placeholder tall mb-3">
                        <i class="bi bi-box" aria-hidden="true"></i>
                    </div>
                    <h6 class="text-truncate">Dawlance no Frost Ref DMD-9060 GD</h6>
                    <div class="text-warning mb-2">
                        <i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-half" aria-hidden="true"></i>
                        <small class="text-muted">(1 review)</small>
                    </div>
                    <div class="mb-2">
                        <span class="old-price">Rs. 260,000</span>
                        <span class="new-price ms-2">Rs. 250,000</span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="product-card p-3 text-center">
                    <x-discount-badge discount="-6%" />
                    <div class="product-image-placeholder tall mb-3">
                        <i class="bi bi-box" aria-hidden="true"></i>
                    </div>
                    <h6 class="text-truncate">LG Refrigerator Side By Side GC-X29FFLRB</h6>
                    <div class="text-warning mb-2">
                        <i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star" aria-hidden="true"></i>
                        <small class="text-muted">(2 reviews)</small>
                    </div>
                    <div class="mb-2">
                        <span class="old-price">Rs. 320,000</span>
                        <span class="new-price ms-2">Rs. 310,000</span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="product-card p-3 text-center">
                    <x-discount-badge discount="-14%" />
                    <div class="product-image-placeholder tall mb-3">
                        <i class="bi bi-box" aria-hidden="true"></i>
                    </div>
                    <h6 class="text-truncate">Haier French Door</h6>
                    <div class="text-warning mb-2">
                        <i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-half" aria-hidden="true"></i><i class="bi bi-star" aria-hidden="true"></i>
                        <small class="text-muted">(1 review)</small>
                    </div>
                    <div class="mb-2">
                        <span class="old-price">Rs. 120,000</span>
                        <span class="new-price ms-2">Rs. 115,000</span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="product-card p-3 text-center">
                    <x-discount-badge discount="-17%" />
                    <div class="product-image-placeholder tall mb-3">
                        <i class="bi bi-box" aria-hidden="true"></i>
                    </div>
                    <h6 class="text-truncate">Pel Single Door</h6>
                    <div class="text-warning mb-2">
                        <i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i>
                        <small class="text-muted">(3 reviews)</small>
                    </div>
                    <div class="mb-2">
                        <span class="old-price">Rs. 78,000</span>
                        <span class="new-price ms-2">Rs. 65,000</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Geyser Section -->
    <section class="container-fluid py-5 bg-white" aria-label="Geysers">
        <h2 class="section-title">Geyser</h2>
        <div class="row g-3">
            <div class="col-6 col-md-3">
                <div class="product-card p-3 text-center">
                    <x-discount-badge discount="-5%" />
                    <div class="product-image-placeholder tall mb-3">
                        <i class="bi bi-droplet-fill" aria-hidden="true"></i>
                    </div>
                    <h6 class="text-truncate">Beetro Electric & Gas Geyser 55 Gallon</h6>
                    <div class="text-warning mb-2">
                        <i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star" aria-hidden="true"></i><i class="bi bi-star" aria-hidden="true"></i>
                        <small class="text-muted">(1 review)</small>
                    </div>
                    <div class="mb-2">
                        <span class="old-price">Rs. 19,500</span>
                        <span class="new-price ms-2">Rs. 18,500</span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="product-card p-3 text-center">
                    <x-discount-badge discount="-9%" />
                    <div class="product-image-placeholder tall mb-3">
                        <i class="bi bi-droplet-fill" aria-hidden="true"></i>
                    </div>
                    <h6 class="text-truncate">Nasgas Electric Geyser NEG-80</h6>
                    <div class="text-warning mb-2">
                        <i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star" aria-hidden="true"></i>
                        <small class="text-muted">(2 reviews)</small>
                    </div>
                    <div class="mb-2">
                        <span class="old-price">Rs. 30,000</span>
                        <span class="new-price ms-2">Rs. 28,000</span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="product-card p-3 text-center">
                    <x-discount-badge discount="-5%" />
                    <div class="product-image-placeholder tall mb-3">
                        <i class="bi bi-droplet-fill" aria-hidden="true"></i>
                    </div>
                    <h6 class="text-truncate">Canon Electric Geyser</h6>
                    <div class="text-warning mb-2">
                        <i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-half" aria-hidden="true"></i><i class="bi bi-star" aria-hidden="true"></i>
                        <small class="text-muted">(1 review)</small>
                    </div>
                    <div class="mb-2">
                        <span class="old-price">Rs. 37,000</span>
                        <span class="new-price ms-2">Rs. 35,000</span>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="product-card p-3 text-center">
                    <x-discount-badge discount="-9%" />
                    <div class="product-image-placeholder tall mb-3">
                        <i class="bi bi-droplet-fill" aria-hidden="true"></i>
                    </div>
                    <h6 class="text-truncate">Singer Gas Geyser</h6>
                    <div class="text-warning mb-2">
                        <i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i>
                        <small class="text-muted">(4 reviews)</small>
                    </div>
                    <div class="mb-2">
                        <span class="old-price">Rs. 24,000</span>
                        <span class="new-price ms-2">Rs. 22,000</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="container-fluid py-5" aria-label="Store features">
        <div class="row text-center feature-bar g-4 rounded bg-white shadow-sm p-4">
            <div class="col-6 col-md-3">
                <i class="bi bi-truck mb-3" aria-hidden="true"></i>
                <h6 class="fw-bold">Delivery in All Pakistan</h6>
            </div>
            <div class="col-6 col-md-3">
                <i class="bi bi-shield-check mb-3" aria-hidden="true"></i>
                <h6 class="fw-bold">7 Days Replacement Warranty</h6>
            </div>
            <div class="col-6 col-md-3">
                <i class="bi bi-headset mb-3" aria-hidden="true"></i>
                <h6 class="fw-bold">Top-Notch Support</h6>
            </div>
            <div class="col-6 col-md-3">
                <i class="bi bi-lock-fill mb-3" aria-hidden="true"></i>
                <h6 class="fw-bold">Secure payments</h6>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="container-fluid py-5 text-center" aria-label="Customer testimonials">
        <h2 class="section-title">Let customers speak for us</h2>
        <div class="text-warning mb-4">
            <i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-half" aria-hidden="true"></i>
            <span class="text-dark">from 2579 reviews</span>
        </div>

        <div id="testimonialCarousel" class="carousel slide bg-white shadow-sm p-5 rounded" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="text-warning mb-2">
                        <i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i>
                    </div>
                    <p class="lead fst-italic">"I am satisfied with their service, and their prices are also much better compared to the market."</p>
                    <h6 class="mt-3">- Qazi Sajid</h6>
                </div>
                <div class="carousel-item">
                    <div class="text-warning mb-2">
                        <i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i>
                    </div>
                    <p class="lead fst-italic">"I have purchased multiple products from Prime, kamra and online. Delivery charges are too high but service is good."</p>
                    <h6 class="mt-3">- Arif</h6>
                </div>
                <div class="carousel-item">
                    <div class="text-warning mb-2">
                        <i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i><i class="bi bi-star-fill" aria-hidden="true"></i>
                    </div>
                    <p class="lead fst-italic">"Good I will 5 star to enush ... Prime."</p>
                    <h6 class="mt-3">- Kashif raza</h6>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="prev" aria-label="Previous testimonial">
                <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next" aria-label="Next testimonial">
                <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
@endsection
