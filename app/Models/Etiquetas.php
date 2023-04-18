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
        'etiqueta',
        'filam',
    ];

    public function cable()
    {
        return $this->belongsTo(Cable::class, 'id_cable');
    }

}
