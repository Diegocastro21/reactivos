<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisionUbicacionReactivo extends Model
{
    use HasFactory;

    protected $table = 'division_ubicacion_reactivos';

    protected $fillable = [
        'columna',
        'nivel',
        'estante_id',
    ];

    public function estante()
    {
        return $this->belongsTo(Estante::class);
    }
}
