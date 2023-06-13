<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiquetas extends Model
{
    use HasFactory;

    protected $table = 'etiqueta';

    protected $fillable = [
        'id_cable',
        'ladoMSANLEFT',
        'ladoMSANRIGHT',
        'ladocabeceraLEFT',
        'ladocabeceraRIGHT',
        'filam',
        'spl',
        'sitio_fca',
        'id_olt'
    ];

    public function cable()
    {
        return $this->belongsTo(Cable::class, 'id_cable');
    }
    public function olt()
    {
        return $this->belongsTo(SlotMSAN::class, 'id_olt');
    }

}
