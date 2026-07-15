<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\EconomyController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RiskScoreController;
use App\Http\Controllers\ComparisonController;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\MapController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Countries
    Route::get('/countries', [CountryController::class, 'index'])->name('countries.index');
    Route::post('/countries', [CountryController::class, 'store'])->name('countries.store');
    Route::get('/countries/import', [CountryController::class, 'import'])->name('countries.import');
    Route::get('/countries/{country}', [CountryController::class, 'show'])->name('countries.show');
    Route::get('/countries/{country}/edit', [CountryController::class, 'edit'])->name('countries.edit');
    Route::put('/countries/{country}', [CountryController::class, 'update'])->name('countries.update');
    Route::delete('/countries/{country}', [CountryController::class, 'destroy'])->name('countries.destroy');

    // Profile
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

    // Weather
    Route::get('/weather', [WeatherController::class, 'index'])
    ->name('weather.index');

    Route::post('/weather/update', [WeatherController::class, 'updateAll'])
    ->name('weather.update');
    Route::resource('weather', WeatherController::class);

    Route::post(
        '/weather/update',
        [WeatherController::class,'updateAll']
    )->name('weather.update');

    Route::get(
        '/weather/{weather}/refresh',
        [WeatherController::class,'refresh']
    )->name('weather.refresh');

    // Economy
    Route::resource('economy', EconomyController::class);

    // News
    Route::resource('news', NewsController::class);
    Route::post(
        '/news/update-api',
        [NewsController::class, 'updateApi']
    )->name('news.updateApi');

    // Risk Score
    Route::resource('risk-score', RiskScoreController::class);
    Route::post('risk-score/{country}/calculate',
        [RiskScoreController::class,'calculate'])
        ->name('risk-score.calculate');
    
    // Comparison
    Route::get('/comparison', [ComparisonController::class, 'index'])
    ->name('comparison.index');
    
    // Watchlist
    Route::get('/watchlist',
    [WatchlistController::class,'index'])
    ->name('watchlist.index');

    Route::post('/watchlist/{country}',
    [WatchlistController::class,'store'])
    ->name('watchlist.store');

    Route::delete('/watchlist/{watchlist}',
    [WatchlistController::class,'destroy'])
    ->name('watchlist.destroy');

    // Currency
    Route::resource('currency', CurrencyController::class);
    Route::post(
        '/currency/update-rates',
        [CurrencyController::class, 'updateRates']
    )->name('currency.updateRates');

    // Map
    Route::get('/map',[MapController::class,'index'])
    ->name('map.index');
    
});


require __DIR__.'/auth.php';