<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'tsit_slider';
    protected $primaryKey = 'id_slider';
    public $timestamps = false;

    protected $fillable = [
        'dsc_titulo',
        'dsc_descripcion',
        'dsc_imagen',
        'dsc_enlace',
        'fec_creacion',
        'fec_modificacion'
    ];
}
