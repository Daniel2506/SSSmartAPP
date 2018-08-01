<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;

class Finalized extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'finalizados';
    public $timestamps = false;

    /**
     * Get the machine record associated with the table finalizados.
     */
    public function machine()
    {
        return $this->hasOne('App\Models\Base\Machine', 'id', 'finalizado_maquina');
    }
}
