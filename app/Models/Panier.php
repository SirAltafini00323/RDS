<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Piece;
use App\Models\Panier;
use App\Models\AjouterPiece;

use Illuminate\Support\Facades\Auth;

class Panier extends Model
{
    use HasFactory;

    public function pieces()
    {
        return $this->belongsToMany("App\Models\Piece","ajouter_pieces");
    }

    public function livraisons()
    {
        return $this->hasMany("App\Models\Livraison");
    }

    public function isBuy()
    {
        if($this->idAchat == null)
            return false;
        return true;
    }

    public static function ajouterPiece(Piece $piece,$quantite)
    {
        $panier = Auth::user()->panierEnCours();
        if(!$panier)
        {
            $panier = new Panier();
            $panier->user()->associate(Auth::user());
            $panier->reference = uniqid();
            $panier->save();
        }
        $ajouter = AjouterPiece::where('piece_id',$piece->id)->where('panier_id',$panier->id)->first();
        if($ajouter)
        {
            $ajouter->quantite += $quantite;
        }
        else
        {
            $ajouter = new AjouterPiece();
            $ajouter->piece()->associate($piece);
            $ajouter->panier()->associate($panier);
            $ajouter->quantite = $quantite;
        }
        $ajouter->prix = $ajouter->quantite * $piece->prix;
        
        
        $ajouter->save();
        return $panier;
    }

    public function supprimerPiece(Piece $piece)
    {
       $this->pieces()->detach($piece->id);
    }

    public function quantitePiece(Piece $piece)
    {
        return $this->ajouterPieces()->where('piece_id',$piece->id)->sum('quantite');
    }

    public function quantitePieces()
    {
        return $this->ajouterPieces()->sum('quantite');
    }


    public function solde()
    {
        $solde = 0;
        $pieces = $this->pieces;
        foreach($pieces as $piece)
        {
            $solde += $this->quantitePiece($piece) * $piece->prix;
        }
        if($this->livraisons()->first() !== null)
            if($this->livraisons()->first()->mode == 1)
                $solde +=  Boutique::first()->prixLivraison;
        return $solde;

    }

    public function soldeAfterPayement(){
        $solde = $this->ajouterPieces()->sum('prix');
        if($this->livraisons()->first() !== null)
            if($this->livraisons()->first()->mode == 1)
                $solde +=  Boutique::first()->prixLivraison;
        return $solde;
    }

  
    public function acheter()
    {

    }

    public function user()
    {
        return $this->belongsTo("App\Models\User");
    }

    public function ajouterPieces()
    {
        return $this->hasMany("App\Models\AjouterPiece");
    }

    public static function achatsTermines()
    {
        return Panier::whereNotNull('idAchat')->get();
    }

    public static function livraisonsEnCours()
    {
        
        $livraisons = Panier::whereNotNull('idAchat')->get()->filter(function($value,$key){ 
            return $value->livraisons()->first()->livrer == 0 && $value->livraisons()->first()->mode == 1;
        }); 
        return $livraisons;
    }

    public static function livraisonsEffectues()
    {
        $livraisons = Panier::whereNotNull('idAchat')->get()->filter(function($value,$key){
            return $value->livraisons()->first()->livrer == 1;
        });
        return $livraisons;   
     
    }

    public function livrer()
    {
        if($this->livraisons->count() != 0 )
        {
            if($this->livraisons()->first()->livrer == 1)
                return true;
            return false;   
        } 
        return false;
        
    }

}
