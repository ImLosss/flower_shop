<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\auth\LogoutController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/category/{id}', [UserController::class, 'category'])->name('category');
Route::get('/product/{id}', [UserController::class, 'product'])->name('product');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('/login', [UserController::class, 'login'])->middleware('guest');
Route::get('/logout', [LogoutController::class, 'logout'])->middleware('auth');
Route::get('/register', [UserController::class, 'register'])->middleware('guest');

Route::resource('cart', CartController::class)->only(['index', 'store', 'update', 'destroy'])->names([
    'index'   => 'cart',
    'store'   => 'addcart',
    'update'  => 'updatecart',
    'destroy' => 'deletecart',
])->middleware('auth');

Route::resource('checkout', CheckoutController::class)->only(['index', 'store', 'update', 'destroy'])->names([
    'index'   => 'checkout',
    'store'   => 'store',
    'update'  => 'checkout.confirm',
    'destroy' => 'destroy',
])->middleware('auth');

Route::group([
    'middleware' => ['auth', 'role:admin'],
    'namespace'  => 'App\Http\Controllers\admin',
    'prefix'     => 'admin',
    'as'         => 'admin.'
], function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::resource('category', CategoryController::class)->only(['destroy', 'index', 'store'])->names([
        'index'   => 'category.index',
        'create'  => 'category.create',
        'store'   => 'category.store',
        'show'    => 'category.show',
        'edit'    => 'category.edit',
        'update'  => 'category.update',
        'destroy' => 'category.destroy',
    ]);

    Route::resource('product', ProductController::class) ->names([
        'index'   => 'product.index',
        'create'  => 'product.create',
        'store'   => 'product.store',
        'show'    => 'product.show',
        'edit'    => 'product.edit',
        'update'  => 'product.update',
        'destroy' => 'product.destroy',
    ]);
});

