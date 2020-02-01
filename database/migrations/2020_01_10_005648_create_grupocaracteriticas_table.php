<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupocaracteriticasTable extends Migration
{
    public function up()
    {
        Schema::create('t_grupoCaracteristicas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->bigIncrements('grupo_id');
            $table->string('grupo_nombre',255);
        });
    }

    public function down()
    {
        Schema::dropIfExists('t_grupoCaracteristicas');
    }
}
