<div class="p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h6 class="text-muted mb-1">Order ID</h6>
            <h4 class="fw-bold mb-0 text-primary">#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</h4>
        </div>
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
            <div class="p-3 bg-light rounded-3 h-100 border">
                <h6 class="fw-bold mb-3 text-secondary text-uppercase small">Shipping Information</h6>
                <p class="mb-1"><i class="bi bi-telephone me-2 text-muted"></i>{{ $order->phone }}</p>
                <p class="mb-0 d-flex"><i class="bi bi-geo-alt me-2 text-muted mt-1"></i><span>{!! nl2br(e($order->shipping_address)) !!}</span></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="p-3 bg-light rounded-3 h-100 border">
                <h6 class="fw-bold mb-3 text-secondary text-uppercase small">Payment Details</h6>
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

    <div class="card shadow-sm border-0 mb-3">
        <div class="card-header bg-white border-bottom p-3">
            <h6 class="fw-bold mb-0">Items</h6>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3 border-0">Product</th>
                        <th class="border-0">Price</th>
                        <th class="border-0">Qty</th>
                        <th class="text-end pe-3 border-0">Total</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @foreach($order->items as $item)
                        <tr>
                            <td class="ps-3">
                                <div class="d-flex align-items-center">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="rounded border me-3" style="width: 40px; height: 40px; object-fit: contain;">
                                    @else
                                        <div class="bg-light rounded border d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <span class="d-block text-truncate fw-semibold" style="max-width: 150px;">{{ $item->product->name ?? 'Product Deleted' }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>Rs. {{ number_format($item->price) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td class="text-end pe-3 fw-bold">Rs. {{ number_format($item->price * $item->quantity) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-end">
        <div class="text-end" style="min-width: 200px;">
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Subtotal:</span>
                <span class="fw-bold">Rs. {{ number_format($order->total_amount) }}</span>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <span class="text-muted">Shipping:</span>
                <span class="text-success fw-bold">FREE</span>
            </div>
            <hr class="my-2">
            <div class="d-flex justify-content-between">
                <span class="h5 fw-bold mb-0">Total:</span>
                <span class="h5 fw-bold text-primary mb-0">Rs. {{ number_format($order->total_amount) }}</span>
            </div>
        </div>
    </div>
</div>
