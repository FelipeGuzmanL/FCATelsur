<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    use HasFactory;

    protected $table = 'estado';

    public function slot()
    {
        return $this->hasMany(Slot::class, 'id_estado');
    }
    public function slotmsan()
    {
        return $this->hasMany(SlotMSAN::class, 'id_estado');
    }
    public function detallecable()
    {
        return $this->hasMany(DetalleCable::class, 'id_estado');
    }
}
