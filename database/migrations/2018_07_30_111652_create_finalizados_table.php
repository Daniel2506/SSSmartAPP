<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinalizadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finalizados', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('finalizados_maquina')->unsigned();
            $table->integer('finalizados_casilla')->unsigned();
            $table->dateTime('finalizados_finicio');
            $table->dateTime('finalizados_ffinal');
            $table->integer('finalizados_tiempo')->unsigned();
            $table->double('finalizados_apagar');
            $table->double('finalizados_ingreso');
            $table->double('finalizados_cambio');

            $table->unique(['finalizados_casilla', 'finalizados_finicio']);
            $table->foreign('finalizados_maquina')->references('id')->on('maquinas')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finalizados');
    }
}
