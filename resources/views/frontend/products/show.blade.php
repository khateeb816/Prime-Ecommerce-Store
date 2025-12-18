@extends('frontend.layouts.app')

@section('title', 'Prime - Product Details')
@section('description', 'View product details, specifications, and reviews at Prime.')
@section('keywords', 'product details, specifications, Prime')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.index') }}" class="text-decoration-none">Products</a></li>
                <li class="breadcrumb-item"><a href="{{ route('products.category', 'Air Conditioner') }}" class="text-decoration-none">Air Conditioner</a></li>
                <li class="breadcrumb-item active" aria-current="page">Haier 1.5 Ton Inverter AC</li>
            </ol>
        </div>
    </nav>

    <!-- Product Details Section -->
    <section class="container py-5">
        <div class="row">
            <!-- Product Images -->
            <div class="col-lg-6 mb-4">
                <div class="product-image-main mb-3 position-relative">
                    <div class="product-image-placeholder tall d-flex align-items-center justify-content-center bg-light border rounded" style="min-height: 500px; cursor: zoom-in;">
                        <i class="bi bi-snow" style="font-size: 200px; color: var(--brand-blue);"></i>
                    </div>
                    <span class="badge bg-danger position-absolute top-0 start-0 m-3" style="font-size: 1rem; padding: 8px 12px;">24% OFF</span>
                </div>
                <div class="product-image-thumbnails d-flex gap-2 overflow-auto pb-2">
                    @for($i = 1; $i <= 5; $i++)
                        <div class="product-image-thumb border rounded flex-shrink-0 {{ $i === 1 ? 'border-danger border-2' : '' }}" style="width: 100px; height: 100px; cursor: pointer; transition: all 0.3s;">
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
                        <h1 class="h2 fw-bold mb-2">Haier 1.5 Ton Inverter AC</h1>
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </div>
                            <span class="text-muted">(4.5) · 24 reviews</span>
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
                    <span class="text-muted">SKU: PRD-001</span>
                    <span class="badge bg-success ms-2">
                        <i class="bi bi-check-circle me-1"></i>In Stock
                    </span>
                    <span class="badge bg-info ms-2">Best Seller</span>
                </div>

                <div class="mb-4 p-3 bg-light rounded">
                    <div class="d-flex align-items-center gap-3 mb-2">
                        <div>
                            <span class="old-price d-block">Rs. 85,000</span>
                            <span class="new-price h4 mb-0">Rs. 65,000</span>
                        </div>
                        <span class="badge bg-danger" style="font-size: 1rem; padding: 8px 12px;">Save 24%</span>
                    </div>
                    <p class="text-muted small mb-0">
                        <i class="bi bi-info-circle me-1"></i>Inclusive of all taxes · Free delivery on orders above Rs. 10,000
                    </p>
                </div>

                <div class="mb-4">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-star me-2 text-warning"></i>Key Features:
                    </h5>
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                <span>Energy Efficient Inverter Technology</span>
                            </div>
                            <div class="d-flex align-items-start mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                <span>1.5 Ton Cooling Capacity</span>
                            </div>
                            <div class="d-flex align-items-start mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                <span>5 Star Energy Rating</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                <span>Wi-Fi Enabled Smart Control</span>
                            </div>
                            <div class="d-flex align-items-start mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                <span>10 Years Compressor Warranty</span>
                            </div>
                            <div class="d-flex align-items-start mb-2">
                                <i class="bi bi-check-circle-fill text-success me-2 mt-1"></i>
                                <span>Auto Clean Technology</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="fw-bold mb-2 d-block">Quantity:</label>
                    <div class="input-group" style="width: 150px;">
                        <button class="btn btn-outline-secondary" type="button" id="decreaseQty">-</button>
                        <input type="number" class="form-control text-center" id="quantity" value="1" min="1" max="10">
                        <button class="btn btn-outline-secondary" type="button" id="increaseQty">+</button>
                    </div>
                </div>

                <div class="d-flex gap-3 mb-4">
                    <button class="btn btn-danger btn-lg flex-fill">
                        <i class="bi bi-cart-plus me-2"></i>Add to Cart
                    </button>
                    <button class="btn btn-outline-danger btn-lg" title="Buy Now">
                        <i class="bi bi-lightning-fill me-2"></i>Buy Now
                    </button>
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
                                <p class="small mb-0 mt-2"><strong>Warranty</strong><br>1 Year Product, 10 Years Compressor</p>
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
                        <i class="bi bi-truck me-2 text-primary"></i>
                        <strong>Delivery:</strong> Free delivery on orders above Rs. 10,000 all over Pakistan
                    </p>
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
                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab">
                            Description
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="specifications-tab" data-bs-toggle="tab" data-bs-target="#specifications" type="button" role="tab">
                            Specifications
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews" type="button" role="tab">
                            Reviews (24)
                        </button>
                    </li>
                </ul>
                <div class="tab-content border border-top-0 p-4" id="productTabsContent">
                    <div class="tab-pane fade show active" id="description" role="tabpanel">
                        <p>Experience superior cooling with the Haier 1.5 Ton Inverter AC. This energy-efficient air conditioner features advanced inverter technology that adjusts compressor speed based on cooling requirements, resulting in significant energy savings.</p>
                        <p>The AC comes with a 5-star energy rating, making it an eco-friendly choice. With Wi-Fi connectivity, you can control your AC remotely using your smartphone. The 10-year compressor warranty ensures peace of mind for years to come.</p>
                    </div>
                    <div class="tab-pane fade" id="specifications" role="tabpanel">
                        <h5 class="mb-4">Technical Specifications</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th width="50%" class="bg-light">Cooling Capacity</th>
                                            <td>1.5 Ton</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Energy Rating</th>
                                            <td>5 Star</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Type</th>
                                            <td>Split AC</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Compressor</th>
                                            <td>Inverter</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Wi-Fi Enabled</th>
                                            <td>Yes</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Remote Control</th>
                                            <td>Yes</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th width="50%" class="bg-light">Power Consumption</th>
                                            <td>1500W</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Refrigerant</th>
                                            <td>R32</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Indoor Unit Dimensions</th>
                                            <td>80 x 30 x 20 cm</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Outdoor Unit Dimensions</th>
                                            <td>85 x 35 x 30 cm</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Warranty</th>
                                            <td>1 Year Product, 10 Years Compressor</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-light">Installation</th>
                                            <td>Professional Installation Available</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <div class="row mb-4">
                            <div class="col-md-4 text-center mb-3 mb-md-0">
                                <div class="p-4 bg-light rounded">
                                    <h2 class="display-4 fw-bold mb-2">4.5</h2>
                                    <div class="text-warning mb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    </div>
                                    <p class="text-muted mb-0">Based on 24 reviews</p>
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
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#writeReviewModal">
                                <i class="bi bi-pencil me-2"></i>Write a Review
                            </button>
                        </div>

                        <div class="review-item border-bottom pb-4 mb-4">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <strong>Ahmed Khan</strong>
                                    <span class="badge bg-success ms-2">
                                        <i class="bi bi-check-circle me-1"></i>Verified Purchase
                                    </span>
                                </div>
                                <span class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </span>
                            </div>
                            <p class="mb-2">Excellent product! Very energy efficient and cools the room quickly. The Wi-Fi feature is amazing - I can control it from my phone. Installation was professional and quick. Highly recommended!</p>
                            <div class="d-flex align-items-center gap-3">
                                <small class="text-muted">
                                    <i class="bi bi-calendar me-1"></i>2 days ago
                                </small>
                                <button class="btn btn-sm btn-link p-0 text-decoration-none">
                                    <i class="bi bi-hand-thumbs-up me-1"></i>Helpful (12)
                                </button>
                            </div>
                        </div>

                        <div class="review-item border-bottom pb-4 mb-4">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <strong>Fatima Ali</strong>
                                </div>
                                <span class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star"></i>
                                </span>
                            </div>
                            <p class="mb-2">Good value for money. The AC works perfectly and the energy consumption is low. Installation was quick and professional. The only minor issue is the remote control could be better.</p>
                            <div class="d-flex align-items-center gap-3">
                                <small class="text-muted">
                                    <i class="bi bi-calendar me-1"></i>1 week ago
                                </small>
                                <button class="btn btn-sm btn-link p-0 text-decoration-none">
                                    <i class="bi bi-hand-thumbs-up me-1"></i>Helpful (8)
                                </button>
                            </div>
                        </div>

                        <div class="review-item border-bottom pb-4 mb-4">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <div>
                                    <strong>Muhammad Hassan</strong>
                                    <span class="badge bg-success ms-2">
                                        <i class="bi bi-check-circle me-1"></i>Verified Purchase
                                    </span>
                                </div>
                                <span class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </span>
                            </div>
                            <p class="mb-2">Great AC with excellent cooling. The inverter technology really saves electricity. Customer service was responsive when I had questions.</p>
                            <div class="d-flex align-items-center gap-3">
                                <small class="text-muted">
                                    <i class="bi bi-calendar me-1"></i>2 weeks ago
                                </small>
                                <button class="btn btn-sm btn-link p-0 text-decoration-none">
                                    <i class="bi bi-hand-thumbs-up me-1"></i>Helpful (5)
                                </button>
                            </div>
                        </div>

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
                    @for($i = 1; $i <= 4; $i++)
                        <div class="col-md-3 col-sm-6">
                            <x-product-card
                                name="Related Product {{ $i }}"
                                price="{{ 60000 + ($i * 5000) }}"
                                oldPrice="{{ 75000 + ($i * 5000) }}"
                                discount="{{ 15 + $i }}"
                                icon="bi-snow"
                                :rating="4.5"
                                :reviews="20 + $i"
                                :showCart="true"
                                slug="related-product-{{ $i }}"
                            />
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </section>

    <!-- Write Review Modal -->
    <div class="modal fade" id="writeReviewModal" tabindex="-1" aria-labelledby="writeReviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="writeReviewModalLabel">Write a Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Rating *</label>
                            <div class="rating-input">
                                <input type="radio" name="rating" id="rating5" value="5" class="d-none">
                                <label for="rating5" class="text-warning" style="cursor: pointer; font-size: 1.5rem;">
                                    <i class="bi bi-star"></i>
                                </label>
                                <input type="radio" name="rating" id="rating4" value="4" class="d-none">
                                <label for="rating4" class="text-warning" style="cursor: pointer; font-size: 1.5rem;">
                                    <i class="bi bi-star"></i>
                                </label>
                                <input type="radio" name="rating" id="rating3" value="3" class="d-none">
                                <label for="rating3" class="text-warning" style="cursor: pointer; font-size: 1.5rem;">
                                    <i class="bi bi-star"></i>
                                </label>
                                <input type="radio" name="rating" id="rating2" value="2" class="d-none">
                                <label for="rating2" class="text-warning" style="cursor: pointer; font-size: 1.5rem;">
                                    <i class="bi bi-star"></i>
                                </label>
                                <input type="radio" name="rating" id="rating1" value="1" class="d-none">
                                <label for="rating1" class="text-warning" style="cursor: pointer; font-size: 1.5rem;">
                                    <i class="bi bi-star"></i>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="reviewTitle" class="form-label">Review Title</label>
                            <input type="text" class="form-control" id="reviewTitle" placeholder="Give your review a title">
                        </div>
                        <div class="mb-3">
                            <label for="reviewText" class="form-label">Your Review *</label>
                            <textarea class="form-control" id="reviewText" rows="5" placeholder="Share your experience with this product..." required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="reviewerName" class="form-label">Your Name *</label>
                            <input type="text" class="form-control" id="reviewerName" required>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">Submit Review</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
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
        document.querySelectorAll('input[name="rating"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                const rating = parseInt(this.value);
                const labels = document.querySelectorAll('.rating-input label');
                labels.forEach(function(label, index) {
                    if (index < rating) {
                        label.querySelector('i').classList.remove('bi-star');
                        label.querySelector('i').classList.add('bi-star-fill');
                    } else {
                        label.querySelector('i').classList.remove('bi-star-fill');
                        label.querySelector('i').classList.add('bi-star');
                    }
                });
            });
        });
    </script>
@endsection

