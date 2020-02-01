<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalcaracteristicasTable extends Migration
{
    public function up()
    {
        Schema::create('t_localCaracteriticas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->bigIncrements('localCaracteristicas_id');
            $table->bigInteger('caracteristicasLocal_id')->unsigned();
            $table->bigInteger('local_id')->unsigned();
            
            $table->foreign('local_id')->references('local_id')->on('t_locales');
            $table->foreign('caracteristicasLocal_id')->references('caracteristicasLocal_id')->on('t_caracteriticasLocal');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('t_localCaracteriticas');
    }
}
