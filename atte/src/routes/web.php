<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\StampingController;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


Route::get('/verify-email', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verify-email');



Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function () {
    Auth::user()->sendEmailVerificationNotification();
    return back()->with('resent', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');



Route::middleware('auth')->group(function () {
    Route::get('/', [StampingController::class, 'index'])->name('index');
    Route::post('/punch-in', [StampingController::class, 'punchIn'])->name('punch.in');
    Route::post('/punch-out', [StampingController::class, 'punchOut'])->name('punch.out');
    Route::post('/start', [StampingController::class, 'start'])->name('rest.start');
    Route::post('/end', [StampingController::class, 'end'])->name('rest.end');
    Route::get('/attendance/{date?}', [StampingController::class, 'Attendance'])->name('attendance');
    Route::get('/userlist', [StampingController::class, 'Userlist'])->name('userlist');
});



