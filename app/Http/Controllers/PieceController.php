<?php

namespace App\Http\Controllers;

use App\Models\Piece;
use App\Models\Type;
use App\Models\Categorie;
use App\Models\Forme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class PieceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $title = "admin";
        $subtitle = "piece";
        View::share(compact('title',"subtitle"));
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $formes = Forme::all();
        return view('admin.pieces.create',compact('types','formes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $this->validate($request,[
            'file'=> "required|mimes:jpeg,jpg,png,gif|max:2048",
        ]);
        $piece = new Piece();
        $piece->nom = $request->input()['nom'];
        $piece->prix = $request->input()['prix'];
        $piece->annee = $request->input()['annee'];
        $piece->description = $request->input()['description'];
        $piece->stock = $request->input()['stock'];
        $piece->categorie()->associate(Categorie::findOrFail($request->input()['categorie_id']));
        $piece->forme()->associate(Forme::findOrFail($request->input()['forme_id']));
        
        if($file = $request->file('file'))
        {
            $idPiece = Piece::all()->count();
            $numero = 1;
            $sourcePath = "images/pieces";
            $nomFichier = $idPiece . "-" . $numero .  "." . $file->getClientOriginalExtension();
            $lien = $sourcePath . "/" . $nomFichier;
            while(file_exists($lien))
            {
                $numero +=1;
                $sourcePath = "images/pieces";
                $nomFichier = $idPiece . "-" . $numero .  "." . $file->getClientOriginalExtension();
                $lien = $sourcePath . "/" . $nomFichier;
            }
            if($file->move($sourcePath,$nomFichier))
                $piece->image = $sourcePath . "/" . $nomFichier;


        }
        $piece->save();
        
        return back()->withSuccess("La pièce $piece->nom a été enrégistré avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Piece  $piece
     * @return \Illuminate\Http\Response
     */
    public function show(Piece $piece)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Piece  $piece
     * @return \Illuminate\Http\Response
     */
    public function edit($item)
    {
        $types = Type::all();
        $formes = Forme::all();
        $item = Piece::findOrFail($item);
        return view('admin.pieces.edit',compact('item','types','formes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Piece  $piece
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $piece = Piece::findOrFail($id);
        $this->validate($request,[
            'file'=> "mimes:jpeg,jpg,png,gif|max:2048",
        ]);
        $piece->nom = $request->input()['nom'];
        $piece->prix = $request->input()['prix'];
        $piece->annee = $request->input()['annee'];
        $piece->description = $request->input()['description'];
        $piece->stock = $request->input()['stock'];
        $piece->categorie()->associate(Categorie::findOrFail($request->input()['categorie_id']));
        $piece->forme()->associate(Forme::findOrFail($request->input()['forme_id']));
        
        if($file = $request->file('image'))
        {
            $idPiece = Piece::all()->count();
            $numero = 1;
            $sourcePath = "images/pieces";
            $nomFichier = $idPiece . "-" . $numero .  "." . $file->getClientOriginalExtension();
            $lien = $sourcePath . "/" . $nomFichier;
            while(file_exists($lien))
            {
                $numero +=1;
                $sourcePath = "images/pieces";
                $nomFichier = $idPiece . "-" . $numero .  "." . $file->getClientOriginalExtension();
                $lien = $sourcePath . "/" . $nomFichier;
            }
            if($file->move($sourcePath,$nomFichier))
                $piece->image = $sourcePath . "/" . $nomFichier;


        }
        $piece->save();
        
        return back()->withSuccess("Élément modifié avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Piece  $piece
     * @return \Illuminate\Http\Response
     */
    public function destroy(Piece $piece)
    {
        $piece->archiver();
        return back()->withSuccess("Element supprimé avec succcès");
    }

    public function stock()
    {
        $items = Piece::piecesNonArchivees()->get();
        $subtitle = "stock";
        return view('admin.pieces.stock',compact('items','subtitle'));
    }

    public function actualiserStock(Request $request)
    {
        $piece = Piece::findOrFail($request->input()['piece_id']);
        $piece->stock = $request->input()['stock'];
        $piece->save();
        return back()->withSuccess("Stock actualisé avec succès");
    }

    public function afficherTout()
    {
        $pieces = Piece::piecesNonArchivees()->paginate(9);
        $types = Type::all();
        $title = "piece";
        return view("afficher.afficher",compact("pieces","types","title"));
    }

    public function afficherParNom($name)
    {
        $types = Type::all();
        $pieces = Piece::piecesNonArchivees()->where('nom','LIKE',"%{$name}%")->paginate(9);
        $title = "piece";
        $recherche = $name;
        return view("afficher.afficher",compact("pieces","types","title","recherche"));
    }
    public function afficher($type = null , $categorie =null, $forme = null, $recherche = null)
    {
        $categorie = Categorie::find($categorie);
        $type = Type::find($type);
        $types = Type::all();
        $title = "piece";
    
        $pieces = Piece::piecesNonArchivees();
        if(isset($forme))
        {
            if($forme == "piece")
            {
                $piece_id = Forme::whereName('piece')->first()->id;
                $pieces = $pieces->where('forme_id',$piece_id);
                $isPiece = true;
            }
            elseif($forme == "moto")
            {
                $moto_id = Forme::whereName('moto')->first()->id;
                $pieces = $pieces->where('forme_id',$moto_id);
                $isPiece = false;
            }
    
        }
        if($categorie)
            $pieces = $pieces->where('categorie_id',$categorie->id);
        else
        {
            if($type)
            {
                $categories_id = $type->categories()->get()->pluck('id');
                $pieces = $pieces->whereIn('categorie_id',$categories_id);
            }
        }

        
        if(isset($recherche))
        {
            $pieces = $pieces->where('nom','LIKE',"%{$recherche}%")->paginate(9);
        }
        else 
            $pieces = $pieces->paginate(9);
        return view("afficher.afficher",compact("pieces","types","title","type","categorie","forme","recherche"));
       
    }
}
