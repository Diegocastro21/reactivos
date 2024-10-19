<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pictogramas extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'imagen'];


    public function reactivos()
    {
        return $this->belongsToMany(Reactivos::class, 'pictograma_reactivo');
    }
}
