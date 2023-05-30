<?php

	$card_data = DB::table('cards')->where('id',$cart_data[0]->card_id)->get();
	$card_sizes = DB::table('card_sizes')->where('id',$cart_data[0]->sizes)->get();
	$card_price = $card_sizes[0]->card_price;
	$cart_qty = $cart_data[0]->qty;
	$cart_total_price = $card_price * $cart_qty;
	
	$card_size_quantity = DB::table('card_sizes')->where('id',$cart_data[0]->sizes)->where('card_id',$cart_data[0]->card_id)->get();
	//print_r($card_size_quantity);
	$size_quantity = $card_size_quantity[0]->card_size_qty;
	$cart_qty = $cart_data[0]->qty;
	$remaining_quantity = $size_quantity - $cart_qty;

?>
<tr>
	<td>
		<span class="delete_icon" onclick="deleteCartItem('{{ $cart_data[0]->cart_id }}')">
			<i class="fa fa-trash"></i>
		</span></td>
		<td class="product-thumbnail"><img src="{{ url('public/upload/cards') }}/{{ $card_data[0]->card_image }}" style="width:100px;"></td>
	<td class="product-title">{{ $card_data[0]->card_title }}</td>
	<td class="qty_td-{{ $cart_data[0]->cart_id }} qty-box">
		
		<button class="min-{{$cart_data[0]->cart_id }} button min-qty" onclick="qtyInc('minus','{{ $cart_data[0]->cart_id }}','{{ $card_price }}','{{ $size_quantity }}')" @if($cart_data[0]->qty < 2) disabled @endif>
		-
		</button>

		<input class="qty-cen" type="text" name="qty-{{ $cart_data[0]->cart_id }}" id="qty-{{ $cart_data[0]->cart_id }}" value="{{ $cart_data[0]->qty }}" readonly />
		<button class="plus-{{ $cart_data[0]->cart_id }} button plus-qty" onclick="qtyInc('plus','{{ $cart_data[0]->cart_id }}','{{ $card_price }}','{{ $size_quantity }}')" @if($remaining_qty < 1) disabled @endif>
		+
		</button>
		<p class="qty_not_available" style="display:none">Card quantity is not available</p>
		
	</td>
	<td>
		{{ $card_sizes[0]->card_type }}
	</td>
	<td>
		<span class="cart_price cart_price-{{ $cart_data[0]->cart_id }}">
		<?php
			
			echo "$".number_format((float)$cart_total_price, 2, '.', '');
		?>
	    </span>
	</td>
</tr>