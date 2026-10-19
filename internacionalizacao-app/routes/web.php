<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/json', [MainController::class, 'jsonView'])->name('json');
Route::get('/parameters', [MainController::class, 'parametersView'])->name('parameters');
Route::post('/parameters', [MainController::class, 'parameter'])->name('parameter');
Route::get('/pluralization', [MainController::class, 'pluralization'])->name('pluralization');
Route::post('/pluralization', [MainController::class, 'pluralizationPost'])->name('pluralizationPost');
Route::get('/locale/{lang}', [MainController::class, 'locale']);