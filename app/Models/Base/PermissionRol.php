<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class PermissionRol extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permiso_rol';

	public $incrementing = false;

    public $timestamps = false;
}
