<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $table = 'slot';

    protected $fillable = [
        'id_msan',
        'id_estado',
        'slot_msan',
    ];

    public function equiposmsan()
    {
        return $this->belongsTo(EquiposMSAN::class, 'id_msan');
    }

    public function slotmsan()
    {
        return $this->hasMany(SlotMSAN::class, 'id_slot');
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class, 'id_estado');
    }
    public function cable()
    {
        return $this->belongsToMany(Cable::class);
    }
}
