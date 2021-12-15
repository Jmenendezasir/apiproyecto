<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(Request $request){

        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        $credentials = request(['email', 'password']);

        if(!Auth::attempt($credentials)){
            return response()->json([
                'status' => 'error',
                'message' => 'Credenciales Incorrectas', 'code' => 401
          ]);
        }

        $user = $request->user();

        $tokenAuth = $user->createToken('Personal Access Token');
        $token = $tokenAuth->accessToken;
        $tokenAuth->token->user_id = $user['id'];

        $tokenAuth->token->expires_at = Carbon::now()->addWeeks(1);

        $tokenAuth->token->save();

        return response()->json([
            'status' => 'success',
            'token' => [
               //  'token' => $tokenAuth,
                 'access_token' => $token,
                 'token_type' => 'Bearer ',
                 'expires_at' => Carbon::parse($tokenAuth->token->expires_at)->toDateTimeString()
            ]
        ]);


    }
    //
    public function signup(Request $request){

        $rules = [
            'id'       => 'required|integer',
            'nombre'   => 'required',
            'email'    => 'required',
            'ciudad'   => 'required',
            'rol'      => 'required',
            'password' => 'required',
            'image'    => 'required',
        ];

        $input = $request->all();
        $validator = Validator::make($input, $rules);
        if ($validator->fails()){
            return response()->json([
                'status' => 'error',
                'message' => 'Error en la validación de los datos',
                'errors'=> $validator->errors()
            ], 200);
        }

        $user = User::create(array(
            'id'       => $request->input('id'),
            'rol'      => $request->input('rol'),
            'nombre'   => $request->input('nombre'),
            'ciudad'   => $request->input('ciudad'),
            'email'    => $request->input('email'),
            'password' => bcrypt($request->password),
            'image'    => $request->input('image')
        ));
        $user->save();

        $tokenAuth = $user->createToken('Personal Access Token');
        $token = $tokenAuth->accessToken;
        $tokenAuth->token->user_id = $request->input('id');
        $tokenAuth->token->save();
        return response()->json([
            'status' => 'success',
            'data' =>  $tokenAuth,
            'message' => 'Successfully created user! '], 201);

    }
        
    public function logout(Request $request){

        $request->user()->token()->revoke();
        return  response()->json([
            'message' => 'Sesión finalizada con éxito',
    ]);
}

    public function getUser(Request $request) {

        //$user = $request->user();
            $user = Auth::user();
            return  response()->json([
                'data' => $user,
                'status' => 'success',
                'code' => 401,
                'message' => 'Datos del usuario',
            ]);
      }
  
}