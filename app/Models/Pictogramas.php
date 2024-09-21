<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pictogramas extends Model
{
    use HasFactory;


    public function reactivos(): MorphToMany
    {
        return $this->morphToMany(Reactivos::class, 'taggable');
    }
}
