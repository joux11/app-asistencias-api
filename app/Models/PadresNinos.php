<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Model;


class PadresNinos extends Model
{

    protected $table = 'padres_niños';

    public $timestamps = false;

    protected $fillable = [
        'padre_id',
        'niño_id'
    ];
}
