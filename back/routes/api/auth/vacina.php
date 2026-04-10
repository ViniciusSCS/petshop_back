<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    VacinaController,
};

Route::prefix('vacina')->group(function () {
    Route::get('/select', [VacinaController::class, 'select']);
    Route::get('/buscar', [VacinaController::class, 'search']);
});