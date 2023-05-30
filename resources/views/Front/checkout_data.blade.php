<?php
	$card_data = DB::table('cards')->where(['id' => $cart_data[0]->card_id])->get();
?>
<tr class="orderlist_tbl">
	<td class="imgqty_info">
		<img src="{{ url('public/upload/cards') }}/{{ $card_data[0]->card_image }}" style="width:100px;">
		<div class="item_qty">{{ $cart_data[0]->qty }}</div>
	</td>
	<td>
		<h5>{{ $card_data[0]->card_title }}</h5>
		<span class="total_card_price-{{ $cart_data[0]->cart_id }}">
			<?php
	            $price = $cart_data[0]->price;  
	            
	            echo "$".number_format((float)$price, 2, '.', '');
	        ?>
		</span>
		
	</td>
</tr>