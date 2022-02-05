@extends("layouts/layout")

@section('content')
    <div class="container" style="margin-top:40px">
    <div class="alert alert-info">
        Votre commande de référence {{$panier->reference}} a été enrégistré avec succès
    </div>
    <div class="row">
        <div class="col-md-6">
            <p>Contactez nous pour discuter de la livraison en cliquant sur le bouton contactez nous </p>
            <button class="btn btn-primary" id="contacter">Contacter</button>
        </div>
        <div class="col-md-6">
            <p>Cliquez sur le bouton pas intéressé si vous comptez venir récupérer vos articles à notre boutique sis à Cotonou fggg</p>
            <button id="sansLivraison" class="btn btn-primary">Pas interessé</button>
        </div>


    </div>

    </div>

    <script>
        var contacter = document.getElementById('contacter')
        contacter.addEventListener('click',function(){
            var xhr = new XMLHttpRequest()
            xhr.onreadystatechange = function() {
            if (this.readyState === 4) {
                reponse = JSON.parse(this.response)
                if (reponse.statut == true) {
                    console.log(this.response)
                    window.location.href = "https://api.whatsapp.com/send?phone=22951534062"
                }
            }
        }
        xhr.open("GET", "/paniers/livraisonMode/{{$panier->id}}/true", false)
        xhr.send() 
        })


        var contacter = document.getElementById('sansLivraison')
        contacter.addEventListener('click',function(){
            var xhr = new XMLHttpRequest()
            xhr.onreadystatechange = function() {
            if (this.readyState === 4) {
                console.log(this.response);
                reponse = JSON.parse(this.response)
                if (reponse.statut == true) {
                    console.log(this.response)
                    window.location.replace("/panier")
                }
            }
        }
        xhr.open("GET", "/paniers/livraisonMode/{{$panier->id}}/false", false)
        xhr.send() 
        })
    </script>

    </div>
       

@endsection