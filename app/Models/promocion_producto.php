<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promocion_producto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'id_producto',
        'stock',
        'descuento',
        'fecha_inicio',
        'fecha_fin',
        'estado'
    ];
}
