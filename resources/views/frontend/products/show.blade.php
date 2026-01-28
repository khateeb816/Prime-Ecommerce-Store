@extends('frontend.layouts.app')

@section('title', $product['name'] . ' - Prime')
@section('description', $product['description'] ?? 'View product details, specifications, and reviews at Prime.')
@section('keywords', $product['name'] . ', product details, specifications, Prime')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">Products</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product['name'] }}</li>
            </ol>
        </div>
    </nav>

    <div class="container mt-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Product Details Section -->
    <section class="container py-5">
        <div class="row">
            <!-- Product Images -->
            <div class="col-lg-6 mb-4">
                <div class="product-image-main mb-3 position-relative">
                    <div class="product-image-placeholder tall d-flex align-items-center justify-content-center bg-light border rounded"
                        style="min-height: 500px; cursor: zoom-in;">
                        <i class="bi bi-snow" style="font-size: 200px; color: var(--brand-blue);"></i>
                    </div>
                    @if ($product['discount'])
                        <span class="badge bg-danger position-absolute top-0 start-0 m-3"
                            style="font-size: 1rem; padding: 8px 12px;">{{ $product['discount'] }}% OFF</span>
                    @endif
                </div>
                <div class="product-image-thumbnails d-flex gap-2 overflow-auto pb-2">
                    @for ($i = 1; $i <= 5; $i++)
                        <div class="product-image-thumb border rounded flex-shrink-0 {{ $i === 1 ? 'border-danger border-2' : '' }}"
                            style="width: 100px; height: 100px; cursor: pointer; transition: all 0.3s;">
                            <div class="d-flex align-items-center justify-content-center h-100">
                                <i class="bi bi-snow" style="font-size: 40px; color: var(--brand-blue);"></i>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-lg-6">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <h1 class="h2 fw-bold mb-2">{{ $product['name'] }}</h1>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="text-warning">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= floor($product['rating']))
                                        <i class="bi bi-star-fill"></i>
                                    @elseif($i - 0.5 <= $product['rating'])
                                        <i class="bi bi-star-half"></i>
                                    @else
                                        <i class="bi bi-star"></i>
                                    @endif
                                @endfor
                            </div>
                            <span class="text-muted">({{ $product->rating ?? 0 }}) · {{ $product->reviews->count() }}
                                {{ $product->reviews->count() == 1 ? 'review' : 'reviews' }}</span>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button class="btn btn-sm btn-outline-secondary" title="Share">
                            <i class="bi bi-share"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger" title="Add to Wishlist">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-3">
                    <span class="badge bg-success ms-2">
                        <i class="bi bi-check-circle me-1"></i>In Stock
                    </span>
                </div>

                <div class="mb-4 p-3 bg-light rounded">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <div>
                            @if ($product['old_price'])
                                <span class="old-price d-block">Rs. {{ number_format($product['old_price']) }}</span>
                            @endif
                            <span class="new-price h4 mb-0">Rs. {{ number_format($product['price']) }}</span>
                        </div>
                        @if ($product['discount'])
                            <span class="badge bg-danger" style="font-size: 1rem; padding: 8px 12px;">Save
                                {{ $product['discount'] }}%</span>
                        @endif
                    </div>

                </div>



                <div class="mb-4">
                    <label class="fw-bold mb-2 d-block">Quantity:</label>
                    <div class="input-group" style="width: 150px;">
                        <button class="btn btn-outline-secondary" type="button" id="decreaseQty">-</button>
                        <input type="number" class="form-control text-center" id="quantity" value="1" min="1"
                            max="10">
                        <button class="btn btn-outline-secondary" type="button" id="increaseQty">+</button>
                    </div>
                </div>

                <div class="d-flex gap-3 mb-4">
                    <a href="{{ route('cart.add', $product->id) }}" class="btn btn-danger btn-lg flex-fill">
                        <i class="bi bi-cart-plus me-2"></i>Add to Cart
                    </a>
                    <a href="{{ route('cart.add', $product->id) }}?buy_now=1" class="btn btn-outline-danger btn-lg"
                        title="Buy Now">
                        <i class="bi bi-lightning-fill me-2"></i>Buy Now
                    </a>
                </div>

                <div class="card border-0 bg-light mb-4">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-6 col-md-4 text-center">
                                <i class="bi bi-truck display-6 text-primary"></i>
                                <p class="small mb-0 mt-2"><strong>Free Delivery</strong><br>On orders above Rs. 10,000</p>
                            </div>
                            <div class="col-6 col-md-4 text-center">
                                <i class="bi bi-shield-check display-6 text-success"></i>
                                <p class="small mb-0 mt-2"><strong>Warranty</strong><br>1 Year Product, 10 Years Compressor
                                </p>
                            </div>
                            <div class="col-6 col-md-4 text-center">
                                <i class="bi bi-credit-card display-6 text-info"></i>
                                <p class="small mb-0 mt-2"><strong>Payment</strong><br>Cash on Delivery Available</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="border-top pt-3">

                    <p class="mb-2">
                        <i class="bi bi-shield-check me-2 text-success"></i>
                        <strong>Warranty:</strong> 1 Year on Product, 10 Years on Compressor
                    </p>
                    <p class="mb-0">
                        <i class="bi bi-credit-card me-2 text-info"></i>
                        <strong>Payment:</strong> Cash on Delivery, Credit/Debit Cards, Bank Transfer
                    </p>
                </div>
            </div>
        </div>

        <!-- Product Tabs -->
        <div class="row mt-5">
            <div class="col-12">
                <ul class="nav nav-tabs" id="productTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                            data-bs-target="#description" type="button" role="tab">
                            Description
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="specifications-tab" data-bs-toggle="tab"
                            data-bs-target="#specifications" type="button" role="tab">
                            Specifications
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                            type="button" role="tab">
                            Reviews ({{ $product->reviews->count() }})
                        </button>
                    </li>
                </ul>
                <div class="tab-content border border-top-0 p-4" id="productTabsContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <p>{{ $product['description'] ?? 'This is a high-quality product with excellent features. It comes with a warranty and all necessary accessories. Perfect for your needs.' }}
                        </p>
                    </div>
                    <div class="tab-pane fade" id="specifications" role="tabpanel">
                        <h5 class="mb-4">Technical Specifications</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered" id="specificationTable">
                                    <thead>
                                        <tr>
                                            <th>Attribute</th>
                                            <th>Value</th>
                                        </tr>
                                    </thead>
                                    <tbody id="attribute_selector">
                                        @foreach ($product->attributeValues as $attributeValue)
                                            <tr>
                                                <td><strong>{{ $attributeValue->attribute->name }}:</strong></td>
                                                <td>{{ $attributeValue->value }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <div class="row mb-4">
                            <div class="col-md-4 text-center mb-3 mb-md-0">
                                <div class="p-4 bg-light rounded">
                                    <h2 class="display-4 fw-bold mb-2">{{ $product['rating'] }}</h2>
                                    <div class="text-warning mb-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($product['rating']))
                                                <i class="bi bi-star-fill"></i>
                                            @elseif($i - 0.5 <= $product['rating'])
                                                <i class="bi bi-star-half"></i>
                                            @else
                                                <i class="bi bi-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="text-muted mb-0">Based on {{ $product->reviews->count() }}
                                        {{ $product->reviews->count() == 1 ? 'review' : 'reviews' }}</p>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-2">
                                    <div class="d-flex align-items-center mb-1">
                                        <small class="text-nowrap me-2" style="width: 40px;">5 stars</small>
                                        <div class="progress flex-fill" style="height: 8px;">
                                            <div class="progress-bar bg-warning" style="width: 60%"></div>
                                        </div>
                                        <small class="text-muted ms-2">14</small>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex align-items-center mb-1">
                                        <small class="text-nowrap me-2" style="width: 40px;">4 stars</small>
                                        <div class="progress flex-fill" style="height: 8px;">
                                            <div class="progress-bar bg-warning" style="width: 25%"></div>
                                        </div>
                                        <small class="text-muted ms-2">6</small>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex align-items-center mb-1">
                                        <small class="text-nowrap me-2" style="width: 40px;">3 stars</small>
                                        <div class="progress flex-fill" style="height: 8px;">
                                            <div class="progress-bar bg-warning" style="width: 10%"></div>
                                        </div>
                                        <small class="text-muted ms-2">2</small>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex align-items-center mb-1">
                                        <small class="text-nowrap me-2" style="width: 40px;">2 stars</small>
                                        <div class="progress flex-fill" style="height: 8px;">
                                            <div class="progress-bar bg-warning" style="width: 5%"></div>
                                        </div>
                                        <small class="text-muted ms-2">1</small>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="d-flex align-items-center mb-1">
                                        <small class="text-nowrap me-2" style="width: 40px;">1 star</small>
                                        <div class="progress flex-fill" style="height: 8px;">
                                            <div class="progress-bar bg-warning" style="width: 0%"></div>
                                        </div>
                                        <small class="text-muted ms-2">0</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            @auth
                                <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#writeReviewModal">
                                    <i class="bi bi-pencil me-2"></i>Write a Review
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-danger">
                                    <i class="bi bi-box-arrow-in-right me-2"></i>Login to Write a Review
                                </a>
                            @endauth
                        </div>

                        @forelse($product->reviews as $review)
                            <div class="review-item border-bottom pb-4 mb-4">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <strong>{{ $review->user ? $review->user->name : 'Deleted User' }}</strong>
                                        <span class="badge bg-success ms-2">
                                            <i class="bi bi-check-circle me-1"></i>Verified Purchase
                                        </span>
                                    </div>
                                    <span class="text-warning">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                        @endfor
                                    </span>
                                </div>
                                <p class="mb-2">{{ $review->comment }}</p>

                                <div class="d-flex align-items-center gap-3 mt-2">
                                    <!-- Like Button -->
                                    <form action="{{ route('reviews.like.toggle', $review->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-sm btn-link text-decoration-none p-0 {{ $review->likes->contains('user_id', auth()->id()) ? 'text-danger' : 'text-muted' }}"
                                            title="Like">
                                            <i
                                                class="bi bi-hand-thumbs-up{{ $review->likes->contains('user_id', auth()->id()) ? '-fill' : '' }} me-1"></i>
                                            {{ $review->likes->count() }}
                                        </button>
                                    </form>

                                    <!-- Reply Toggle -->
                                    <button class="btn btn-sm btn-link text-decoration-none p-0 text-muted"
                                        onclick="document.getElementById('reply-form-{{ $review->id }}').classList.toggle('d-none')">
                                        Reply
                                    </button>
                                </div>

                                <!-- Reply Form -->
                                <div id="reply-form-{{ $review->id }}" class="mt-3 d-none">
                                    @auth
                                        <form action="{{ route('reviews.reply.store', $review->id) }}" method="POST">
                                            @csrf
                                            <div class="d-flex gap-2">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=random"
                                                    class="rounded-circle" width="32" height="32" alt="User">
                                                <div class="flex-grow-1">
                                                    <textarea name="body" class="form-control form-control-sm mb-2" rows="2" placeholder="Add a reply..."
                                                        required></textarea>
                                                    <div class="text-end">
                                                        <button type="button"
                                                            class="btn btn-sm btn-link text-muted text-decoration-none"
                                                            onclick="document.getElementById('reply-form-{{ $review->id }}').classList.add('d-none')">Cancel</button>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-primary rounded-pill px-3">Reply</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    @else
                                        <p class="small text-muted mb-0">Please <a href="{{ route('login') }}"
                                                class="text-danger">login</a> to reply.</p>
                                    @endauth
                                </div>

                                <!-- Replies List -->
                                @if ($review->replies && $review->replies->count() > 0)
                                    <div class="mt-3 ps-4 border-start">
                                        @foreach ($review->replies as $reply)
                                            <div class="d-flex gap-2 mb-3">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($reply->user->name) }}&background=random"
                                                    class="rounded-circle" width="32" height="32"
                                                    alt="{{ $reply->user->name }}">
                                                <div>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <strong class="small">
                                                            {{ $reply->user->name }}
                                                            @if (auth()->user()->role == 'admin')
                                                                <span class="badge bg-danger">Admin</span>
                                                            @endif
                                                        </strong>
                                                        <small class="text-muted"
                                                            style="font-size: 0.75rem;">{{ $reply->created_at->diffForHumans() }}</small>
                                                    </div>
                                                    <p class="small mb-0">{{ $reply->body }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="d-flex align-items-center gap-3">
                                    @if ($review->reply)
                                        <div class="ms-4 p-3 bg-light rounded border-start border-4 border-danger mt-3">
                                            <div class="fw-bold mb-1 text-danger">Response from Prime:</div>
                                            <div class="text-muted small">{{ $review->reply }}</div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="bi bi-chat-left-dots display-1 text-muted mb-3 d-block"></i>
                                <p class="text-muted">No reviews yet. Be the first to share your experience!</p>
                            </div>
                        @endforelse

                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
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
            </div>
        </div>

        <!-- Related Products Section -->
        <div class="row mt-5">
            <div class="col-12">
                <h3 class="h4 fw-bold mb-4">You May Also Like</h3>
                <div class="row g-4">
                    @forelse($relatedProducts as $related)
                        <div class="col-md-3 col-sm-6">
                            <x-product-card :id="$related->id" :name="$related->name" :price="$related->sale_price ?? $related->price" :oldPrice="$related->sale_price ? $related->price : null"
                                :icon="$related->image ? null : 'bi-box'" :image="$related->image" :rating="$related->rating ?? 0" :reviews="$related->reviews ? $related->reviews->count() : 0" :showCart="true"
                                :slug="$related->slug" />
                        </div>
                    @empty
                        <div class="col-12 text-center text-muted py-4">No related products found.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Write Review Modal -->
    <div class="modal fade" id="writeReviewModal" tabindex="-1" aria-labelledby="writeReviewModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="writeReviewModalLabel">Write a Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('products.review.store', $product->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label fw-bold">Overall Rating *</label>
                            <div class="rating-input d-flex gap-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <input type="radio" name="rating" id="rating{{ $i }}"
                                        value="{{ $i }}" class="d-none" {{ $i == 5 ? 'checked' : '' }}>
                                    <label for="rating{{ $i }}" class="text-warning cursor-pointer"
                                        style="font-size: 2.5rem;">
                                        <i class="bi bi-star-fill"></i>
                                    </label>
                                @endfor
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="reviewText" class="form-label fw-bold">Your Review *</label>
                            <textarea name="comment" class="form-control" id="reviewText" rows="5"
                                placeholder="Share your experience with this product..." required minlength="10"></textarea>
                            <div class="form-text">Minimum 10 characters.</div>
                        </div>
                        <div class="bg-light p-3 rounded mb-4">
                            <div class="d-flex align-items-center gap-2 text-muted">
                                <i class="bi bi-person-circle fs-5"></i>
                                <span>Posting as: <strong>{{ auth()->user()->name ?? '' }}</strong></span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger btn-lg w-100 py-3 shadow-sm">
                            Submit My Review
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto load on edit page
        document.addEventListener('DOMContentLoaded', function() {
            fetchBrandsAndAttributes();
        });

        // Quantity controls
        document.getElementById('increaseQty').addEventListener('click', function() {
            const qtyInput = document.getElementById('quantity');
            const currentValue = parseInt(qtyInput.value);
            if (currentValue < parseInt(qtyInput.max)) {
                qtyInput.value = currentValue + 1;
            }
        });

        document.getElementById('decreaseQty').addEventListener('click', function() {
            const qtyInput = document.getElementById('quantity');
            const currentValue = parseInt(qtyInput.value);
            if (currentValue > parseInt(qtyInput.min)) {
                qtyInput.value = currentValue - 1;
            }
        });

        // Image thumbnail click handler
        document.querySelectorAll('.product-image-thumb').forEach(function(thumb) {
            thumb.addEventListener('click', function() {
                document.querySelectorAll('.product-image-thumb').forEach(function(t) {
                    t.classList.remove('border-danger', 'border-2');
                });
                this.classList.add('border-danger', 'border-2');
            });
        });

        // Rating stars interaction
        const ratingInputs = document.querySelectorAll('input[name="rating"]');
        const labels = document.querySelectorAll('.rating-input label');

        function updateStars(rating) {
            labels.forEach(function(label, index) {
                const icon = label.querySelector('i');
                if (index < rating) {
                    icon.classList.replace('bi-star', 'bi-star-fill');
                } else {
                    icon.classList.replace('bi-star-fill', 'bi-star');
                }
            });
        }

        ratingInputs.forEach(function(radio) {
            radio.addEventListener('change', function() {
                updateStars(parseInt(this.value));
            });
        });

        labels.forEach(function(label, index) {
            label.addEventListener('mouseenter', function() {
                updateStars(index + 1);
            });

            label.addEventListener('mouseleave', function() {
                const checkedRadio = document.querySelector('input[name="rating"]:checked');
                if (checkedRadio) {
                    updateStars(parseInt(checkedRadio.value));
                }
            });
        });

        // Initialize stars on page load
        const checkedRadio = document.querySelector('input[name="rating"]:checked');
        if (checkedRadio) {
            updateStars(parseInt(checkedRadio.value));
        }
    </script>
@endsection
