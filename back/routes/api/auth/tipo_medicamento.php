<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    TiposMedicamentosController
};

Route::prefix('tipo_medicamento')->group(function () {
    Route::post('/cadastro', [TiposMedicamentosController::class, 'create']);
    Route::get('/listar', [TiposMedicamentosController::class, 'list']);
});