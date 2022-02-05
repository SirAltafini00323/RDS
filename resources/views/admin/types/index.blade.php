@extends("layouts/layoutAdmin")

@section('content')
<article class="card mb-3">
<div class="card-header">
          <h3 class="card-title">Marque de motos</h3>
        </div>
        <div class="card-body">
        <section >
        
                    <div class="container has-text-left">
                        <div class="column is-12 is-12-desktop">
                          <form form method="POST" action="{{ route('types.store') }}">
                            @csrf
                            <div class="field">
                              <div class="control">
                                <input class="form-control form-lg" type="text" placeholder="Nom" name="nom" required>
                              </div>
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
    <article class="card  mb-3">
			                <div class="card-body">
			                    <h5 class="card-title mb-4">Liste des types de moto</h5>	
			                    <table class="table">
			                        <thead>
			                          <tr>
			                            <th>Nom </th>
			                            <th>Action</th>
			                          </tr>
			                        </thead>
			                        <tbody>
                                    @foreach($items as $item)
			                          <tr>
			                            <td>{{$item->nom}}</td>
			                            <td>
                                        <button class="button is-primary">Modifier</button>
                                        <form method="POST" action="{{ route('types.destroy',$item) }}" style="display:inline-block">
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