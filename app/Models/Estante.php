<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estante extends Model
{
    use HasFactory;

    protected $table = 'estante';

    protected $fillable = [
        'no_estante',
        'descripcion',
        'laboratorio_id',
    ];

    

    public function laboratorio()
    {
        return $this->belongsTo(Laboratorio::class);
    }

    public function divisionesUbicacion()
    {
        return $this->hasMany(DivisionUbicacionReactivo::class);
    }
}
