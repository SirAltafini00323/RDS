@extends("layouts/layout")

@section('content')

<script src="https://cdn.kkiapay.me/k.js"></script>
<script>


    openKkiapayWidget({
    amount:"{{$montant}}",
    position:"center",
    callback:"",
    data:"",
    theme:"green",
    key:"f19a95f097ef11ebb611b7e676b55ada",
    sandbox : true})
    addSuccessListener( response => {
        document.location.href="payementEffectue/"+response.transactionId+"/{{$panier->id}}"
    });
    addErrorListener( response => {
        console.log(response);
    });

</script>

@endsection