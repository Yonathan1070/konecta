<?php

namespace App\Models\Tablas;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo UsuariosRoles, donde se establecen los atributos de la tabla en la 
 * Base de Datos y se realizan las distintas operaciones sobre la misma
 * 
 * @author: Yonathan Bohorquez
 * @email: ycbohorquez@ucundinamarca.edu.co
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
}
