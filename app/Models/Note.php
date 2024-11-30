<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
     // Campos que se pueden llenar masivamente
     protected $fillable = [
        'titulo',
        'autor',
        'descripcion',
        'fecha',
    ];
}
