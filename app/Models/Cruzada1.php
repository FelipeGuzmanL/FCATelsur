<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cruzada1 extends Model
{
    use HasFactory;

    protected $table = 'cruzada1';

    protected $fillable = [
        'id_fil1',
        'id_fil2',
    ];


    public function detalleFil1()
    {
        return $this->belongsTo(DetalleCable::class, 'id_fil1', 'id');
    }

    public function detalleFil2()
    {
        return $this->belongsTo(DetalleCable::class, 'id_fil2', 'id');
    }

}
