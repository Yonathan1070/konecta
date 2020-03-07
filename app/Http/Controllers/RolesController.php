<?php

namespace App\Http\Controllers;

use App\Models\Tablas\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Mostrar todos los roles
     */
    public function obtenerTodos()
    {
        $roles = Roles::all();
        return $roles;
    }

    /**
     * Crear Rol
     */
    public function crearRol(Request $request)
    {
        $rol = Roles::create($request->all());
        return $rol;
    }

    /**
     * Mostrar Rol
     *
     * @param  int  $id
     */
    public function obtenerRol($id)
    {
        $rol = Roles::find($id);
        return $rol;
    }

    /**
     * Actualiza Rol
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function editarRol(Request $request, $id)
    {
        $rol = $this->obtenerRol($id);
        $rol->fill($request->all())->save();
        return $rol;
    }

    /**
     * Eliminar Rol
     *
     * @param  int  $id
     */
    public function eliminarRol($id)
    {
        $rol = $this->obtenerRol($id);
        $rol->delete();
        return $rol;
    }
}
