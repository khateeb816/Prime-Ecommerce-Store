<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Admin Dashboard') | Prime Admin</title>
    <meta name="description" content="@yield('description', 'Prime Admin Dashboard')">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/images/logo.png') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/admin.css') }}">

    @stack('styles')
</head>
<body>
    <!-- Start Header menu area -->
    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
                <a href="{{ route('backend.dashboard') }}" class="logo-link">
                    <img src="{{ asset('frontend/images/logo.png') }}" alt="Prime Trading & Leasing" class="sidebar-logo">
                </a>
            </div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro">
                    <ul class="metismenu" id="menu1">
                        <li class="{{ request()->routeIs('backend.dashboard') ? 'active' : '' }}">
                            <a href="{{ route('backend.dashboard') }}">
                                <span class="bi bi-speedometer2 icon-wrap"></span>
                                <span class="mini-click-non">Dashboard</span>
                            </a>
                        </li>
                        <li class="{{ request()->routeIs('backend.products.*') || request()->routeIs('backend.categories.*') || request()->routeIs('backend.brands.*') ? 'active' : '' }}">
                            <a class="has-arrow" href="#" aria-expanded="false">
                                <span class="bi bi-box-seam icon-wrap"></span>
                                <span class="mini-click-non">Products</span>
                            </a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a href="{{ route('backend.products.index') }}"><span class="mini-sub-pro">All Products</span></a></li>
                                <li><a href="{{ route('backend.products.create') }}"><span class="mini-sub-pro">Add Product</span></a></li>
                                <li><a href="{{ route('backend.categories.index') }}"><span class="mini-sub-pro">Categories</span></a></li>
                                <li><a href="{{ route('backend.brands.index') }}"><span class="mini-sub-pro">Brands</span></a></li>
                            </ul>
                        </li>
                        <li class="{{ request()->routeIs('backend.orders.*') ? 'active' : '' }}">
                            <a class="has-arrow" href="#" aria-expanded="false">
                                <span class="bi bi-bag-check icon-wrap"></span>
                                <span class="mini-click-non">Orders</span>
                            </a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a href="{{ route('backend.orders.index') }}"><span class="mini-sub-pro">All Orders</span></a></li>
                                <li><a href="{{ route('backend.orders.index', ['status' => 'pending']) }}"><span class="mini-sub-pro">Pending Orders</span></a></li>
                                <li><a href="{{ route('backend.orders.index', ['status' => 'completed']) }}"><span class="mini-sub-pro">Completed Orders</span></a></li>
                            </ul>
                        </li>
                        <li class="{{ request()->routeIs('backend.users.*') ? 'active' : '' }}">
                            <a class="has-arrow" href="#" aria-expanded="false">
                                <span class="bi bi-people icon-wrap"></span>
                                <span class="mini-click-non">Users</span>
                            </a>
                            <ul class="submenu-angle" aria-expanded="false">
                                <li><a href="{{ route('backend.users.index') }}"><span class="mini-sub-pro">All Users</span></a></li>
                                <li><a href="{{ route('backend.users.create') }}"><span class="mini-sub-pro">Add User</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ route('home') }}" target="_blank">
                                <span class="bi bi-globe icon-wrap"></span>
                                <span class="mini-click-non">View Website</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="bi bi-box-arrow-right icon-wrap"></span>
                                <span class="mini-click-non">Logout</span>
                            </a>
                            <form id="logout-form" action="#" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    <!-- End Header menu area -->

    <!-- Start Welcome area -->
    <div class="all-content-wrapper">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top p-3">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-primary me-3">
                    <i class="bi bi-list"></i>
                </button>
                <div class="ms-auto d-flex align-items-center gap-4">
                    <div class="dropdown">
                        <a href="#" class="nav-link text-dark" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell fs-5"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><h6 class="dropdown-header">Notifications</h6></li>
                            <li><a class="dropdown-item" href="#"><small>New order received</small></a></li>
                            <li><a class="dropdown-item" href="#"><small>Product out of stock</small></a></li>
                            <li><a class="dropdown-item" href="#"><small>New user registered</small></a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-center" href="#"><small>View All</small></a></li>
                        </ul>
                    </div>
                    <div class="dropdown">
                        <a href="#" class="d-block" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('frontend/images/logo.png') }}" alt="User" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover; border: 2px solid #e0e0e0;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Breadcrumb -->
        <div class="breadcome-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="breadcome-list">
                            <ul class="breadcome-menu">
                                <li><a href="{{ route('backend.dashboard') }}">Dashboard</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">@yield('page-title', 'Dashboard')</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="container-fluid">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>

        <!-- Footer -->
        <div class="footer-copyright-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="footer-copy-right">
                            <p>Copyright © {{ date('Y') }}. All rights reserved. Prime Admin Panel</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Admin JS -->
    <script src="{{ asset('backend/js/admin.js') }}"></script>

    @stack('scripts')
</body>
</html>

