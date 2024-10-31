<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/product', function () {
    return view('product');
});

// Route::get('/stocks/report', [StockReportController::class, 'generateReport'])->name('stocks.report');

Route::get('/report/preview', [StockReportController::class, 'generateReport'])->name('report.preview');

