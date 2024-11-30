<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'autor',
        'descripcion',
        'fecha',
    ];

    // Si la fecha está en otro formato al guardar o mostrar
    protected $casts = [
        'fecha' => 'datetime', // Para asegurarse de que se trate como fecha
    ];
}
