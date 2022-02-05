@extends("layouts/layoutAdmin")

@section('content')
<article class="card  mb-3">
    <div class="card-header">
        <h2 class="card-title">Stock disponible</h2>
    </div>
    <div class="card-body">
        <section>
            <table class="table" id="table_id" >
                <thead>
                    <tr>
                        <th>Modèle </th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th >Quantité disponible</th>
                     
                        <th></th>
                        <th></th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>{{$item->categorie->nom}}</td>
                        <td>{{$item->nom}}</td>
                        <td>{{$item->prix}}</td>
                        <td>{{$item->stock}}</td>
                        <td> <a href="{{route('pieces.edit',$item->id)}}" class="btn btn-primary"> Modifier </a></td>
                        <td>
                        <form method="POST" action="{{ route('pieces.destroy',$item) }}"
                            style="display:inline-block">
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-danger">Supprmer</button>
                        </form>
                        </td>


                    </tr>
                    @endforeach


                </tbody>
            </table>


    </div> <!-- card-body .// -->
</article>

<script>
                    window.addEventListener('load', function() {
                        $(document).ready( function () {
                                $('#table_id').DataTable();
                            } );
                    })
                                                      
                        
                    </script>
@endsection