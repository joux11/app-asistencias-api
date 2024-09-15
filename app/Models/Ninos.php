<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;


class Ninos extends Model
{

    protected $table = 'niños';

    protected $fillable = [
        'identificacion',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'fecha?nacimiento',
        'genero',
        'aula_id'
    ];

    public function aula()
    {
        return $this->belongsTo(Aulas::class);
    }
    public function padres()
    {
        return $this->belongsToMany(Padres::class, 'padres_niños', 'niño_id', 'padre_id');
    }
    public function asistencias()
    {
        return $this->hasMany(AsistenciaNinos::class);
    }
}
