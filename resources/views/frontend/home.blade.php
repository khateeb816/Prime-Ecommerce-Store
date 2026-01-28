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
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 text-center g-4 justify-content-center">
            @forelse($categories as $category)
                <div class="col">
                     <a href="{{ route('products.category', $category->slug) }}" class="text-decoration-none text-dark">
                        <div class="category-card p-3 h-100 border rounded shadow-sm hover-effect">
                            <div class="fs-1 mb-2 text-dark">
                                <i class="bi {{ $category->icon ?: 'bi-grid-fill' }}"></i>
                            </div>
                            <h6 class="fw-bold">{{ $category->name }}</h6>
                        </div>
                     </a>
                </div>
            @empty
                <div class="col-12"><p class="text-muted">No categories available.</p></div>
            @endforelse
        </div>
    </section>

    <!-- Sale Products Section -->
    @if($saleProducts->isNotEmpty())
    <section class="container-fluid py-5 bg-white" aria-label="Sale products">
        <div class="px-3 px-md-4 px-lg-5">
            <h2 class="section-title mb-4">SAB SE BARI ASLI SALE</h2>

            <!-- Products Carousel -->
            <div id="saleProductsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                <div class="carousel-inner">
                    @foreach($saleProducts->chunk(4) as $index => $chunk)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="row g-3 g-md-4">
                                @foreach($chunk as $product)
                                    <div class="col-6 col-md-3">
                                        <x-product-card
                                            :id="$product->id"
                                            :name="$product->name"
                                            :price="$product->sale_price ?? $product->price"
                                            :oldPrice="$product->sale_price ? $product->price : null"
                                            :discount="$product->discount_percent"
                                            :image="$product->image"
                                            :rating="$product->rating ?? 0"
                                            :reviews="$product->reviews->count()"
                                            :showCart="true"
                                            :slug="$product->slug"
                                        />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#saleProductsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#saleProductsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>
    @endif


     <!-- Featured Products Section -->
    @if($featuredProducts->isNotEmpty())
    <section class="container-fluid py-5 bg-white" aria-label="Sale products">
        <div class="px-3 px-md-4 px-lg-5">
            <h2 class="section-title mb-4">FEATURED PRODUCTS</h2>

            <!-- Products Carousel -->
            <div id="saleProductsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000">
                <div class="carousel-inner">
                    @foreach($featuredProducts->chunk(4) as $index => $chunk)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="row g-3 g-md-4">
                                @foreach($chunk as $product)
                                    <div class="col-6 col-md-3">
                                        <x-product-card
                                            :id="$product->id"
                                            :name="$product->name"
                                            :price="$product->sale_price ?? $product->price"
                                            :oldPrice="$product->sale_price ? $product->price : null"
                                            :discount="$product->discount_percent"
                                            :image="$product->image"
                                            :rating="$product->rating ?? 0"
                                            :reviews="$product->reviews->count()"
                                            :showCart="true"
                                            :slug="$product->slug"
                                        />
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#saleProductsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#saleProductsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>
    @endif


    <!-- Popular Brands Section -->
    <section class="container-fluid py-5 bg-light" aria-label="Popular Brands">
        <div class="px-3 px-md-4 px-lg-5">
            <h2 class="section-title mb-4">Popular Brands</h2>

             <!-- Brands Carousel -->
            <div id="brandsCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3500">
                <div class="carousel-inner">
                    @forelse($brands->chunk(4) as $index => $chunk)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <div class="row g-3 g-md-4">
                                @foreach($chunk as $brand)
                                    <div class="col-6 col-md-3">
                                        <a href="{{ route('products.brand', $brand->slug) }}" class="text-decoration-none">
                                            <div class="brand-card p-4 text-center h-100 bg-white rounded shadow-sm">
                                                <div class="brand-icon mb-3">
                                                    @if($brand->icon)
                                                        <img src="{{ asset('storage/' . $brand->icon) }}" alt="{{ $brand->name }}" style="height: 60px; object-fit: contain;">
                                                    @else
                                                        <i class="bi bi-building" style="font-size: 60px; color: var(--brand-blue);"></i>
                                                    @endif
                                                </div>
                                                <h5 class="text-dark mb-0 fw-bold">{{ $brand->name }}</h5>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                         <div class="carousel-item active">
                            <div class="col-12"><p class="text-muted text-center">No brands feature yet.</p></div>
                        </div>
                    @endforelse
                </div>

                <!-- Carousel Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#brandsCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#brandsCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
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
    @if($reviews->isNotEmpty())
    <section class="container-fluid py-5 text-center" aria-label="Customer testimonials">
        <h2 class="section-title">Let customers speak for us</h2>

        <div id="testimonialCarousel" class="carousel slide bg-white shadow-sm p-5 rounded" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($reviews as $index => $review)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="text-warning mb-2">
                        @for($i=0; $i < $review->rating; $i++)
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                        @endfor
                    </div>
                    <p class="lead fst-italic">"{{ Str::limit($review->comment, 150) }}"</p>
                    <h6 class="mt-3">- {{ $review->user ? $review->user->name : 'Customer' }}</h6>
                </div>
                @endforeach
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
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var saleCarousel = new bootstrap.Carousel(document.getElementById('saleProductsCarousel'), {
                interval: 3500,
                ride: 'carousel'
            });
            var brandsCarousel = new bootstrap.Carousel(document.getElementById('brandsCarousel'), {
                interval: 3500,
                ride: 'carousel'
            });
        });
    </script>
@endsection
