<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\frontend\CategoryController;
use App\Http\Controllers\frontend\DetailController;
use App\Http\Controllers\frontend\CartController;


// Admin
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\DashboardProductController;
use App\Http\Controllers\backend\DashboardTransactionsController;
use App\Http\Controllers\backend\DashboardSettingController;

use App\Http\Controllers\backend\admin\DashboardAdminController;
use App\Http\Controllers\backend\admin\CategoryAdminController;
use App\Http\Controllers\backend\admin\UserAdminController;
use App\Http\Controllers\backend\admin\ProductAdminController;
use App\Http\Controllers\backend\admin\ProductGalleryAdminController;

use App\Http\Controllers\CheckoutController;


// AUTH
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//homepage
Route::get('/', [HomeController::Class, 'index'] )->name('home');
Route::get('/categories', [CategoryController::Class, 'index'] )->name('categories');
Route::get('/categories/{id}', [CategoryController::Class, 'detail'] )->name('categories-detail');
Route::get('/detail/{slug}', [DetailController::Class, 'index'] )->name('detail');
Route::POST('/detail/{slug}', [DetailController::Class, 'add'] )->name('detail-add-cart');

Route::get('/cart', [CartController::Class, 'index'] )->name('cart');
Route::DELETE('/cart/{id}', [CartController::Class, 'delete'] )->name('cart-delete');
Route::get('/success', [CartController::Class, 'success'] )->name('success');


//checkout
Route::POST('/checkout', [CheckoutController::Class, 'process'] )->name('checkout');
Route::POST('/checkout/callback', [CheckoutController::Class, 'callback'] )->name('midtrans-callback');



// AUTH
Route::POST('/register/success', [RegisterController::Class, 'success'] )->name('register-success');


Route::get('/register', [RegisterController::Class, 'index'] )->name('register');
Route::get('/login', [LoginController::Class, 'index'] )->name('login');
Route::POST('/authenticate', [LoginController::Class, 'authenticate'] )->name('authtifikasi');
Route::POST('/logout', [LoginController::Class, 'logout'] )->name('logout');


//reseller
Route::get('/dashboard', [DashboardController::Class, 'index'] )->name('dashboard');
Route::get('/dashboard/products', [DashboardProductController::Class, 'index'] )->name('dashboard-product');
Route::get('/dashboard/products/create', [DashboardProductController::Class, 'create'] )->name('dashboard-product-create');    
Route::get('/dashboard/products/{id}', [DashboardProductController::Class, 'detail'] )->name('dashboard-product-detail');

Route::get('/dashboard/transactions', [DashboardTransactionsController::Class, 'index'] )->name('dashboard-transactions');
Route::get('/dashboard/transactions/{id}', [DashboardTransactionsController::Class, 'detail'] )->name('dashboard-transactions-detail');

Route::get('/dashboard/setting', [DashboardSettingController::Class, 'index'] )->name('dashboard-setting');
Route::get('/dashboard/account', [DashboardSettingController::Class, 'account'] )->name('dashboard-setting-account');


//fungsi prefix untuk memanggil satu kesatuan // ADMIN
Route::prefix('admin')->namespace('')->group(function(){
    Route::get('/', [DashboardAdminController::Class, 'index'])->name('dashboard-admin'); 
    Route::resource('category', CategoryAdminController::class);
    Route::resource('user', UserAdminController::class);
    Route::resource('product', ProductAdminController::class);
    Route::resource('product-gallery', ProductGalleryAdminController::class);
});



//checker debug dan tracking debug
Route::get('/debug-sentry', function () {
    throw new Exception('Ada error!');
});

