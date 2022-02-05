@extends("layouts/layoutAdmin")

@section('content')
            
                    <article class="card mb-3">
                        <div class="card-body">
                            
                            <figure class="icontext">
                                    
                                    <div class="text">
                                        <strong> Mr. Jackson Someone </strong> <br> 
                                       
                                        
                                    </div>
                            </figure>
                            <hr>
                            <p>
                                
                                Bienvenue sur votre tableau de bord <br> <br>
                                
                            </p>
            
                            
            
                            <article class="card-group">
                                <figure class="card bg">
                                    <div class="p-3">
                                         <h5 class="card-title">{{$achatsTermines}}</h5>
                                        <span>Achats terminés</span>
                                    </div>
                                </figure>
                                <figure class="card bg">
                                    <div class="p-3">
                                         <h5 class="card-title">{{$livraisonsEnCours }}</h5>
                                        <span>Livraisons en attente</span>
                                    </div>
                                </figure>
                                <figure class="card bg">
                                    <div class="p-3">
                                         <h5 class="card-title">{{$livraisonsTermines }}</h5>
                                        <span>Livraisons effectuées</span>
                                    </div>
                                </figure>
                            </article>
                            
            
                        </div> <!-- card-body .// -->
                    </article> <!-- card.// -->
            
                    <article class="card  mb-3">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Livraisons en cours </h5>	
                            <table class="table">
                                <thead>
                                  <tr>
                                    <th>Référence</th>
                                    <th>Nom du client</th>
                                    <th>Montant</th>
                                    <th>Date</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                  <tr>
                                    <td>{{$item->reference}}</td>
                                    <td>{{$item->user->name}}</td>
                                    <td>{{$item->soldeAfterPayement()}}</td>
                                    <td>{{$item->created_at->diffForhumans()}}</td>
                                  <td><a href="{{route('admin.paniers.show',$item->reference)}}"><button class="btn btn-success">Détail</button></a></td>

                                  </tr>      
                                  @endforeach
                                  
                                </tbody>
                              </table>
                            
            
                            <div class="row">
                        
                            
                            
                            </div> <!-- row.// -->
            
                            <a href="{{route('pieces.stock')}}" class="btn btn-outline-primary"> Actualiser le stock </a>
                        </div> <!-- card-body .// -->
                    </article> <!-- card.// -->

               
       
@endsection