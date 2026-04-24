<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// moje rute
Route::get('/convert', [CurrencyController::class, 'showForm']);
Route::post('/convert', [CurrencyController::class, 'convert']);


// Breeze
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // NOVA RUTA (image upload)
    Route::post('/profile/change-avatar', [ProfileController::class, 'changeAvatar'])->name('profile.changeAvatar');
});

require __DIR__ . '/auth.php';
