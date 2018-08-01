<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonedasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monedas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('moneda_maquina')->unsigned();
            $table->integer('moneda_canal')->unsigned();
            $table->integer('moneda_denominacion')->unsigned();
            $table->integer('moneda_hopper')->unsigned();

            $table->unique(['moneda_denominacion', 'moneda_canal']);
            $table->foreign('moneda_maquina')->references('id')->on('maquinas')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monedas');
    }
}
