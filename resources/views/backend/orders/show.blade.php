@extends('backend.layouts.app')

@section('title', 'Order Details | Prime Admin')
@section('page-title', 'Order Details')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="white-box">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="box-title">Order #ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h3>
                    <form action="{{ route('backend.orders.updateStatus', $order->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <select name="status" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </form>
                </div>
                
                <div class="mb-4">
                    <h5 class="mb-3">Customer Information</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> {{ $order->user->name ?? 'Guest' }}</p>
                            <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
                            <p><strong>Phone:</strong> {{ $order->phone ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
                            <p><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
                            <p><strong>Status:</strong> 
                                @php
                                    $badgeClass = 'bg-secondary';
                                    if($order->status == 'delivered') $badgeClass = 'bg-success';
                                    elseif($order->status == 'processing') $badgeClass = 'bg-info text-white';
                                    elseif($order->status == 'pending') $badgeClass = 'bg-warning text-dark';
                                    elseif($order->status == 'shipped') $badgeClass = 'bg-primary';
                                    elseif($order->status == 'cancelled') $badgeClass = 'bg-danger';
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ ucfirst($order->status) }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h5 class="mb-3">Shipping Address</h5>
                    <p>{!! nl2br(e($order->shipping_address)) !!}</p>
                </div>
                
                <div class="mb-4">
                    <h5 class="mb-3">Order Items</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>{{ $item->product->name ?? 'Product Deleted' }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>Rs. {{ number_format($item->price) }}</td>
                                        <td>Rs. {{ number_format($item->price * $item->quantity) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Subtotal:</th>
                                    <th>Rs. {{ number_format($order->total_amount) }}</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-end">Delivery:</th>
                                    <th class="text-success">FREE</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-end">Total:</th>
                                    <th class="text-danger">Rs. {{ number_format($order->total_amount) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                
                <div class="d-flex gap-2">
                    <a href="{{ route('backend.orders.index') }}" class="btn btn-secondary">Back to Orders</a>
                    <button class="btn btn-primary" onclick="window.print()">Print Invoice</button>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="white-box">
                <h5 class="mb-3">Order Details</h5>
                <div class="timeline">
                    <div class="timeline-item mb-3">
                        <div class="d-flex">
                            <div class="timeline-marker bg-success rounded-circle me-3" style="width: 12px; height: 12px;"></div>
                            <div>
                                <strong>Order Placed</strong>
                                <p class="text-muted small mb-0">{{ $order->created_at->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

