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
            $table->integer('finalizado_maquina')->unsigned();
            $table->integer('finalizado_casilla')->unsigned();
            $table->dateTime('finalizado_finicio');
            $table->dateTime('finalizado_ffinal');
            $table->integer('finalizado_tiempo')->unsigned();
            $table->double('finalizado_apagar');
            $table->double('finalizado_ingreso');
            $table->double('finalizado_cambio');

            $table->unique(['finalizado_casilla', 'finalizado_finicio']);
            $table->foreign('finalizado_maquina')->references('id')->on('maquinas')->onDelete('restrict');
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
