<?php

namespace App\Http\Controllers;

use App\Models\Boutique;
use App\Models\Livraison;
use App\Models\Panier;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class PanierAdminController extends Controller
{
    public function show($reference)
    {
        if(!Auth::check())
            return redirect()->route("users.login",["page"=>"/admin/paniers/$reference"]); 
        $panier = Panier::whereReference($reference)->first();
        $items = null;
        if($panier)
            $items = $panier->ajouterPieces;
        $prixLivraison = Boutique::first()->prixLivraison;
        $title = "panier";
        $livraisons = [];
        return view('admin.paniers.show',compact('panier','items','prixLivraison','title'));
    }

}
