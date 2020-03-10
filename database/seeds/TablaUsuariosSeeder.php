<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Agregar Usuario Administrador
        DB::table('TBL_Usuarios')->insert([
            'USR_Documento_Usuario' => '1070979976',
            'USR_Nombres_Usuario' => 'Yonathan',
            'USR_Apellidos_Usuario'  => 'Bohorquez',
            'USR_Direccion_Residencia_Usuario' => 'Calle 5 # 13 18',
            'USR_Correo_Usuario' => 'yonathancam@hotmail.com',
            'USR_Nombre_Usuario' => 'yonathan',
            'password' => 'yonathan'
        ]);
    }
}
