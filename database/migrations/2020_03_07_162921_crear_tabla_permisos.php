<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearTablaPermisos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Permisos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('PRM_Nombre_Permiso', 50);
            $table->string('PRM_Slug_Permiso', 100);
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
        Schema::dropIfExists('TBL_Permisos');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
