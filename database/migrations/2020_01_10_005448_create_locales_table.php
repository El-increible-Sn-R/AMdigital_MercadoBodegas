<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalesTable extends Migration
{
    public function up()
    {
        Schema::create('t_locales', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->bigIncrements('local_id');
            $table->string('local_nombre',255);
            $table->string('local_descripcion',255)->nullable();
            $table->bigInteger('empresa_id')->unsigned();
            $table->bigInteger('local_telefono')->unsigned();
            $table->string('local_email',255);
            $table->string('local_pais',255);
            $table->string('local_region',255);//en peru: departamento
            $table->string('local_provincia',255);//en peru: Provincia 
            $table->string('local_comuna',255);//en peru: distritos
            $table->string('local_direccion',255);
            $table->bigInteger('usuario_id')->unsigned();
            $table->double('local_latitud');
            $table->double('local_longitud');
            $table->string('local_nDiasDeReserva',255);
            $table->char('local_estaBorrado',1)->default('n');
            
            $table->foreign('empresa_id')->references('empresa_id')->on('t_empresas');
            $table->foreign('usuario_id')->references('usuario_id')->on('t_usuarios');
        });
        DB::statement("ALTER TABLE t_locales ADD CONSTRAINT chk_estaBorrado check (local_estaBorrado in ('b','n'));");
    }

    public function down()
    {
        Schema::dropIfExists('t_locales');
    }
}
