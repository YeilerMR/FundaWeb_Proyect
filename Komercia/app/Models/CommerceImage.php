<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommerceImage extends Model
{
    protected $table = 'tsit_imagen_comercio';
    protected $primaryKey = 'id_imagen';
    public $timestamps = false;

    protected $fillable = [
        'id_comercio',
        'dsc_url',
        'dsc_alt'
    ];

    public function commerce()
    {
        return $this->belongsTo(Commerce::class, 'id_comercio', 'id_comercio');
    }
}
