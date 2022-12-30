<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquiposMSAN extends Model
{
    use HasFactory;

    protected $table = 'equipos_msan';

    protected $fillable = [
        'id_ubicacion',
        'numero',
        'slot',
    ];

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion');
    }
    public function slotmsan()
    {
        return $this->hasMany(SlotMSAN::class, 'id_msan');
    }
}
