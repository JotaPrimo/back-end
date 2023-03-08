<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetsEstimacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'especie',
        'peso',
        'pelagem',
        'sexo'
    ];
}
