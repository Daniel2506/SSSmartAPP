<?php

use Illuminate\Database\Seeder;
use App\Models\Base\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name'   => 'consultar',
            'display_name'   => 'Consultar',
            'description'   => 'Permisos de consulta',
        ]);

        Permission::create([
            'name'   => 'crear',
            'display_name'   => 'Crear',
            'description'   => 'Permisos de creacion',
        ]);

        Permission::create([
            'name'   => 'editar',
            'display_name'   => 'Editar',
            'description'   => 'Permisos de editar',
        ]);

        Permission::create([
            'name'   => 'eliminar',
            'display_name'   => 'Eliminar',
            'description'   => 'Permisos para eliminar',
        ]);
    }
}
