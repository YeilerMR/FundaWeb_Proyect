<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailCommerce extends Model
{
    protected $table = 'tsit_correo_comercio';
    protected $primaryKey = 'id_correo';
    public $timestamps = false;

    protected $fillable = [
        'id_comercio',
        'dsc_correo'
    ];

    public function commerce()
    {
        return $this->belongsTo(Commerce::class, 'id_comercio', 'id_comercio');
    }
}
