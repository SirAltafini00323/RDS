@extends("layouts/layout")


@section("style")
<style>
.cacher {
    display: none;
}

.dropdown-toggle::after {
    margin-left: 0.255em;
}
</style>

@endsection

@section("content")

<section id="page-title" class="page-title-parallax page-title-dark"
    style="background-color:rgba(0,0,0,0.5); background-size: cover; padding: 100px 0;"
    data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -300px;">
    <center>
        <h2 style="color:white">Faites une recherche simple</h2>
    </center>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-4">
            <input type="text" class="form-control " id="nom" value="{{isset($recherche) ? $recherche : ''}}"
                placeholder="Entrer le nom de la moto ou de la pièce que vous recherchez">
        </div>
        <div class="col-md-2">
            <button id="rechercheParNom" class="button button-3d button-rounded btn-block ml-0 mt-0">Rechercher</button>
        </div>
    </div>

</section><!-- #page-title end -->

<section id="content">
    <div class="content-wrap pt-0" style="overflow: visible;">
        <div class="container">
        <form name="forme"  class="mb-0">
            <div class="card p-4 shadow" style="top: -60px;">


                <h2>Recherchez à partir de:</h2>
               
                    @csrf
                    <div class="row clearfix">

    
                        <div class="col-md-4 col-sm-6 col-12 mt-4 mt-md-0">
                            <label for="">Marque</label>
                            <select name="type" id="type" class="selectpicker form-control customjs"
                                title="Selectionner une marque" data-size="10" data-live-search="true"
                                style="width:100%;">
                                <option value="tous">Toutes les marques</option>
                                @foreach($types as $elt)
                                <option value="{{$elt->id}}" id="type_{{$elt->id}}"
                                    {{ isset($type) && $type->id == $elt->id ? 'selected' : '' }}>{{$elt->nom}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-6 col-12 mt-4 mt-md-0">
                            <label for="" class="">Modèle</label>
                            <select name="categorie" id="categorie" class="customjs form-control" data-size="10"
                                data-live-search="true" title="Selectionner un modèle"
                                style="width:100%; line-height: 30px;">
                                <option value="tous">Tous</option>
                                @foreach($types as $type)
                                <optgroup label="{{$type->nom}}" class="optgroup" type="type_{{$type->id}}">
                                    @foreach($type->categories as $elt)
                                    <option value="{{$elt->id}}"
                                        {{ isset($categorie) && $categorie->id == $elt->id ? 'selected' : '' }}>
                                        {{$elt->nom}}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4 col-sm-6 col-6">
                            <button id="rechercher" class="button button-3d button-rounded btn-block ml-0"
                                style="margin-top: 29px;">Rechercher</button>
                        </div>
                    </div>
              
            </div>
            <div class="row">
            <div class="col-md-2"> </div>
            <div class="col-md-2" style="font-weight:bold;font-size:20px">Filtre : </div>
                <div class="form-group col-md-2 mt-2"><input type="radio" name="forme" value="all" {{ isset($forme) && $forme== 'all' ? 'checked' : '' }}> <label for=""> Moto
                        et piece</label></div>
                <div class="form-group col-md-2 mt-2"><input type="radio" name="forme" value="moto" {{ isset($forme) && $forme== 'moto' ? 'checked' : '' }}> <label for="">
                        Moto</label></div>
                <div class="form-group col-md-2 mt-2"><input type="radio" name="forme" value="piece" {{ isset($forme) && $forme== 'piece' ? 'checked' : '' }}> <label for="">
                        Piece</label></div>
            </div>
           
                        </form>



        

    </div>

    <div class="section m-0 pt-0 bg-transparent">
        <div class="container">

            <article>
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success')}}
                </div>
                @endif
                @if(Session::has('danger'))
                <div class="alert alert-danger" >
                    {{ Session::get('danger')}}
                </div>
                @endif
                <div class="alert alert-info" id="alertInfo" style="display:none">

                </div>
            </article>
            <!-- Portfolio Items
						============================================= -->
            <div id="portfolio" class="portfolio row gutter-30 grid-container" data-layout="fitRows">

                @foreach($pieces as $piece)
                <article
                    class="portfolio-item col-12 col-sm-6 col-md-4 cf-sedan {{ $piece->forme->name == 'piece' ? 'piece' : 'moto' }}">
                    <div class="grid-inner">
                        <div class="portfolio-image">
                            <a href="#" width="100px">
                                <img src="{{ asset($piece->image) }}" style="height:200px" alt="Open Imagination"
                                    width="">
                                <div class="filter-p-pricing">
                                    <span class="p-price font-weight-bold ls1">{{$piece->prix}} FCFA</span>
                                    <span class="p-price-msrp">DISPONIBLE :
                                        <strong>{{$piece->stock}}</strong></span>
                                </div>
                            </a>
                        </div>
                        <div class="portfolio-desc">
                            <h3><a href="#">{{$piece->nom}}</a></h3><br>
                            <form name="ajoutPiece" action="{{route('ajouterPiece')}}" method="post">
                                @csrf()
                                <div class="row">
                                    <div class="quantity col-lg-5" style="margin-right:0px">
                                        <input type="button" value="-" class="minus">
                                        <input type="text" id="quantite_{{$piece->id}}" min="1" name="quantite" value="1" class="qty" />
                                        <input type="button" value="+" class="plus">
                                    </div>

                                    <div class="col-lg-7">
                                        <button piece="{{$piece->id}}" class="button button-3d button-rounded ajouter">Ajouter au
                                            panier</button>
                                    </div>

                                </div>
                            </form>

                        </div>
                        <div class="row no-gutters car-p-features font-primary clearfix">


                        </div>
                    </div>
                </article>
                @endforeach
                <div class="col-md-4"></div>
                <div class="col-md-8 float-right">
                    @if($pieces->count()!=0)
                    {{ $pieces->render() }}
                    @endif
                </div>




            </div>
        </div>
    </div>


    </div>
</section><!-- #content end -->

<script>

var forme2 = document.forme.forme;
var forme = document.forme
var nbPiece = document.getElementById("nbPiece")



for(let i=0 ; i<forme2.length ; ++i)
{
    forme2[i].addEventListener('change',function(e)
    {
        a = forme.forme.value ; b = forme.categorie.value ; c = forme.type.value
    if(!a)
        a = null 
    if(!b)
        b = null 
    if(!c) 
        c = null
        
     window.location.replace("/pieces/" + c + "/" + b + "/" + a + "/" + document.getElementById('nom').value )
    })
}


//Ajout de produit au panier
var ajouterButtons = document.querySelectorAll(".ajouter");
var alertInfo = document.getElementById('alertInfo')
for (let i = 0; i < ajouterButtons.length; ++i) {
    ajouterButtons[i].addEventListener('click', function(e) { 
        e.preventDefault()
        let piece = this.getAttribute("piece")
        let quantite = document.getElementById("quantite_"+piece).value
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = function() {
            if (this.readyState === 4) {
                console.log(this.response);
                reponse = JSON.parse(this.response)
                if(!reponse.statut)
                    window.location.replace("/login")
                nbPiece.innerHTML = parseInt(nbPiece.innerHTML) + parseInt(quantite)
                alertInfo.innerHTML = reponse.info 
                alertInfo.style.display = "block"
            }
        }
        xhr.open("POST", "/pieces/ajouterPiece/")
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("piece="+piece+"&&quantite="+quantite+"&&_token={{ csrf_token() }}")

    })
}

var rechercher = document.getElementById('rechercher');

rechercher.addEventListener('click',function(e){
    e.preventDefault();
    a = forme.forme.value ; b = forme.categorie.value ; c = forme.type.value
    if(!a)
        a = null 
    if(!b)
        b = null 
    if(!c) 
        c = null
     window.location.replace("/pieces/" + c + "/" + b + "/" + a)
    
})


var rechercheParNom = document.getElementById('rechercheParNom')

rechercheParNom.addEventListener('click', function() {
    window.location.replace("/pieces/" + document.getElementById('nom').value)
})

var type = document.getElementById('type')
var optgroups = document.querySelectorAll('optgroup')

type.addEventListener('change', function() {
    element = this.options[this.selectedIndex]
    if (element.value == "tous") {
        for (let i = 0; i < optgroups.length; ++i)
            optgroups[i].style.display = "block"
    } else {
        for (let i = 0; i < optgroups.length; ++i) {
            if (optgroups[i].getAttribute('type') == element.getAttribute('id'))
                optgroups[i].style.display = "block"
            else
                optgroups[i].style.display = "none"
        }
    }


})
</script>



@endsection