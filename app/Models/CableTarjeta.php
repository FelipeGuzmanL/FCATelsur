<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CableTarjeta extends Model
{
    use HasFactory;

    public function cable()
    {
        return $this->belongsToMany(Cable::class);
    }
}
