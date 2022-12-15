<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalle_venta extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'precio',
        'cantidad',
        'id_producto',
        'id_registro_promocion',
        'id_promocion_producto',
        'id_venta',
        'estado',
    ];
}
