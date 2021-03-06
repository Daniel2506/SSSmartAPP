<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBitacorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitacoras', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('bitacora_maquina')->unsigned();
            $table->string('bitacora_usuario', 10);
            $table->string('bitacora_accion', 10);
            $table->double('bitacora_valor1');
            $table->double('bitacora_valor2');
            $table->string('bitacora_observaciones', 100);
            $table->dateTime('bitacora_fh')->unique();

            $table->foreign('bitacora_maquina')->references('id')->on('maquinas')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bitacoras');
    }
}
