<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;

class TypeController extends Controller
{
   
    public function __construct()
    {
        $title = "admin";
        $subtitle = "type";
        View::share(compact('title',"subtitle"));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Type::all();
        return view('admin.types.index',compact('items'));
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
        $type = new Type();
        $type->nom = $request->input()['nom'];
        $type->save();
        return back()->withSuccess("Type de moto ($type->nom) enregistré avec succès");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $type = Type::findOrFail($type);
        $type->nom = $request->input()['nom'];
        $type->save();
        return back()->withSuccess("Type de moto ($type->nom) modifié avec succès");
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy($type)
    {
        Type::destroy($type);
        return back()->withSuccess("Element supprimé avec succcès");
    }

    public function categories($type)
    {
        $type = Type::find($type);
        if(!$type)
            return Response::json(Categorie::all());
        return Response::json($type->categories);
    }
}
