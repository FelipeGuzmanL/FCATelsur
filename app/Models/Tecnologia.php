<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tecnologia extends Model
{
    use HasFactory;

    protected $table = 'tecnologia';

    protected $fillable = [
        'nombre_tec',
    ];

    public function slotstec()
    {
        return $this->hasMany(SlotTecnologia::class, 'id_tecnologia');
    }
    public function equiposmsan()
    {
        return $this->hasMany(EquiposMSAN::class, 'id_tecnologia');
    }
}
