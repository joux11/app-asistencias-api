<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;


class Padres extends Model
{

    protected $table = 'padres';

    protected $fillable = [
        'identificacion',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'numero_celular',
        'email',
        'foto',
    ];

    public function ninos()
    {
        return $this->belongsToMany(Ninos::class, 'padres_niños', 'padre_id', 'niño_id');
    }
}
