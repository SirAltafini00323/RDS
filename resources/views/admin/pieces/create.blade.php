@extends("layouts/layoutAdmin")

@section('content')
<article class="card mb-3">
<div class="card-header">
          <h2 class="card-title">Pièces de moto</h2>
        </div>
        <div class="card-body">
        <section >
        
                    <div class="container has-text-left">
                        <div class="column is-12 is-12-desktop">
                          <form method="POST" accept-charset="UTF-8" action="{{ route('pieces.store') }}" enctype="multipart/form-data">
                            @csrf
                            @include('admin.pieces.form')
                            <div class="row mt-3">
                              <div class="col-md-6">
                                <button type="reset" class="form-control btn btn-danger">Annuler</button>
                              </div>
                              <div class="col-md-6">
                                <button class="form-control btn btn-success" type="submit">Enregistrer</button>
                              </div>
                            </div>
                            
                          </form>
                        </div>
                      
                    </div>
                  </section>
   
        </div>
    </article>
@endsection