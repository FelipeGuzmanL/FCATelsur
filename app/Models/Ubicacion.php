<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;

    protected $table = 'ubicacion';

    protected $fillable = [
        'id_ciudad',
        'direccion',
        'coordenadas',
        'link_gmaps',
        'sitio_fca',
        'descripcion_sitio',
    ];

    public function ciudad()
    {
        return $this->belongsTo(Sitio::class, 'id_ciudad');
    }
    public function msan()
    {
        return $this->hasMany(EquiposMSAN::class, 'id_ubicacion');
    }
}
