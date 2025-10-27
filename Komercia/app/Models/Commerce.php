<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commerce extends Model
{
   protected $table = 'tsim_comercio';
    protected $primaryKey = 'id_comercio';
    public $timestamps = false;

    protected $fillable = [
        'dsc_nombre',
        'dsc_descripcion',
        'dsc_direccion',
        'dsc_latitud',
        'dsc_longitud',
        'dsc_instagram',
        'dsc_facebook',
        'dsc_imagen_destacada',
        'fec_creacion',
        'fec_modificacion'
    ];

    // Relacion 1 a N con categorias
    public function categories(){
        return $this->belongsToMany(
            Category::class,
            'tsim_comercio_categoria',
            'id_categoria',
            'id_comercio'
        );
    }
}
