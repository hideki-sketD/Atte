<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StampingController;


Route::middleware('auth')->group(function () {
    Route::get('/', [StampingController::class, 'index']);
});