<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PetController
};

Route::prefix('pet')->group(function () {
    Route::post('/cadastro', [PetController::class, 'create']);
    Route::get('/listar', [PetController::class, 'list']);
    Route::get('/editar/{id}', [PetController::class, 'edit']);
    Route::get('/select/{id}', [PetController::class, 'select']);
    Route::get('/relatorio', [PetController::class, 'petReport']);
    Route::get('/buscar', [PetController::class, 'search']);
    Route::put('/atualizar/{id}', [PetController::class, 'update']);
    Route::put('/pet-falecido/{id}', [PetController::class, 'demise']);
    Route::delete('/deletar/{id}', [PetController::class, 'delete']);
});