<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeSliderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('backend.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Category
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/store-category', [CategoryController::class, 'storeCategory'])->name('store-category');
    Route::post('/edit-category', [CategoryController::class, 'editCategory'])->name('edit-category');
    Route::get('/delete-category/{cat_id}', [CategoryController::class, 'deleteCategory'])->name('delete-category');
    Route::get('/restore-category/{id}', [CategoryController::class, 'resotoreCategory'])->name('restore-category');
    Route::get('/restore-all-category', [CategoryController::class, 'resotoreAllCategory'])->name('restore-all-Category');

    //Sub Category
    Route::get('/sub-category', [SubCategoryController::class, 'index'])->name('sub-category');
    Route::post('/store-subcategory', [SubCategoryController::class, 'storeSubcategory'])->name('store-subcategory');
    Route::post('/edit-subcategory', [SubCategoryController::class, 'editSubcategory'])->name('edit-subcategory');
    Route::get('/delete-subcategory/{sub_id}', [SubCategoryController::class, 'deleteSubcategory'])->name('delete-subcategory');
    Route::get('/restore-subcategory/{id}', [SubCategoryController::class, 'resotoreSubcategory'])->name('restore-subcategory');
    Route::get('/restore-all-subcategory', [SubCategoryController::class, 'resotoreAllSubcategory'])->name('restore-all-subcategory');

    // Product
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::post('/store-product', [ProductController::class, 'storeProduct'])->name('store-product');
    Route::post('/edit-product', [ProductController::class, 'editProduct'])->name('edit-product');
    Route::get('/delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('delete-product');
    Route::get('/restore-product/{id}', [ProductController::class, 'resotoreProduct'])->name('restore-product');
    Route::get('/restore-all-product', [ProductController::class, 'resotoreAllProduct'])->name('restore-all-Product');
    Route::get('/force-delete-product/{id}', [ProductController::class, 'forceDeleteProduct'])->name('force-delete-product');
    Route::get('/force-delete-all-product', [ProductController::class, 'forceDeleteAllProduct'])->name('force-delete-all-product');
    Route::get('/update-pin-status/{id}/{status}', [ProductController::class, 'updatePinStatus'])->name('update-pin-status');
    // Get Sub Category
    Route::get('/get-subcategory-ajax', [ProductController::class, 'getSubcategoryAjax'])->name('get-subcategory');
    // Product Description
    Route::get('/product-description/{id}', [ProductController::class, 'productDescriptionIndex'])->name('product-description');
    Route::post('/store-product-description', [ProductController::class, 'storeProductDescription'])->name('store-product-description');

    // Home Page
    Route::get('/home-slider', [HomeSliderController::class, 'index'])->name('home-slider');
    Route::post('/store-slider', [HomeSliderController::class, 'storeSlider'])->name('store-slider');
    Route::post('/edit-slider', [HomeSliderController::class, 'editSlider'])->name('edit-slider');
    Route::get('/delete-slider/{id}', [HomeSliderController::class, 'deleteSlider'])->name('delete-slider');
    Route::get('/restore-slider/{id}', [HomeSliderController::class, 'resotoreSlider'])->name('restore-slider');
    Route::get('/restore-all-slider', [HomeSliderController::class, 'resotoreAllSlider'])->name('restore-all-slider');
    Route::get('/force-delete-slider/{id}', [HomeSliderController::class, 'forceDeleteSlider'])->name('force-delete-slider');
    Route::get('/force-delete-all-slider', [HomeSliderController::class, 'forceDeleteAllSlider'])->name('force-delete-all-slider');




});












require __DIR__.'/auth.php';
