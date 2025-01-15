<?php

use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

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
});

Route::get('/key', function () {
    return response()->json([
        'apiKey' => config('services.openweather.key')
    ]);
});

Route::prefix('weather')->group(function () {
    Route::get('/current', [WeatherController::class, 'getCurrentWeather']);
    Route::get('/forecast', [WeatherController::class, 'getForecast']);
});
Route::post('/submit-payment', [PaymentController::class, 'store'])->middleware('auth');
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/payments', [App\Http\Controllers\Admin\PaymentController::class, 'index']);
    Route::post('/admin/payments/{payment}/status', [App\Http\Controllers\Admin\PaymentController::class, 'updateStatus']);
});
require __DIR__.'/auth.php';
