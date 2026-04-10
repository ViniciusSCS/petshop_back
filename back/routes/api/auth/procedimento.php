<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    ProcedimentoController,
};

Route::prefix('procedimento')->group(function () {
    Route::get('/listar', [ProcedimentoController::class, 'list']);
    Route::post('/cadastro', [ProcedimentoController::class, 'create']);
    Route::get('/buscar', [ProcedimentoController::class, 'search']);
});