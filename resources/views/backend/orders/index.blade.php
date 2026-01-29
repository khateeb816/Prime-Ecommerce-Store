@extends('backend.layouts.app')

@section('title', 'Orders | Prime Admin')
@section('page-title', 'Orders')

@section('content')
@php
    $status = request()->get('status');
@endphp

    <div class="row">
        <div class="col-lg-12">
            <div class="white-box">
                <div class="mb-4">
                    <form action="{{ route('backend.orders.index') }}" method="GET" class="p-3 bg-light rounded shadow-sm border">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="search" class="form-label small fw-bold">Search</label>
                                <input type="text" class="form-control form-control-sm" id="search" name="search" value="{{ request('search') }}" placeholder="Order ID, Name, Email">
                            </div>
                            <div class="col-md-2">
                                <label for="status" class="form-label small fw-bold">Status</label>
                                <select class="form-select form-select-sm" id="status" name="status">
                                    <option value="">All Statuses</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="payment_status" class="form-label small fw-bold">Payment</label>
                                <select class="form-select form-select-sm" id="payment_status" name="payment_status">
                                    <option value="">All</option>
                                    <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                                    <option value="unpaid" {{ request('payment_status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                    <option value="cod" {{ request('payment_status') == 'cod' ? 'selected' : '' }}>COD</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="start_date" class="form-label small fw-bold">Start Date</label>
                                <input type="date" class="form-control form-control-sm" id="start_date" name="start_date" value="{{ request('start_date') }}">
                            </div>
                            <div class="col-md-2">
                                <label for="end_date" class="form-label small fw-bold">End Date</label>
                                <input type="date" class="form-control form-control-sm" id="end_date" name="end_date" value="{{ request('end_date') }}">
                            </div>
                            <div class="col-md-1 d-flex align-items-end">
                                <div class="w-100">
                                    <button type="submit" class="btn btn-primary btn-sm w-100"><i class="bi bi-filter"></i></button>
                                </div>
                            </div>
                        </div>
                        @if(request()->anyFilled(['search', 'status', 'payment_status', 'start_date', 'end_date']))
                            <div class="mt-2">
                                <a href="{{ route('backend.orders.index') }}" class="small text-danger text-decoration-none"><i class="bi bi-x-circle"></i> Clear Filters</a>
                            </div>
                        @endif
                    </form>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="box-title">
                        @if(request('status'))
                             {{ ucfirst(request('status')) }} Orders
                        @elseif(request('search'))
                            Search Results
                        @else
                            All Orders
                        @endif
                    </h3>
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

