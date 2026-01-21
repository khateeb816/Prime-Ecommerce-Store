@extends('frontend.layouts.app')

@section('title', 'Prime - My Wishlist')
@section('description', 'View and manage your wishlist items')
@section('keywords', 'wishlist, favorites, Prime')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="text-decoration-none">My Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
            </ol>
        </div>
    </nav>

    <section class="container py-5">
        <div class="row">
            <!-- Sidebar -->
            @include('frontend.user.partials.sidebar')

            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h3 fw-bold mb-0">My Wishlist</h2>
                    <span class="text-muted">{{ $wishlistItems->total() }} items</span>
                </div>

                @forelse($wishlistItems as $item)
                    @if($loop->first) <div class="row g-4 mb-4"> @endif
                        <div class="col-md-4 col-sm-6">
                            @if($item->product)
                                <div class="product-card p-3 text-center position-relative shadow-sm border rounded hover-effect h-100">
                                    {{-- Remove Button (Placeholder action) --}}
                                    <button class="btn btn-sm btn-outline-danger position-absolute top-0 end-0 m-2" style="z-index: 10;" title="Remove from wishlist">
                                        <i class="bi bi-heart-fill"></i>
                                    </button>
                                    
                                    <div class="product-image-placeholder mb-3 position-relative overflow-hidden rounded">
                                        @if($item->product->image)
                                            <img src="{{ asset('storage/' . $item->product->image) }}" class="img-fluid" alt="{{ $item->product->name }}" style="height: 150px; object-fit: contain;">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center bg-light" style="height: 150px;">
                                                <i class="bi bi-image text-muted fs-1"></i>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <h6 class="text-truncate mb-1">{{ $item->product->name }}</h6>
                                    
                                    <div class="mb-3">
                                        @if($item->product->sale_price)
                                            <span class="text-muted text-decoration-line-through me-2 small">Rs. {{ number_format($item->product->price) }}</span>
                                            <span class="text-danger fw-bold">Rs. {{ number_format($item->product->sale_price) }}</span>
                                        @else
                                            <span class="fw-bold">Rs. {{ number_format($item->product->price) }}</span>
                                        @endif
                                    </div>

                                    <div class="d-flex gap-2">
                                        <a href="#" class="btn btn-danger btn-sm flex-fill">
                                            <i class="bi bi-cart-plus me-1"></i>Add
                                        </a>
                                        <a href="{{ route('products.show', $item->product->slug ?? $item->product->id) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning">Product Unavailable</div>
                            @endif
                        </div>
                    @if($loop->last) </div> @endif
                @empty
                    <div class="card text-center py-5 shadow-sm border-0 rounded-3">
                        <div class="card-body">
                            <i class="bi bi-heart display-1 text-muted mb-3 opacity-25"></i>
                            <h4 class="mb-3">Your Wishlist is Empty</h4>
                            <p class="text-muted mb-4">Start adding products you love to your wishlist!</p>
                            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg rounded-pill px-4">
                                <i class="bi bi-arrow-left me-2"></i>Start Shopping
                            </a>
                        </div>
                    </div>
                @endforelse

                @if($wishlistItems->hasPages())
                    <div class="mt-4">
                        {{ $wishlistItems->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

