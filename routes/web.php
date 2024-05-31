<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerifyToken;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::view('/', 'layouts.sidenav-app');


Route::view('/login', 'pages.auth.login-page')->name('login');
Route::view('/registration', 'pages.auth.registration-page')->name('registration');
Route::view('/send-otp', 'pages.auth.send-otp-page')->name('send-otp');
Route::view('/verify-otp', 'pages.auth.verify-otp-page')->name('verify-otp');
Route::view('/reset-pass', 'pages.auth.reset-pass-page')->name('reset-pass');
Route::view('/profile', 'pages.dashboard.profile-page')->middleware([TokenVerifyToken::class]);




Route::post('/registration', [UserController::class, 'registration']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/log-out', [UserController::class, 'logout'])
    ->middleware(TokenVerifyToken::class)
    ->name('logout');


Route::post('/send-otp', [UserController::class, 'sendOtp']);
Route::post('/verify-otp', [UserController::class, 'verifyOtp']);
Route::post('/reset-pass', [UserController::class, 'resetPassword'])
    ->middleware(TokenVerifyToken::class);
