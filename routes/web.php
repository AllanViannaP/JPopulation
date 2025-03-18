<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsvImportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/import', [CsvImportController::class, 'showImportForm'])->name('import.form');
Route::post('/import', [CsvImportController::class, 'importCsv'])->name('import.csv');