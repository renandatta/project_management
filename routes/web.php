<?php

use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::prefix('clients')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('clients');
    Route::post('search', [ClientController::class, 'search'])->name('clients.search');
    Route::post('info', [ClientController::class, 'info'])->name('clients.info');
    Route::post('save', [ClientController::class, 'save'])->name('clients.save');
    Route::post('delete', [ClientController::class, 'delete'])->name('clients.delete');
});
