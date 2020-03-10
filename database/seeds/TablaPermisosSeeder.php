<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TablaPermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Crear Permisos Iniciales
        DB::table('TBL_Permisos')->insert([
            'PRM_Nombre_Permiso' => 'Listar Vendedores',
            'PRM_Slug_Permiso' => 'listar-vendedores'
        ]);
        DB::table('TBL_Permisos')->insert([
            'PRM_Nombre_Permiso' => 'Crear Vendedores',
            'PRM_Slug_Permiso' => 'crear-vendedores'
        ]);
        DB::table('TBL_Permisos')->insert([
            'PRM_Nombre_Permiso' => 'Editar Vendedores',
            'PRM_Slug_Permiso' => 'editar-vendedores'
        ]);
        DB::table('TBL_Permisos')->insert([
            'PRM_Nombre_Permiso' => 'Eliminar Vendedores',
            'PRM_Slug_Permiso' => 'eliminar-vendedores'
        ]);
        DB::table('TBL_Permisos')->insert([
            'PRM_Nombre_Permiso' => 'Obtener Vendedor',
            'PRM_Slug_Permiso' => 'obtener-vendedor'
        ]);
        DB::table('TBL_Permisos')->insert([
            'PRM_Nombre_Permiso' => 'Listar Clientes',
            'PRM_Slug_Permiso' => 'listar-clientes'
        ]);
        DB::table('TBL_Permisos')->insert([
            'PRM_Nombre_Permiso' => 'Crear Clientes',
            'PRM_Slug_Permiso' => 'crear-clientes'
        ]);
        DB::table('TBL_Permisos')->insert([
            'PRM_Nombre_Permiso' => 'Editar Clientes',
            'PRM_Slug_Permiso' => 'editar-clientes'
        ]);
        DB::table('TBL_Permisos')->insert([
            'PRM_Nombre_Permiso' => 'Eliminar Clientes',
            'PRM_Slug_Permiso' => 'eliminar-clientes'
        ]);
        DB::table('TBL_Permisos')->insert([
            'PRM_Nombre_Permiso' => 'Obtener Cliente',
            'PRM_Slug_Permiso' => 'obtener-cliente'
        ]);
    }
}
