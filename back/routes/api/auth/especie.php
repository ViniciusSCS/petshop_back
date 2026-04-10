<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    EspecieController,
};

Route::prefix('especie')->group(function () {
    Route::get('/select', [EspecieController::class, 'select']);
});