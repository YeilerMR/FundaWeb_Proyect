<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "tsim_categoria";
    protected $primaryKey = "id_categoria";

    public $timestamps = false;

    protected $fillable = [
        'dsc_nombre',
        'dsc_imagen'
    ];

    public function commerces(){
        return $this->belongsToMany(
            Commerce::class,
            'tsim_comercio_categoria',
            'id_categoria',
            'id_comercio'
        );
    }
}
