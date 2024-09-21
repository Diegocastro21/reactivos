<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroHistorico extends Model
{
    use HasFactory;

    public function reactivo(): MorphOne
    {
        return $this->morphOne(Reactivos::class, 'reactivos');
    }
}
