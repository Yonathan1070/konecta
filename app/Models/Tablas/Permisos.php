<?php

namespace App\Models\Tablas;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Permiso, donde se establecen los atributos de la tabla en la 
 * Base de Datos y se realizan las distintas operaciones sobre la misma
 * 
 * @author: Yonathan Bohorquez
 * @email: yonathancam@hotmail.com
 * 
 * 
 * @version: 07/03/2020 1.0
 */
class Permisos extends Model
{
    protected $table = "TBL_Permisos";
    protected $fillable = [
        'PRM_Nombre_Permiso',
        'PRM_Slug_Permiso'
    ];
    protected $guarded = ['id'];
}
