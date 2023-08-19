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
        'id_usuario',
        'id_olt',
        'servicio',
        'cruzada',
        'longitud',
        'gmaps',
        'observaciones',
        'ocupacion',
    ];
    public function cable()
    {
        return $this->belongsTo(Cable::class, 'id_cable');
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'id_estado');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    public function olt()
    {
        return $this->belongsTo(SlotMSAN::class, 'id_olt');
    }
    public function alerta()
    {
        return $this->hasOne(Alerta::class, 'id_detallecable');
    }
    public function cruzadaFil1()
    {
        return $this->hasOne(Cruzada::class, 'id_fil1', 'id');
    }

    public function cruzadaFil2()
    {
        return $this->hasOne(Cruzada::class, 'id_fil2', 'id');
    }

}
