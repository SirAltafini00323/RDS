@extends("layouts/layout")


@section("style")

<style>
.dropdown-toggle::after {
    margin-left: 0.255em;
}

.dark .irs-bar {
    background-color: #CCC
}

.dark .irs-grid-text {
    color: #EEE
}

.slide-caption {
    position: absolute;
    opacity: 0;
    max-width: none !important;
    -webkit-transition: opacity .4s .4s, transform .4s .4s ease-in-out;
    -o-transition: opacity .4s .4s, transform .4s .4s ease-in-out;
    transition: opacity .4s .4s, transform .4s .4s ease-in-out;
    -webkit-transform: translateY(50px);
    -ms-transform: translateY(50px);
    -o-transform: translateY(50px);
    transform: translateY(50px);
}

.flex-viewport {
    height: 100% !important;
}

.slide-caption.slider-caption-bottom {
    padding: 20px;
    width: 100%;
    min-width: 100%;
    height: auto !important;
    left: 0;
    top: auto;
    bottom: 0;
}

.slide-caption.slider-caption-bottom p {
    margin-bottom: 0;
    font-size: 15px;
}

.slide.flex-active-slide .slide-caption {
    opacity: 1;
    -webkit-transform: translateY(0);
    -ms-transform: translateY(0);
    -o-transform: translateY(0);
    transform: translateY(0);
}

.slide .slide-caption.card {
    width: auto !important;
    height: auto !important;
    top: 20px;
    font-size: 18px;
    -webkit-transform: translateY(0);
    -ms-transform: translateY(0);
    -o-transform: translateY(0);
    transform: translateY(0);
    -webkit-transition: opacity .4s .6s;
    -o-transition: opacity .4s .6s;
    transition: opacity .4s .6s;
}
</style>
@endsection
@section("content")
<section id="content">
    <div class="content-wrap pt-0" style="overflow: visible;">

        <div id="slider" class="slider-element h-auto">
            <div class="slider-inner">

                <div class="row align-items-stretch flex-md-row-reverse mx-0">
                    <div class="col-md-8 col-sm-12 px-0 min-vh-50">
                        <div class="fslider h-100 shadow-sm" data-arrows="true" data-autoplay="6000" data-loop="true">
                            <div class="flexslider h-100">
                                <div class="slider-wrap h-100">
                                    <div class="slide h-100"
                                        style="background: url('{{asset('demos/car/images/7.jpg') }}') center center; background-size: cover;">
                                        <div class="slide-caption bg-dark card shadow-sm ml-4">
                                            <div class="card-body font-weight-semibold py-1 px-2 text-light">2011</div>
                                        </div>
                                        <div
                                            class="slide-caption d-flex justify-content-between align-items-center flex-row dark slider-caption-bottom bg-dark slider-caption-bg py-4 px-4">
                                            <div class="w-75">
                                                <h2 class="mb-1">HAOJUE TF 125</h2>

                                            </div>
                                            <h2 class="font-weight-bold h2 mb-0">500000 FCFA</h2>
                                        </div>
                                    </div>
                                    @foreach($motos as $moto)
                                    <div class="slide h-100"
                                        style="background: url('{{$moto->image}}') center center; background-size: cover;">
                                        <div class="slide-caption bg-dark card shadow-sm ml-4">
                                            <div class="card-body font-weight-semibold py-1 px-2 text-light">
                                                {{$moto->annee}}</div>
                                        </div>
                                        <div
                                            class="slide-caption d-flex justify-content-between align-items-center flex-row dark slider-caption-bottom bg-dark slider-caption-bg py-4 px-4">
                                            <div class="w-75">
                                                <h2 class="mb-1">{{$moto->nom}}</h2>

                                            </div>
                                            <h2 class="font-weight-bold h2 mb-0">{{$moto->prix}} FCFA</h2>
                                        </div>
                                    </div>
                                    @endforeach


                                    <!--<div class="slide h-100" style="background: url('{{asset('demos/car/images/accueil.jpg') }}') center center; background-size: cover;">
												
												<div class="slide-caption d-flex justify-content-between align-items-center flex-row dark slider-caption-bottom bg-dark slider-caption-bg py-4 px-4">
													<div class="w-75">
														<h2 class="mb-1">Bienvenue chez RDS Motors</h2>
														<p class="font-weight-light text-white-50">Notre boutique met à votre disposition des pièces de motos efficaces pour couvrir tous vos besoins. Des motos seront également bientôt disponibles.</p>
													</div>
												</div>
											</div>-->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-12 px-0">
                        <div class="card bg-color rounded-0 shadow-sm p-4 h-100">
                            <div class="card-body">
                                <h3 class="text-white">Entrez les détails du produit que vous recherchez:</h3>
                                <form name="forme" class="mb-0">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="text-white d-block">Type</label>
                                            <input class="bt-switch" type="checkbox" name="forme" checked
                                                data-on-text="Pièces" data-off-text="Motos" data-on-color="default"
                                                data-off-color="default" data-handle-width="50">
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label class="text-white">Marques</label>
                                            <select name="type" id="type" class="selectpicker form-control customjs"
                                                title="Selectionner la marque" data-size="7" data-live-search="true"
                                                style="width:100%;">
                                                <option value="tous">Toutes les marques</option>
                                                @foreach($types as $type)
                                                <option value="{{$type->id}}" id="type_{{$type->id}}">{{$type->nom}}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label class="text-white">Modèle</label>
                                            <select name="categorie" class="customjs form-control"
                                                data-live-search="true" title="Selectionner un modèle"
                                                style="width:100%; line-height: 30px;">
                                                <option value="tous">Tous</option>
                                                @foreach($types as $type)
                                                <optgroup label="{{$type->nom}}" class="optgroup"
                                                    type="type_{{$type->id}}">
                                                    @foreach($type->categories as $categorie)
                                                    <option value="{{$categorie->id}}">{{$categorie->nom}}</option>
                                                    @endforeach
                                                </optgroup>
                                                @endforeach

                                            </select>

                                        </div>
                                        <div class="col-12 mt-3 input-daterange travel-date-group">
                                            <label class="text-white" for="template-contactform-date">Entrez des détails
                                                supplémentaires</label>
                                            <input type="text" id="template-contactform-date"
                                                name="template-contactform-date" value=""
                                                class="form-control text-left">
                                        </div>


                                        <div class="col-12 mt-4">
                                            <button
												id="rechercher"
                                                class="button button-3d button-rounded button-white button-light button-large btn-block m-0">Rechercher</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="section center nbottomomargin mt-3 footer-stick" style="padding:80px 0 ">
            <div class="container clearfix">
                <h3 class="font-primary">Profitez de la meilleure qualité à des prix abordables</h3>
                <a href="{{route('pieces.afficherTout')}}"
                    class="button button-color button-large button-rounded">Découvrir la boutique</a>
            </div>
        </div>
    </div>
</section><!-- #content end -->

<script>
var forme = document.forme
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