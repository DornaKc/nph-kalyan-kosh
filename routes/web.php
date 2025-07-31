<?php

use App\Http\Controllers\backend\BudgetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\backend\FiscalYearController;
use App\Http\Controllers\backend\MaghFaramController;
use App\Http\Controllers\backend\KharidAdeshController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    Route::resource('fiscalYear', FiscalYearController::class);
    Route::resource('maghFaram', MaghFaramController::class);
    Route::resource('budget', BudgetController::class);
    Route::resource('kharidAadesh', KharidAdeshController::class);


});

require __DIR__.'/auth.php';
