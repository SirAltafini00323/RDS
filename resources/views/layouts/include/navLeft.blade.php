

            <ul class="list-group mb-3 mb-3 mt-md-0">
                <a class="list-group-item {{isset($subtitle) && $subtitle == 'general' ? 'active' : '' }}" href="{{route('admin')}}"> Vue générale  </a>
                <a class="list-group-item {{isset($subtitle) && $subtitle == 'livraison' ? 'active' : '' }}" href="{{route('admin.afficher','livraisonsEnCours')}}">Livraisons en attente </a>
                <a class="list-group-item {{isset($subtitle) && $subtitle == 'stock' ? 'active' : '' }}" href="{{route('pieces.stock')}}"> Actualiser le stock </a>
                 <a class="list-group-item {{isset($subtitle) && $subtitle == 'type' ? 'active' : '' }}" href="{{route('types.index')}}"> Type de moto </a>
                 <a class="list-group-item {{isset($subtitle) && $subtitle == 'modele' ? 'active' : '' }}" href="{{route('categories.index')}}"> Modèle de pièce </a>
                <a class="list-group-item {{isset($subtitle) && $subtitle == 'piece' ? 'active' : '' }}" href="{{route('pieces.create')}}"> Ajouter un nouveau produit </a>
               
                
            </ul>