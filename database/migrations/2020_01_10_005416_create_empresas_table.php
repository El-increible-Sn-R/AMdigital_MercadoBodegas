<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    public function up()
    {
        Schema::create('t_empresas', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->bigIncrements('empresa_id');
            $table->string('empresa_nombre',255);
            $table->char('empresa_estaBorrado',1)->default('n');
            $table->string('empresa_pais',255);
            $table->string('empresa_region',255);
            $table->string('empresa_provincia',255);
            $table->string('empresa_comuna',255);
            //$table->bigInteger('usuario_id')->unsigned();
            
            //$table->foreign('usuario_id')->references('usuario_id')->on('t_usuarios');
        });
        DB::statement("ALTER TABLE t_empresas ADD CONSTRAINT chk_estaBorrado CHECK (empresa_estaBorrado in ('s','n'));");
    }

    public function down()
    {
        Schema::dropIfExists('t_empresas');
    }
}
