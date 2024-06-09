<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StampingController;


Route::middleware('auth')->group(function () {
    Route::get('/', [StampingController::class, 'index'])->name('index');
});



Route::post('/punch-in', [StampingController::class, 'punchIn'])->name('punch.in');
Route::post('/punch-out', [StampingController::class, 'punchOut'])->name('punch.out');

Route::post('/start', [StampingController::class, 'start'])->name('rest.start');
Route::post('/end', [StampingController::class, 'end'])->name('rest.end');

Route::get('/attendance/{date?}', [StampingController::class, 'Attendance'])->name('attendance');