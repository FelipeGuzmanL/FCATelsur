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
        'nombre_cable',
        'cant_filam',
        'cant_minitubos',
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
}
