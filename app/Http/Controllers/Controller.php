<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        if(Auth::check())
            {
                if($panier = Auth::user()->panierEnCours())
                {
                    $nbPiece = $panier->quantitePieces();
                    $prixLivraison = Boutique::first()->prixLivraison;
                    View::share('nbPiece', $nbPiece);
                    View::share('prixLivraison',$prixLivraison);
                }
                

            }
    }
}
