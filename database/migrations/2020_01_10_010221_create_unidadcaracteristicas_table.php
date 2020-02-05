<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadcaracteristicasTable extends Migration
{
    public function up()
    {
        Schema::create('t_pivot_caracteriticas_unidad', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->bigIncrements('unidadCaracteristicas_id');
            $table->bigInteger('unidad_id')->unsigned();
            $table->bigInteger('caracteristicasUnidad_id')->unsigned();
            
            $table->foreign('unidad_id')->references('unidad_id')->on('t_unidades');
            $table->foreign('caracteristicasUnidad_id')->references('caracteristicasUnidad_id')->on('t_caracteriticas_de_unidades');
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_pivot_caracteriticas_unidad');
    }
}
