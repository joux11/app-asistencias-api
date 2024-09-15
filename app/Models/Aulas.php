<?php

namespace app\Models;

use app\Models\Ninos;
use Illuminate\Database\Eloquent\Model;

class Aulas extends Model
{
    protected $table = 'aulas';
    protected $fillable = [
        'nombre',
        'descripcion'
    ];
    public function ninos()
    {
        return $this->hasMany(Ninos::class);
    }
}
