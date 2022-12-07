<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tipo_usuario extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'tipo_usuario',
        'estado',
    ];
}
