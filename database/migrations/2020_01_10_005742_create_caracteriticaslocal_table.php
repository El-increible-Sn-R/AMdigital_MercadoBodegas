<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaracteriticaslocalTable extends Migration
{
    public function up()
    {
        Schema::create('t_caracteriticas_de_locales', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->bigIncrements('caracteristicasLocal_id');
            $table->string('caracteristicasLocal_nombre',255);
            $table->bigInteger('grupo_id')->unsigned();
            
            $table->foreign('grupo_id')->references('grupo_id')->on('t_grupo_de_caracteristicas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_caracteriticas_de_locales');
    }
}
