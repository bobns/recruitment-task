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


Route::get('/', [PostController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');
Route::get('posts/create', [PostController::class, 'create'])->middleware(['auth'])->name('post-form');
Route::post('posts/create', [PostController::class, 'store'])->middleware(['auth'])->name('create-post');
Route::get('posts/{postId}', [PostController::class, 'edit'])->middleware(['auth'])->name('edit-post-form');
Route::put('posts/{postId}', [PostController::class, 'update'])->middleware(['auth'])->name('update-post');
Route::delete('posts/{postId}/delete', [PostController::class, 'destroy'])->middleware(['auth'])->name('delete-post');
Route::get('categories/create', [CategoryController::class, 'create'])->middleware(['auth'])->name('category-form');
Route::post('categories/create', [CategoryController::class, 'store'])->middleware(['auth'])->name('create-category');

Route::get('/categories', [CategoryController::class, 'index'])->middleware(['auth'])->name('categories');
Route::get('posts', [PostController::class, 'index'])->middleware(['auth'])->name('posts');

Route::get('/categories/{categoryId}', [CategoryController::class, 'edit'])->middleware(['auth'])->name('edit-category-form');
Route::put('/categories/{categoryId}', [CategoryController::class, 'update'])->middleware(['auth'])->name('update-category');
Route::delete('categories/{categoryId}/delete', [CategoryController::class, 'destroy'])->middleware(['auth'])->name('delete-category');


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';