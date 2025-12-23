@extends('frontend.layouts.app')

@section('title', 'Prime - Home')
@section('description', 'Prime - Your trusted electronics store. Shop the latest home appliances, kitchen electronics, and more at the best prices in Pakistan.')
@section('keywords', 'electronics, home appliances, kitchen appliances, Prime, online shopping, Pakistan')

@section('content')
    <!-- Hero Banner Carousel Section -->
    <section class="hero-banner" aria-label="Hero banner carousel">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-indicators mt-3">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <img src="https://plus.unsplash.com/premium_photo-1701590725747-ac131d4dcffd?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8d2Vic2l0ZSUyMGJhbm5lcnxlbnwwfHwwfHx8MA%3D%3D" class="d-block w-100" alt="Banner 1">
                </div>
                <!-- Slide 2 -->
                <div class="carousel-item">
                    <img src="https://plus.unsplash.com/premium_photo-1701590725747-ac131d4dcffd?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8d2Vic2l0ZSUyMGJhbm5lcnxlbnwwfHwwfHx8MA%3D%3D" class="d-block w-100" alt="Banner 2">
                </div>
                <!-- Slide 3 -->
                <div class="carousel-item">
                    <img src="https://plus.unsplash.com/premium_photo-1701590725747-ac131d4dcffd?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8d2Vic2l0ZSUyMGJhbm5lcnxlbnwwfHwwfHx8MA%3D%3D" class="d-block w-100" alt="Banner 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" aria-label="Previous slide">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" aria-label="Next slide">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- All Categories Section -->
    <section class="container-fluid py-5" aria-label="Product categories">
        <h2 class="section-title">ALL CATEGORIES</h2>
        <div class="row text-center g-4">
            <x-category-item name="Air Conditioners" icon="bi-snow" />
            <x-category-item name="LED TVs" icon="bi-tv" />
            <x-category-item name="Built In Ovens" icon="bi-thermometer-high" />
            <x-category-item name="Refrigerators" icon="bi-thermometer-snow" />
            <x-category-item name="Washing Machines" icon="bi-arrow-repeat" />
            <x-category-item name="Water Dispensers" icon="bi-droplet-fill" />
            <x-category-item name="Air Coolers" icon="bi-wind" />
            <x-category-item name="Air Fryers" icon="bi-lightning-fill" />
            <x-category-item name="Deep Freezers" icon="bi-snow" />
            <x-category-item name="Kitchen Hoods" icon="bi-fan" />
            <x-category-item name="Kitchen Hobs" icon="bi-fire" />
            <x-category-item name="Kitchen Appliances" icon="bi-app" />
        </div>
    </section>

    <!-- Sale Products Section -->
    <section class="container-fluid py-5 bg-white" aria-label="Sale products">
        <div class="px-3 px-md-4 px-lg-5">
            <h2 class="section-title mb-4">SAB SE BARI ASLI SALE</h2>

            <!-- Products Carousel -->
            <div id="saleProductsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div class="row g-3 g-md-4">
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
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <div class="row g-3 g-md-4">
                            <div class="col-6 col-md-3">
                                <x-product-card
                                    name="Haier Refrigerator 300L"
                                    oldPrice="85000"
                                    newPrice="68000"
                                    discount="20"
                                    icon="bi-snow"
                                    :showCart="true"
                                />
                            </div>
                            <div class="col-6 col-md-3">
                                <x-product-card
                                    name="LG Washing Machine 8kg"
                                    oldPrice="95000"
                                    newPrice="75000"
                                    discount="21"
                                    icon="bi-droplet"
                                    :showCart="true"
                                />
                            </div>
                            <div class="col-6 col-md-3">
                                <x-product-card
                                    name="Samsung LED TV 43 inch"
                                    oldPrice="120000"
                                    newPrice="95000"
                                    discount="21"
                                    icon="bi-tv"
                                    :showCart="true"
                                />
                            </div>
                            <div class="col-6 col-md-3">
                                <x-product-card
                                    name="Orient Air Cooler"
                                    oldPrice="25000"
                                    newPrice="18000"
                                    discount="28"
                                    icon="bi-wind"
                                    :showCart="true"
                                />
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="carousel-item">
                        <div class="row g-3 g-md-4">
                            <div class="col-6 col-md-3">
                                <x-product-card
                                    name="Dawlance Deep Freezer"
                                    oldPrice="55000"
                                    newPrice="42000"
                                    discount="24"
                                    icon="bi-snow"
                                    :showCart="true"
                                />
                            </div>
                            <div class="col-6 col-md-3">
                                <x-product-card
                                    name="Gree 1 Ton AC"
                                    oldPrice="90000"
                                    newPrice="72000"
                                    discount="20"
                                    icon="bi-snow"
                                    :showCart="true"
                                />
                            </div>
                            <div class="col-6 col-md-3">
                                <x-product-card
                                    name="Haier Microwave Oven"
                                    oldPrice="18000"
                                    newPrice="14000"
                                    discount="22"
                                    icon="bi-fire"
                                    :showCart="true"
                                />
                            </div>
                            <div class="col-6 col-md-3">
                                <x-product-card
                                    name="Philips Blender"
                                    oldPrice="12000"
                                    newPrice="9500"
                                    discount="21"
                                    icon="bi-lightning"
                                    :showCart="true"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#saleProductsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#saleProductsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

                <!-- Carousel Indicators -->
                <div class="carousel-indicators mt-3">
                    <button type="button" data-bs-target="#saleProductsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#saleProductsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#saleProductsCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
            </div>
        </div>
    </section>



    <!-- Popular Brands Section -->
    <section class="container-fluid py-5 bg-white" aria-label="Popular Brands">
        <div class="px-3 px-md-4 px-lg-5">
            <h2 class="section-title mb-4">Popular Brands</h2>

            <!-- Brands Carousel -->
            <div id="brandsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3500">
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div class="row g-3 g-md-4">
                            @php
                                $brands1 = [
                                    ['name' => 'Haier', 'slug' => 'haier-ac', 'icon' => 'bi-building'],
                                    ['name' => 'LG', 'slug' => 'lg-ac', 'icon' => 'bi-building'],
                                    ['name' => 'Samsung', 'slug' => 'samsung-tv', 'icon' => 'bi-building'],
                                    ['name' => 'Dawlance', 'slug' => 'dawlance-refrigerator', 'icon' => 'bi-building'],
                                ];
                            @endphp
                            @foreach($brands1 as $brand)
                                <div class="col-6 col-md-3">
                                    <a href="{{ route('products.brand', $brand['slug']) }}" class="text-decoration-none">
                                        <div class="brand-card p-4 text-center h-100">
                                            <div class="brand-icon mb-3">
                                                <i class="bi {{ $brand['icon'] }}" style="font-size: 60px; color: var(--brand-blue);"></i>
                                            </div>
                                            <h5 class="text-dark mb-0 fw-bold">{{ $brand['name'] }}</h5>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <div class="row g-3 g-md-4">
                            @php
                                $brands2 = [
                                    ['name' => 'Philips', 'slug' => 'philips-iron', 'icon' => 'bi-building'],
                                    ['name' => 'Panasonic', 'slug' => 'panasonic-iron', 'icon' => 'bi-building'],
                                    ['name' => 'Orient', 'slug' => 'orient-ac', 'icon' => 'bi-building'],
                                    ['name' => 'Gree', 'slug' => 'gree-ac', 'icon' => 'bi-building'],
                                ];
                            @endphp
                            @foreach($brands2 as $brand)
                                <div class="col-6 col-md-3">
                                    <a href="{{ route('products.brand', $brand['slug']) }}" class="text-decoration-none">
                                        <div class="brand-card p-4 text-center h-100">
                                            <div class="brand-icon mb-3">
                                                <i class="bi {{ $brand['icon'] }}" style="font-size: 60px; color: var(--brand-blue);"></i>
                                            </div>
                                            <h5 class="text-dark mb-0 fw-bold">{{ $brand['name'] }}</h5>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="carousel-item">
                        <div class="row g-3 g-md-4">
                            @php
                                $brands3 = [
                                    ['name' => 'Nasgas', 'slug' => 'nasgas-geyser', 'icon' => 'bi-building'],
                                    ['name' => 'Beetro', 'slug' => 'beetro-geyser', 'icon' => 'bi-building'],
                                    ['name' => 'Singer', 'slug' => 'singer-geyser', 'icon' => 'bi-building'],
                                    ['name' => 'Canon', 'slug' => 'canon-geyser', 'icon' => 'bi-building'],
                                ];
                            @endphp
                            @foreach($brands3 as $brand)
                                <div class="col-6 col-md-3">
                                    <a href="{{ route('products.brand', $brand['slug']) }}" class="text-decoration-none">
                                        <div class="brand-card p-4 text-center h-100">
                                            <div class="brand-icon mb-3">
                                                <i class="bi {{ $brand['icon'] }}" style="font-size: 60px; color: var(--brand-blue);"></i>
                                            </div>
                                            <h5 class="text-dark mb-0 fw-bold">{{ $brand['name'] }}</h5>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Slide 4 -->
                    <div class="carousel-item">
                        <div class="row g-3 g-md-4">
                            @php
                                $brands4 = [
                                    ['name' => 'TCL', 'slug' => 'tcl-tv', 'icon' => 'bi-building'],
                                    ['name' => 'Sony', 'slug' => 'sony-tv', 'icon' => 'bi-building'],
                                    ['name' => 'Remington', 'slug' => 'remington-personal-care', 'icon' => 'bi-building'],
                                    ['name' => 'Braun', 'slug' => 'braun-personal-care', 'icon' => 'bi-building'],
                                ];
                            @endphp
                            @foreach($brands4 as $brand)
                                <div class="col-6 col-md-3">
                                    <a href="{{ route('products.brand', $brand['slug']) }}" class="text-decoration-none">
                                        <div class="brand-card p-4 text-center h-100">
                                            <div class="brand-icon mb-3">
                                                <i class="bi {{ $brand['icon'] }}" style="font-size: 60px; color: var(--brand-blue);"></i>
                                            </div>
                                            <h5 class="text-dark mb-0 fw-bold">{{ $brand['name'] }}</h5>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#brandsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#brandsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

                <!-- Carousel Indicators -->
                <div class="carousel-indicators mt-3">
                    <button type="button" data-bs-target="#brandsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#brandsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#brandsCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#brandsCarousel" data-bs-slide-to="3" aria-label="Slide 4"></button>
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
