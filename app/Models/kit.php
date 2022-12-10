<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kit extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'cantidad',
        'id_registro_promocion',
        'id_producto',
        'estado'
    ];
}
