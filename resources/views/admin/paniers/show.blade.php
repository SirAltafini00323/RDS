@extends("layouts/layoutAdmin")

@section('content')
<article class="card">
    <div class="card-header">
        <h4 class="card-title">Détail de la commande {{ $panier->reference }}</h4>
    </div>
    <div class="card-body">
        <section>
            <div class="row">
                <h4 class="col-md-3">
                    Nom du client : 
                </h4>
                <div class="col-md-3">{{$panier->user->name}}</div>
                <h4 class="col-md-3">
                   Numéro à joindre : 
                </h4>
                <div class="col-md-3">{{$panier->livraisons()->first()->tel}}</div>
            </div>
            <div class="row">
                <h4 class="col-md-3">
                    Date de payement : 
</h4>
                <div class="col-md-3">{{$panier->created_at}}</div>
                <h4 class="col-md-3">
                   Adresse du client : 
                </h4>
                <div class="col-md-3">{{$panier->livraisons()->first()->adresse}}</div>
            </div><br>

          
            <table class="table cart mb-5">
                <thead>
                    <tr>
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
                             {{$item->quantite}}
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
                            <h1 style="color:rgba(0,0,0,0.4);text-align:center;margin-top: 40px;">Aucun produit commandé
                            </h1>
                        </td>
                    </tr>
                    @endif
                </tbody>

            </table>
            @if($panier)
            <div class="row col-mb-30">
                <div class="col-lg-6">
                    <h4>LIVRAISON</h4>
                    <div class="form-check">
                        @if($panier->livraisons()->first()->mode == 1)
                        <label for="" class="form-check-label">Le client veut se faire livrer</label>
                        @else
                        <div>Le client viendra recupérer lui même ses produits</div>
                        @endif
                    </div><br>
                   

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
        </section>

    </div>
</article>



@endif


@endsection