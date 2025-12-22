<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm p-3">
        <div class="container-fluid position-relative">
            <div class="row align-items-center w-100 g-2 g-md-3">
                <!-- Logo - Mobile: Full width, Tablet/Desktop: Auto -->
                <div class="col-12 col-md-auto col-lg-auto order-1 order-md-1 order-lg-1 d-flex justify-content-center justify-content-md-start mb-2 mb-md-0">
                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('frontend/images/logo.png') }}" alt="Prime Logo" height="50">
                    </a>
                </div>

                <!-- Search Bar - Hidden on mobile, visible on tablet/desktop, centered -->
                <div class="col-12 col-md-6 col-lg-5 order-3 order-md-2 order-lg-2 d-none d-md-flex justify-content-center search-bar-center">
                    <form action="{{ route('products.search') }}" method="GET" class="input-group search-group w-100">
                        <input type="text" name="q" class="form-control search-input" placeholder="Search For Products" value="{{ request('q') }}">
                        <button class="btn search-btn bg-brand-blue text-white" type="submit">Search</button>
                    </form>
                </div>

                <!-- Header Icons - Mobile: Full width, Tablet/Desktop: Auto, Right aligned on desktop -->
                <div class="col-12 col-md-auto col-lg-auto order-2 order-md-3 order-lg-3 d-flex align-items-center justify-content-center justify-content-md-end justify-content-lg-end ms-md-auto ms-lg-auto header-icons gap-3 gap-md-2">
                    <a href="{{ route('user.dashboard') }}" class="text-dark header-icon-link"><i class="bi bi-person-circle"></i></a>
                    <a href="{{ route('user.wishlist') }}" class="text-dark header-icon-link position-relative">
                        <i class="bi bi-heart"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">12</span>
                    </a>
                    <a href="{{ route('cart.index') }}" class="text-dark header-icon-link position-relative">
                        <i class="bi bi-cart3"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">0</span>
                    </a>
                    <button class="navbar-toggler header-icon-link d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <div class="bg-brand-blue p-2 position-relative">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="mainNav">
                <div class="d-lg-none p-3 mb-2">
                    <form action="{{ route('products.search') }}" method="GET" class="input-group search-group">
                        <input type="text" name="q" class="form-control mobile-search-input" placeholder="Search For Products" value="{{ request('q') }}">
                        <button class="btn search-btn bg-brand-blue text-white" type="submit">Search</button>
                    </form>
                </div>
                <div class="text-white d-flex flex-column flex-lg-row justify-content-start align-items-center gap-4 fw-light fs-6 py-2">
                    <span class="d-flex align-items-center mobile-category-trigger" style="cursor: pointer;"><i class="bi bi-list me-1"></i> SHOP BY CATEGORY</span>
                    <a href="{{ route('mobiles') }}" class="text-white text-decoration-none d-flex align-items-center">Mobiles</a>
                        <a href="{{ route('electronics') }}" class="text-white text-decoration-none d-flex align-items-center">Electronics</a>
                    <a href="{{ route('bikes') }}" class="text-white text-decoration-none d-flex align-items-center">Bikes</a>
                    <a href="{{ route('store-location') }}" class="text-white text-decoration-none d-flex align-items-center">Store Location</a>
                    <a href="{{ route('about') }}" class="text-white text-decoration-none d-flex align-items-center">About Us</a>
                    <a href="{{ route('home') }}" class="text-white text-decoration-none text-brand-red d-flex align-items-center">SAB SE BARI ASLI SALE - ANNUAL SALE</a>
                </div>
            </div>
            <div class="d-none d-lg-block">
                <div class="text-white d-flex justify-content-start align-items-center gap-4 fw-light fs-6 py-2">
                    <span class="category-trigger position-relative d-flex align-items-center"><i class="bi bi-list me-1"></i> SHOP BY CATEGORY</span>
                    <a href="{{ route('mobiles') }}" class="text-white text-decoration-none d-flex align-items-center">Mobiles</a>
                    <a href="{{ route('electronics') }}" class="text-white text-decoration-none d-flex align-items-center">Electronics</a>
                    <a href="{{ route('bikes') }}" class="text-white text-decoration-none d-flex align-items-center">Bikes</a>
                    <a href="{{ route('store-location') }}" class="text-white text-decoration-none d-flex align-items-center">Store Location</a>
                    <a href="{{ route('about') }}" class="text-white text-decoration-none d-flex align-items-center">About Us</a>
                    <a href="{{ route('home') }}" class="text-white text-decoration-none text-brand-red d-flex align-items-center">SAB SE BARI ASLI SALE - ANNUAL SALE</a>
                </div>
            </div>
        </div>

        <!-- Category Menu Dropdown -->
        <div class="category-menu-wrapper">
            <x-category-menu />
        </div>

        <!-- Mobile Category Menu Overlay -->
        <div class="mobile-category-overlay" id="mobileCategoryOverlay">
            <div class="mobile-category-menu">
                <div class="mobile-category-header">
                    <h5 class="mb-0">SHOP BY CATEGORY</h5>
                    <button class="mobile-category-close" id="mobileCategoryClose">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div class="mobile-category-content">
                    <x-category-menu />
                </div>
            </div>
        </div>
    </div>
</header>
