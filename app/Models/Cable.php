<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cable extends Model
{
    use HasFactory;

    protected $table = 'cable';

    protected $fillable = [
        'id_sitio',
        'id_tipo_cable',
        'nombre_cable',
        'cant_filam',
        'descripcion',
    ];

    public function sitio()
    {
        return $this->belongsTo(Sitio::class, 'id_sitio');
    }
    public function slotmsan()
    {
        return $this->hasMany(SlotMSAN::class, 'id_cable');
    }
    public function cableslot()
    {
        return $this->hasMany(CableSlot::class, 'id_cable');
    }
    public function detallecable()
    {
        return $this->hasMany(DetalleCable::class, 'id_cable');
    }
    public function tipocable()
    {
        return $this->belongsTo(TipoCable::class, 'id_tipo_cable');
    }
    public function slotstarjeta()
    {
        return $this->belongsToMany(Slot::class);
    }
    public function mufas()
    {
        return $this->hasMany(Mufa::class, 'id_cable');
    }
    public function etiqueta()
    {
        return $this->hasMany(Etiquetas::class, 'id_cable');
    }
}
