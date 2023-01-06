<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCable extends Model
{
    use HasFactory;

    protected $table = 'detallecable';

    protected $fillable = [
        'filamento',
        'direccion',
        'id_estado',
        'id_cable',
        'servicio',
        'cruzada',
        'longitud',
        'observaciones',
    ];
    public function cable()
    {
        return $this->belongsTo(Cable::class, 'id_cable');
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'id_estado');
    }
}
