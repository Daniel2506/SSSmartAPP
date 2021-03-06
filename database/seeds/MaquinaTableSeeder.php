<?php

use Illuminate\Database\Seeder;
use App\Models\Base\Machine;

class MaquinaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Machine::create([
            'maquina_serie' => 'Serie000',
            'maquina_ubicacion' => 'Unicentro medellín',
            'maquina_casillas' => 15,
            'maquina_contacto' => 'contacto000',
            'maquina_telefono' => 'tele000',
            'maquina_direccion' => 'direccion000',
            'maquina_email' => 'email000@email.com',
            'maquina_documentos' => 'documentos000',
            'maquina_servidor' => 'server000',
            'maquina_usuario' => 'user000',
            'maquina_contraseña' => md5('pass000'),
            'maquina_directorio' => 'unimedellin',
            'maquina_ultima' => date('Y-m-d H:m:s'),
            'maquina_comision1' => 10,
            'maquina_comision2' => 15,
            'maquina_comision3' => 20
    	]);
    }
}
