<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlotMSAN extends Model
{
    use HasFactory;

    protected $table = 'slot_msan';

    protected $fillable = [
        'id_slot',
        'id_cable',
        'id_usuario',
        'id_estado',
        'sitio_fca',
        'link_sitio_fca',
        'descripcion_fca',
        'olt',
        'spl',
        'filam',
    ];

    public function msan()
    {
        return $this->belongsTo(Slot::class, 'id_slot');
    }
    public function cable()
    {
        return $this->belongsTo(Cable::class, 'id_cable');
    }
    public function estad()
    {
        return $this->belongsTo(Estado::class, 'id_estado');
    }
    public function cableslot()
    {
        return $this->hasMany(CableSlot::class, 'id_slot');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    public function detallecable()
    {
        return $this->hasOne(DetalleCable::class, 'id_olt');
    }
}
