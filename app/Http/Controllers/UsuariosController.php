<?php

namespace App\Http\Controllers;

use App\Models\Tablas\Usuarios;
use App\Models\Tablas\UsuariosRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Usuarios Controller, donde se visualizaran y realizaran cambios
 * en la Base de Datos de los usuarios
 * 
 * @author: Yonathan Bohorquez
 * @email: ycbohorquez@ucundinamarca.edu.co
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
        $usuarios = DB::table('TBL_Usuarios as u')
            ->join('TBL_Usuarios_Roles as ur', 'ur.USR_RLS_Usuario_Id', '=', 'u.id')
            ->join('TBL_Roles as r', 'r.id', '=', 'ur.USR_RLS_Rol_Id')
            ->where('ur.USR_RLS_Estado', '=', 1)
            ->where('r.id', '=', 1)
            ->get();
        return $usuarios;
    }

    /**
     * Obtiene el listado de todos los vendedores
     */
    public function obtenerVendedores()
    {
        $usuarios = DB::table('TBL_Usuarios as u')
            ->join('TBL_Usuarios_Roles as ur', 'ur.USR_RLS_Usuario_Id', '=', 'u.id')
            ->join('TBL_Roles as r', 'r.id', '=', 'ur.USR_RLS_Rol_Id')
            ->where('ur.USR_RLS_Estado', '=', 1)
            ->where('r.id', '=', 2)
            ->get();
        return $usuarios;
    }

    /**
     * Obtiene el listado de todos los clientes
     */
    public function obtenerClientes()
    {
        $usuarios = DB::table('TBL_Usuarios as u')
            ->join('TBL_Usuarios_Roles as ur', 'ur.USR_RLS_Usuario_Id', '=', 'u.id')
            ->join('TBL_Roles as r', 'r.id', '=', 'ur.USR_RLS_Rol_Id')
            ->where('ur.USR_RLS_Estado', '=', 1)
            ->where('r.id', '=', 3)
            ->get();
        return $usuarios;
    }

    /**
     * Crear Usuario Administrador
     */
    public function crearUsuario(Request $request)
    {
        if (
            Usuarios::where('USR_Documento_Usuario', '=', $request['USR_Documento_Usuario'])
                ->first()
        ) {
            return response()
                ->json('El documento del usuario ya está registrado', 200);
        }
        if (
            Usuarios::where('USR_Correo_Usuario', '=', $request['USR_Correo_Usuario'])
                ->first()
        ) {
            return response()
                ->json('El correo del usuario ya se encuentra en uso', 200);
        }
        if (
            Usuarios::where('USR_Nombre_Usuario', '=', $request['USR_Nombre_Usuario'])
                ->first()
        ) {
            return response()
                ->json('El Nombre de usuario ya está en uso', 200);
        }
        $usuario = Usuarios::create([
            'USR_Documento_Usuario' => $request['USR_Documento_Usuario'],
            'USR_Nombres_Usuario' => $request['USR_Nombres_Usuario'],
            'USR_Apellidos_Usuario' => $request['USR_Apellidos_Usuario'],
            'USR_Direccion_Residencia_Usuario' => $request['USR_Direccion_Residencia_Usuario'],
            'USR_Correo_Usuario' => $request['USR_Correo_Usuario'],
            'USR_Nombre_Usuario' => $request['USR_Nombre_Usuario'],
            'password' => bcrypt($request['password'])
        ]);
        UsuariosRoles::create([
            'USR_RLS_Rol_Id' => $request['Id_Rol'],
            'USR_RLS_Usuario_Id' => $usuario->id,
            'USR_RLS_Estado' => 1
        ]);
        return $usuario;
    }

    /**
     * Mostrar usuario
     *
     * @param  int  $id
     */
    public function obtenerUsuario($id)
    {
        $usuario = Usuarios::find($id);
        return $usuario;
    }

    /**
     * Actualiza usuario
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function editarUsuario(Request $request, $id)
    {
        $usuario = $this->obtenerUsuario($id);
        $usuario->fill($request->all())->save();
        return $usuario;
    }

    /**
     * Eliminar usuario
     *
     * @param  int  $id
     */
    public function eliminarUsuario($id)
    {
        $usuario = $this->obtenerUsuario($id);
        $usuario->delete();
        return $usuario;
    }
}
