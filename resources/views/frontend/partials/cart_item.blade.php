@if(session('shopping_cart'))
	@foreach(session('shopping_cart') as $cartKey => $row)
	@php
		$pro_price = $row['price'];
		$pro_qty = $row['qty'];
		$total_Price = $row['price']*$row['qty'];

		if($gtext['currency_position'] == 'left'){
			$price = $gtext['currency_icon'].NumberFormat($pro_price);
			$totalPrice = $gtext['currency_icon'].NumberFormat($total_Price);
		}else{
			$price = NumberFormat($pro_price).$gtext['currency_icon'];
			$totalPrice = NumberFormat($total_Price).$gtext['currency_icon'];
		}
	@endphp
	<li id="row_delete_{{ $cartKey }}">
		<div class="cart-img">
			<a href="{{ route('frontend.product', [$row['id'], \Illuminate\Support\Str::slug($row['name'])]) }}">
				<img src="{{ asset('public/media/'.($row['thumbnail'] ?? 'default.png')) }}" alt="{{ $row['name'] }}" style="max-width: 50px; height: auto;">
			</a>
		</div>
		<div class="cart-info">
			<h6 class="mb-1"><a href="{{ route('frontend.product', [$row['id'], \Illuminate\Support\Str::slug($row['name'])]) }}">{{ \Illuminate\Support\Str::limit($row['name'], 20) }}</a></h6>
			@if(isset($row['variation_details']) && $row['variation_details'])
				<p class="mb-0"><small>({{ $row['variation_details'] }})</small></p>
			@endif
			@if(isset($row['unit']) && $row['unit'] != '')
				<p class="mb-0"><small>{{ $row['unit'] }}</small></p>
			@endif
			<p class="price">{{ $price }} x {{ $pro_qty }}</p>
		</div>
		<div class="del-icon">
			<a data-id="{{ $cartKey }}" id="removetocart_{{ $cartKey }}" onclick="onRemoveToCart('{{ $cartKey }}')" href="javascript:void(0);"><i class="bi bi-x-lg"></i></a>
		</div>
	</li>
	@endforeach
@endif
