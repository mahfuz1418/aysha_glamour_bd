<?php

use App\Http\Controllers\CategoryController;
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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Category
Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::post('/store-category', [CategoryController::class, 'storeCategory'])->name('store-category');
Route::post('/edit-category', [CategoryController::class, 'editCategory'])->name('edit-category');
Route::get('/delete-category/{cat_id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
Route::get('/restore-category/{id}', [CategoryController::class, 'resotoreCategory'])->name('deleteCategory');
Route::get('/restore-all-category', [CategoryController::class, 'resotoreAllCategory'])->name('restoreAllCategory');

// Category
Route::get('/sub-category', [SubCategoryController::class, 'index'])->name('sub-category');
Route::post('/store-subcategory', [SubCategoryController::class, 'storeSubcategory'])->name('store-subcategory');


















require __DIR__.'/auth.php';
