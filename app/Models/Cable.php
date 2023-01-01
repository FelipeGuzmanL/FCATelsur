<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cable extends Model
{
    use HasFactory;

    protected $table = 'cable';

    protected $fillable = [
        'nombre_cable',
        'cant_filam',
        'cant_minitubos',
    ];

    public function slotmsan()
    {
        return $this->hasMany(SlotMSAN::class, 'id_cable');
    }
    public function cableslot()
    {
        return $this->hasMany(CableSlot::class, 'id_cable');
    }
}
