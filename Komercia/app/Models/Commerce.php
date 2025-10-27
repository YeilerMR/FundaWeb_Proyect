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

    public function gallery()
    {
        return $this->hasMany(CommerceImage::class, 'id_comercio', 'id_comercio');
    }

    public function phones()
    {
        return $this->hasMany(PhoneCommerce::class, 'id_comercio', 'id_comercio');
    }

    public function emails()
    {
        return $this->hasMany(EmailCommerce::class, 'id_comercio', 'id_comercio');
    }
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
