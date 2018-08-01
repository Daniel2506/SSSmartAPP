<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class Coin extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'monedas';
    public $timestamps = false;
}
