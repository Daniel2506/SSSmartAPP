<?php

use Illuminate\Database\Seeder;
use App\Models\Base\Module;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Module::create([
        	'name' => 'bitacoras',
        	'display_name' => 'Bitácoras',
        	'nivel1' => 1
    	]);
        Module::create([
            'name' => 'facturas',
            'display_name' => 'Facturas',
            'nivel1' => 2
        ]);
    	Module::create([
        	'name' => 'maquinas',
        	'display_name' => 'Máquinas',
        	'nivel1' => 3
    	]);
    	Module::create([
        	'name' => 'usuarios',
        	'display_name' => 'Usuarios',
        	'nivel1' => 4
    	]);
        Module::create([
            'name' => 'roles',
            'display_name' => 'Roles',
            'nivel1' => 5
        ]);
    }
}
