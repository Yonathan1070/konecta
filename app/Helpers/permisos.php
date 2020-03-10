<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Helper permisos, permite validar si el rol tiene acceso al permiso
 * que se desea acceder.
 * 
 * @author: Yonathan Bohorquez
 * @email: yonathancam@hotmail.com
 * 
 * 
 * @version: 09/03/2020 1.0
 */

if (!function_exists('canUser')) {
    function can($permiso, $redirect = true)
    {
        $rol = Auth::user()->roles()->where('USR_RLS_Estado', 1)->first();
        if (strtolower($rol->RLS_Nombre_Rol) == 'administrador') {
            return true;
        } else {
            $permisos = DB::table('TBL_Permisos as p')
                ->join('TBL_Permisos_Roles as pr', 'pr.PRM_RLS_Permiso_Id', '=', 'p.id')
                ->join('TBL_Roles as r', 'r.id', '=', 'pr.PRM_RLS_Rol_Id')
                ->where('r.id', $rol->id)
                ->where('PRM_Slug_Permiso', $permiso)
                ->select('p.PRM_Slug_Permiso')
                ->first();
            if ($permisos == null) {
                if ($redirect) {
                    return false;
                } else {
                    return false;
                }
            }
        }
        return true;
    }
}
