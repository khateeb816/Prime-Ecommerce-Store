@extends('frontend.layouts.app')

@section('title', 'Prime - Search Results')
@section('description', 'Search results for ' . $queryStr)
@section('keywords', 'search, products, Prime')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Search Results</li>
            </ol>
        </div>
    </nav>

    <!-- Search Results Section -->
    <section class="container py-5">
        <form action="{{ route('products.search') }}" method="GET" id="filterForm">
            <input type="hidden" name="q" value="{{ $queryStr }}">
            
            <div class="row mb-4">
                <div class="col-md-6">
                    <h1 class="h2 fw-bold">Search Results</h1>
                    @if($products->total() > 0)
                        <p class="text-muted">Found <strong>{{ $products->total() }}</strong> results for "<strong>{{ $queryStr }}</strong>"</p>
                    @endif
                </div>
                <div class="col-md-6 text-md-end">
                    <div class="d-flex align-items-center justify-content-md-end gap-3">
                        <label for="sort" class="mb-0">Sort by:</label>
                        <select class="form-select form-select-sm" id="sort" name="sort" style="width: auto;" onchange="document.getElementById('filterForm').submit()">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating</option>
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
                                <div class="d-flex gap-2">
                                    <input type="number" class="form-control form-control-sm" name="min_price" placeholder="Min" value="{{ request('min_price') }}">
                                    <input type="number" class="form-control form-control-sm" name="max_price" placeholder="Max" value="{{ request('max_price') }}">
                                </div>
                            </div>

                            <!-- Brands Filter -->
                            @if($brands->isNotEmpty())
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3">Brands</h6>
                                <div class="filter-scroll" style="max-height: 200px; overflow-y: auto;">
                                    @foreach ($brands as $brand)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="brand_{{ $brand->id }}" name="brand[]" value="{{ $brand->slug }}" {{ in_array($brand->slug, (array)request('brand', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="brand_{{ $brand->id }}">
                                                {{ $brand->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            
                            <!-- Categories Filter -->
                            @if($categories->isNotEmpty())
                            <div class="mb-4">
                                <h6 class="fw-bold mb-3">Categories</h6>
                                <div class="filter-scroll" style="max-height: 200px; overflow-y: auto;">
                                    @foreach ($categories as $cat)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" id="cat_{{ $cat->id }}" name="category" value="{{ $cat->slug }}" {{ request('category') == $cat->slug ? 'checked' : '' }}>
                                            <label class="form-check-label" for="cat_{{ $cat->id }}">
                                                {{ $cat->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Rating Filter -->
                             <div class="mb-4">
                                <h6 class="fw-bold mb-3">Rating</h6>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rating" value="4" id="rating4" {{ request('rating') == '4' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="rating4">4 Stars & Up</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rating" value="3" id="rating3" {{ request('rating') == '3' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="rating3">3 Stars & Up</label>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="bi bi-check-circle me-2"></i>Apply Filters
                                </button>
                                <a href="{{ route('products.search', ['q' => $queryStr]) }}" class="btn btn-outline-secondary w-100">
                                    <i class="bi bi-arrow-counterclockwise me-2"></i>Reset
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="col-lg-9">
                    <div class="row g-4">
                        @forelse($products as $product)
                            <div class="col-md-4 col-sm-6">
                                <x-product-card
                                    :id="$product->id"
                                    :name="$product->name"
                                    :price="$product->discounted_price ?? $product->price"
                                    :oldPrice="$product->discounted_price ? $product->price : null"
                                    :image="$product->image"
                                    :rating="$product->rating ?? 0"
                                    :reviews="$product->reviews->count()"
                                    :showCart="true"
                                    :slug="$product->slug"
                                />
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <i class="bi bi-search display-1 text-muted"></i>
                                <h3 class="mt-3">No results found for "{{ $queryStr }}"</h3>
                                <p class="text-muted">Try using different keywords or check your spelling.</p>
                                <a href="{{ route('products.index') }}" class="btn btn-primary rounded-pill px-4 mt-3">Browse All Products</a>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-5">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection

