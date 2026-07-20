<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\EquipoController;
use \App\Http\Controllers\ClienteController;
use \App\Http\Controllers\DashboardController;

Route::inertia('/', 'Welcome')->name('home');

Route::resource('equipos', EquipoController::class);
Route::resource('clientes', ClienteController::class);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');
});


require __DIR__.'/settings.php';
