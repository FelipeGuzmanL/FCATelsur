<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    use HasFactory;

    protected $table = 'alertas';

    protected $fillable = [
        'id_gravedad',
        'id_detallecable',
        'id_mufa',
        'id_olt',
        'observacion',
    ];

    public function olt()
    {
        return $this->belongsTo(SlotMSAN::class, 'id_olt');
    }
    public function gravedad()
    {
        return $this->belongsTo(GravedadAlerta::class, 'id_gravedad');
    }
    public function detallecable()
    {
        return $this->belongsTo(DetalleCable::class, 'id_detallecable');
    }
    public function mufa()
    {
        return $this->belongsTo(Mufa::class, 'id_mufa');
    }
}
