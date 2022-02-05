<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;

    public function livrer()
    {
        $this->livrer = 1;
        return $this->save();
        
    }

    public function panier()
    {
        return $this->belongsTo("App\Models\Panier");
    }
}
