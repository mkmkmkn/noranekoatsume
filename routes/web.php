<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CatimageController;
use App\Http\Controllers\CatimageUploadController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\NiceController;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
    Route::get('/dashboard', [CatimageController::class, 'index'])->name('dashboard');
    Route::post('/destroy{id}', [CatimageController::class, 'destroy'])->name('catimage.destroy');

    Route::get('/catimage_upload', [CatimageUploadController::class, 'index'])->name('catimage_upload');
    Route::post('/upload', [CatimageUploadController::class, 'store'])->name('catimage.store');

    Route::get('/album', [AlbumController::class, 'index'])->name('album');
});

    Route::post('/nice', [NiceController::class, 'nice'])->name('nice');

    Route::post('/comment/store', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/comment/destroy{id}', [CommentController::class, 'destroy'])->name('comment.destroy');

require __DIR__.'/auth.php';
