<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class registro_promocion extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'descripcion',
        'descuento',
        'cantidad_inicial',
        'cantidad_restante',
        'fecha_inicio',
        'fecha_fin',
        'situacion_promocion',
        'estado',
        'id_tipo_promocion'
    ];
}
