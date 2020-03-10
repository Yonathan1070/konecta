<?php

namespace App\Models\Tablas;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo UsuariosRoles, donde se establecen los atributos de la tabla en la 
 * Base de Datos y se realizan las distintas operaciones sobre la misma
 * 
 * @author: Yonathan Bohorquez
 * @email: yonathancam@hotmail.com
 * 
 * 
 * @version: 07/03/2020 1.0
 */
class UsuariosRoles extends Model
{
    protected $table = "TBL_Usuarios_Roles";
    protected $fillable = [
        'USR_RLS_Rol_Id',
        'USR_RLS_Usuario_Id',
        'USR_RLS_Estado'
    ];
    protected $guarded = ['id'];
    public $timestamps = false;

    //Función para crear la asociación del usuario con el rol
    public static function crearAsociacion($request, $id)
    {
        UsuariosRoles::create([
            'USR_RLS_Rol_Id' => $request['Rol_Id'],
            'USR_RLS_Usuario_Id' => $id,
            'USR_RLS_Estado' => 1
        ]);
    }
}
