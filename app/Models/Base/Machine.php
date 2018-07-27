<?php

namespace App\Models\Base;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Machine extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'maquinas';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['maquina_serie', 'maquina_ubicacion', 'maquina_casillas', 'maquina_email', 'maquina_contacto', 'maquina_telefono', 'maquina_direccion', 'maquina_documentos','maquina_usuario', 'maquina_servidor', 'maquina_directorio'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['maquina_contraseña'];

    public function isValid($data)
    {
        $rules = [
            'maquina_serie' => 'required|unique:maquinas',
            'maquina_email' => 'email'
        ];

        if ($this->exists){
            $rules['maquina_serie'] .= ',maquina_serie,' . $this->id;
        }else{
            $rules['maquina_serie'] .= '|required';
        }

        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            return true;
        }
        $this->errors = $validator->errors();
        return false;
    }

    public static function getMachines()
    {
        return Machine::get()->pluck('maquina_serie', 'id');
    }
}
