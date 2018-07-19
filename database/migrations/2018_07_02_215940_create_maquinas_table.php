<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaquinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maquinas', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('maquina_serie', 100);
            $table->string('maquina_ubicacion', 100);
            $table->integer('maquina_casillas')->unsigned();
            $table->string('maquina_contacto', 100);
            $table->string('maquina_telefono', 100);
            $table->string('maquina_direccion', 100);
            $table->string('maquina_email', 100);
            $table->string('maquina_documentos', 100);
            $table->string('maquina_servidor', 100);
            $table->string('maquina_usuario', 100);
            $table->string('maquina_contraseña', 100);
            $table->string('maquina_directorio', 100);
            $table->dateTime('maquina_ultima');
            $table->double('maquina_comision1')->comment('centro comercial');
            $table->double('maquina_comision2')->comment('parqueaderos');
            $table->double('maquina_comision3')->comment('empresa');

            $table->unique(['maquina_serie', 'maquina_directorio']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maquinas');
    }
}
