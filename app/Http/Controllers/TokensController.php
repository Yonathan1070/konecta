<?php

namespace App\Http\Controllers;

use App\Models\Tablas\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class TokensController extends Controller
{

    /** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'USR_Documento_Usuario' => 'required',
            'USR_Nombres_Usuario' => 'required',
            'USR_Apellidos_Usuario' => 'required',
            'USR_Direccion_Residencia_Usuario' => 'required',
            'USR_Correo_Usuario' => 'required|email',
            'USR_Nombre_Usuario' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = Usuarios::create($input); 
        $success['token'] =  $user->createToken('MyApp')-> accessToken; 
        $success['name'] =  $user->USR_Nombres_Usuario;
        
        return response()->json(['success'=>$success], 200); 
    }
    
    public function login(Request $request)
    {
        $credenciales = $request->only('username', 'password');
        $validador = Validator::make($credenciales, [
            'username' => 'required',
            'password' => 'required'
        ]);
        if ($validador->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Falló validación',
                'errors' => $validador->errors()
            ], 422);
        }

        if(Auth::attempt(['USR_Nombre_Usuario' => $credenciales['username'], 'password' => $credenciales['password']])){ 
            $user = Auth::user();
            $roles = $user->roles()->where('USR_RLS_Estado', 1)->first();
            $success = [
                'token' => $user->createToken('MyApp')->accessToken,
                'rol' => $roles
            ];
            return response()->json(['success' => $success], 200);
        } 
        else{ 
            return response()->json(['error'=>'Unauthorised'], 401); 
        }
    }

    /** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], 200); 
    }

    public function logout()
    { 
        if (Auth::check()) {
            $user = Auth::user()->token();
            $user->revoke();
           return response()->json(['success' => 'Sesión Finalizada'], 200);
        }
    }
}
