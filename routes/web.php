<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyController;

Route::get('/', function () {
    return view('welcome');
});

// GET forma
Route::get('/convert', [CurrencyController::class, 'showForm']);

// POST konverzija
Route::post('/convert', [CurrencyController::class, 'convert']);
