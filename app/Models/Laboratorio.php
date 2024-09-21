<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    use HasFactory;


    protected $table = 'laboratorio';

    protected $fillable = [
        'nombre',
        'ubicacion',
        'coordinador',
        'telefono_coordinador',
        'correo_coordinador',
        'ciudad',
    ];


    public function estante(): HasOne
    {
        return $this->hasOne(Estante::class);
    }

}
