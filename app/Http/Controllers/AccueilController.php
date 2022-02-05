<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Type;
use App\Models\Forme;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;

class AccueilController extends Controller
{
   public function __invoke()
   {    
    $title = "accueil";
    $types = Type::all();
    if($motos = Forme::whereName('moto')->first())
    $motos = $motos->pieces;
    return view("index",compact('title','types','motos'));
   }

   public function apropos()
   {
        $title = "apropos";
        return view('apropos',compact('title'));
   }

   public function color($color)
   {
      $color = $color;
      return view('colors',compact('color'));
   }
}
