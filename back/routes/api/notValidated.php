<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UsuarioController
};

Route::post('/login', [UsuarioController::class, 'login']);
Route::post('/cadastro', [UsuarioController::class, 'create']);
