@extends('frontend.layouts.app')

@section('title', 'Prime - My Orders')
@section('description', 'View your order history')
@section('keywords', 'orders, order history, Prime')

@section('content')
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light py-3">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="text-decoration-none">My Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">My Orders</li>
            </ol>
        </div>
    </nav>

    <section class="container py-5">
        <div class="row">
            <!-- Sidebar -->
            @include('frontend.user.partials.sidebar')

            <div class="col-lg-9">
                <h2 class="h3 fw-bold mb-4">My Orders</h2>

                @forelse($orders as $order)
                    <div class="card mb-3 shadow-sm border-0 rounded-3">
                        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center p-3">
                            <div>
                                <strong class="text-primary">Order #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</strong>
                                <span class="text-muted ms-2 small">{{ $order->created_at->format('M d, Y h:i A') }}</span>
                            </div>
                            <span class="badge rounded-pill px-3 
                                {{ $order->status == 'delivered' ? 'bg-success' : '' }}
                                {{ $order->status == 'pending' ? 'bg-warning text-dark' : '' }}
                                {{ $order->status == 'cancelled' ? 'bg-danger' : '' }}
                                {{ $order->status == 'processing' ? 'bg-info text-dark' : '' }}
                            ">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div class="card-body p-3">
                            @foreach($order->items->take(2) as $item)
                                <div class="row align-items-center {{ !$loop->last ? 'mb-2' : '' }}">
                                    <div class="col-md-2 col-3">
                                        @if($item->product && $item->product->image)
                                             <img src="{{ asset('storage/' . $item->product->image) }}" class="img-fluid rounded border" alt="{{ $item->product->name }}" style="max-height: 60px; object-fit: contain;">
                                        @else
                                            <div class="bg-light rounded d-flex align-items-center justify-content-center border" style="height: 60px;">
                                                <i class="bi bi-image text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6 col-9">
                                        <h6 class="mb-0 text-truncate">{{ $item->product->name ?? 'Product Deleted' }}</h6>
                                        <small class="text-muted">Qty: {{ $item->quantity }} x Rs. {{ number_format($item->price) }}</small>
                                    </div>
                                    @if($loop->first)
                                        <div class="col-md-4 text-md-end mt-2 mt-md-0">
                                            <strong class="text-primary d-block">Rs. {{ number_format($order->total_amount) }}</strong>
                                            <small class="text-muted d-block">{{ $order->items->count() }} Items Total</small>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                            @if($order->items->count() > 2)
                                <div class="text-center mt-2">
                                    <small class="text-muted">+ {{ $order->items->count() - 2 }} more items</small>
                                </div>
                            @endif
                        </div>
                         <div class="card-footer bg-white border-top-0 text-end p-3">
                            <a href="#" class="btn btn-sm btn-outline-primary">View Details</a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="bi bi-bag-x display-1 text-muted"></i>
                        <h4 class="mt-3">No orders yet</h4>
                        <p class="text-muted">Start shopping to see your orders here.</p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Shop Now</a>
                    </div>
                @endforelse

                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection

