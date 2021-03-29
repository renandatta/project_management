<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
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

Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('projects');
    Route::post('search', [ProjectController::class, 'search'])->name('projects.search');
    Route::post('info', [ProjectController::class, 'info'])->name('projects.info');
    Route::post('save', [ProjectController::class, 'save'])->name('projects.save');
    Route::post('delete', [ProjectController::class, 'delete'])->name('projects.delete');
});
