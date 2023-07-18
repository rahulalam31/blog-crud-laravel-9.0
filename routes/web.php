<?php

use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::post('comment/{id}', [CommentController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {




Route::get('/posts', [BlogsController::class, 'index'])->name('posts');
Route::get('/posts-create', [BlogsController::class, 'create'])->name('createBlog');

Route::get('/post/{id}/edit', [BlogsController::class, 'edit'])->name('editBlog');
Route::get('/post/{id}/delete', [BlogsController::class, 'destroy'])->name('destroyBlog');

Route::post('/posts-store', [BlogsController::class, 'store'])->name('storeBlog');
Route::post('/posts-update/{id}', [BlogsController::class, 'update'])->name('updateBlog');







    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
