<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posicion extends Model
{
    use HasFactory;

    protected $table = 'posiciones';

    protected $fillable = [
        'estante_id', 
        'fila',
        'columna', 
        'reactivos_id',
    ];

    /**
     * Relación con Estante (muchas posiciones pertenecen a un estante)
     */
    public function estante(): BelongsTo
    {
        return $this->belongsTo(Estante::class);
    }

    /**
     * Relación con Reactivo (una posición puede tener un reactivo)
     */
    public function reactivo()
    {
        return $this->belongsTo(Reactivos::class, 'reactivos_id');
    }
}
