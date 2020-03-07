<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->truncateTablas([
            'TBL_Usuarios',
            'TBL_Roles',
            'TBL_Usuarios_Roles',
            'TBL_Permisos',
            'TBL_Permisos_Roles'
        ]);
        $this->call(TablaUsuariosSeeder::class);
        $this->call(TablaRolesSeeder::class);
        $this->call(TablaUsuariosRolesSeeder::class);
        $this->call(TablaPermisosSeeder::class);
        $this->call(TablaPermisosRolesSeeder::class);
    }

    protected function truncateTablas(array $tablas){
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        foreach($tablas as $tabla){
            DB::table($tabla)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
