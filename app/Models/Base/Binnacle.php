<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class Binnacle extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bitacoras';
    public $timestamps = false;
}
