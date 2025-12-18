@extends('backend.layouts.app')

@section('title', 'Dashboard | Prime Admin')
@section('page-title', 'Dashboard')

@section('content')
    <!-- Analytics Cards -->
    <div class="analytics-sparkle-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line reso-mg-b-30">
                        <div class="analytics-content">
                            <h5>Total Products</h5>
                            <h2><span class="counter">1,250</span></h2>
                            <span class="text-success">+15%</span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-success" role="progressbar" style="width:75%;"> <span class="sr-only">75% Complete</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line reso-mg-b-30">
                        <div class="analytics-content">
                            <h5>Total Orders</h5>
                            <h2><span class="counter">850</span></h2>
                            <span class="text-success">+8%</span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-success" role="progressbar" style="width:60%;"> <span class="sr-only">60% Complete</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line reso-mg-b-30 table-mg-t-pro dk-res-t-pro-30">
                        <div class="analytics-content">
                            <h5>Total Revenue</h5>
                            <h2>Rs. <span class="counter">2,500,000</span></h2>
                            <span class="text-success">+25%</span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-success" role="progressbar" style="width:85%;"> <span class="sr-only">85% Complete</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="analytics-sparkle-line table-mg-t-pro dk-res-t-pro-30">
                        <div class="analytics-content">
                            <h5>Total Customers</h5>
                            <h2><span class="counter">3,200</span></h2>
                            <span class="text-success">+12%</span>
                            <div class="progress m-b-0">
                                <div class="progress-bar progress-bar-success" role="progressbar" style="width:70%;"> <span class="sr-only">70% Complete</span> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="product-sales-area mg-tb-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-sales-chart">
                        <div class="portlet-title">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="caption pro-sl-hd">
                                        <span class="caption-subject"><b>Recent Orders</b></span>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="actions graph-rp graph-rp-dl">
                                        <a href="{{ route('backend.orders.index') }}" class="btn btn-sm btn-primary">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Products</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#ORD-0001</td>
                                        <td>Customer 1</td>
                                        <td>1 item(s)</td>
                                        <td>Rs. 55,000</td>
                                        <td><span class="badge bg-warning">Pending</span></td>
                                        <td>Dec 17, 2025</td>
                                        <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>#ORD-0002</td>
                                        <td>Customer 2</td>
                                        <td>2 item(s)</td>
                                        <td>Rs. 60,000</td>
                                        <td><span class="badge bg-info">Processing</span></td>
                                        <td>Dec 16, 2025</td>
                                        <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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

