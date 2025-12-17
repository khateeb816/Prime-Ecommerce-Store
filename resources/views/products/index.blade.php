@extends('layouts.app')

@section('title', $category ? 'Prime - ' . $category : 'Prime - Products')
@section('description', 'Browse our wide selection of ' . ($category ?? 'products') . ' at Prime. Best prices and quality guaranteed.')
@section('keywords', $category . ', products, Prime, online shopping')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">Products</a></li>
                @if($category)
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
                <div class="card">
                    <div class="card-header bg-brand-blue text-white">
                        <h5 class="mb-0">Filters</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Price Range</h6>
                            <div class="input-group mb-2">
                                <span class="input-group-text">Rs</span>
                                <input type="number" class="form-control" placeholder="Min">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Rs</span>
                                <input type="number" class="form-control" placeholder="Max">
                            </div>
                        </div>
                        <div class="mb-4">
                            <h6 class="fw-bold mb-3">Brand</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="brand1">
                                <label class="form-check-label" for="brand1">Haier</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="brand2">
                                <label class="form-check-label" for="brand2">LG</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="brand3">
                                <label class="form-check-label" for="brand3">Samsung</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="brand4">
                                <label class="form-check-label" for="brand4">Dawlance</label>
                            </div>
                        </div>
                        <button class="btn btn-primary w-100">Apply Filters</button>
                        <button class="btn btn-outline-secondary w-100 mt-2">Reset</button>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9">
                <div class="row g-4">
                    @for($i = 1; $i <= 12; $i++)
                        <div class="col-md-4 col-sm-6">
                            <x-product-card
                                name="Product Name {{ $i }}"
                                price="45000"
                                oldPrice="55000"
                                discount="18"
                            />
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
@endsection

