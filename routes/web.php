<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;


Route::get('/test', [HomeController::class, 'test_create'])->name('test');
Route::post('/test', [HomeController::class, 'test_store'])->name('test.store');
Route::get('/phpinfo', function () {
    phpinfo();
});

Route::middleware(['guest:web'])->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/home', [HomeController::class, 'home'])->name('home.index');



    Route::group(['as' => 'services.'], function () {
        Route::get('/shop', [ServiceController::class, 'shop_index'])->name('shop');
        Route::get('/tires', [ServiceController::class, 'tire_index'])->name('tires');
        Route::get('{id}/shop-single/', [ServiceController::class, 'shop_single'])->name('shop_single');
        Route::get('/cart', [ServiceController::class, 'cart_create'])->name('cart')->middleware('otp.verified');
        Route::get('/inspection', [ServiceController::class, 'inspection_create'])->name('inspection');
        Route::post('/inspection', [ServiceController::class, 'inspection_store'])->name('inspection.store');
        Route::get('/checkout', [ServiceController::class, 'checkout_create'])->name('checkout')->middleware('otp.verified');
        Route::get('/contact', [ServiceController::class, 'contact_create'])->name('contact');
        Route::post('/send_email', [ServiceController::class, 'send_email'])->name('email.store')->middleware('otp.verified');
    });


    // Route::group(['as'=> 'order.'], function () {
    //     Route::get('/order/confirmation/{order_id}', [ServiceController::class, 'confirmation_create'])->name('confirmation');
    // });


});

Route::get('/order/confirmation/{order_id}', [ServiceController::class, 'confirmation_create'])->name('services.order.confirmation');

Route::get('/routes', [HomeController::class, 'index'])->name('routes');

Route::middleware(['auth:web', 'otp.verified', 'verified'])->group(function () {

    Route::get('/dashboard', [ServiceController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/{panel}', [ServiceController::class, 'dashboard_go'])->name('dashboard.go');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
