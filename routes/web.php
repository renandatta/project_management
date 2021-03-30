<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

Route::get('assets/{folder}/{filename}', function ($folder,$filename){
    $path = storage_path('app/' . $folder . '/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('profiles')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profiles');
    Route::post('search', [ProfileController::class, 'search'])->name('profiles.search');
    Route::post('info', [ProfileController::class, 'info'])->name('profiles.info');
    Route::post('save', [ProfileController::class, 'save'])->name('profiles.save');
    Route::post('delete', [ProfileController::class, 'delete'])->name('profiles.delete');
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

Route::prefix('invoices')->group(function () {
    Route::get('/', [InvoiceController::class, 'index'])->name('invoices');
    Route::post('search', [InvoiceController::class, 'search'])->name('invoices.search');
    Route::get('info/{id?}', [InvoiceController::class, 'info'])->name('invoices.info');
    Route::post('save', [InvoiceController::class, 'save'])->name('invoices.save');
    Route::post('delete', [InvoiceController::class, 'delete'])->name('invoices.delete');

    Route::prefix('details')->group(function () {
        Route::post('info', [InvoiceController::class, 'details_info'])->name('invoices.details.info');
        Route::post('delete', [InvoiceController::class, 'details_delete'])->name('invoices.details.delete');
    });
});
