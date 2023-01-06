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
}
