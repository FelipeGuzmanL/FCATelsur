<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CableSlot extends Model
{
    use HasFactory;

    protected $table = 'cableslot';

    protected $fillable = [
        'id_slot',
        'id_cable',
    ];

    public function cable()
    {
        return $this->belongsTo(Cable::class, 'id_cable');
    }

    public function slotmsan()
    {
        return $this->belongsTo(SlotMSAN::class, 'id_slot');
    }
}
