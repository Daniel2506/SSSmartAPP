<?php

use Illuminate\Database\Seeder;
use App\Models\Base\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'   => 'admin',
            'display_name'   => 'Administrador',
            'description'   => 'Perfil administrador plataforma'
        ]);
    }
}
