<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquiposMSAN extends Model
{
    use HasFactory;

    protected $table = 'equipos_msan';

    protected $fillable = [
        'id_ubicacion',
        'id_usuario',
        'id_sitio',
        'id_tecnologia',
        'numero',
        'tecnologia',
    ];

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'id_ubicacion');
    }
    public function slotmsan()
    {
        return $this->hasMany(SlotMSAN::class, 'id_msan');
    }
    public function slot()
    {
        return $this->hasMany(Slot::class, 'id_msan');
    }
    public function sitio()
    {
        return $this->belongsTo(Sitio::class, 'id_sitio');
    }
    public function tecnologia()
    {
        return $this->belongsTo(Tecnologia::class, 'id_tecnologia');
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    public function mantencionmsan()
    {
        return $this->hasMany(MantencionMsan::class, 'id_msan');
    }
}
