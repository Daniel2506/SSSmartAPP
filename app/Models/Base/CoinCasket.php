<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class CoinCasket extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'coins';
    public $timestamps = false;
}
