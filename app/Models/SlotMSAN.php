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
        'sitio_fca',
        'descripcion_fca',
        'olt',
        'spl',
        'filam',
        'estado',
    ];

    public function msan()
    {
        return $this->belongsTo(Slot::class, 'id_slot');
    }
    public function cable()
    {
        return $this->belongsToMany(Cable::class, 'id_cable');
    }
}
