<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearTablaUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Usuarios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('USR_Documento_Usuario', 50)->unique();
            $table->string('USR_Nombres_Usuario', 50);
            $table->string('USR_Apellidos_Usuario', 50);
            $table->string('USR_Direccion_Residencia_Usuario', 100);
            $table->string('USR_Correo_Usuario', 100);
            $table->string('USR_Nombre_Usuario', 15);
            $table->text('password');
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
        Schema::dropIfExists('TBL_Usuarios');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
