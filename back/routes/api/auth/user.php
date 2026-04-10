<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UsuarioController,
};

Route::prefix('user')->group(function () {
    Route::get('/', [UsuarioController::class, 'user']);
    Route::put('/atualizar', [UsuarioController::class, 'update']);
    Route::post('/logout', [UsuarioController::class, 'logout']);
    Route::delete('/deletar', [UsuarioController::class, 'delete']);
    Route::get('/select', [UsuarioController::class, 'select']);
});