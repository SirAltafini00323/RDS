<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;


use Illuminate\Http\Request;
use App\Models\Piece;
use App\Models\Panier;
use App\Models\AjouterPiece;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Models\Boutique;
use App\Models\Livraison;


class PanierController extends Controller
{
    public function ajouterPiece(Request $request)
    {
        
        $piece = Piece::findOrFail($request->input()['piece']);
        $quantite = $request->input()['quantite'];
        if(!Auth::user())
            return Response::json(["statut" => false,"info"=>"Non autorisé"]);
        $panier = Panier::ajouterPiece($piece,$quantite);
        $nbPiece = $panier->quantitePieces();
        return Response::json(["statut" => true,"info"=>"$quantite $piece->nom ajouté au panier avec succès"]);
         
    }



    public function supprimerPiece($piece)
    {
        $panier = Auth::user()->panierEnCours();
        $piece = Piece::findOrFail($piece);
        $panier->supprimerPiece($piece);
        
        if($panier->pieces->count() == 0)
        {
            foreach($panier->livraisons as $livraison )
                Livraison::destroy($livraison->id);
            Panier::destroy($panier->id);

        }
        return Response::json(["statut" => true,"info"=>"La pièce $piece->nom a été supprimé du panier avec succès"]);
       
    }

    public function panier()
    {
        if(!Auth::check())
            return redirect()->route("users.login",["page"=>"/panier"]);
        $panier = Auth::user()->panierEnCours();
        $items = null;
        if($panier)
            $items = $panier->ajouterPieces;
        $prixLivraison = Boutique::first()->prixLivraison;
        $title = "panier";
        $paniers = Auth::user()->paniers;
        $livraisons = [];
        foreach($paniers as $pan)
        {
            $livraison = $pan->livraisons()->first();
            if($livraison)
            {
                if($livraison->livrer == 0)
                {
                    array_push($livraisons,$livraison);
                }
            }
            
        }
        return view('panier',compact('panier','items','prixLivraison','title','livraisons'));
    }

    public function payer(Request $request)
    {
        $validated = $request->validate([
            'numero' => 'required|numeric',
            'adresse' => 'required',
        ]);
        $panier = Panier::findOrFail($request->input()['panier']);
        foreach($request->input() as $key=>$value)
        {
            if(Str::startsWith($key,'piece_'))
            {
                $piece = Piece::findOrFail(explode("_",$key)[1]);
                if($panier->quantitePiece($piece) != $value )
                {
                    $panier->pieces()->detach($piece->id);
                    $ajouter = new AjouterPiece();
                    $ajouter->panier()->associate($panier);
                    $ajouter->piece()->associate($piece);
                    $ajouter->quantite = $value;
                    $ajouter->save();
                }
            }
        }
        $livraison = $panier->livraisons()->first();    
        if(!$livraison)
            $livraison = new Livraison();
        $livraison->adresse = $request->input()['adresse'];
        $livraison->tel = $request->input()['numero'];  
        if(isset($request->input()['livraison']))
            $livraison->mode = "0";
        $livraison->panier()->associate($panier);
        $livraison->save();
        $montant = $panier->solde();
        return view('payer',compact('montant','panier'));
     
    }

    public function livraisonMode($panier,$livrer){
        $panier = Panier::findOrFail($panier);
        $livraison = $panier->livraisons()->first();
        if($livrer == "true")
            $livraison->mode = 1;
        else 
            $livraison->mode = 0;
        $livraison->save();
        return response()->json(['statut' => true]);

    }

    public function payementEffectue($transaction,$panier)
    {
        $panier = Panier::findOrFail($panier);
        $public_key = "f19a95f097ef11ebb611b7e676b55ada";
        $private_key = "tpk_f19abd0197ef11ebb611b7e676b55ada";
        $secret = "tsk_f19abd0297ef11ebb611b7e676b55ada";
        $kkiapay = new \Kkiapay\Kkiapay($public_key,
                                $private_key, 
                                $secret, 
                                $sandbox = true);
        Mail::to('boukarimarfourz@gmail.com')->send(new Contact(["panier"=>$panier]));
        if($kkiapay->verifyTransaction($transaction)->amount != $panier->solde() )
        {
            return redirect()->route("panier")->withDanger("Un problème lors du payement. Les montants ne coincident pas.Contacter nous au 97050840");
        }
        else
        {
            $panier->idAchat = $transaction;
            $panier->save();
            return view('paymentSucess',compact('panier'));
        }
    }

    public function show()
    {
        $items = Auth::paniers;
        return view('paniers.show',compact('items'));
    }

    public function detail($panier)
    {
        $panier = Panier::findOrFail($panier);
        return view('paniers.detail',compact('panier'));
    }

    public function nbPiece()
    {
        if(Auth::check())
        {
            if($panier = Auth::user()->panierEnCours())
            {
                $reponse = [
                    "statut" => true,
                    "nbPiece" => $panier->quantitePieces()
                ];
                return Response::json($reponse);
            }
        }
        return Response::json(["statut" => false]);
    }

    public function historique()
    {
        if(Auth::check())
        {
            $title = "panier";
            $items = Auth::user()->paniers->filter(function ($value,$key) {return $value->isBuy();});
            return view('historique',compact('title','items'));
        }
    }

    public function livraisonEffectue($reference)
    {
        $panier = Panier::whereReference($reference)->first();
        if($panier)
        {
            $livraison = $panier->livraisons()->first();
            $livraison->livrer = 1;
            $livraison->save();
            return back()->withSuccess("Merci pour la confiance que vous nous portez.");
        }
    }
    
    
}
