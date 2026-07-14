<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortController;
use App\Http\Controllers\WeatherController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Countries
    Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');
    Route::get('/countries/import', [CountryController::class, 'import'])->name('countries.import');
    Route::get('/countries/{country}', [CountryController::class, 'show'])->name('countries.show');
    Route::get('/countries/{country}/edit', [CountryController::class, 'edit'])->name('countries.edit');
    Route::put('/countries/{country}', [CountryController::class, 'update'])->name('countries.update');
    Route::delete('/countries/{country}', [CountryController::class, 'destroy'])->name('countries.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Ports
    Route::resource('ports', App\Http\Controllers\PortController::class);
    Route::get('/ports/{port}', [PortController::class, 'show'])
    ->name('ports.show');
    Route::get('/ports/{port}/edit', [PortController::class, 'edit'])->name('ports.edit');
    Route::put('/ports/{port}', [PortController::class, 'update'])->name('ports.update');
    Route::delete('/ports/{port}', [PortController::class, 'destroy'])->name('ports.destroy');

    Route::resource('weather', WeatherController::class);
    Route::get('/weather/{weather}/refresh', [WeatherController::class, 'refresh'])
        ->name('weather.refresh');


});

require __DIR__.'/auth.php';