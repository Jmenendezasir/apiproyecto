<?php

namespace App\Http\Controllers\Juegos;

use App\Http\Controllers\Controller;
use App\Models\Juegos;
use Illuminate\Http\Request;

class JuegosController extends Controller
{
    public function index()
    {
        $juegos = Juegos::all();
        //return view('juegos/listar', array('juegos' => $juegos));
        return response()->json($juegos);
    }
    public function insert(Request $request)
    {
        
        $juego = Juegos::create(array
        (
            'idJuego'       => $request->input('idJuego'),
            'tituloJuego'   => $request->input('tituloJuego'),
            'descripcion'   => $request->input('descripcion'),
            'idGenero'      => $request->input('idGenero'),
            'precio'        => $request->input('precio'),
            'portada'       => $request->input('portada')
        ));
        $juego->save();
        if ($juego->save()){
            return response()->json([
                'status' => 'success',
                'message' => 'Se ha introducido el juego correctamente',
                'data' => $juego
            ], 200);
        }
    }
}