@props(['id' => null, 'name', 'oldPrice' => null, 'newPrice' => null, 'price' => null, 'discount' => null, 'icon' => 'bi-box', 'image' => null, 'rating' => 0, 'reviews' => 0, 'showCart' => false, 'tall' => false, 'slug' => null])

@php
    // Support both 'price' and 'newPrice' props
    $displayPrice = $newPrice ?? $price;
    // Generate slug from name if not provided
    $productSlug = $slug ?? strtolower(str_replace([' ', '&', '/'], ['-', 'and', '-'], $name));
@endphp

<div class="product-card p-3 text-center position-relative shadow-sm border rounded hover-effect h-100" style="cursor: pointer;" onclick="window.location.href='{{ route('products.show', $productSlug) }}'">
    @if($discount)
        <div class="sale-ribbon">{{ $discount }}% OFF</div>
    @endif
    
    <div class="product-image-placeholder mb-3 {{ $tall ? 'tall' : '' }} position-relative overflow-hidden rounded">
        @if($image)
            <img src="{{ asset('storage/' . $image) }}" alt="{{ $name }}" class="img-fluid" style="height: 100%; object-fit: contain;">
        @else
            <i class="bi {{ $icon }} display-4 text-muted"></i>
        @endif
    </div>

    <h6 class="text-truncate fw-bold mb-2">{{ $name }}</h6>
    
    @if($rating > 0 || $reviews > 0)
        <div class="text-warning mb-2 small">
            @for($i = 1; $i <= 5; $i++)
                @if($i <= floor($rating))
                    <i class="bi bi-star-fill"></i>
                @elseif($i - 0.5 <= $rating)
                    <i class="bi bi-star-half"></i>
                @else
                    <i class="bi bi-star"></i>
                @endif
            @endfor
            @if($reviews > 0)
                <span class="text-muted ms-1">({{ $reviews }})</span>
            @endif
        </div>
    @endif

    <div class="mb-3">
        @if($oldPrice)
            <span class="text-muted text-decoration-line-through small me-2">Rs. {{ number_format($oldPrice) }}</span>
        @endif
        @if($displayPrice)
            <span class="text-danger fw-bold fs-5">Rs. {{ number_format($displayPrice) }}</span>
        @endif
    </div>

    @if($showCart && $id)
        <a href="{{ route('cart.add', $id) }}" class="btn btn-danger btn-sm w-100 rounded-pill py-2" onclick="event.stopPropagation();">
            <i class="bi bi-cart-plus me-1"></i> Add to Cart
        </a>
    @elseif($showCart)
         <button class="btn btn-outline-primary btn-sm w-100 rounded-pill py-2" onclick="event.stopPropagation(); window.location.href='{{ route('products.show', $productSlug) }}'">
            View Details
        </button>
    @endif
</div>

