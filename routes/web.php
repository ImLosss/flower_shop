<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\OrderController as AdminOrderController;
use App\Http\Controllers\admin\PaymentController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\ReportController;
use App\Http\Controllers\admin\UserController as AdminUserController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// mainRoute

Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/category/{id}', [UserController::class, 'category'])->name('category');
Route::get('/product/{id}', [UserController::class, 'product'])->name('product');
Route::get('/product', [UserController::class, 'search'])->name('product.search');

// endRoute

// routeAuthenticate

Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [LogoutController::class, 'logout']);
Route::get('/register', [UserController::class, 'register']);

// endRoute

// routeCartAndCheckout

// endRoute

// routeOrderController

Route::group([
    'namespace' => 'App\Http\Controllers',
    'prefix' => '/',
], function () {
    Route::resource('order', OrderController::class)->only(['index', 'update', 'show', 'edit', 'store', 'destroy'])->names([
        'index'   => 'order',
        'update'  => 'order.confirm',
        'show'  => 'order.view',
        'edit' => 'confirm',
        'store' => 'order.storepayment',
        'destroy' => 'order.destroy'
    ]);
});

// endRoute

Route::group([
    'namespace'  => 'App\Http\Controllers\admin',
    'prefix'     => 'admin',
    'as'         => 'admin.'
], function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

    // routeCategory

    Route::resource('category', CategoryController::class)->only(['destroy', 'index', 'store'])->names([
        'index'   => 'category.index',
    ]);

    // endRoute

    // routeProduct

    Route::resource('product', ProductController::class) ->names([
        'index'   => 'product.index',
    ]);

    // endRoute

    // routeOrderController

    Route::resource('manageorder', AdminOrderController::class)->only(['index', 'show', 'destroy'])->names([
        'index'   => 'manageorder.index',
        'show'    => 'manageorder.show',
    ]);

    Route::get('/getDataOrder', [AdminOrderController::class, 'getOrderData'])->name('dataTable.getOrderData');

    // endRoute

    // routeReportController

    Route::resource('laporan', ReportController::class)->only(['index'])->names([
        'index'   => 'laporan.index',
    ]);

    // endRoute

    // routeUserController

    Route::resource('user', AdminUserController::class)->only(['index', 'destroy'])->names([
        'index'   => 'user.index',
    ]);

    // endRoute

    // routePaymentController

    Route::resource('payment', PaymentController::class)->only(['index', 'destroy', 'store'])->names([
        'index'   => 'payment.index'
    ]);

    // endRoute
});

