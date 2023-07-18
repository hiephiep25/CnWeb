<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\CommentController;
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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/my-blogs', [BlogController::class, 'index'])->name('my-blogs');
    Route::get('/new-blog', function () {
        return view('new-blog');
    });
    Route::post('/new-blog', [BlogController::class, 'store']);
    Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');

    Route::get('dashboard/blogs/{blog}', [DashboardController::class, 'show'])->name('blogs.show');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::get('auth/google', [GoogleController::class, 'signInwithGoogle']);
Route::get('callback/google', [GoogleController::class, 'callbackToGoogle']);
