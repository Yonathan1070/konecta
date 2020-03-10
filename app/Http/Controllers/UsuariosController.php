<?php

namespace App\Http\Controllers;

use App\Models\Tablas\Usuarios;
use App\Models\Tablas\UsuariosRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * UsuariosController, donde se visualizaran y realizaran cambios
 * en la Base de Datos de los usuarios
 * 
 * @author: Yonathan Bohorquez
 * @email: yonathancam@hotmail.com
 * 
 * 
 * @version: 07/03/2020 1.0
 */
class UsuariosController extends Controller
{
    /**
     * Obtiene el listado de todos los usuarios
     */
    public function obtenerTodos()
    {
        $usuarios = Usuarios::all();
        return $usuarios;
    }

    /**
     * Obtiene el listado de todos los administradores
     */
    public function obtenerAdministradores()
    {
        $user = Auth::user()->roles()->where('USR_RLS_Estado', 1)->first();
        if (strtolower($user->RLS_Nombre_Rol) == 'administrador') {
            $usuarios = DB::table('TBL_Usuarios as u')
                ->join('TBL_Usuarios_Roles as ur', 'ur.USR_RLS_Usuario_Id', '=', 'u.id')
                ->join('TBL_Roles as r', 'r.id', '=', 'ur.USR_RLS_Rol_Id')
                ->where('ur.USR_RLS_Estado', '=', 1)
                ->where('r.id', '=', 1)
                ->get();
            return $usuarios;
        }
        return response()->json(['error'=>'No tiene acceso'], 401);
    }

    /**
     * Obtiene el listado de todos los vendedores
     */
    public function obtenerVendedores()
    {
        if(can('listar-vendedores')){
            $usuarios = DB::table('TBL_Usuarios as u')
                ->join('TBL_Usuarios_Roles as ur', 'ur.USR_RLS_Usuario_Id', '=', 'u.id')
                ->join('TBL_Roles as r', 'r.id', '=', 'ur.USR_RLS_Rol_Id')
                ->where('ur.USR_RLS_Estado', '=', 1)
                ->where('r.id', '=', 2)
                ->get();
            return $usuarios;
        }
        
        return response()->json(['error'=>'No tiene acceso'], 401);
    }

    /**
     * Obtiene el listado de todos los clientes
     */
    public function obtenerClientes()
    {
        if(can('listar-clientes')){
            $usuarios = DB::table('TBL_Usuarios as u')
                ->join('TBL_Usuarios_Roles as ur', 'ur.USR_RLS_Usuario_Id', '=', 'u.id')
                ->join('TBL_Roles as r', 'r.id', '=', 'ur.USR_RLS_Rol_Id')
                ->where('ur.USR_RLS_Estado', '=', 1)
                ->where('r.id', '=', 3)
                ->get();
            return $usuarios;
        }
        return response()->json(['error'=>'No tiene acceso'], 401);
    }

