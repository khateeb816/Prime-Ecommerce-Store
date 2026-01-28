<?php

use App\Http\Controllers\Backend\AttributeController;
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
Route::get('/brand/{brand}', [ProductController::class, 'brand'])->name('products.brand');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products/{id}/review', [ProductController::class, 'storeReview'])->name('products.review.store')->middleware('auth');
Route::post('/reviews/{id}/reply', [\App\Http\Controllers\Frontend\ReviewController::class, 'storeReply'])->name('reviews.reply.store')->middleware('auth');
Route::post('/reviews/{id}/like', [\App\Http\Controllers\Frontend\ReviewController::class, 'toggleLike'])->name('reviews.like.toggle')->middleware('auth');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');

// Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/add-to-cart/{id}', [CartController::class, 'add'])->name('cart.add');
Route::patch('/update-cart', [CartController::class, 'update'])->name('cart.update');
Route::delete('/remove-from-cart', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/clear-cart', [CartController::class, 'clear'])->name('cart.clear');

// Checkout
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});

// Authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Dashboard
Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [UserController::class, 'updatePassword'])->name('profile.password');
    Route::get('/orders', [UserController::class, 'orders'])->name('orders');
    Route::get('/orders/{id}', [UserController::class, 'orderShow'])->name('orders.show');
    Route::get('/wishlist', [UserController::class, 'wishlist'])->name('wishlist');
});

// Pages
Route::get('/about-us', [PageController::class, 'about'])->name('about');
Route::get('/store-location', [PageController::class, 'storeLocation'])->name('store-location');

// Backend Admin Routes
Route::prefix('admin')->name('backend.')->middleware(['auth', 'admin'])->group(function () {

    Route::get('/', function () {
        return redirect()->route('backend.dashboard');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Products
    Route::post('products/bulk-update-attributes', [BackendProductController::class, 'bulkUpdateAttributes'])->name('products.bulkUpdateAttributes');
    Route::resource('products', BackendProductController::class);

    // Categories
    Route::resource('categories', CategoryController::class);

    // Brands
    Route::resource('brands', BrandController::class);
    Route::get('/brandsByCategory/{categoryId}', [BrandController::class, 'brandsByCategory']);


    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // Users
    Route::resource('users', BackendUserController::class);

    // Attributes
    Route::resource('attributes', AttributeController::class);
    Route::get('/attributesByCategory/{categoryId}', [AttributeController::class, 'attributesByCategory']);


    // Reviews
    Route::resource('reviews', \App\Http\Controllers\Backend\ReviewController::class)->only(['index', 'edit', 'update', 'destroy']);
});
