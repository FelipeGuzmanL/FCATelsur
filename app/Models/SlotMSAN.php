<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlotMSAN extends Model
{
    use HasFactory;

    protected $table = 'slot_msan';

    protected $fillable = [
        'id_msan',
        'olt',
        'sitio_fca',
        'spl',
        'descripcion_sitio',
        'cable',
        'filam',
    ];

    public function msan()
    {
        return $this->belongsTo(EquiposMSAN::class, 'id_msan');
    }
}
