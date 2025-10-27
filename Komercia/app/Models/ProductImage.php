<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'tsit_imagen_producto';
    protected $primaryKey = 'id_imagen';
    public $timestamps = false;

    protected $fillable = [
        'id_producto',
        'dsc_url',
        'dsc_alt'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_producto', 'id_producto');
    }
}