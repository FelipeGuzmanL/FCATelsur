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
        'descripcion',
        'url',
    ];

    public function ubicacion()
    {
        return $this->hasMany(Ubicacion::class, 'id_sitio');
    }
}
