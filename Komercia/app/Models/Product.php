<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tsim_producto';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    protected $fillable = [
        'id_comercio',
        'dsc_nombre',
        'dsc_descripcion',
        'precio',
        'dsc_imagen_destacada'
    ];

    public function commerce()
    {
        return $this->belongsTo(Commerce::class, 'id_comercio', 'id_comercio');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'id_producto', 'id_producto');
    }
}
