@extends('frontend.layouts.app')

@section('title', 'Order Details - Prime')

@section('content')
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="text-decoration-none">My Account</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.orders') }}" class="text-decoration-none">My Orders</a></li>
                <li class="breadcrumb-item active" aria-current="page">Order Details</li>
            </ol>
        </div>
    </nav>

    <section class="container py-5">
        <div class="row">
            @include('frontend.user.partials.sidebar')

            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h3 fw-bold mb-0">Order #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h2>
                    <span class="badge rounded-pill px-3 py-2
                        {{ $order->status == 'delivered' ? 'bg-success' : '' }}
                        {{ $order->status == 'pending' ? 'bg-warning text-dark' : '' }}
                        {{ $order->status == 'cancelled' ? 'bg-danger' : '' }}
                        {{ $order->status == 'processing' ? 'bg-info text-dark' : '' }}
                        {{ $order->status == 'shipped' ? 'bg-primary' : '' }}
                    ">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="fw-bold mb-3 border-bottom pb-2">Shipping Information</h5>
                                <p class="mb-1"><strong>Phone:</strong> {{ $order->phone }}</p>
                                <p class="mb-0"><strong>Address:</strong><br>{!! nl2br(e($order->shipping_address)) !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body">
                                <h5 class="fw-bold mb-3 border-bottom pb-2">Payment Information</h5>
                                <p class="mb-1"><strong>Method:</strong> {{ strtoupper($order->payment_method) }}</p>
                                <p class="mb-1"><strong>Status:</strong> 
                                    <span class="text-{{ $order->payment_status == 'paid' ? 'success' : 'danger' }} fw-bold">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </p>
                                <p class="mb-0"><strong>Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0">
                    <div class="card-header bg-white border-bottom p-3">
                        <h5 class="fw-bold mb-0">Order Items</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="ps-3">Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th class="text-end pe-3">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td class="ps-3">
                                                <div class="d-flex align-items-center">
                                                    @if($item->product && $item->product->image)
                                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="rounded border me-3" style="width: 50px; height: 50px; object-fit: contain;">
                                                    @else
                                                        <div class="bg-light rounded border d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px;">
                                                            <i class="bi bi-image text-muted"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0 small fw-bold text-truncate" style="max-width: 250px;">{{ $item->product->name ?? 'Product Deleted' }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Rs. {{ number_format($item->price) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td class="text-end pe-3">Rs. {{ number_format($item->price * $item->quantity) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="3" class="text-end border-0"><strong>Subtotal</strong></td>
                                        <td class="text-end pe-3 border-0">Rs. {{ number_format($order->total_amount) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end border-0"><strong>Shipping</strong></td>
                                        <td class="text-end pe-3 border-0 text-success">FREE</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end border-0"><h5 class="fw-bold mb-0">Total</h5></td>
                                        <td class="text-end pe-3 border-0 text-danger"><h5 class="fw-bold mb-0">Rs. {{ number_format($order->total_amount) }}</h5></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button class="btn btn-outline-primary" onclick="window.print()">
                        <i class="bi bi-printer me-2"></i>Print Invoice
                    </button>
                    <a href="{{ route('user.orders') }}" class="btn btn-secondary ms-2">Back to Orders</a>
                </div>
            </div>
        </div>
    </section>

    <style>
        @media print {
            .navbar, footer, .breadcrumb, .col-lg-3, button, .btn {
                display: none !important;
            }
            .col-lg-9 {
                width: 100% !important;
            }
        }
    </style>
@endsection
