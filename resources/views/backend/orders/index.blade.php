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
                            @forelse($orders as $order)
                                <tr>
                                    <td><strong>#ORD-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</strong></td>
                                    <td>
                                        <div>
                                            <strong>{{ $order->user->name ?? 'Guest' }}</strong><br>
                                            <small class="text-muted">{{ $order->user->email ?? '' }}</small>
                                        </div>
                                    </td>
                                    <td>{{ $order->items->count() }} item(s)</td>
                                    <td><strong>Rs. {{ number_format($order->total_amount) }}</strong></td>
                                    <td>{{ strtoupper($order->payment_method) }}</td>
                                    <td>
                                        @php
                                            $badgeClass = 'bg-secondary';
                                            if($order->status == 'delivered') $badgeClass = 'bg-success';
                                            elseif($order->status == 'processing') $badgeClass = 'bg-info';
                                            elseif($order->status == 'pending') $badgeClass = 'bg-warning text-dark';
                                            elseif($order->status == 'shipped') $badgeClass = 'bg-primary';
                                            elseif($order->status == 'cancelled') $badgeClass = 'bg-danger';
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">{{ ucfirst($order->status) }}</span>
                                    </td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="d-flex gap-2 align-items-center">
                                            <a href="{{ route('backend.orders.show', $order->id) }}" class="btn btn-sm btn-info text-white">
                                                <i class="bi bi-eye"></i>
                                            </a>
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
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<style>
    .bg-info { background-color: #0dcaf0 !important; }
</style>
@endpush

