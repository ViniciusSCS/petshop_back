<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    MedicamentoController,
};

Route::prefix('medicamento')->group(function () {
    Route::post('/cadastro', [MedicamentoController::class, 'create']);
    Route::get('/listar', [MedicamentoController::class, 'list']);
    Route::put('/atualizar/{id}', [MedicamentoController::class, 'update']);
    Route::get('/buscar', [MedicamentoController::class, 'search']);
});