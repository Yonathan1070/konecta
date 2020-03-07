<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearTablaRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('RLS_Nombre_Rol', 30);
            $table->text('RLS_Descripcion_Rol');
            $table->timestamps();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        Schema::dropIfExists('TBL_Roles');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
