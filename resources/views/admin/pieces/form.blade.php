<div class="row">
    <div class="col-md-4">
        <select name="categorie_id" id="type" required class="form-control">
            @foreach($types as $type)
            <optgroup label="{{$type->nom}}">
                @foreach($type->categories as $categorie)
                <option value="{{$categorie->id}}" {{ isset($item) && $categorie->id == $item->categorie->id ? 'selected' : ''}} >{{$categorie->nom}}</option>
                @endforeach
            </optgroup>
            @endforeach
        </select>
    </div>
    <div class="field col-md-4">
        <select name="forme_id" id="forme" required class="form-control">
            @foreach($formes as $forme)
            <option value="{{$forme->id}}" {{ isset($item) && $forme->id == $item->forme->id ? 'selected' : '' }}>{{$forme->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <input type="file" name="file" class="form-control  ">
        @error('file')
        <span class="erreur">
            {{ $message }}
        </span>
        @enderror
    </div>

</div><br>



<div class="row">
    <div class="col-md-6">
        <input class="form-control" type="text" name="nom" placeholder="Nom de la pièce"
            value="{{isset($item) ? $item->nom : '' }}">
    </div>
    <div class="col-md-6">
        <input class="form-control" type="date" name="annee" placeholder="Année de création"
            value="{{isset($item) ? $item->annee : '' }}">
    </div>
</div>



<div class="row mt-2">
    <div class="col-md-6">
            <input class="form-control" type="number" name="prix" placeholder="Prix"
                value="{{isset($item) ? $item->prix : '' }}">
    </div>
    <div class="col-md-6">
            <input class="form-control" type="number" name="stock" placeholder="Stock"
                value="{{isset($item) ? $item->stock : '' }}">
    </div>
</div>

<div class="row mt-2">
        <textarea class="form-control" name="description" id="" cols="30"
            rows="5">{{isset($item) ? $item->description : 'Description de la pièce' }}</textarea>
</div>