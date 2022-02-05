<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get("/","AccueilController")->name("accueil"); 

Route::get("accueil","AccueilController")->name("accueil"); 

Route::get("apropos","AccueilController@apropos")->name('apropos');

Route::resource('users',"UserController");

Route::get('login',function(){
    return view('users.login');
});

Route::post('login',"UserController@login")->name('users.login');

Route::get('logout',"UserController@logout")->name('users.logout');

Route::get('pieces',"PieceController@afficherTout")->name('pieces.afficherTout');

Route::get('pieces/{type}/{categorie}/{forme}/{recherche}',"PieceController@afficher")->name('pieces.afficher');
Route::get('pieces/{type}/{categorie}/{forme}',"PieceController@afficher")->name('pieces.afficher');

Route::get('pieces/{nom}',"PieceController@afficherParNom")->name('afficherParNom');

Route::get("type/categories/{type}","TypeController@categories");

Route::get('color',"AccueilController@color")->name('color');

Route::get('/paniers/nbPiece','PanierController@nbPiece');
Route::get('/paniers/livraisonMode/{panier}/{livrer}','PanierController@livraisonMode');


Route::get('/admin/paniers/{reference}','PanierAdminController@show')->name('admin.paniers.show');
Route::group(['prefix' => 'admin', 'middleware' => ["auth",'admin'] ], function() {

    Route::get('/',"AdminController@index")->name('admin');
    Route::get('/achats/{type}',"AdminController@afficher")->name('admin.afficher');
    Route::resource('categories','CategorieController');
    Route::resource('types','TypeController');
    Route::get('pieces/stock','PieceController@stock')->name('pieces.stock');
    Route::post('pieces/stock/store','PieceController@actualiserStock')->name('pieces.stock.store');
    Route::resource('pieces','PieceController');
   
});



Route::post('/pieces/ajouterPiece',"PanierController@ajouterPiece")->name("ajouterPiece");
Route::get('panier',"PanierController@panier")->name("panier");
Route::group(['middleware' => ["auth"]],function(){
    Route::get("/pieces/supprimerPiece/{piece}","PanierController@supprimerPiece")->name("supprimerPiece");
    Route::post('payer',"PanierController@payer")->name('payer');
    
    Route::get('payementEffectue/{transaction}/{panier}',"PanierController@payementEffectue");
    Route::get('/historique',"PanierController@historique")->name("historique");
    Route::get('/panier/livraisonEffectue/{reference}',"PanierController@livraisonEffectue")->name("livraisonEffectue");

});











//Auth::routes();
