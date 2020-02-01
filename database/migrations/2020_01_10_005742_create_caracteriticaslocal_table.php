<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaracteriticaslocalTable extends Migration
{
    public function up()
    {
        Schema::create('t_caracteriticasLocal', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->bigIncrements('caracteristicasLocal_id');
            $table->string('caracteristicasLocal_nombre',255);
            $table->bigInteger('grupo_id')->unsigned();
            
            $table->foreign('grupo_id')->references('grupo_id')->on('t_grupoCaracteristicas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_caracteriticasLocal');
    }
}
