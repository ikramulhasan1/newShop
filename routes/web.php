<?php

use Illuminate\Support\Str;
// use GuzzleHttp\Psr7\Request;
// use Dotenv\Util\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\CategoryRequest;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resources([
        'categories' => CategoryController::class,
    ]);
});

require __DIR__ . '/auth.php';
