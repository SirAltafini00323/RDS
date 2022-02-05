<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $title = "admin";
        $subtitle = "modele";
        View::share(compact('title',"subtitle"));
    }
    
    public function index()
    {
        $subtitle = "modele";
        $types = Type::all();
        $items = Categorie::all();
        return view('admin.categories.index',compact('subtitle','types','items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Categorie();
        $category->nom = $request->input('nom');
        $type = Type::findOrFail($request->input('type_id'));
        $category->type()->associate($type);
        $category->save();
        return back()->withSucess("Modele de piece ($category->nom) enregistré avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(Categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $categorie)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorie $categorie)
    {
        $category = Categorie::findOrFail($categorie);
        $category->update($request->all());
        return back()->withSucess("Modele de piece ($category->nom) modifié avec succès");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy($categorie)
    {
        Categorie::destroy($categorie);
        return back()->withSuccess("Element supprimé avec succcès");
    }

   
}
