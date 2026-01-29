@extends('frontend.layouts.app')

@section('title', 'Prime - My Account')
@section('description', 'Manage your Prime account')
@section('keywords', 'account, dashboard, Prime')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Account</li>
            </ol>
        </div>
    </nav>

    <section class="container py-5">
        <div class="row">
            <!-- Sidebar -->
            @include('frontend.user.partials.sidebar')

            <!-- Dashboard Content -->
            <div class="col-lg-9">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h3 fw-bold mb-0">Dashboard</h2>
                    <span class="text-muted">Welcome back, {{ auth()->user()->name }}!</span>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 border-0 shadow-sm rounded-3 hover-effect">
                            <div class="card-body text-center p-4">
                                <div class="icon-box mb-3 mx-auto bg-light text-primary rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 60px; height: 60px;">
                                    <i class="bi bi-bag-check fs-3"></i>
                                </div>
                                <h3 class="fw-bold">{{ $totalOrders }}</h3>
                                <p class="text-muted mb-0">Total Orders</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 border-0 shadow-sm rounded-3 hover-effect">
                            <div class="card-body text-center p-4">
                                <div class="icon-box mb-3 mx-auto bg-light text-danger rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 60px; height: 60px;">
                                    <i class="bi bi-heart fs-3"></i>
                                </div>
                                <h3 class="fw-bold">{{ $wishlistCount }}</h3>
                                <p class="text-muted mb-0">Wishlist Items</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100 border-0 shadow-sm rounded-3 hover-effect">
                            <div class="card-body text-center p-4">
                                <div class="icon-box mb-3 mx-auto bg-light text-warning rounded-circle d-flex align-items-center justify-content-center"
                                    style="width: 60px; height: 60px;">
                                    <i class="bi bi-star fs-3"></i>
                                </div>
                                <h3 class="fw-bold">{{ $reviewsCount }}</h3>
                                <p class="text-muted mb-0">My Reviews</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-white p-3 border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">Recent Orders</h5>
                        <a href="{{ route('user.orders') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">View
                            All</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="ps-4">Order ID</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th class="text-end pe-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentOrders as $order)
                                        <tr>
                                            <td class="ps-4 fw-bold text-primary">
                                                #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <span
                                                    class="badge rounded-pill px-3
                                                    {{ $order->status == 'delivered' ? 'bg-success' : '' }}
                                                    {{ $order->status == 'pending' ? 'bg-warning text-dark' : '' }}
                                                    {{ $order->status == 'cancelled' ? 'bg-danger' : '' }}
                                                    {{ $order->status == 'processing' ? 'bg-info text-dark' : '' }}
                                                ">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="fw-bold">Rs. {{ number_format($order->total_amount) }}</td>
                                            <td class="text-end pe-4"><a href="#" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#orderDetailsModal" 
                                                    data-order-id="{{ $order->id }}"
                                                    class="btn btn-sm btn-light text-primary"><i class="bi bi-eye"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-4 text-muted">No orders found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @include('frontend.user.partials.order_details_modal')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var orderDetailsModal = document.getElementById('orderDetailsModal');
            orderDetailsModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var orderId = button.getAttribute('data-order-id');
                var modalBody = orderDetailsModal.querySelector('#orderDetailsContent');
                
                // Show loading spinner
                modalBody.innerHTML = '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';

                // Fetch order details
                fetch('{{ url("user/orders") }}/' + orderId, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    modalBody.innerHTML = html;
                })
                .catch(error => {
                    modalBody.innerHTML = '<div class="alert alert-danger m-3">Failed to load order details. Please try again.</div>';
                    console.error('Error:', error);
                });
            });
        });
    </script>
@endsection
