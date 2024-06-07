<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [OrderController::class, 'StepOrder'])->name('StepOrder');
Route::get('/get-restaurants/{mealId}', [OrderController::class, 'getRestaurants'])->name('getRestaurants');
Route::get('/get-dishes/{restaurantId}', [OrderController::class, 'getdishes'])->name('getdishes');

Route::post('/submit-form', [OrderController::class, 'submitFormOrder'])->name('submitFormOrder');
