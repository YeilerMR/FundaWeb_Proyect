<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
protected $table = "tsim_categoria";
protected $primaryKey = "id_categoria";

public $timestamps = false;
}
