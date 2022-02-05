<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Categorie extends Model
{
    use HasFactory;

    public function type()
    {
        return $this->belongsTo("App\Models\Type");
    }

    public function pieces()
    {
        return $this->hasMany("App\Models\Piece");
    }
}
