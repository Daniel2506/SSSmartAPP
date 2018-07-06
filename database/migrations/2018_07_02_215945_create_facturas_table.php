<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facturas', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('factura_maquina')->unsigned()->nullable();
            $table->integer('factura_numero')->unsigned();
            $table->string('factura_prefijo', 10);
            $table->string('factura_fecha_emision');
            $table->string('factura_fh_inicio');
            $table->string('factura_fh_final');
            $table->integer('factura_casilla')->unsigned();
            $table->double('factura_subtotal');
            $table->double('factura_iva');
            $table->integer('factura_iva_p')->unsigned();
            $table->double('factura_total');
            $table->double('factura_pago');
            $table->double('factura_cambio');
            $table->double('factura_tiempo');

            $table->unique(['factura_numero', 'factura_prefijo']);
            $table->foreign('factura_maquina')->references('id')->on('maquinas')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facturas');
    }
}
