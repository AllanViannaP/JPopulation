<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CsvImportController;
use App\Http\Controllers\PopulationController;

Route::get('/', [PopulationController::class, 'index'])->name('home');
Route::get('/search', [PopulationController::class, 'search'])->name('population.search');  
Route::get('/import', [CsvImportController::class, 'showImportForm'])->name('import.form');
Route::post('/import', [CsvImportController::class, 'importCsv'])->name('import.csv');