<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroHistorico extends Model
{
    use HasFactory;

    protected $table = 'registro_historico';

    protected $fillable = [
        'descripcion',
        'fecha_movimiento',
        'cantidad',
        'tipo_transaccion',
        'user_id',
        'reactivos_id',
    ];

     // Relación: Un registro histórico pertenece a un usuario
     public function usuario()
     {
         return $this->belongsTo(User::class, 'user_id');
     }


    public function reactivo()
    {
        return $this->belongsTo(Reactivos::class, 'reactivos_id');
    }
}
