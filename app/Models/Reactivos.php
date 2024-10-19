<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Reactivos extends Model
{
    use HasFactory;

    protected $table = 'reactivos';

    protected $fillable = [
        'codigo',
        'nombre',
        'disponibilidad',
        'unidad_medida',
        'cantidad_disponible',
        'codigo_indicacion_peligro',
        'lote',
        'marca',
        'fabricante',
        'url_ficha_seguridad',
        'fecha_vencimiento',
        // 'nivel_reactivo',
        // 'columna_estante',
        'estante_id',
    ];

    protected $casts = [
        'cantidad_disponible' => 'decimal:2',
        'fecha_vencimiento' => 'date',
    ];

    public function estante()
    {
        return $this->belongsTo(Estante::class);
    }

    public function posicion(): HasOne
    {
        return $this->hasOne(Posicion::class);
    }


    public function categorias(): MorphToMany
    {
        return $this->morphToMany(Categoria::class, 'taggable');
    }

    public function pictogramas(): MorphToMany
    {
        return $this->morphToMany(Pictogramas::class, 'taggable');
    }

    public function proveedores(): MorphToMany
    {
        return $this->morphToMany(Proveedor::class, 'taggable');
    }

    public function registros_historicos(): MorphMany
    {
        return $this->morphMany(RegistroHistorico::class, 'registros');
    }
}
