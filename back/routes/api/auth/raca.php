<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    RacaController,
};

Route::prefix('raca')->group(function () {
    Route::get('/select/{especieId}', [RacaController::class, 'select']);
});