@extends("layouts/layoutAdmin")

@section('content')
<article class="card mb-3">
    <div class="card-header">
        <h2 class="card-title">Pièces de moto</h2>
    </div>
    <div class="card-body">
        <section>

            <div class="container has-text-left">
                <div class="column is-12 is-12-desktop">
                    <form method="POST" accept-charset="UTF-8" action="{{ route('pieces.update',$item->id) }}"
                        enctype="multipart/form-data">
                        <input name="_method" type="hidden" value="PUT">
                        @csrf

                        <div class="row">
                            <div class="col-md-5">
                                <div class="mb-4">
                                    <input type="file" name="image" class="form-control">
                                    @error('file')
                                    <span class="erreur">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div>
                                
                                <img src="{{ asset($item->image) }}" height="250px">
                                </div>

                                
                            </div>
                            <div class="col-md-7">
                                <div class="row form-group">
                                    <label for="" class="col-md-4">Type</label>
                                    <select name="forme_id" id="forme" required class="form-control col-md-8">
                                        @foreach($formes as $forme)
                                        <option value="{{$forme->id}}"
                                            {{ isset($item) && $forme->id == $item->forme->id ? 'selected' : '' }}>
                                            {{$forme->name}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="row form-group">
                                    <label class="col-md-4" for="">Modele</label>
                                    <select name="categorie_id" id="type" required class="form-control col-md-8">
                                        @foreach($types as $type)
                                        <optgroup label="{{$type->nom}}">
                                            @foreach($type->categories as $categorie)
                                            <option value="{{$categorie->id}}"
                                                {{ isset($item) && $categorie->id == $item->categorie->id ? 'selected' : ''}}>
                                                {{$categorie->nom}}</option>
                                            @endforeach
                                        </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row form-group">
                                    <label for="" class="col-md-4">Nom</label>
                                    <input class=" col-md-8 form-control" type="text" name="nom"
                                        placeholder="Nom de la pièce" value="{{isset($item) ? $item->nom : '' }}">
                                </div>
                                <div class="row form-group">
                                    <label class="col-md-4" for="">Prix</label>
                                    <input class="form-control col-md-8" type="number" name="prix" placeholder="Prix"
                                        value="{{isset($item) ? $item->prix : '' }}">

                                </div>
                                <div class="row form-group">
                                    <label class="col-md-4" for="">Date de création</label>
                                    <input class="form-control col-md-8" type="number" name="annee"
                                        placeholder="Année de création" value="{{isset($item) ? $item->annee : '' }}">
                                </div>
                                <div class="row form-group">
                                    <label class="col-md-4" for="">Stock</label>
                                    <input class="form-control col-md-8" type="number" name="stock" placeholder="Stock"
                                        value="{{isset($item) ? $item->stock : '' }}">
                                </div>
                            </div>
                        </div>


                        
                        <div class="row form-group mt-4">
                            <label for="">Description</label>
                            <textarea class="form-control" name="description" id="" cols="30"
                                rows="5">{{isset($item) ? $item->description : 'Description de la pièce' }}</textarea>
                        </div>


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