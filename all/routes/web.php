<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\DisableProductController;

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

Route::get('/', [FrontController::class, 'index']);

//customer
Route::get('/manage-customer', [CustomerController::class, 'index'])->name('customer.manage');
Route::get('/add-customer', [CustomerController::class, 'add'])->name('customer.add');
Route::post('/profile-customer', [CustomerController::class, 'searchProfile'])->name('customer.profile');
Route::post('/store-customer', [CustomerController::class, 'store'])->name('customer.store');
Route::get('/edit-customer/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
Route::post('/update-customer/{id}', [CustomerController::class, 'update'])->name('customer.update');
Route::get('/delete-customer/{id}', [CustomerController::class, 'delete'])->name('customer.delete');
Route::get('/pagination/paginate-data', [CustomerController::class, 'pagination'])->name('paginate');
Route::get('/search-customer', [CustomerController::class, 'searchCustomer'])->name('customer.search');


//profile
Route::get('/add-profile/{id}', [ProfileController::class, 'add'])->name('profile.add');
Route::get('/manage-profile', [ProfileController::class, 'index'])->name('profile.manage');
Route::post('/store-profile', [ProfileController::class, 'store'])->name('profile.store');
Route::get('/edit-profile/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/update-profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/delete-profile/{id}', [ProfileController::class, 'delete'])->name('profile.delete');


//Product
Route::get('/manage-product', [ProductController::class, 'index'])->name('product.index');
Route::get('/add-product', [ProductController::class, 'add'])->name('product.add');
Route::post('/store-product', [ProductController::class, 'store'])->name('product.store');
Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/update-product/{id}', [ProductController::class, 'update'])->name('product.update');
Route::get('/delete-product/{id}', [ProductController::class, 'delete'])->name('product.delete');
Route::get('/search-product', [ProductController::class, 'searchProduct'])->name('search.product');
Route::get('/pagination/product', [ProductController::class, 'pagination'])->name('paginate.product');
Route::get('/update-status/{id}', [ProductController::class, 'updateStatus'])->name('status.update');

//Inventory
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::get('/add-inventory/{id}', [InventoryController::class, 'add'])->name('inventory.add');
Route::post('/store-inventory/{id}', [InventoryController::class, 'store'])->name('inventory.store');
Route::post('/add-unit/{id}', [InventoryController::class, 'addUnit'])->name('unit.add');

//Disable Product
Route::get('/disable-product/{id}', [DisableProductController::class, 'disable'])->name('product.disable');
Route::get('/disable-product-index', [DisableProductController::class, 'index'])->name('disable.index');
/*
|--------------------------------------------------------------------------
| Multi Authentication Routes
|--------------------------------------------------------------------------
*/

Auth::routes();
Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::get('/login/merchant', [LoginController::class,'showMerchantLoginForm']);
Route::get('/register/admin', [RegisterController::class,'showAdminRegisterForm']);
Route::get('/register/merchant', [RegisterController::class,'showMerchantRegisterForm']);

Route::post('/login/admin', [LoginController::class,'adminLogin']);
Route::post('/login/merchant', [LoginController::class,'merchantLogin']);
Route::post('/register/admin', [RegisterController::class,'createAdmin']);
Route::post('/register/merchant', [RegisterController::class,'createMerchant']);

Route::group(['middleware' => 'auth:merchant'], function () {
    Route::view('/merchant', 'merchant');
});

Route::group(['middleware' => 'auth:admin'], function () {
    Route::view('/admin', 'admin');
});

Route::get('logout', [LoginController::class,'logout']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
