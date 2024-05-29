<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth', 'verified']], function(){
    //  Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    //  Deposit Routes
    Route::prefix('deposit')->group(function () {
        Route::get('list', [DepositController::class, 'index'])->name('deposit.list');
        Route::post('add', [DepositController::class, 'store'])->name('deposit.store');
    });
    //  Deposit Routes
    Route::prefix('withdrawal')->group(function () {
        Route::get('list', [WithdrawalController::class, 'index'])->name('withdrawal.list');
        Route::get('add', [WithdrawalController::class, 'create'])->name('withdrawal.add');
        Route::post('add', [WithdrawalController::class, 'store'])->name('withdrawal.store');
    });
});

require __DIR__.'/auth.php';
