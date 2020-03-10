<?php

namespace App\Models\Tablas;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Roles, donde se haran las distintas consultas a la Base de 
 * datos sobre la tabla Roles
 * 
 * @author: Yonathan Bohorquez
 * @email: yonathancam@hotmail.com
 * 
 * 
 * @version: 07/03/2020 1.0
 */
class Roles extends Model
{
    protected $table = "TBL_Roles";
    protected $fillable = [
        'RLS_Rol_Id', 
        'RLS_Nombre_Rol', 
        'RLS_Descripcion_Rol', 
    ];
    protected $guarded = ['id'];
}
