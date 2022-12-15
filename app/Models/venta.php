<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class venta extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'subtotal',
        'total',
        'fecha',
        'estado',
        'id_user',
        'id_tipo_pago'
    ];
}
