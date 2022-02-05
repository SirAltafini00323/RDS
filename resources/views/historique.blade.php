@extends("layouts/layout")

@section('content')
<section id="content">
			<div class="content-wrap">
				<div class="container">
                    
					<table class="table cart mb-5">
						<thead>
							<tr>
								
							
								<th class="cart-product-name">Code de référence</th>
								<th class="cart-product-quantity">Quantité de produits</th>
								<th class="cart-product-subtotal">Montant total</th>
							</tr>
						</thead>
						<tbody>
                        @foreach($items as $item)
							<tr class="cart_item">

								<td class="cart-product-name">
									<a href="#">{{$item->reference}}</a>
								</td>


								<td class="cart-product-quantity">
									<div class="quantity">
										{{$item->quantitePieces()}}
									</div>
								</td>

								<td class="cart-product-subtotal">
									<span class="amount">{{$item->soldeAfterPayement()}}</span>
								</td>
							</tr>
                        @endforeach
														
						</tbody>

					</table>

					
				</div>
			</div>
		</section><!-- #content end -->

@endsection