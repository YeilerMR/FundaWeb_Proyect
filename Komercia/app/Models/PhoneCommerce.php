<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneCommerce extends Model
{
    protected $table = 'tsit_telefono_comercio';
    protected $primaryKey = 'id_telefono';
    public $timestamps = false;

    protected $fillable = [
        'id_comercio',
        'dsc_telefono'
    ];

    public function commerce()
    {
        return $this->belongsTo(Commerce::class, 'id_comercio', 'id_comercio');
    }
}
