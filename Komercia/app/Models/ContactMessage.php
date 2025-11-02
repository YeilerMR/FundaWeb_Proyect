<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $table = 'tsit_mensaje_contacto';
    protected $primaryKey = 'id_mensaje';
    public $timestamps = false;

    protected $fillable = [
        'id_comercio',
        'dsc_nombre',
        'dsc_telefono',
        'dsc_correo',
        'dsc_mensaje',
        'fec_envio'
    ];
}
