<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FinancialReportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('financial-report.index');
});

Route::get('login', function() {
    return view('auth.login');
})->middleware('guest')->name('login');
Route::post('login/authenticate', [AuthController::class, 'authenticate'])->name('login.auth');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function() {
    Route::prefix('laporan-keuangan')->name('financial-report.')->group(function () {
        Route::get('/', [FinancialReportController::class, 'index'])->name('index');
        Route::get('tambah', [FinancialReportController::class, 'create'])->name('create');
        Route::get('export', [FinancialReportController::class, 'export'])->name('export');
        Route::post('simpan', [FinancialReportController::class, 'store'])->name('store');
        Route::get('{id}/edit', [FinancialReportController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [FinancialReportController::class, 'update'])->name('update');
        Route::delete('{id}/hapus', [FinancialReportController::class, 'destroy'])->name('delete');
    });

    Route::prefix('kategori')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('tambah', [CategoryController::class, 'create'])->name('create');
        Route::post('simpan', [CategoryController::class, 'store'])->name('store');
        Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('{id}/update', [CategoryController::class, 'update'])->name('update');
        Route::delete('{id}/hapus', [CategoryController::class, 'destroy'])->name('delete');
    });
});
