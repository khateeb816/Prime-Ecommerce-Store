<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProductController as BackendProductController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\UserController as BackendUserController;

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/category/{category}', [ProductController::class, 'index'])->name('products.category');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');

// User Dashboard
Route::prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/orders', [UserController::class, 'orders'])->name('orders');
    Route::get('/wishlist', [UserController::class, 'wishlist'])->name('wishlist');
});

// Pages
Route::get('/about-us', [PageController::class, 'about'])->name('about');
Route::get('/store-location', [PageController::class, 'storeLocation'])->name('store-location');
Route::get('/corporate-sales', [PageController::class, 'corporateSales'])->name('corporate-sales');
Route::get('/built-in-kitchen-appliances', [PageController::class, 'builtInKitchen'])->name('built-in-kitchen');

// Backend Admin Routes
Route::prefix('admin')->name('backend.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('backend.dashboard');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::resource('products', BackendProductController::class);

    // Categories
    Route::resource('categories', CategoryController::class);

    // Brands
    Route::resource('brands', BrandController::class);

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Users
    Route::resource('users', BackendUserController::class);
});
