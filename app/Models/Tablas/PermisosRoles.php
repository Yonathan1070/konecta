<?php

namespace App\Models\Tablas;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo PermisoUsuario, donde se establecen los atributos de la tabla en la 
 * Base de Datos y se realizan las distintas operaciones sobre la misma
 * 
 * @author: Yonathan Bohorquez
 * @email: ycbohorquez@ucundinamarca.edu.co
 * 
 * @author: Manuel Bohorquez
 * @email: jmbohorquez@ucundinamarca.edu.co
 * 
 * @version: 07/03/2020 1.0
 */
class PermisosRoles extends Model
{
    protected $table = "TBL_Permisos_Roles";
    protected $fillable = [
        'PRM_USR_Usuario_Id',
        'PRM_USR_Permiso_Id'
    ];
    protected $guarded = ['id'];
    public $timestamps = false;
}
