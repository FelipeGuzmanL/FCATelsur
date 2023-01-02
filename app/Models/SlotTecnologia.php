<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlotTecnologia extends Model
{
    use HasFactory;

    protected $table = 'slots_tec';

    protected $fillable = [
        'id_tecnologia',
        'slots'
    ];

    public function tecnologia()
    {
        return $this->belongsTo(Tecnologia::class, 'id_tecnologia');
    }
}
