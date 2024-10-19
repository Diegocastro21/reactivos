<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'nivel',
    ];

    public function reactivos()
    {
        return $this->belongsToMany(Reactivos::class, 'categoria_reactivo');
    }
}
