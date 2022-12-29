<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'ciudad';

    protected $fillable = [
        'nombre',
        'abreviacion',
    ];

    public function ubicacion()
    {
        return $this->hasMany(Ubicacion::class, 'id_ciudad');
    }
}
