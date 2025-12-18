@extends('backend.layouts.app')

@section('title', 'Order Details | Prime Admin')
@section('page-title', 'Order Details')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="white-box">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="box-title">Order #ORD-{{ str_pad($id, 4, '0', STR_PAD_LEFT) }}</h3>
                    <select class="form-select form-select-sm" style="width: auto;" onchange="updateOrderStatus({{ $id }}, this.value)">
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="completed" selected>Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                
                <div class="mb-4">
                    <h5 class="mb-3">Customer Information</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> Customer {{ $id }}</p>
                            <p><strong>Email:</strong> customer{{ $id }}@example.com</p>
                            <p><strong>Phone:</strong> +92 300 1234567</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Order Date:</strong> {{ now()->subDays($id)->format('M d, Y h:i A') }}</p>
                            <p><strong>Payment Method:</strong> Cash on Delivery</p>
                            <p><strong>Status:</strong> <span class="badge bg-success">Completed</span></p>
                        </div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h5 class="mb-3">Shipping Address</h5>
                    <p>123 Main Street, Block A<br>Karachi, Pakistan<br>Postal Code: 75500</p>
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
                                @for($i = 1; $i <= 3; $i++)
                                    <tr>
                                        <td>Product Name {{ $i }}</td>
                                        <td>{{ $i }}</td>
                                        <td>Rs. {{ number_format(50000 + ($i * 5000)) }}</td>
                                        <td>Rs. {{ number_format((50000 + ($i * 5000)) * $i) }}</td>
                                    </tr>
                                @endfor
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">Subtotal:</th>
                                    <th>Rs. 150,000</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-end">Delivery:</th>
                                    <th class="text-success">FREE</th>
                                </tr>
                                <tr>
                                    <th colspan="3" class="text-end">Total:</th>
                                    <th class="text-danger">Rs. 150,000</th>
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
                <h5 class="mb-3">Order Timeline</h5>
                <div class="timeline">
                    <div class="timeline-item mb-3">
                        <div class="d-flex">
                            <div class="timeline-marker bg-success rounded-circle me-3" style="width: 12px; height: 12px;"></div>
                            <div>
                                <strong>Order Placed</strong>
                                <p class="text-muted small mb-0">{{ now()->subDays($id)->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item mb-3">
                        <div class="d-flex">
                            <div class="timeline-marker bg-info rounded-circle me-3" style="width: 12px; height: 12px;"></div>
                            <div>
                                <strong>Order Confirmed</strong>
                                <p class="text-muted small mb-0">{{ now()->subDays($id)->subHours(2)->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item mb-3">
                        <div class="d-flex">
                            <div class="timeline-marker bg-warning rounded-circle me-3" style="width: 12px; height: 12px;"></div>
                            <div>
                                <strong>Shipped</strong>
                                <p class="text-muted small mb-0">{{ now()->subDays($id - 1)->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="d-flex">
                            <div class="timeline-marker bg-success rounded-circle me-3" style="width: 12px; height: 12px;"></div>
                            <div>
                                <strong>Delivered</strong>
                                <p class="text-muted small mb-0">{{ now()->subDays($id - 2)->format('M d, Y h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function updateOrderStatus(orderId, status) {
        if (confirm('Are you sure you want to update the order status?')) {
            // Handle status update
            console.log('Updating order:', orderId, 'to status:', status);
        }
    }
</script>
@endpush

