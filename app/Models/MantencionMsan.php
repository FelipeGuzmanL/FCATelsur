<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MantencionMsan extends Model
{
    use HasFactory;

    protected $table = 'mantencionesmsan';

    protected $fillable = [
        'id_msan',
        'id_usuario',
        'comprobacion_1',
        'comprobacion_2',
        'comprobacion_3',
        'comprobacion_4',
        'comprobacion_5',
        'comprobacion_6',
        'comprobacion_7',
        'comprobacion_8',
        'comprobacion_9',
        'comprobacion_10',
        'comprobacion_11',
        'fecha_mantencion',
        'observaciones',
        'numero_ticket',
        'coordenadas',
    ];

    public function msan()
    {
        return $this->belongsTo(EquiposMSAN::class, 'id_msan');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
