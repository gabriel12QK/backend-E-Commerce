<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'nombre',
        'precio',
        'peso',
        'stock',
        'imagen',
        'estado',
        'id_categoria',
        'id_marca',
        'id_tipo_peso',
    ];
}

