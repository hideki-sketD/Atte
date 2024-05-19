<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StampingController;


Route::get('/', [StampingController::class, 'index']);
