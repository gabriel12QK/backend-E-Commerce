<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orden extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id_venta',
        'id_repartidor',
        'latitud',
        'longitud',
        'total',
        'cod_comprobante',
        'id_estado_orden',
        'estado',
    ];
}
