<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;


    protected $table = 'proveedor';

    protected $fillable = [
        'nombre',
        'telefono',
        'direccion',
        'ciudad',
        'pais',
    ];


    //  $table->string('nombre');
    // $table->string('telefono');
    // $table->string('direccion');
    // $table->string('ciudad');
    // $table->string('pais');

    public function reactivos(): MorphToMany
    {
        return $this->morphToMany(Reactivos::class, 'taggable');
    }
}
