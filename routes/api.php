<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/visits', [\App\Http\Controllers\VisitsController::class, 'saveVisitCountry']);
Route::get('/visits', [\App\Http\Controllers\VisitsController::class, 'getCountriesVisits']);
