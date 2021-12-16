<?php

namespace App\Http\Controllers\Categorias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index()
    {
        return response()->json('Listado de categorias');
    }
}
