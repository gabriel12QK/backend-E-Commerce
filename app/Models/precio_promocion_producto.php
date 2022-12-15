<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class precio_promocion_producto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'precio',
        'id_promocion_producto',
        'estado',
    ];
}
