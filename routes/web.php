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

Route::post('/login', [LoginController::class, 'authenticate'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->name('register')->middleware('guest');
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::get('/logout', [LogoutController::class, 'logout'])->middleware('auth');
Route::get('/register', [UserController::class, 'register'])->middleware('guest');

// endRoute

// routeCartAndCheckout

Route::resource('checkout', CheckoutController::class)->only(['index', 'update'])->names([
    'index'   => 'checkout',
    'update'  => 'checkout.confirm',
])->middleware('auth');

Route::resource('cart', CartController::class)->only(['index', 'store', 'update', 'destroy'])->names([
    'index'   => 'cart',
    'store'   => 'addcart',
    'update'  => 'updatecart',
    'destroy' => 'deletecart',
])->middleware('auth');

// endRoute

// routeOrderController

Route::group([
    'middleware' => ['auth', 'role:member'],
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
    'middleware' => ['auth', 'role:admin'],
    'namespace'  => 'App\Http\Controllers\admin',
    'prefix'     => 'admin',
    'as'         => 'admin.'
], function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

    // routeCategory

    Route::resource('category', CategoryController::class)->only(['destroy', 'index', 'store'])->names([
        'index'   => 'category.index',
        'create'  => 'category.create',
        'store'   => 'category.store',
        'show'    => 'category.show',
        'edit'    => 'category.edit',
        'update'  => 'category.update',
        'destroy' => 'category.destroy',
    ]);

    // endRoute

    // routeProduct

    Route::resource('product', ProductController::class) ->names([
        'index'   => 'product.index',
        'create'  => 'product.create',
        'store'   => 'product.store',
        'show'    => 'product.show',
        'edit'    => 'product.edit',
        'update'  => 'product.update',
        'destroy' => 'product.destroy',
    ]);

    // endRoute

    // routeOrderController

    Route::resource('manageorder', AdminOrderController::class)->only(['index', 'show', 'destroy'])->names([
        'index'   => 'manageorder.index',
        'show'    => 'manageorder.show',
    ]);

    Route::patch('/manageorder/{invoice}/confirm', [AdminOrderController::class, 'confirmPayment'])->name('manageorder.confirm');
    Route::patch('/manageorder/{invoice}/kirim', [AdminOrderController::class, 'kirim'])->name('manageorder.kirim');
    Route::patch('/manageorder/{invoice}/selesai', [AdminOrderController::class, 'selesaikan'])->name('manageorder.selesai');

    // endRoute

    // routeReportController

    Route::resource('laporan', ReportController::class)->only(['index'])->names([
        'index'   => 'laporan.index',
    ]);

    Route::get('/laporan/print', [ReportController::class, 'print'])->name('laporan.print');

    // endRoute

    // routeUserController

    Route::resource('user', AdminUserController::class)->only(['index', 'destroy'])->names([
        'index'   => 'user.index',
        'destroy' => 'user.destroy',
    ]);

    Route::get('/laporan/print', [ReportController::class, 'print'])->name('laporan.print');

    // endRoute

    // routePaymentController

    Route::resource('payment', PaymentController::class)->only(['index', 'destroy', 'store'])->names([
        'index'   => 'payment.index',
        'destroy' => 'payment.destroy',
        'store'   => 'payment.store'
    ]);

    // endRoute
});

