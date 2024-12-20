<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\UserRegistationController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminRegistationController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminOrderController;

// Public Routes
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Resource Routes for Categories and Products
Route::resource('/category', CategoryController::class);
Route::resource('/product', ProductController::class)->names([
    'index' => 'product.index',
]);

// Shop Route
Route::get('/shop', [ShopController::class, 'index'])->name('shop');

// Cart Routes
Route::prefix('cart')->group(function () {
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::get('/', [CartController::class, 'view'])->name('cart.view');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('orders/{order}', 'OrderController@show')->name('orders.show');
    Route::patch('orders/{order}/cancel', 'OrderController@cancel')->name('orders.cancel');
});

// User Authentication Routes
Route::prefix('user')->group(function () {
    Route::get('/login', [UserLoginController::class, 'index'])->name('login')->middleware('clear_cookies');
    Route::post('/check', [UserLoginController::class, 'check'])->name('check');
    Route::get('/register', [UserRegistationController::class, 'create'])->name('register');
    Route::post('/register', [UserRegistationController::class, 'store'])->name('user.register');
    Route::post('/logout', [UserLoginController::class, 'logout'])->name('user.logout')->middleware('clear_cookies');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

    // Protected User Routes
    Route::middleware(['auth', 'user'])->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
        Route::get('/orders', [OrderController::class, 'index'])->name('user.orders');
        Route::get('/order/{id}', [OrderController::class, 'show'])->name('user.order.details');
        Route::patch('/order/{id}/cancel', [OrderController::class, 'cancel'])->name('user.order.cancel');
    });
});

// Admin Authentication Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'index'])->name('admin.login')->middleware('clear_cookies');
    Route::post('/check', [AdminLoginController::class, 'admincheck'])->name('admin.check');
    Route::get('/register', [AdminRegistationController::class, 'create'])->name('admin.register');
    Route::post('/register', [AdminRegistationController::class, 'store'])->name('admin.store');
    
    // Protected Admin Routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout')->middleware('clear_cookies');

        // Admin Orders Management
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
        Route::get('/order/{id}', [AdminOrderController::class, 'show'])->name('admin.order.details');
        Route::patch('/order/{id}/update', [AdminOrderController::class, 'updateStatus'])->name('admin.order.update');
        Route::get('/order/{id}/edit', [AdminOrderController::class, 'edit'])->name('admin.order.edit');
        Route::delete('/order/{id}', [AdminOrderController::class, 'destroy'])->name('admin.order.destroy');
    });
});
