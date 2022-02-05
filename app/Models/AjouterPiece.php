<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AjouterPiece extends Model
{
    use HasFactory;

    public function piece()
    {
        return $this->belongsTo("App\Models\Piece");
    }

    public function panier()
    {
        return $this->belongsTo("App\Models\Panier");
    }


}
