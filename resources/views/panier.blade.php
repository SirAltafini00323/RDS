@extends("layouts/layout")

@section('style')
<style>
.quantity .moins,
.quantity .pluss {
    display: block;
    cursor: pointer;
    border: 0px transparent;
    padding: 0;
    width: 36px;
    height: 40px;
    line-height: 40px;
    text-align: center;
    background-color: #EEE;
    font-size: 1rem;
    font-weight: bold;
    transition: background-color .2s linear;
    -webkit-transition: background-color .2s linear;
    -o-transition: background-color .2s linear;
}
</style>
@endsection

@section("content")

<section id="content">
    <div class="content-wrap">
        @if($panier)
        <form action="{{route('payer')}}" method="post">
            @csrf
            <input type="hidden" name="panier" value="{{$panier->id}}">
            @endif
            <div class="container">

                <p>
                <h4>Bienvenue dans votre parier. Vous pouvez consultez <a href="{{route('historique')}}"> l'historique
                        de vos achats</a></h4>
                </p>
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success')}}
                </div>
                @endif
                @if(Session::has('danger'))
                <div class="alert alert-danger">
                    {{ Session::get('danger')}}
                </div>
                @endif
                @if(count($livraisons) !=0)
                <div class="alert alert-success">
                    @foreach($livraisons as $livraison)
                    <p>Votre panier de réference {{$livraison->panier->reference}} vous sera livré bientôt. Une fois
                        recu veillez cliquer sur le bouton j'ai recu <br><a class="btn btn-danger" style="float:right"
                            href="{{route('livraisonEffectue',$livraison->panier->reference)}}">J'ai recu mon coli</button></a></p>

                    @endforeach

                </div>
                @endif
				
                <table class="table cart mb-5">
                    <thead>
                        <tr>
                            <th class="cart-product-remove">&nbsp;</th>
                            <th class="cart-product-thumbnail">&nbsp;</th>
                            <th class="cart-product-name">Produits</th>
                            <th class="cart-product-price">Prix Unitaire</th>
                            <th class="cart-product-quantity">Quantité</th>
                            <th class="cart-product-subtotal">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($panier)
                        @foreach($items as $item)
                        <tr class="cart_item">
                            <td class="cart-product-remove">
                                <div>
                                    <input type="hidden" name="piece" value="{{$item->piece->id}}" min="1">
                                    <a href="#" piece="{{$item->piece->id}}" class="remove" title="Remove this item"><i
                                            class="icon-trash2"></i></a>
                                </div>

                            </td>

                            <td class="cart-product-thumbnail">
                                <a href="#"><img width="64" height="64" src="{{ $item->piece->image}}"
                                        alt="Pink Printed Dress"></a>
                            </td>

                            <td class="cart-product-name">
                                <a href="#">{{$item->piece->nom}}</a>
                            </td>

                            <td class="cart-product-price">
                                <span class="amount prix">{{$item->piece->prix}}</span>
                            </td>

                            <td class="cart-product-quantity">
                                <div class="quantity">
                                    <input type="button" value="-" class="moins">
                                    <input type="text" name="piece_{{$item->piece->id}}" class="qty quantite"
                                        value="{{$item->quantite}}" min="1" prix="{{$item->piece->prix}}" />
                                    <input type="button" value="+" class="pluss">
                                </div>
                            </td>

                            <td class="cart-product-subtotal">
                                <span class="amount"
                                    id="piece_{{$item->piece->id}}">{{ $item->piece->prix * $item->quantite}}</span>
                            </td>
                        </tr>

                        @endforeach
                        @else
                        <tr class="cart_item">
                            <td colspan="6">
                                <h1 style="color:rgba(0,0,0,0.4);text-align:center;margin-top: 40px;">Vous n'avez aucun
                                    produits dans votre panier</h1>
                            </td>
                        </tr>
                        @endif
                    </tbody>

                </table>
                @if($panier)
                <div class="row col-mb-30">
                    <div class="col-lg-6">
	
                        <h4>DETAILS </h4>
                        <div class="row">
                            <div class="col-6 form-group">
                                <input type="text" name="numero" class="sm-form-control"
                                    placeholder="Numéro à joindre" value="{{old('numero')}}" />
                                    @error('numero')
                                    <span class="erreur">
                                      {{ $message }}
                                    </span>
                                    @enderror
                            </div>

                            <div class="col-6 form-group">
                                <input type="text" name="adresse" class="sm-form-control" placeholder="Adresse" value="{{old('adresse')}}"/>
                                @error('adresse')
                                    <span class="erreur">
                                      {{ $message }}
                                    </span>
                                    @enderror
                            </div>
                        </div>


                    </div>

                    <div class="col-lg-6">


                        <div class="table-responsive">
                            <table class="table cart cart-totals">
                                <tbody>
                                    <tr class="cart_item">
                                        <td class="cart-product-name">
                                            <strong>Total des achats</strong>
                                        </td>

                                        <td class="cart-product-name">
                                            <span id="montantTotal" class="amount">{{$panier->solde()}}</span>
                                        </td>
                                    </tr>
                                    <tr class="cart_item" id="affichageFraisLivraison">
                                        <td class="cart-product-name">
                                            <strong>Frais de livraison</strong>
                                        </td>

                                        <td class="cart-product-name">
                                            <span class="amount"
                                                id="prixLivraison">{{isset($prixLivraison) ? $prixLivraison : 0}}</span>
                                        </td>
                                    </tr>
                                    <tr class="cart_item">
                                        <td class="cart-product-name">
                                            <strong>Total</strong>
                                        </td>

                                        <td class="cart-product-name">
                                            <span class="amount color lead"><strong
                                                    id="total">{{$panier->solde() + (isset($prixLivraison) ? $prixLivraison : 0)}}</strong></span>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
                @endif
                @if($panier)

                <div class="row col-mb-30">
                    <div class="col-6"></div>
                    <table>
                        <tr class="cart_item">
                            <td colspan="6">
                                <div class="row justify-content-between py-2 col-mb-30">
                                    <div class="col-lg-auto pr-lg-0">
                                        <button type="submit" width="100%"
                                            class="button button-3d mt-2 mt-sm-0 mr-0">Procéder au paiement</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>



                </div>
                @endif
            </div>
    </div>
    @if($panier)
    </form>
    @endif

