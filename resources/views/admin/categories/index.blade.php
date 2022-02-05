@extends("layouts/layoutAdmin")

@section('content')
<article class="card">
        <div class="card-header">
          <h4 class="card-title">Model de motos ou de pièces</h4>
        </div>
        <div class="card-body">
        <section >
        
                    <div class="container has-text-left">
                        <div class="column is-12 is-12-desktop">
                          <form method="POST" action="{{ route('categories.store') }}">
                            @csrf
                            <div class="row">
                                <select name="type_id" id="" required class="form-control">
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}">{{ $type->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mt-2">
                                <input class="form-control  mt-2 mt-md-0" type="text" placeholder="Nom" name="nom" required>
                            </div>
       
                            <div class="form-group row mt-4">
                              <div class="col-md-6">
                                <button type="reset" class="form-control btn btn-danger">Annuler</button>
                              </div>
                              <div class="col-md-6 mt-2 mt-md-0">
                                <button class="form-control btn btn-success" type="submit">Enregistrer</button>
                              </div>
                            </div>
                            
                          </form>
                        </div>
                      
                    </div>
                  </section>
   
        </div>
    </article>
    <article class="card  mb-3  mt-3 mt-md-0">
			                <div class="card-body">
			                    <h5 class="card-title mb-4">Achats récents </h5>	
			                    <table class="table">
			                        <thead>
			                          <tr>
                                        <th>Type de moto</th>
			                            <th>Nom du modèle</th>
			                            <th>Action</th>
			                          </tr>
			                        </thead>
			                        <tbody>
                                        @foreach($items as $item)
                                            <tr>
                                                <td>{{ $item->type->nom }}</td>
                                                <td>{{$item->nom}}</td>
                                                <td>
                                                <button class="button is-primary">Modifier</button>
                                                    <form method="POST" action="{{ route('categories.destroy',$item) }}" style="display:inline-block">
                                                       @csrf
                                                        <input name="_method" type="hidden"  value="DELETE">
                                                        <button type="submit" class="btn btn-danger">Supprmer</button>
                                                    </form>
                                                    
                                                </td>
                                                
                                            </tr> 
                                        @endforeach     
			                          
			                          
			                        </tbody>
			                      </table>
			                    
		
			                </div> <!-- card-body .// -->
			            </article> <!-- card.// -->
@endsection