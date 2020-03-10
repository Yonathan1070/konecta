<?php

namespace App\Http\Controllers;

use App\Models\Tablas\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * TokensController, permite realizar el inicio de sesión y generar el
 * token JWT para el uso de la api rest de la aplicación, al igual que
 * finalizar la sesión activa.
 * 
 * @author: Yonathan Bohorquez
 * @email: yonathancam@hotmail.com
 * 
 * 
 * @version: 09/03/2020 1.0
 */
class TokensController extends Controller
{   
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

        $usuario = Usuarios::where('USR_Nombre_Usuario', $credenciales['username'])->first();
        $correcta = Hash::check($credenciales['password'], $usuario->password, []);
        if(Auth::attempt(['USR_Nombre_Usuario' => $credenciales['username'], 'password' => $credenciales['password']]) && $correcta == true){ 
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

    public function logout()
    { 
        if (Auth::check()) {
            $user = Auth::user()->token();
            $user->revoke();
           return response()->json(['success' => 'Sesión Finalizada'], 200);
        }
    }
}
