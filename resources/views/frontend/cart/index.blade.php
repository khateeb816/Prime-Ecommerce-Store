@extends('frontend.layouts.app')

@section('title', 'Prime - Shopping Cart')
@section('description', 'View and manage your shopping cart at Prime.')
@section('keywords', 'cart, shopping cart, Prime')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
            </ol>
        </div>
    </nav>

    <!-- Cart Section -->
    <section class="container py-5">
        <h1 class="h2 fw-bold mb-4">Shopping Cart</h1>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4">Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th class="pe-4"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($cart as $id => $details)
                                        <tr data-id="{{ $id }}">
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="product-image-thumbnail border rounded" style="width: 70px; height: 70px;">
                                                        @if($details['image'])
                                                            <img src="{{ asset('storage/' . $details['image']) }}" alt="{{ $details['name'] }}" style="width: 100%; height: 100%; object-fit: contain;">
                                                        @else
                                                            <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                                                <i class="bi bi-image text-muted"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 fw-bold">{{ $details['name'] }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Rs. {{ number_format($details['price']) }}</td>
                                            <td>
                                                <div class="input-group input-group-sm" style="width: 110px;">
                                                    <button class="btn btn-outline-secondary update-cart" type="button" data-action="decrease">-</button>
                                                    <input type="number" class="form-control text-center cart-qty" value="{{ $details['quantity'] }}" min="1">
                                                    <button class="btn btn-outline-secondary update-cart" type="button" data-action="increase">+</button>
                                                </div>
                                            </td>
                                            <td class="fw-bold text-primary">Rs. {{ number_format($details['price'] * $details['quantity']) }}</td>
                                            <td class="pe-4">
                                                <button class="btn btn-sm btn-link text-danger remove-from-cart" title="Remove">
                                                    <i class="bi bi-trash fs-5"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <div class="py-4">
                                                    <i class="bi bi-cart-x display-1 text-muted"></i>
                                                    <h4 class="mt-3">Your cart is empty!</h4>
                                                    <p class="text-muted">Looks like you haven't added anything to your cart yet.</p>
                                                    <a href="{{ route('products.index') }}" class="btn btn-primary rounded-pill px-4">Shop Now</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @if(count($cart) > 0)
                    <div class="mt-4 d-flex justify-content-between align-items-center">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary rounded-pill">
                            <i class="bi bi-arrow-left me-2"></i>Continue Shopping
                        </a>
                        <a href="{{ route('cart.clear') }}" class="btn btn-link text-muted text-decoration-none">
                            <i class="bi bi-trash me-1"></i>Clear Cart
                        </a>
                    </div>
                @endif
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-white p-3 border-bottom">
                        <h5 class="mb-0 fw-bold">Order Summary</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between mb-3 text-muted">
                            <span>Subtotal:</span>
                            <span>Rs. {{ number_format($total) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3 text-muted">
                            <span>Shipping Cost:</span>
                            @if($total == 0)
                                <span>Rs. 0</span>
                            @elseif($total > 10000)
                                <span class="text-success fw-bold">FREE</span>
                            @else
                                <span>Rs. 500</span>
                            @endif
                        </div>
                        <hr class="my-4">
                        <div class="d-flex justify-content-between mb-4">
                            <span class="h5 fw-bold mb-0">Total:</span>
                            @php
                                $grandTotal = $total;
                                if($total > 0 && $total <= 10000) {
                                    $grandTotal += 500;
                                }
                            @endphp
                            <span class="h5 fw-bold mb-0 text-primary">Rs. {{ number_format($grandTotal) }}</span>
                        </div>
                        
                        <a href="{{ route('checkout.index') }}" class="btn btn-danger btn-lg w-100 rounded-pill mb-3 {{ count($cart) == 0 ? 'disabled' : '' }}">
                            Proceed to Checkout <i class="bi bi-arrow-right ms-2"></i>
                        </a>
                        
                        <div class="bg-light p-3 rounded text-center small">
                            <i class="bi bi-shield-lock me-2"></i> 100% Secure Checkout Guaranteed
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".update-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            var id = ele.parents("tr").attr("data-id");
            var quantityInput = ele.parents("tr").find(".cart-qty");
            var currentQty = parseInt(quantityInput.val());
            var action = ele.attr("data-action");

            if(action == "increase") {
                currentQty++;
            } else if(action == "decrease" && currentQty > 1) {
                currentQty--;
            } else {
                return;
            }

            $.ajax({
                url: '{{ route('cart.update') }}',
                method: "patch",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: id, 
                    quantity: currentQty
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        });

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            if(confirm("Are you sure you want to remove this item?")) {
                $.ajax({
                    url: '{{ route('cart.remove') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}', 
                        id: ele.parents("tr").attr("data-id")
                    },
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    });
</script>
@endsection

