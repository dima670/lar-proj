<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/data', [\App\Http\Controllers\DataController::class, 'index'])->name('data.index');
