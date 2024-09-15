<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;

class AsistenciaNinos extends Model
{
    protected $table = 'asistencia_niños';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'fecha_marcacion',
        'hora_entrada',
        'hora_salida',
        'estado',
        'observacion_entrada',
        'observacion_salida',
        'niño_id',
    ];

    public function niño()
    {
        return $this->belongsTo(Ninos::class);
    }
}
