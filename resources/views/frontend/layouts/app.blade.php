<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('description', 'Prime - Your trusted electronics store. Shop the latest home appliances, kitchen electronics, and more at the best prices.')">
    <meta name="keywords" content="@yield('keywords', 'electronics, home appliances, kitchen appliances, Prime, online shopping')">
    <meta name="author" content="Prime">
    <title>@yield('title', 'Prime')</title>

    <!-- Preconnect for performance -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net">

    <!-- Stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    @vite(['resources/css/app.css'])
</head>
<body>
    <div class="bg-brand-blue text-white top-bar">
        <div class="container-fluid text-center py-2">
            <div class="top-bar-line-1">
                <span class="text-warning">Shipping All Over Pakistan</span> 🇵🇰
            </div>
            <div class="top-bar-line-2 text-white">
                Our Prices are different for different regions
            </div>
        </div>
    </div>
    @include('frontend.partials.header')

    <main>
        @yield('content')
    </main>

    @include('frontend.partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Fix hamburger menu - prevent immediate closing
        document.addEventListener('DOMContentLoaded', function() {
            const navbarToggler = document.querySelector('.navbar-toggler');
            const mainNav = document.getElementById('mainNav');

            if (navbarToggler && mainNav) {
                navbarToggler.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }

            // Category menu hover functionality
            const categoryTrigger = document.querySelector('.category-trigger');
            const categoryMenuWrapper = document.querySelector('.category-menu-wrapper');
            const categoryItems = document.querySelectorAll('.category-item');
            const brandsMenus = document.querySelectorAll('.brands-menu');

            if (categoryTrigger && categoryMenuWrapper) {
                // Show menu on hover
                categoryTrigger.addEventListener('mouseenter', function() {
                    categoryMenuWrapper.style.opacity = '1';
                    categoryMenuWrapper.style.visibility = 'visible';
                    categoryMenuWrapper.style.pointerEvents = 'all';
                });

                const brandsDropdown = document.querySelector('.brands-dropdown');

                categoryMenuWrapper.addEventListener('mouseleave', function() {
                    // Clear any pending hide timeout
                    clearTimeout(hideBrandsTimeout);

                    categoryMenuWrapper.style.opacity = '0';
                    categoryMenuWrapper.style.visibility = 'hidden';
                    categoryMenuWrapper.style.pointerEvents = 'none';
                    // Hide all brand menus
                    brandsMenus.forEach(menu => menu.classList.remove('active'));
                    categoryItems.forEach(item => item.classList.remove('active'));
                    // Hide brands dropdown
                    if (brandsDropdown) {
                        brandsDropdown.classList.remove('has-active');
                    }
                    // Remove has-brands class from container
                    const container = categoryMenuWrapper.querySelector('.category-menu-container');
                    if (container) {
                        container.classList.remove('has-brands');
                    }
                });

                // Show brands on category hover
                let hideBrandsTimeout;
                categoryItems.forEach(item => {
                    const category = item.getAttribute('data-category');
                    const brandMenu = document.querySelector(`.brands-menu[data-category="${category}"]`);

                    item.addEventListener('mouseenter', function() {
                        // Clear any pending hide timeout
                        clearTimeout(hideBrandsTimeout);

                        // Hide all brand menus first
                        brandsMenus.forEach(menu => menu.classList.remove('active'));
                        categoryItems.forEach(cat => cat.classList.remove('active'));

                        // Show current brand menu
                        if (brandMenu && brandsDropdown) {
                            brandMenu.classList.add('active');
                            item.classList.add('active');
                            brandsDropdown.classList.add('has-active');
                            categoryMenuWrapper.querySelector('.category-menu-container').classList.add('has-brands');
                        }
                    });

                    item.addEventListener('mouseleave', function(e) {
                        // Check if mouse is moving to brands dropdown
                        const relatedTarget = e.relatedTarget;
                        const isMovingToBrands = relatedTarget && (
                            brandsDropdown.contains(relatedTarget) ||
                            relatedTarget.closest('.brands-dropdown') ||
                            relatedTarget.closest('.brands-menu')
                        );

                        // Only hide if not moving to brands area
                        if (!isMovingToBrands) {
                            hideBrandsTimeout = setTimeout(function() {
                                if (brandsDropdown) {
                                    brandsDropdown.classList.remove('has-active');
                                }
                                const container = categoryMenuWrapper.querySelector('.category-menu-container');
                                if (container) {
                                    container.classList.remove('has-brands');
                                }
                                brandMenu.classList.remove('active');
                                item.classList.remove('active');
                            }, 100); // Small delay to allow transition
                        }
                    });
                });

                // Keep brands visible when hovering over brands dropdown or brand menu
                if (brandsDropdown) {
                    brandsDropdown.addEventListener('mouseenter', function() {
                        // Clear any pending hide timeout
                        clearTimeout(hideBrandsTimeout);

                        const activeCategory = document.querySelector('.category-item.active');
                        if (activeCategory) {
                            const category = activeCategory.getAttribute('data-category');
                            const brandMenu = document.querySelector(`.brands-menu[data-category="${category}"]`);
                            if (brandMenu) {
                                brandMenu.classList.add('active');
                                activeCategory.classList.add('active');
                                brandsDropdown.classList.add('has-active');
                                categoryMenuWrapper.querySelector('.category-menu-container').classList.add('has-brands');
                            }
                        }
                    });

                    brandsDropdown.addEventListener('mouseleave', function() {
                        // Hide brands when leaving brands area
                        if (brandsDropdown) {
                            brandsDropdown.classList.remove('has-active');
                        }
                        const container = categoryMenuWrapper.querySelector('.category-menu-container');
                        if (container) {
                            container.classList.remove('has-brands');
                        }
                        brandsMenus.forEach(menu => menu.classList.remove('active'));
                        categoryItems.forEach(item => item.classList.remove('active'));
                    });
                }
            }
        });
    </script>
</body>
</html>

