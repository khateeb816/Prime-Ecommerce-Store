@props(['name', 'oldPrice', 'newPrice', 'discount' => null, 'icon' => 'bi-box', 'rating' => 0, 'reviews' => 0, 'showCart' => false, 'tall' => false])

<div class="product-card p-3 text-center">
    @if($discount)
        <div class="sale-ribbon">{{ $discount }}% OFF</div>
    @endif
    <div class="product-image-placeholder mb-3 {{ $tall ? 'tall' : '' }}">
        <i class="bi {{ $icon }}"></i>
    </div>
    <h6 class="text-truncate">{{ $name }}</h6>
    @if($rating > 0)
        <div class="text-warning mb-2">
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
                <small class="text-muted">({{ $reviews }} {{ $reviews == 1 ? 'review' : 'reviews' }})</small>
            @endif
        </div>
    @endif
    <div class="mb-2">
        @if($oldPrice)
            <span class="old-price">Rs. {{ number_format($oldPrice) }}</span>
        @endif
        <span class="new-price ms-2">Rs. {{ number_format($newPrice) }}</span>
    </div>
    @if($showCart)
        <button class="add-to-cart-btn">Add to Cart</button>
    @endif
</div>

