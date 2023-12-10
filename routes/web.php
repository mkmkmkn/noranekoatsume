<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CatimageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AlbumController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
    // Route::get('/', function () {
    //     return view('welcome');
    // });
    Route::get('/create', [App\Http\Controllers\CatimageController::class, 'create'])->name('create.form');
    Route::post('/upload', [CatimageController::class, 'store'])->name('upload.catimage');
    Route::post('/destroy{id}', [CatimageController::class, 'destroy'])->name('create.destroy');
    
    // Route::get('/create/nice/{post}', [NiceController::class, 'nice'])->name('nice');
    // Route::get('/create/unnice/{post}', [NiceController::class, 'unnice'])->name('unnice');

    // Route::get('/album', [AlbumController::class, 'create'])->name('create');
    // Route::post('/upload', [AlbumController::class, 'store'])->name('upload.catimage');
    // Route::post('/destroy{id}', [AlbumController::class, 'destroy'])->name('create.destroy');
});

    Route::post('/create/nice', [CatimageController::class, 'nice'])->name('nice');
    Route::get('/create/unnice/{post}', [CatimageController::class, 'unnice'])->name('unnice');

    Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/comment/destroy{id}', [CommentController::class, 'destroy'])->name('comment.destroy');

require __DIR__.'/auth.php';
