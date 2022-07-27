<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerApiController;
use App\Http\Controllers\Api\MerchantApiController;
use App\Http\Controllers\Api\ProfileApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\MultipleUploadController;
use App\Http\Controllers\Api\InventoryApiController;
use App\Http\Controllers\Api\DisableProductApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//merchant api
Route::post('/register-merchant', [MerchantApiController::class, 'register']);
Route::post('/login-merchant', [MerchantApiController::class, 'login']);

Route::group(["middleware"=>["auth:api"]], function (){
    Route::get('/profile', [MerchantApiController::class, 'profile']);
    Route::post('/logout', [MerchantApiController::class, 'logout']);

    //customer api
    Route::post('/add-customer', [CustomerApiController::class, 'addCustomer']);
    Route::get('/customer/{id?}', [CustomerApiController::class, 'showCustomer']);
    Route::post('/add-multiple-customers', [CustomerApiController::class, 'addMultipleCustomer']);
    Route::put('/update-customer/{id}', [CustomerApiController::class, 'updateCustomer']);
    Route::delete('/delete-customer/{id}', [CustomerApiController::class, 'deleteCustomer']);

    //profile api
    Route::post('/add-profile', [ProfileApiController::class, 'store']);
    Route::get('/customer-profile/{id?}', [ProfileApiController::class, 'showProfile']);
    Route::put('/update-profile/{id}', [ProfileApiController::class, 'updateProfile']);
    Route::delete('/delete-profile/{id}', [ProfileApiController::class, 'deleteProfile']);

    //product api
    Route::put('/update-status/{id}', [ProductApiController::class, 'updateStatus']);
    Route::get('/inventory', [ProductApiController::class, 'showInventory']);

    //Inventory
    Route::get('/inventory', [InventoryApiController::class, 'index']);
    Route::get('/add-inventory/{id}', [InventoryApiController::class, 'add']);
    Route::post('/add-unit/{id}', [InventoryApiController::class, 'addUnit']);

    Route::get('/disable-product/{id}', [DisableProductApiController::class, 'disable']);
    Route::get('/disable-product-index', [DisableProductApiController::class, 'index']);
    Route::get('/move-disable-product/{id}', [DisableProductApiController::class, 'move']);

});
Route::post('/add-multiple-images', [MultipleUploadController::class, 'store']);
Route::post('/add-single-image', [MultipleUploadController::class, 'uploadImage']);
Route::get('/image', [MultipleUploadController::class, 'getOriginalUrlAttribute']);



