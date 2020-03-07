<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Crear Roles Iniciales
        DB::table('TBL_Roles')->insert([
            'RLS_Nombre_Rol' => 'Administrador',
            'RLS_Descripcion_Rol' => 'Super Admin del sistema'
        ]);
        DB::table('TBL_Roles')->insert([
            'RLS_Nombre_Rol' => 'Vendedor',
            'RLS_Descripcion_Rol' => 'Vendedor en la aplicación'
        ]);
        DB::table('TBL_Roles')->insert([
            'RLS_Nombre_Rol' => 'Cliente',
            'RLS_Descripcion_Rol' => 'Cliente de la aplicación'
        ]);
    }
}
