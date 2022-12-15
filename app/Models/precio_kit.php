<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class precio_kit extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'precio',
        'id_registro_promocion',
        'estado',
    ];
}
