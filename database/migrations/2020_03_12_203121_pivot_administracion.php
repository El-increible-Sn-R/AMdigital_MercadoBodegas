<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PivotAdministracion extends Migration
{
    public function up()
    {
        Schema::create('t_pivot_administracion', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('administracion_id');
            $table->bigInteger('usuario_id')->unsigned();
            $table->bigInteger('empresa_id')->unsigned()->nullable();
            $table->bigInteger('local_id')->unsigned()->nullable();

            $table->foreign('empresa_id')->references('empresa_id')->on('t_empresas');
            $table->foreign('usuario_id')->references('usuario_id')->on('t_usuarios');
            $table->foreign('local_id')->references('local_id')->on('t_locales');
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_pivot_administracion');
    }
}
