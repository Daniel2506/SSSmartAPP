<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'modulos';

    public $timestamps = false;

    public static function getModules($role)
    {
        $query = Module::query();
        $query->select('modulos.id', 'display_name', 'nivel1', 'nivel2', 'nivel3', 'nivel4');
        $query->orderBy('nivel1', 'asc');
        $modules = $query->get();
        $data = [];
        foreach ($modules as $module)
        {
            $object = new \stdClass();
            $object->id = $module->id;
            $object->display_name = $module->display_name;
            $object->nivel1 = $module->nivel1;
            $object->nivel2 = $module->nivel2;
            $object->nivel3 = $module->nivel3;
            $object->nivel4 = $module->nivel4;

            $query = PermissionRol::query();
            $query->where('role_id', $role);
            $query->where('module_id', $module->id);
            $query->orderBy('permission_id', 'asc');
            $object->mpermissions = $query->lists('permission_id');

            $data[] = $object;
        }
        return $data;
   	}
}
