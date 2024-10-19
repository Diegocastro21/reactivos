<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Estante extends Model
{
    use HasFactory;

    protected $table = 'estante';

    protected $fillable = [
        'no_estante',
        'descripcion',
        'filas',
        'columnas',
        'laboratorio_id',
    ];

    

    public function laboratorio()
    {
        return $this->belongsTo(Laboratorio::class);
    }

    

    public function posiciones()
    {
        return $this->hasMany(Posicion::class);
    }


}
