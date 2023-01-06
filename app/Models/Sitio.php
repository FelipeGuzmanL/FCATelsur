<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sitio extends Model
{
    use HasFactory;

    protected $table = 'ciudad';

    protected $fillable = [
        'nombre',
        'abreviacion',
        'direccion',
        'descripcion',
        'url',
    ];

    public function ubicacion()
    {
        return $this->hasMany(Ubicacion::class, 'id_sitio');
    }
    public function msan()
    {
        return $this->hasMany(EquiposMSAN::class, 'id_sitio');
    }
    public function cable()
    {
        return $this->hasMany(Cable::class, 'id_sitio');
    }
}
