<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\MultiImageController;

use Illuminate\Support\Facades\Route;
use App\Models\User;

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

Route::get('/', function () {
    return view('home');
});

Route::middleware(['auth'])->group(function () {
    // Product Category
    Route::resource('category', CategoryController::class);
    Route::get('/restoreCategory/{id}', [CategoryController::class, 'restoreCategory'])->name('restoreCategory');
    Route::get('/moveAllCategoriesToBin', [CategoryController::class, 'moveAllCategoriesToBin'])->name('moveAllCategoriesToBin');
    Route::get('/deleteCategoryPermanently/{id}', [CategoryController::class, 'deleteCategoryPermanently'])->name('deleteCategoryPermanently');
    Route::get('/deleteAllCategoriesPermanently', [CategoryController::class, 'deleteAllCategoryPermanently'])->name('deleteAllCategoriesPermanently');
    Route::get('/restoreAllCategories', [CategoryController::class, 'restoreAllCategories'])->name('restoreAllCategories');

    // Brand routes
    Route::resource('brand', BrandController::class);

    // Multi Image for the brand 
    Route::resource('multi_image', MultiImageController::class);
});



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    return view('admin.index');
})->name('dashboard');
