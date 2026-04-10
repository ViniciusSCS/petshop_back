<?php

use Illuminate\Support\Facades\Route;


require __DIR__ . '/api/notValidated.php';

Route::middleware('auth:api')->group(function () {

    require __DIR__ . '/api/auth/user.php';
    require __DIR__ . '/api/auth/pet.php';
    require __DIR__ . '/api/auth/procedimento.php';
    require __DIR__ . '/api/auth/vacina.php';
    require __DIR__ . '/api/auth/raca.php';
    require __DIR__ . '/api/auth/especie.php';
    require __DIR__ . '/api/auth/medicamento.php';
    require __DIR__ . '/api/auth/tipo_medicamento.php';
});
