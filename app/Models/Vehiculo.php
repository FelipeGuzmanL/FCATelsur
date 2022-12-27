<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehiculo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vehiculo';

    protected $fillable = [
        'patente',
        'marca',
        'modelo',
        'anio',
        'id_usuario',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class,'id_usuario');
    }

    public function diatrabajo()
    {
        return $this->hasMany(DiaTrabajo::class, 'id_vehiculo');
    }
}
