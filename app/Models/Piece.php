<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'description',
        'annee',
        'prix',
        'categorie_id',
        'forme_id',
        'stock',
        'image'
    ];

    public function scopePiecesNonArchivees($query){
        return $query->where('archiver',0);
    }

    public function paniers()
    {
        return $this->belongsToMany("App\Models\Panier","ajouter_pieces");
    }

    public function categorie()
    {
        return $this->belongsTo("App\Models\Categorie");
    }

    public function forme()
    {
        return $this->belongsTo("App\Models\Forme");
    }

    public function archiver(){
        $this->archiver = 1;
        $this->save();
    }



}