    /**
     * Crear Usuarios
     */
    public function crearUsuario(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'USR_Documento_Usuario' => 'required|unique:TBL_Usuarios,USR_Documento_Usuario',
            'USR_Nombres_Usuario' => 'required',
            'USR_Apellidos_Usuario' => 'required',
            'USR_Direccion_Residencia_Usuario' => 'required',
            'USR_Correo_Usuario' => 'required|unique:TBL_Usuarios,USR_Correo_Usuario',
            'USR_Nombre_Usuario' => 'required|unique:TBL_Usuarios,USR_Nombre_Usuario',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'Rol_Id' => 'required'
        ]);

        if ($validador->fails()) {
            return response()->json(['error' => $validador->errors()], 422);
        }

        if ($request['Rol_Id'] == 2 && can('crear-vendedores')) {
            $usuario = Usuarios::crearUsuario($request);
            UsuariosRoles::crearAsociacion($request, $usuario->id);
            return response()->json(['success' => $usuario], 200);
        } else if ($request['Rol_Id'] == 3 && can('crear-clientes')) {
            $usuario = Usuarios::crearUsuario($request);
            UsuariosRoles::crearAsociacion($request, $usuario->id);
            return response()->json(['success' => $usuario], 200);
        } else {
            return response()->json(['error'=>'No tiene acceso'], 401);
        }
    }

    /**
     * Mostrar usuario
     *
     * @param  int  $id
     */
    public function obtenerUsuario($id)
    {
        $usuario = DB::table('TBL_Usuarios as u')
            ->join('TBL_Usuarios_Roles as ur', 'ur.USR_RLS_Usuario_Id', 'u.id')
            ->join('TBL_Roles as r', 'r.id', 'ur.USR_RLS_Rol_Id')
            ->where('u.id', $id)
            ->first();
        if (strtolower($usuario->RLS_Nombre_Rol) == 'administrador') {
            return response()->json(['success' => $usuario], 200);
        }
        if (can('obtener-vendedor') && strtolower($usuario->RLS_Nombre_Rol) == 'vendedor') {
            return response()->json(['success' => $usuario], 200);
        }
        if (can('obtener-cliente') && strtolower($usuario->RLS_Nombre_Rol) == 'cliente') {
            return response()->json(['success' => $usuario], 200);
        }
        
        return response()->json(['error'=>'No tiene acceso'], 401);
    }

    /**
     * Actualiza usuario
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function editarUsuario(Request $request, $id)
    {
        $validador = Validator::make($request->all(), [
            'USR_Documento_Usuario' => 'required|unique:TBL_Usuarios,USR_Documento_Usuario,'. $id,
            'USR_Nombres_Usuario' => 'required',
            'USR_Apellidos_Usuario' => 'required',
            'USR_Direccion_Residencia_Usuario' => 'required',
            'USR_Correo_Usuario' => 'required|unique:TBL_Usuarios,USR_Correo_Usuario,'. $id,
            'USR_Nombre_Usuario' => 'required|unique:TBL_Usuarios,USR_Nombre_Usuario,'. $id,
        ]);

        if ($validador->fails()) {
            return response()->json(['error' => $validador->errors()], 422);
        }

        $usuario = DB::table('TBL_Usuarios as u')
            ->join('TBL_Usuarios_Roles as ur', 'ur.USR_RLS_Usuario_Id', 'u.id')
            ->join('TBL_Roles as r', 'r.id', 'ur.USR_RLS_Rol_Id')
            ->where('u.id', $id)
            ->first();
        
        if (can('editar-vendedores') && strtolower($usuario->RLS_Nombre_Rol) == 'vendedor') {
            $usuario = Usuarios::find($id);
            $usuario->fill($request->all())->save();
            return response()->json(['success' => $usuario], 200);
        } else if (can('editar-clientes') && strtolower($usuario->RLS_Nombre_Rol) == 'cliente') {
            $usuario = Usuarios::find($id);
            $usuario->fill($request->all())->save();
            return response()->json(['success' => $usuario], 200);
        } else {
            return response()->json(['error'=>'No tiene acceso'], 401);
        }
        return $usuario;
    }

    /**
     * Eliminar usuario
     *
     * @param  int  $id
     */
    public function eliminarUsuario($id)
    {
        $usuario = DB::table('TBL_Usuarios as u')
            ->join('TBL_Usuarios_Roles as ur', 'ur.USR_RLS_Usuario_Id', 'u.id')
            ->join('TBL_Roles as r', 'r.id', 'ur.USR_RLS_Rol_Id')
            ->where('u.id', $id)
            ->select('r.*', 'ur.id as Id_Relacion')
            ->first();
        
        $idRelacion = $usuario->Id_Relacion;
        
        if (can('eliminar-vendedores') && strtolower($usuario->RLS_Nombre_Rol) == 'vendedor') {
            UsuariosRoles::find($idRelacion)->delete();
            $usuario = Usuarios::find($id);
            $usuario->delete();
            return response()->json(['eliminado' => $usuario], 200);
        } else if (can('eliminar-clientes') && strtolower($usuario->RLS_Nombre_Rol) == 'cliente') {
            UsuariosRoles::find($idRelacion)->delete();
            $usuario = Usuarios::find($id);
            $usuario->delete();
            return response()->json(['eliminado' => $usuario], 200);
        } else {
            return response()->json(['error'=>'No tiene acceso'], 401);
        }
        return $usuario;
    }
}
