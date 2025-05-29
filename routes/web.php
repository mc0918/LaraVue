<?php

use App\Http\Controllers\Table\GeographyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [GeographyController::class, 'index'])->name('home');
