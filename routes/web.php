<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CatimageController;
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
    Route::get('/create', [CatimageController::class, 'create'])->name('create.form');
    Route::post('/upload', [CatimageController::class, 'store'])->name('upload.catimage');
    Route::post('/destroy{id}', [CatimageController::class, 'destroy'])->name('create.destroy');
    
    Route::get('/create/nice/{post}', [NiceController::class, 'nice'])->name('nice');
    Route::get('/create/unnice/{post}', [NiceController::class, 'unnice'])->name('unnice');
});

require __DIR__.'/auth.php';
