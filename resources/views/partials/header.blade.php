<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm p-3">
        <div class="container-fluid position-relative">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('frontend/images/logo.png') }}" alt="Prime Logo" height="50">
            </a>

            <div class="search-bar-center d-none d-lg-block">
                <div class="input-group search-group">
                    <input type="text" class="form-control search-input" placeholder="Search For Products">
                    <button class="btn search-btn bg-brand-blue text-white" type="button">Search</button>
                </div>
            </div>

            <div class="d-flex align-items-center header-icons">
                <a href="#" class="text-dark header-icon-link"><i class="bi bi-person-circle"></i></a>
                <a href="#" class="text-dark header-icon-link position-relative">
                    <i class="bi bi-heart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">0</span>
                </a>
                <a href="#" class="text-dark header-icon-link position-relative">
                    <i class="bi bi-cart3"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">0</span>
                </a>
                <button class="navbar-toggler header-icon-link" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </nav>

    <div class="bg-brand-blue p-2 position-relative">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="mainNav">
                <div class="d-lg-none p-3 mb-2">
                    <div class="input-group search-group">
                        <input type="text" class="form-control mobile-search-input" placeholder="Search For Products">
                        <button class="btn search-btn bg-brand-blue text-white" type="button">Search</button>
                    </div>
                </div>
                <div class="text-white d-flex flex-column flex-lg-row justify-content-start gap-4 fw-light fs-6 py-2">
                    <span><i class="bi bi-list"></i> SHOP BY CATEGORY</span>
                    <a href="#" class="text-white text-decoration-none">Built in Kitchen Appliances</a>
                    <a href="#" class="text-white text-decoration-none">Store Location</a>
                    <a href="#" class="text-white text-decoration-none">About Us</a>
                    <a href="#" class="text-white text-decoration-none">Corporate Sales</a>
                    <a href="#" class="text-white text-decoration-none text-brand-red">SAB SE BARI ASLI SALE - ANNUAL SALE</a>
                </div>
            </div>
            <div class="d-none d-lg-block">
                <div class="text-white d-flex justify-content-start gap-4 fw-light fs-6 py-2">
                    <span class="category-trigger position-relative"><i class="bi bi-list"></i> SHOP BY CATEGORY</span>
                    <a href="#" class="text-white text-decoration-none">Built in Kitchen Appliances</a>
                    <a href="#" class="text-white text-decoration-none">Store Location</a>
                    <a href="#" class="text-white text-decoration-none">About Us</a>
                    <a href="#" class="text-white text-decoration-none">Corporate Sales</a>
                    <a href="#" class="text-white text-decoration-none text-brand-red">SAB SE BARI ASLI SALE - ANNUAL SALE</a>
                </div>
            </div>
        </div>

        <!-- Category Menu Dropdown -->
        <div class="category-menu-wrapper">
            <x-category-menu />
        </div>
    </div>
</header>
