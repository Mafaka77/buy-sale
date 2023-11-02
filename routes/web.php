<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
//Route::group(['middleware' => ['adminAuth']], function () {
//ADMIN
    Route::get('admin',[\App\Http\Controllers\AdminUserController::class,'index'])->name('admin');
    Route::get('dashboard',[\App\Http\Controllers\AdminDashboardController::class,'index'])->name('dashboard');
    Route::resource('category',\App\Http\Controllers\CategoryController::class);
    Route::post('upload-category-icon',[\App\Http\Controllers\CategoryController::class,'uploadCategoryIcon'])->name('upload-category-icon');

    //HOUSE TYPE
    Route::resource('house-type',\App\Http\Controllers\HouseTypeController::class);
    Route::post('upload-house-type-icon',[\App\Http\Controllers\HouseTypeController::class,'uploadIcon'])->name('upload-house-type-icon');
    //FURNISH TYPE
    Route::resource('furnish-type',\App\Http\Controllers\FurnishTypeController::class);
    //FURNISHING
    Route::resource('furnishing',\App\Http\Controllers\FurnishingsController::class);
    Route::post('upload-furnishing-icon',[\App\Http\Controllers\FurnishingsController::class,'uploadIcon'])->name('upload-furnishing-icon');
    //AMENITIES
    Route::resource('amenities',\App\Http\Controllers\AmenitiesController::class);
    Route::post('upload-amenities-icon',[\App\Http\Controllers\AmenitiesController::class,'uploadIcon'])->name('upload-amenities-icon');
    //SUB CATEGORY
    Route::resource('sub-category',\App\Http\Controllers\SubCategoryController::class);
    //BRANDS
    Route::resource('brands',\App\Http\Controllers\BrandController::class);
    Route::post('upload-brand-logo',[\App\Http\Controllers\BrandController::class,'uploadIcon'])->name('upload-brand-logo');
//});

//Route::resource('admin',\App\Http\Controllers\AdminUserController::class)->middleware('adminAuth');

