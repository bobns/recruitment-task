<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/', [PostController::class, 'dashboard'])->name('dashboard');

    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', [PostController::class, 'index'])->name('posts');
        Route::get('/create', [PostController::class, 'create'])->name('post-form');
        Route::post('/create', [PostController::class, 'store'])->name('create-post');
        Route::get('/{postId}', [PostController::class, 'edit'])->name('edit-post-form');
        Route::put('/{postId}', [PostController::class, 'update'])->name('update-post');
        Route::delete('/{postId}/delete', [PostController::class, 'destroy'])->name('delete-post');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories');
        Route::get('/create', [CategoryController::class, 'create'])->name('category-form');
        Route::post('/create', [CategoryController::class, 'store'])->name('create-category');
        Route::get('/{categoryId}', [CategoryController::class, 'edit'])->name('edit-category-form');
        Route::put('/{categoryId}', [CategoryController::class, 'update'])->name('update-category');
        Route::delete('/{categoryId}/delete', [CategoryController::class, 'destroy'])->name('delete-category');
    });
});








// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';