</section><!-- #content end -->



<script>
var quantites = document.querySelectorAll(".quantite")
var montantTotal = 0
var removes = document.querySelectorAll('.remove')
var livraison = document.getElementById('livraison')

/*livraison.addEventListener('change',function(e){
	var affichageFraisLivraison = document.getElementById("affichageFraisLivraison")
	if(e.target.checked)
		affichageFraisLivraison.style.display = "none"
	else
		affichageFraisLivraison.style.display = ""
	calculMontant()
})*/

function calculMontant() {
    montantTotal = 0
    for (let j = 0; j < quantites.length; ++j) {
        console.log(quantites[j]);
        prix = parseInt(quantites[j].getAttribute('prix'))
        montantTotal += prix * quantites[j].value
    }
    document.getElementById('montantTotal').innerText = montantTotal
	/*if(livraison.checked)
		prixLivraison = 0
	else
    	prixLivraison = parseInt(document.getElementById("prixLivraison").innerText)*/
    montant =/* prixLivraison +*/ montantTotal

    document.getElementById('total').innerText = montant
}

for (let i = 0; i < removes.length; ++i) {
    removes[i].addEventListener('click', function(event) {
        event.preventDefault();
        piece = this.getAttribute('piece')
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = function() {
            if (this.readyState === 4) {
                console.log(this.response);
                reponse = JSON.parse(this.response)
                if (reponse.statut == true) {
                    console.log(this.response)
                    element =  removes[i].parentNode.parentNode.parentNode
                    element.parentNode.removeChild(element)
                    removes = document.querySelectorAll('.remove')
                    calculMontant()
                }
            }
        }
        xhr.open("GET", "/pieces/supprimerPiece/" + piece, false)
        xhr.send()
    })
}
for (let i = 0; i < quantites.length; ++i) {
    quantites[i].addEventListener('input', function(e) {
        montantTotal = 0
        calculMontant()
        document.getElementById(this.name).innerText = parseInt(this.getAttribute('prix')) * this.value

    })
}


var plus = document.querySelectorAll('.pluss')
var minus = document.querySelectorAll('.moins')

for (let i = 0; i < plus.length; ++i) {
    plus[i].addEventListener('click', function() {
        quantite = this.parentNode.querySelector('.quantite')
        quantite.value = parseInt(quantite.value) + 1
        document.getElementById(quantite.name).innerText = parseInt(quantite.getAttribute('prix')) * parseInt(
            quantite.value)
        calculMontant()
    })
}
for (let i = 0; i < minus.length; ++i) {
    minus[i].addEventListener('click', function() {
        quantite = this.parentNode.querySelector('.quantite')
        if (quantite.value > 1)
            quantite.value = parseInt(quantite.value) - 1
        console.log(quantite.value)
        document.getElementById(quantite.name).innerText = parseInt(quantite.getAttribute('prix')) * parseInt(
            quantite.value)
        calculMontant()
    })
}
</script>

@endsection