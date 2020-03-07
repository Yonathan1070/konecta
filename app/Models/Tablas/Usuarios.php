<?php

namespace App\Models\Tablas;

use Illuminate\Database\Eloquent\Model;

/**
 * Usuarios, modelo donde encontramos los atributos de la tabla
 * usuarios de la Base de Datos
 * 
 * @author: Yonathan Bohorquez
 * @email: ycbohorquez@ucundinamarca.edu.co
 * 
 * 
 * @version: 07/03/2020 1.0
 */
class Usuarios extends Model
{
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
}
