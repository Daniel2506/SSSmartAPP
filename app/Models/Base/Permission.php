<?php

namespace App\Models\Base;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permisos';

    public $timestamps = false;
}
