<?php

use App\Http\Controllers\BrandController;
use Illuminate\Support\Str;
// use GuzzleHttp\Psr7\Request;
// use Dotenv\Util\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SubCategoryController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Frontend view
Route::get('/', [FrontendController::class, 'index'])->name('front.home');
Route::get('/shop/{categorySlug?}/{subCategorySlug?}', [ShopController::class, 'index'])->name('front.shop');
Route::get('/product/{slug}', [ShopController::class, 'product'])->name('front.product');


Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resources([
        'categories' => CategoryController::class,
        'subcategories' => SubCategoryController::class,
        'brands' => BrandController::class,
        'products' => ProductController::class,
    ]);

    // categories
    Route::get('/category/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::get('/category/restore/{id}', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');

    // sub-category
    Route::get('/subcategory/trash', [SubCategoryController::class, 'trash'])->name('subcategories.trash');
    Route::get('/subcategory/restore/{id}', [SubCategoryController::class, 'restore'])->name('subcategories.restore');
    Route::get('/subcategory/delete/{id}', [SubCategoryController::class, 'delete'])->name('subcategories.delete');
});

require __DIR__ . '/auth.php';
