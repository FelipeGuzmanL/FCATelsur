<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mufa extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mufas';

    protected $fillable = [
        'id_cable',
        'item',
        'distancia_k',
        'ruta5_k',
        'ubicacion',
        'latitud',
        'longitud',
        'observaciones',
        'link_gmaps',
        'fecha',
    ];

    public function cable()
    {
        return $this->belongsTo(Cable::class, 'id_cable');
    }
}
