<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Juegos\JuegosController;
use App\Http\Controllers\Categorias\CategoriasController;

use App\Http\Controllers\Admin\AuthController;

Route::post('register', [AuthController::class, 'signup']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', [AuthController::class, 'getUser']);
    Route::post('/juegos/insert', [JuegosController::class, 'insert']);
});

Route::get('/juegos', [JuegosController::class, 'index']);
Route::get('/categorias', [CategoriasController::class, 'index']);
