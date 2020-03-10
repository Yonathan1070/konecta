<?php

namespace App\Models\Tablas;

use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Usuarios, modelo donde encontramos los atributos de la tabla
 * usuarios de la Base de Datos y realizamos las distintas
 * operaciones de sobre la misma.
 * 
 * @author: Yonathan Bohorquez
 * @email: yonathancam@hotmail.com
 * 
 * 
 * @version: 07/03/2020 1.0
 */
class Usuarios extends Authenticatable
{
    use HasApiTokens;

    protected $remember_token = false;
    protected $table = 'TBL_Usuarios';
    protected $fillable = [
        'USR_Documento_Usuario',
        'USR_Nombres_Usuario',
        'USR_Apellidos_Usuario',
        'USR_Direccion_Residencia_Usuario',
        'USR_Correo_Usuario',
        'USR_Nombre_Usuario',
        'password'
    ];
    protected $guarded = ['id'];

    //Funcion que obtiene los roles del usuario
    public function roles()
    {
        return $this->belongsToMany(
            Roles::class,
            'TBL_Usuarios_Roles',
            'USR_RLS_Usuario_Id',
            'USR_RLS_Rol_Id'
        )->withPivot('USR_RLS_Usuario_Id', 'USR_RLS_Rol_Id');
    }

    //Funcion para crear usuarios
    public static function crearUsuario($request)
    {
        $usuario = Usuarios::create([
            'USR_Documento_Usuario' => $request['USR_Documento_Usuario'],
            'USR_Nombres_Usuario' => $request['USR_Nombres_Usuario'],
            'USR_Apellidos_Usuario' => $request['USR_Apellidos_Usuario'],
            'USR_Direccion_Residencia_Usuario' => $request['USR_Direccion_Residencia_Usuario'],
            'USR_Correo_Usuario' => $request['USR_Correo_Usuario'],
            'USR_Nombre_Usuario' => $request['USR_Nombre_Usuario'],
            'password' => bcrypt($request['password'])
        ]);

        return $usuario;
    }
}
