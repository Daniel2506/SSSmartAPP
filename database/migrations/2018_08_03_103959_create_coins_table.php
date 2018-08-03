<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('coin_maquina')->unsigned();
            $table->integer('coin_canal')->unsigned();
            $table->integer('coin_denominacion')->unsigned();
            $table->integer('coin_cofre')->unsigned();

            $table->unique(['coin_denominacion', 'coin_canal']);
            $table->foreign('coin_maquina')->references('id')->on('maquinas')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coins');
    }
}
