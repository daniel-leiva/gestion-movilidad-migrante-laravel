<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroMovilidad extends Model
{
    use HasFactory;

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
    public function migrante()
    {
        return $this->belongsTo(Migrante::class);
    }

    public function caravana()
    {
        return $this->belongsTo(Caravana::class);
    }
    public function nucleo()
    {
        return $this->belongsTo(Nucleo::class);
    }
}
