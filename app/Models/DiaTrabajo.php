<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiaTrabajo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'diatrabajo';

    protected $fillable = [
        'hora_salda',
        'hora_entrada',
        'km_salida',
        'km_entrada',
        'id_vehiculo',
        'litros',
        'gasto_perso',
        'guia',
    ];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class,'id_vehiculo');
    }
}
