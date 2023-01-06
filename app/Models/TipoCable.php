<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoCable extends Model
{
    use HasFactory;

    protected $table = 'tipo_cable';

    public function cable()
    {
        return $this->hasMany(Cable::class, 'id_tipo_cable');
    }
}
