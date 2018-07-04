<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class Bills extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'facturas';
    public $timestamps = false;
}
