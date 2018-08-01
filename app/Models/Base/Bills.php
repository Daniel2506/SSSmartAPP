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

    /**
     * Get the machine record associated with the table finalizados.
     */
    public function machine()
    {
        return $this->hasOne('App\Models\Base\Machine', 'id', 'factura_maquina');
    }
}
