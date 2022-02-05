<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Panier;

class AdminController extends Controller
{
    public function index()
    {
        $subtitle = "general";
        $achatsTermines = Panier::achatsTermines()->count();
        $livraisonsEnCours = Panier::livraisonsEnCours()->count();
        $livraisonsTermines = Panier::livraisonsEffectues()->count();
        $items = Panier::all()->filter(function ($value,$key) {return $value->isBuy();});
        return view('admin.index',compact("subtitle","items","achatsTermines","livraisonsEnCours","livraisonsTermines"));
    }

    public function afficher($type)
    {
        $subtitle = "livraison";
        $achatsTermines = Panier::achatsTermines()->count();
        $livraisonsEnCours = Panier::livraisonsEnCours()->count();
        $livraisonsTermines = Panier::livraisonsEffectues()->count();   
        if($type == "achatsTermines")
        {
            $items = Panier::achatsTermines();
        }
        else if ($type == "livraisonsEnCours")
        {
            $items = Panier::livraisonsEnCours();
        }
        else if ($type == "livraisonsEffectues") 
        {
            $items = Panier::livraisonsEffectues();
        }
        return view('admin.afficher',compact("subtitle","achatsTermines","livraisonsEnCours","livraisonsTermines","items"));
    }
}
