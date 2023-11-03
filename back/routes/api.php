<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PetController,
    RacaController,
    VacinaController,
    EspecieController,
    UsuarioController,
    MedicamentoController,
    ProcedimentoController,
    TiposMedicamentosController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [UsuarioController::class, 'login']);
Route::post('/cadastro', [UsuarioController::class, 'create']);

Route::middleware('auth:api')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/', [UsuarioController::class, 'user']);
        Route::put('/editar', [UsuarioController::class, 'edit']);
        Route::post('/logout', [UsuarioController::class, 'logout']);
        Route::delete('/deletar', [UsuarioController::class, 'delete']);
    });

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

    Route::prefix('procedimento')->group(function () {
        Route::get('/listar', [ProcedimentoController::class, 'list']);
        Route::post('/cadastro', [ProcedimentoController::class, 'create']);
        Route::get('/buscar', [ProcedimentoController::class, 'search']);
    });

    Route::prefix('vacina')->group(function () {
        Route::get('/select', [VacinaController::class, 'select']);
        Route::get('/buscar', [VacinaController::class, 'search']);
    });

    Route::prefix('raca')->group(function () {
        Route::get('/select/{especieId}', [RacaController::class, 'select']);
    });

    Route::prefix('especie')->group(function () {
        Route::get('/select', [EspecieController::class, 'select']);
    });

    Route::prefix('medicamento')->group(function () {
        Route::post('/cadastro', [MedicamentoController::class, 'create']);
        Route::get('/listar', [MedicamentoController::class, 'list']);
        Route::put('/atualizar/{id}', [MedicamentoController::class, 'update']);
        Route::get('/buscar', [MedicamentoController::class, 'search']);
    });

    Route::prefix('tipo_medicamento')->group(function () {
        Route::post('/cadastro', [TiposMedicamentosController::class, 'create']);
        Route::get('/listar', [TiposMedicamentosController::class, 'list']);
    });
});
