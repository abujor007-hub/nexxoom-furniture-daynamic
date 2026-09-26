<?php

use App\Http\Controllers\AddsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\pages_conntroller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SSLCommerzController;
use Illuminate\Support\Facades\Route;

Route::get('/auth/google', [GoogleController::class, 'redirect'])
    ->name('google.login');

Route::get('/auth/google/callback', [GoogleController::class, 'callback']);

// Route::get('/', function () {
//     return view('welcome');
// });


Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password.update');


// main page controller start
Route::get('/', [pages_conntroller::class, 'home']);
Route::get('home', [pages_conntroller::class, 'home'])->name('home.page');
Route::get('new-arrivel', [pages_conntroller::class, 'newArrivel'])->name('newArrivel.page');
Route::get('shop', [pages_conntroller::class, 'shop'])->name('shop.page');
Route::get('bed', [pages_conntroller::class, 'bed'])->name('bed.page');
Route::get('sofa', [pages_conntroller::class, 'sofa'])->name('sofa.page');
Route::get('chair', [pages_conntroller::class, 'chair'])->name('chair.page');
Route::get('contact', [pages_conntroller::class, 'contact'])->name('contact.page');
Route::get('checkout', [pages_conntroller::class, 'checkout'])->name('checkout.page');
Route::get('product/details', [pages_conntroller::class, 'details'])->name('product.details.page');
Route::middleware('auth')->group(function () {

     // All Orders
    Route::get('user/orders', [OrderController::class, 'index'])
        ->name('orders.page');

    // Single Order
    Route::get('/orders/{id}', [OrderController::class, 'show'])
        ->name('orders.show');

    // Edit Order
    Route::get('us/orders/{id}/edit', [OrderController::class, 'edit'])
        ->name('orders.edit');

    // Update Order
    Route::put('/orders/{id}', [OrderController::class, 'update'])
        ->name('orders.update');

    // Cancel Order
Route::delete('/orders/{id}/cancel', [OrderController::class, 'cancel'])
    ->name('orders.cancel');

});


// main page controller end


// dashboard admin controller start
// category route start 

Route::get('admin/profile', [DashboardController::class, 'profile'])->name('admin.profile');
Route::get('category', [CategoryController::class, 'category'])->name('category.page');
Route::put('category/store', [CategoryController::class, 'store'])->name('category.store');
Route::delete('category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
// category route end
// product route start
Route::get('product', [ProductController::class, 'product'])->name('addproduct.page');
Route::put('product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('product/list', [ProductController::class, 'productList'])->name('product.list');
Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::put('product/update/{id}', [ProductController::class, 'update'])->name('product.update');
Route::delete('product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
Route::get('product/sofa', [ProductController::class, 'sofa'])->name('product.sofa');
Route::get('product/table', [ProductController::class, 'table'])->name('product.table');
Route::get('product/bed', [ProductController::class, 'bed'])->name('product.bed');
Route::get('product/slider',[ProductController::class,'slider'])->name('product.slider');
Route::get('product/details/{id}', [ProductController::class, 'details'])->name('product.details');


Route::get('/add-to-cart/{id}', [ProductController::class, 'addToCartStore']) ->name('addtocart.store');


/*
|--------------------------------------------------------------------------
| Cart Quantity AJAX Update
|--------------------------------------------------------------------------
*/

Route::post('/cart/quantity/update', [ProductController::class, 'updateQuantity'])
    ->name('cart.quantity.update');

Route::get('cartitemdelte/{id}', [ProductController::class, 'addToCartItemDelete'])->name('addtocarditemdelete');

// product route end

// dashboard controller end

// order route start
Route::put('order', [OrderController::class, 'store'])->name('order');
Route::get('orderConfirm/{id}', [OrderController::class, 'orderConfirm'])->name('order.confirm');
// order route end

// payment rout start 
Route::get('checkout', [pages_conntroller::class, 'checkout'])
    ->name('checkout.page');

Route::put('order', [OrderController::class, 'store'])
    ->name('order');

Route::get('orderConfirm/{id}', [OrderController::class, 'orderConfirm'])
    ->name('order.confirm');

Route::get('/sslcommerz/pay/{id}', [SSLCommerzController::class, 'pay'])
    ->name('sslcommerz.pay');

Route::post('/sslcommerz/success', [SSLCommerzController::class, 'success'])
    ->name('sslcommerz.success');

Route::post('/sslcommerz/fail', [SSLCommerzController::class, 'fail'])
    ->name('sslcommerz.fail');

Route::post('/sslcommerz/cancel', [SSLCommerzController::class, 'cancel'])
    ->name('sslcommerz.cancel');

Route::post('/sslcommerz/ipn', [SSLCommerzController::class, 'ipn'])
    ->name('sslcommerz.ipn');
// payment rout end

// contact route start
Route::post('/contact/store',[ContactController::class,'store'])->name('contact.message') ;
Route::get('show/message',[ContactController::class,'show'])->name('show.message');
// contact route end

Route::get('/product/live-search', [ProductController::class, 'liveSearch'])
    ->name('product.live.search');


    Route::get('all/order',[OrderController::class,'allorder'])->name('allorder.page');

    Route::get('/admin/order/{id}', [OrderController::class, 'showorder'])
    ->name('admin.order.show');

    Route::put('/admin/order/{id}/status', [OrderController::class, 'updateStatus'])
    ->name('admin.order.status.update');


    // link route start
    Route::get('link/create',[LinkController::class,'create'])->name('create.link'); 
    Route::put('store/link',[LinkController::class,'store'])->name('store.link');
    // link route end
    
    Route::middleware(['auth', 'verified'])->group(function () {

    Route::get(
        '/admin/dashboard',
        [DashboardController::class, 'view']
    )->name('admin.dashboard');

});

// add and logo start
Route::get('add/logo',[AddsController::class,'create'])->name('add.logo.create');
Route::put('store/add/logo',[AddsController::class, 'store'])->name('store.add.logo');
// add and logo end

Route::get('pending/order',[OrderController::class,'pending'])->name('penging.order');
Route::get('processing/order',[OrderController::class,'processing'])->name('prossessing.order');
Route::get('delivered/order',[OrderController::class,'Delivered'])->name('delivered.order');
Route::get('cancelled/order',[OrderController::class,'cancelled'])->name('cancelled.order');