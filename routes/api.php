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

Route::middleware('auth:api')->group(function (){
    Route::prefix('user')->group(function () {
        Route::get('/', [UsuarioController::class, 'usuario']);
        Route::put('/editar', [UsuarioController::class, 'edit']);
        Route::post('/logout', [UsuarioController::class, 'logout']);
    });

    Route::prefix('pet')->group(function() {
        Route::get('/listar', [PetController::class, 'listar']);
        Route::get('/editar/{id}', [PetController::class, 'editar']);
        Route::get('/select/{id}', [PetController::class, 'select']);
        Route::post('/cadastro', [PetController::class, 'cadastrar']);
        Route::put('/atualizar/{id}', [PetController::class, 'atualizar']);
    });

    Route::prefix('procedimento')->group(function () {
        Route::get('/listar', [ProcedimentoController::class, 'list']);
        Route::post('/cadastro', [ProcedimentoController::class, 'create']);
    });

    Route::prefix('vacina')->group(function () {
        Route::get('/select', [VacinaController::class, 'select']);
    });

    Route::prefix('raca')->group(function () {
        Route::get('/select/{id}', [RacaController::class, 'select']);
    });

    Route::prefix('especie')->group(function () {
        Route::get('/select', [EspecieController::class, 'select']);
    });

    Route::prefix('medicamento')->group(function () {
        Route::post('/cadastro', [MedicamentoController::class, 'create']);
        Route::get('/listar', [MedicamentoController::class, 'list']);
        Route::put('/atualizar/{id}', [MedicamentoController::class, 'update']);
    });

    Route::prefix('tipo_medicamento')->group(function () {
        Route::post('/cadastro', [TiposMedicamentosController::class, 'create']);
        Route::get('/listar', [TiposMedicamentosController::class, 'list']);
    });
});



