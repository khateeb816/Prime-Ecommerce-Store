@extends('backend.layouts.app')

@section('title', 'Dashboard | Prime Admin')
@section('page-title', 'Dashboard')

@section('content')
    <!-- Analytics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="white-box mb-0 h-100">
                <div class="analytics-content">
                    <h5 class="text-muted small text-uppercase fw-bold mb-3">Total Products</h5>
                    <h2 class="fw-bold mb-2"><span class="counter">1,250</span></h2>
                    <span class="text-success small fw-bold"><i class="bi bi-arrow-up me-1"></i>+15%</span>
                    <div class="progress mt-3">
                        <div class="progress-bar" role="progressbar" style="width:75%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="white-box mb-0 h-100">
                <div class="analytics-content">
                    <h5 class="text-muted small text-uppercase fw-bold mb-3">Total Orders</h5>
                    <h2 class="fw-bold mb-2"><span class="counter">850</span></h2>
                    <span class="text-success small fw-bold"><i class="bi bi-arrow-up me-1"></i>+8%</span>
                    <div class="progress mt-3">
                        <div class="progress-bar" role="progressbar" style="width:60%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="white-box mb-0 h-100">
                <div class="analytics-content">
                    <h5 class="text-muted small text-uppercase fw-bold mb-3">Total Revenue</h5>
                    <h2 class="fw-bold mb-2">Rs. <span class="counter">2,500,000</span></h2>
                    <span class="text-success small fw-bold"><i class="bi bi-arrow-up me-1"></i>+25%</span>
                    <div class="progress mt-3">
                        <div class="progress-bar" role="progressbar" style="width:85%;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="white-box mb-0 h-100">
                <div class="analytics-content">
                    <h5 class="text-muted small text-uppercase fw-bold mb-3">Total Customers</h5>
                    <h2 class="fw-bold mb-2"><span class="counter">3,200</span></h2>
                    <span class="text-success small fw-bold"><i class="bi bi-arrow-up me-1"></i>+12%</span>
                    <div class="progress mt-3">
                        <div class="progress-bar" role="progressbar" style="width:70%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="white-box">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
            <h3 class="box-title mb-0">Recent Orders</h3>
            <a href="{{ route('backend.orders.index') }}" class="btn btn-sm btn-primary px-4">View All</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th class="ps-0">Order ID</th>
                        <th>Customer</th>
                        <th>Products</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end pe-0">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-0 fw-bold">#ORD-0001</td>
                        <td>Customer 1</td>
                        <td>1 item(s)</td>
                        <td>Rs. 55,000</td>
                        <td><span class="badge bg-warning rounded-pill px-3">Pending</span></td>
                        <td>Dec 17, 2025</td>
                        <td class="text-end pe-0">
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="bi bi-eye"></i> View
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td class="ps-0 fw-bold">#ORD-0002</td>
                        <td>Customer 2</td>
                        <td>2 item(s)</td>
                        <td>Rs. 60,000</td>
                        <td><span class="badge bg-info rounded-pill px-3">Processing</span></td>
                        <td>Dec 16, 2025</td>
                        <td class="text-end pe-0">
                            <a href="#" class="btn btn-sm btn-primary">
                                <i class="bi bi-eye"></i> View
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    // Counter animation
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.counter').forEach(function(counter) {
            const text = counter.textContent;
            const number = parseInt(text.replace(/[^0-9]/g, ''));
            const hasComma = text.includes(',');
            const prefix = text.match(/^[^0-9]*/)?.[0] || '';
            const suffix = text.match(/[^0-9]*$/)?.[0] || '';

            let current = 0;
            const increment = number / 50;
            const duration = 2000;
            const stepTime = duration / 50;

            const timer = setInterval(function() {
                current += increment;
                if (current >= number) {
                    counter.textContent = prefix + (hasComma ? number.toLocaleString() : number) + suffix;
                    clearInterval(timer);
                } else {
                    const displayNum = Math.floor(current);
                    counter.textContent = prefix + (hasComma ? displayNum.toLocaleString() : displayNum) + suffix;
                }
            }, stepTime);
        });
    });
</script>
@endpush

