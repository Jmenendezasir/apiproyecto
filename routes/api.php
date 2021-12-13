<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Juegos\JuegosController;

Route::get('/juegos', [JuegosController::class, 'index']);
Route::post('/juegos/insert', [JuegosController::class, 'insert']);