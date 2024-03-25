<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Mail\VerifyEmail;

Route::get('/', function () {
    return view('home');
});

Route::get('/register', function () {
    return view('user.register');
});
Route::post('/register', [UserController::class, 'register'])->name('user.register');

Route::get('/login', function () {
    return view('user.login');
})->name('user.login');
Route::post('/login', [UserController::class, 'login'])->name('user.login');
Route::get('/logout', [UserController::class, 'logout'])->name('user.logout');


Route::get('/verify', [UserController::class, 'verifyEmail'])->name('user.verify');
Route::get('/resend', [UserController::class, 'sendVerifyEmail'])->name('user.resend');

Route::get('/forget', function () {
    return view('user.forget');
})->name('user.forget');
Route::post('/forget', [UserController::class, 'forgetPassword'])->name('user.forget');

Route::get('/reset', function (Request $request) {
    return view('user.reset')->with('token', $request->token)->with('email', $request->email);
})->name('password.reset');
Route::post('/reset', [UserController::class, 'resetPassword'])->name('password.reset');
