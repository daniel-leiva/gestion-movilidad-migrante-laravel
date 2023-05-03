<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroEnfermo extends Model
{
    use HasFactory;
    public function migrante()
    {
        return $this->belongsTo(Migrante::class);
    }

}
