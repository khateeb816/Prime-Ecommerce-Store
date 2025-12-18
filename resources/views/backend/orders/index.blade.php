@extends('backend.layouts.app')

@section('title', 'Orders | Prime Admin')
@section('page-title', 'Orders')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="box-title">
                        @if($status)
                            {{ ucfirst($status) }} Orders
                        @else
                            All Orders
                        @endif
                    </h3>
                    <div class="btn-group">
                        <a href="{{ route('backend.orders.index') }}" class="btn btn-sm {{ !$status ? 'btn-primary' : 'btn-outline-primary' }}">All</a>
                        <a href="{{ route('backend.orders.index', ['status' => 'pending']) }}" class="btn btn-sm {{ $status == 'pending' ? 'btn-warning' : 'btn-outline-warning' }}">Pending</a>
                        <a href="{{ route('backend.orders.index', ['status' => 'processing']) }}" class="btn btn-sm {{ $status == 'processing' ? 'btn-info' : 'btn-outline-info' }}">Processing</a>
                        <a href="{{ route('backend.orders.index', ['status' => 'completed']) }}" class="btn btn-sm {{ $status == 'completed' ? 'btn-success' : 'btn-outline-success' }}">Completed</a>
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Products</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 1; $i <= 20; $i++)
                                @php
                                    $statuses = ['pending', 'processing', 'completed', 'cancelled'];
                                    $orderStatus = $statuses[$i % 4];
                                    $paymentMethods = ['Cash on Delivery', 'Credit Card', 'Bank Transfer'];
                                    $paymentMethod = $paymentMethods[$i % 3];
                                @endphp
                                @if(!$status || $orderStatus == $status)
                                    <tr>
                                        <td><strong>#ORD-{{ str_pad($i, 4, '0', STR_PAD_LEFT) }}</strong></td>
                                        <td>
                                            <div>
                                                <strong>Customer {{ $i }}</strong><br>
                                                <small class="text-muted">customer{{ $i }}@example.com</small>
                                            </div>
                                        </td>
                                        <td>{{ $i }} item(s)</td>
                                        <td><strong>Rs. {{ number_format(50000 + ($i * 5000)) }}</strong></td>
                                        <td>{{ $paymentMethod }}</td>
                                        <td>
                                            @if($orderStatus == 'completed')
                                                <span class="badge bg-success">Completed</span>
                                            @elseif($orderStatus == 'processing')
                                                <span class="badge bg-info">Processing</span>
                                            @elseif($orderStatus == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @else
                                                <span class="badge bg-danger">Cancelled</span>
                                            @endif
                                        </td>
                                        <td>{{ now()->subDays($i)->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('backend.orders.show', $i) }}" class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <select class="form-select form-select-sm d-inline-block" style="width: auto;" onchange="updateOrderStatus({{ $i }}, this.value)">
                                                <option value="pending" {{ $orderStatus == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="processing" {{ $orderStatus == 'processing' ? 'selected' : '' }}>Processing</option>
                                                <option value="completed" {{ $orderStatus == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="cancelled" {{ $orderStatus == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endif
                            @endfor
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>
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

