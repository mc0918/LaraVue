<?php

use App\Http\Controllers\Table\GeographyController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

// ignore csrf for demo purposes
Route::get('/', [GeographyController::class, 'index'])->name('home')->withoutMiddleware(VerifyCsrfToken::class);
Route::get('/favorites', [GeographyController::class, 'getCountryLists'])->name('favorites')->withoutMiddleware(VerifyCsrfToken::class);
Route::post('/save', [GeographyController::class, 'save'])->name('save')->withoutMiddleware(VerifyCsrfToken::class);
Route::delete('/delete/{id}', [GeographyController::class, 'deleteCountryList'])->name('delete')->withoutMiddleware(VerifyCsrfToken::class);
Route::delete('/delete/{listId}/country/{countryId}', [GeographyController::class, 'deleteCountryFromList'])->name('deleteCountry')->withoutMiddleware(VerifyCsrfToken::class);
