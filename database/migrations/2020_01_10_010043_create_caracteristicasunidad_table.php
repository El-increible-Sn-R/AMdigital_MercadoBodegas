<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaracteristicasunidadTable extends Migration
{
    public function up()
    {
        Schema::create('t_caracteriticas_de_unidades', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->bigIncrements('caracteristicasUnidad_id');
            $table->string('caracteristicasUnidad_nombre',255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_caracteriticas_de_unidades');
    }
}
