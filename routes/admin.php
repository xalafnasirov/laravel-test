<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Ecommerce\EcommerceController;
use App\Http\Controllers\Admin\Manage\ProductController;



Route::middleware('guest:admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Routes
        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);
    });


Route::middleware('auth:admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Routes
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::group(['prefix'=> 'manage', 'as'=>'manage.'], function () { 
            Route::get('/brand', [ProductController::class, 'show_brand'])->name('brand');
            Route::get('/category', [ProductController::class, 'show_category'])->name('category');
            Route::get('/sub-category', [ProductController::class, 'show_sub_category'])->name('sub_category');
            Route::get('/car-part', [ProductController::class, 'show_car_part'])->name('car_part');
            Route::get('/tire-brand', [ProductController::class, 'show_tire_brand'])->name('tire_brand');
            Route::get('/tire', [ProductController::class, 'show_tire'])->name('tire');
        });
    
        Route::group(['prefix'=> 'ecommerce', 'as'=>'ecommerce.'], function () { 
            Route::get('/users', [EcommerceController::class, 'users_index'])->name('users');
            Route::get('/orders', [EcommerceController::class, 'orders_index'])->name('orders');
            Route::get('/completed-orders', [EcommerceController::class, 'completed_orders_index'])->name('completed_orders');
            Route::get('/order/{id}', [EcommerceController::class, 'order_show'])->name('order.show');
            Route::get('/car-requests', [EcommerceController::class, 'car_requests_index'])->name('car_requests');

        });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    });
