<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categoria extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'descripcion',
        'imagen',
        'estado',
    ];
}
