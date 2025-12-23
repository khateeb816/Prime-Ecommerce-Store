@extends('frontend.layouts.app')

@section('title', $category ? 'Prime - ' . $category : 'Prime - Products')
@section('description',
    'Browse our wide selection of ' .
    ($category ?? 'products') .
    ' at Prime. Best prices and
    quality guaranteed.')
@section('keywords', $category . ', products, Prime, online shopping')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">Products</a>
                </li>
                @if ($category)
                    <li class="breadcrumb-item active" aria-current="page">{{ $category }}</li>
                @endif
            </ol>
        </div>
    </nav>

    <!-- Products Section -->
    <section class="container py-5">
        <div class="row mb-4">
            <div class="col-md-6">
                <h1 class="h2 fw-bold">{{ $category ?? 'All Products' }}</h1>
                <p class="text-muted">Showing all available products</p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="d-flex align-items-center justify-content-md-end gap-3">
                    <label for="sort" class="mb-0">Sort by:</label>
                    <select class="form-select form-select-sm" id="sort" style="width: auto;">
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                        <option>Newest First</option>
                        <option>Most Popular</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-lg-3 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-brand-blue text-white">
                        <h5 class="mb-0"><i class="bi bi-funnel me-2"></i>Filters</h5>
                    </div>
                    <div class="card-body">
                        <!-- Price Range -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Price Range</h6>
                            <div class="price-range-container">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted small">Rs. <span id="minPriceDisplay">0</span></span>
                                    <span class="text-muted small">Rs. <span id="maxPriceDisplay">500,000</span></span>
                                </div>
                                <div class="range-slider-wrapper">
                                    <input type="range" class="form-range" id="minPriceRange" min="0" max="500000"
                                        value="0" step="1000"
                                        onchange="document.getElementById('minPriceInput').value = parseInt(this.value); document.getElementById('minPriceDisplay').innerHTML = parseInt(this.value);">
                                    <input type="range" class="form-range" id="maxPriceRange" min="0" max="500000"
                                        value="500000" step="1000"
                                        onchange="document.getElementById('maxPriceInput').value = parseInt(this.value); document.getElementById('maxPriceDisplay').innerHTML = parseInt(this.value);">
                                </div>
                                <div class="d-flex gap-2 mt-3">
                                    <div class="flex-fill">
                                        <label class="form-label small text-muted">Min</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light">Rs</span>
                                            <input type="number" class="form-control" id="minPriceInput" value="0"
                                                min="0" max="500000" onchange="document.getElementById('minPriceRange').value = parseInt(this.value); document.getElementById('minPriceDisplay').innerHTML = parseInt(this.value);">
                                        </div>
                                    </div>
                                    <div class="flex-fill">
                                        <label class="form-label small text-muted">Max</label>
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-text bg-light">Rs</span>
                                            <input type="number" class="form-control" id="maxPriceInput" value="500000"
                                                min="0" max="500000" onchange="document.getElementById('maxPriceRange').value = parseInt(this.value); document.getElementById('maxPriceDisplay').innerHTML = parseInt(this.value);">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Categories Filter -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Categories</h6>
                            <div class="filter-scroll" style="max-height: 200px; overflow-y: auto;">
                                @php
                                    $categories = [
                                        'Air Conditioner',
                                        'Geyser',
                                        'Refrigerator',
                                        'Deep Freezer',
                                        'Water Dispenser',
                                        'LED TV',
                                        'Washing Machine',
                                        'Heater',
                                        'Air Fryer',
                                        'Air Cooler',
                                        'Personal Care',
                                        'Kitchen Appliances',
                                        'Iron & Garment Steamer',
                                        'Microwave Oven',
                                        'Oven Toaster',
                                    ];
                                @endphp
                                @foreach ($categories as $index => $cat)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="category{{ $index }}"
                                            name="categories[]" value="{{ $cat }}">
                                        <label class="form-check-label"
                                            for="category{{ $index }}">{{ $cat }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Brands Filter -->
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Brands</h6>
                            <div class="filter-scroll" style="max-height: 200px; overflow-y: auto;">
                                @php
                                    $brands = [
                                        'Haier',
                                        'LG',
                                        'Samsung',
                                        'Dawlance',
                                        'Philips',
                                        'Panasonic',
                                        'Orient',
                                        'Gree',
                                        'Nasgas',
                                        'Beetro',
                                        'Singer',
                                        'Canon',
                                        'TCL',
                                        'Sony',
                                        'Remington',
                                        'Braun',
                                        'Eastcool',
                                        'Kenwood',
                                        'Bosch',
                                        'Hitachi',
                                    ];
                                @endphp
                                @foreach ($brands as $index => $brand)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="brand{{ $index }}"
                                            name="brands[]" value="{{ $brand }}">
                                        <label class="form-check-label"
                                            for="brand{{ $index }}">{{ $brand }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary w-100" id="applyFilters">
                                <i class="bi bi-check-circle me-2"></i>Apply Filters
                            </button>
                            <button class="btn btn-outline-secondary w-100" id="resetFilters">
                                <i class="bi bi-arrow-counterclockwise me-2"></i>Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9">
                <div class="row g-4">
                    @for ($i = 1; $i <= 12; $i++)
                        <div class="col-md-4 col-sm-6">
                            <x-product-card name="Product Name {{ $i }}" price="45000" oldPrice="55000"
                                discount="18" />
                        </div>
                    @endfor
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation" class="mt-5">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
                    const minPriceSlider = document.getElementById('minPriceRange');
                    const maxPriceSlider = document.getElementById('maxPriceRange');
                    const minPriceInput = document.getElementById('minPriceInput');
                    const maxPriceInput = document.getElementById('maxPriceInput');
                    const minPriceDisplay = document.getElementById('minPriceDisplay');
                    const maxPriceDisplay = document.getElementById('maxPriceDisplay');
                    const wrapper = document.querySelector('.range-slider-wrapper');



                    // Format number with commas
                    function formatNumber(num) {
                        return parseInt(num).toLocaleString('en-US');
                    }




                    // Reset filters
                    document.getElementById('resetFilters').addEventListener('click', function() {
                        minPriceSlider.value = 0;
                        maxPriceSlider.value = 500000;
                        updateFromSliders();

                        // Uncheck all checkboxes
                        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                            checkbox.checked = false;
                        });
                    });

                    // Apply filters
                    document.getElementById('applyFilters').addEventListener('click', function() {
                        const selectedCategories = Array.from(document.querySelectorAll(
                            'input[name="categories[]"]:checked')).map(cb => cb.value);
                        const selectedBrands = Array.from(document.querySelectorAll(
                            'input[name="brands[]"]:checked')).map(cb => cb.value);
                        const minPrice = minPriceSlider.value;
                        const maxPrice = maxPriceSlider.value;

                        // Here you would typically make an AJAX call or form submission
                        console.log('Filters applied:', {
                            categories: selectedCategories,
                            brands: selectedBrands,
                            priceRange: {
                                min: minPrice,
                                max: maxPrice
                            }
                        });

                        // Show success message
                        alert('Filters applied successfully!');
                    });
    </script>
@endsection
