<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\ReportController;




Route::get('/',[AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login',[AuthController::class, 'login'])->name('login.submit');


Route::get('/register',[AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register',[AuthController::class, 'register'])->name('register.submit');

Route::middleware('auth')-> group( function(){
    Route::get('dashboard', [DashboardController::class, 'showStats'])->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::resource('stockin', StockInController::class);
    Route::resource('stockout', StockOutController::class);
    Route::get('/reports', [ReportController::class, 'getReportPage'])->name('report.page');
    Route::post('/reports', [ReportController::class, 'getReport'])->name('report.generate');

});