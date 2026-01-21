@extends('frontend.layouts.app')

@section('title', $brand->name . ' - Prime')
@section('description', 'Browse ' . $brand->name . ' products at Prime. Find the latest and most searched ' . $brand->name . ' products.')
@section('keywords', $brand->name . ', products, Prime, electronics')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $brand->name }}</li>
            </ol>
        </div>
    </nav>

    <!-- Brand Header -->
    <section class="container py-4">
        <div class="row align-items-center">
            <div class="col-auto">
                 @if($brand->icon)
                    <img src="{{ asset('storage/' . $brand->icon) }}" alt="{{ $brand->name }}" style="width: 80px; height: 80px; object-fit: contain;" class="border rounded p-2 bg-white">
                @else
                    <i class="bi bi-building fs-1 text-muted"></i>
                @endif
            </div>
            <div class="col">
                <h1 class="h2 fw-bold mb-1">{{ $brand->name }}</h1>
                <p class="text-muted mb-0">Explore our collection of {{ $products->total() }} {{Str::plural('product', $products->total())}}</p>
            </div>
        </div>
    </section>

    <div class="container pb-5">
        <form action="{{ route('products.brand', $brand->slug) }}" method="GET" id="filterForm">
            <div class="row">
                <!-- Sidebar / Filters -->
                <div class="col-lg-3 mb-4 mb-lg-0">
                    <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-brand-blue text-white fw-bold">
                            <i class="bi bi-grid me-2"></i>Categories
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item {{ !request('category') ? 'bg-light fw-bold' : '' }}">
                                <a href="{{ route('products.brand', $brand->slug) }}" class="text-decoration-none text-dark d-block">
                                    All Categories
                                </a>
                            </li>
                            @foreach($categories as $cat)
                                <li class="list-group-item {{ request('category') == $cat->slug ? 'bg-light fw-bold' : '' }}">
                                    <div class="form-check m-0">
                                        <input class="form-check-input d-none" type="radio" name="category" value="{{ $cat->slug }}" id="cat_{{ $cat->id }}" {{ request('category') == $cat->slug ? 'checked' : '' }} onchange="this.form.submit()">
                                        <label class="form-check-label d-block cursor-pointer" for="cat_{{ $cat->id }}">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span>{{ $cat->name }}</span>
                                                <span class="badge bg-secondary rounded-pill">{{ $cat->products_count }}</span>
                                            </div>
                                        </label>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    @if(request('category'))
                     <div class="card shadow-sm border-0 mb-4">
                        <div class="card-header bg-brand-blue text-white fw-bold">
                            <i class="bi bi-funnel me-2"></i>Filters
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

                             <!-- Rating Filter -->
                             <div class="mb-4">
                                <h6 class="fw-bold mb-3">Rating</h6>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="rating" value="4" id="rating4" {{ request('rating') == '4' ? 'checked' : '' }} onchange="this.form.submit()">
                                    <label class="form-check-label" for="rating4">4 Stars & Up</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="rating" value="3" id="rating3" {{ request('rating') == '3' ? 'checked' : '' }} onchange="this.form.submit()">
                                    <label class="form-check-label" for="rating3">3 Stars & Up</label>
                                </div>
                            </div>

                            <!-- Dynamic Attributes Filters -->
                            @if(isset($attributes) && $attributes->isNotEmpty())
                                @foreach($attributes as $attribute)
                                    @if($attribute->unique_values && $attribute->unique_values->count() > 0)
                                        <div class="mb-4 border-top pt-3">
                                            <h6 class="fw-bold mb-3">{{ $attribute->name }}</h6>
                                            <div class="filter-scroll" style="max-height: 150px; overflow-y: auto;">
                                                @foreach($attribute->unique_values as $val)
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="checkbox" 
                                                            name="attributes[{{ $attribute->id }}][]" 
                                                            value="{{ $val }}" 
                                                            id="attr_{{ $attribute->id }}_{{ md5($val) }}"
                                                            {{ in_array($val, (array)request('attributes.'.$attribute->id, [])) ? 'checked' : '' }}
                                                            onchange="this.form.submit()">
                                                        <label class="form-check-label" for="attr_{{ $attribute->id }}_{{ md5($val) }}">
                                                            {{ $val }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endif

                             <!-- Action Buttons -->
                             <div class="d-grid gap-2 mt-4">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    Apply Filters
                                </button>
                                <a href="{{ route('products.brand', ['brand' => $brand->slug, 'category' => request('category')]) }}" class="btn btn-outline-secondary btn-sm">
                                    Reset Filters
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Products Grid -->
                <div class="col-lg-9">
                     <!-- Sorting Toolbar -->
                    <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded shadow-sm">
                        <p class="mb-0 text-muted">Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }} products</p>
                        <div class="d-flex align-items-center gap-2">
                            <label for="sort" class="me-2 text-nowrap small text-muted">Sort By:</label>
                            <select name="sort" id="sort" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                                <option value="most_searched" {{ request('sort') == 'most_searched' ? 'selected' : '' }}>Most Searched</option>
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest</option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>Rating</option>
                            </select>
                        </div>
                    </div>

                    @if($products->count() > 0)
                    <div class="row g-3 g-md-4">
                        @foreach($products as $product)
                            <div class="col-6 col-md-4">
                                <x-product-card
                                    :id="$product->id"
                                    :name="$product->name"
                                    :price="$product->is_on_sale ? $product->discounted_price : $product->price"
                                    :oldPrice="$product->is_on_sale ? $product->price : null"
                                    :discount="$product->is_on_sale ? $product->discount_percent : null"
                                    :image="$product->image"
                                    :rating="$product->rating ?? 0"
                                    :reviews="$product->reviews->count()"
                                    :showCart="true"
                                    :slug="$product->slug"
                                />
                            </div>
                        @endforeach
                    </div>
                    
                     <div class="mt-5 d-flex justify-content-center">
                        {{ $products->links() }}
                    </div>

                    @else
                        <div class="text-center py-5 bg-white rounded shadow-sm">
                            <i class="bi bi-search display-1 text-muted mb-3 d-block"></i>
                            <h3>No products matches your filters.</h3>
                            <p class="text-muted">Try removing some filters to see more products.</p>
                            <a href="{{ route('products.brand', $brand->slug) }}" class="btn btn-primary mt-3">Clear All Filters</a>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
@endsection

