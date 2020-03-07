<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPermisosRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TBL_Permisos_Roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('PRM_RLS_Rol_Id');
            $table->foreign('PRM_RLS_Rol_Id', 'FK_Permiso_Rol_Roles')->references('id')->on('TBL_Roles')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('PRM_RLS_Permiso_Id');
            $table->foreign('PRM_RLS_Permiso_Id', 'FK_Permiso_Rol_Permisos')->references('id')->on('TBL_Permisos')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('TBL_Permisos_Roles');
    }
}
