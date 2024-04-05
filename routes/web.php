<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\IncomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Mail\VerifyEmail;
use App\Models\Income;

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


// Route::get('/verify', [UserController::class, 'verifyEmail'])->name('user.verify');
Route::get('/verify/{id}', [UserController::class, 'verifyEmail'])->name('user.verify');
Route::get('/resend', [UserController::class, 'sendVerifyEmail'])->name('user.resend');

Route::get('/forget', function () {
    return view('user.forget');
})->name('user.forget');
Route::post('/forget', [UserController::class, 'forgetPassword'])->name('user.forget');

Route::get('/reset', function (Request $request) {
    return view('user.reset')->with('token', $request->token)->with('email', $request->email);
})->name('password.reset');
Route::post('/reset', [UserController::class, 'resetPassword'])->name('password.reset');


// Accounts urls
Route::get('/accounts', [AccountController::class, 'index'])->name('accounts.index');
Route::get('/accounts/create', [AccountController::class, 'create'])->name('accounts.create');
Route::post('/accounts/store', [AccountController::class, 'store'])->name('accounts.store');
Route::get('/accounts/{id}/show', [AccountController::class, 'show'])->name('accounts.show');
Route::get('/accounts/{account}/edit', [AccountController::class, 'edit'])->name('accounts.edit');
Route::put('/accounts/{account}/upadte', [AccountController::class, 'update'])->name('accounts.update');
Route::get('/accounts/{account}/delete', [AccountController::class, 'destroy'])->name('accounts.delete');


// Income urls
Route::get('/incomes/create', [IncomeController::class, 'create'])->name('incomes.create');
Route::post('/incomes/store', [IncomeController::class, 'store'])->name('incomes.store');
Route::get('/incomes', [IncomeController::class, 'index'])->name('incomes.index');
Route::get('/incomes/{income}/show', [IncomeController::class, 'show'])->name('incomes.show');
Route::get('/incomes/{income}/edit', [IncomeController::class, 'edit'])->name('incomes.edit');
Route::put('/incomes/{income}/update', [IncomeController::class, 'update'])->name('incomes.update');
Route::get('/incomes/{income}/delete', [IncomeController::class, 'destroy'])->name('incomes.delete');
