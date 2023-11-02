<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::get('send-otp',[\App\Http\Controllers\Api\AuthController::class,'sendOtp'])->name('send-otp');
Route::get('verify-otp/{id}',[\App\Http\Controllers\Api\AuthController::class,'verifyOtp'])->name('verify-otp');
Route::put('user-details',[\App\Http\Controllers\Api\AuthController::class,'userDetails'])->name('user-details');
Route::get('get-user-data/{id}',[\App\Http\Controllers\Api\AuthController::class,'getUserData'])->name('get-user-data');
//HOME
Route::get('get-category',[\App\Http\Controllers\Api\HomeController::class,'getCategory'])->name('get-category');
Route::get('get-all-category',[\App\Http\Controllers\Api\HomeController::class,'getAllCategory'])->name('get-all-category');
//ADD POST
Route::get('get-sub-category/{id}',[\App\Http\Controllers\Api\PostController::class,'getSubCategory'])->name('get-sub-category');
Route::post('submit-ads',[\App\Http\Controllers\Api\PostController::class,'submitMobilePost'])->name('submit-ads');
Route::post('submit-vehicle-ads',[\App\Http\Controllers\Api\PostController::class,'submitVehiclePost'])->name('submit-vehicle-ads');
Route::post('submit-property-ads',[\App\Http\Controllers\Api\PostController::class,'submitPropertyAds'])->name('submit-property-ads');
//GET ADS
Route::get('get-ads-by-category',[\App\Http\Controllers\Api\HomeController::class,'getAdsByCategory'])->name('get-ads-by-category');
