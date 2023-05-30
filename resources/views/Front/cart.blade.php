@extends('Front.layout.layout')
@section('title', 'Birthdaycards')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<style>
	.cart_page{
		margin-top:50px;
	}
</style>
<div class="cart_titlebar">
<div class="container cart_header">
		<h2>Cart</h2>
	</div>
</div>
<div class="container cart_page">
	<div class="cart_content">
		    @if ($message = Session::get('message'))
		      <div class="alert alert-success">
		          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		      {{ $message }}
		    </div>
		     @endif
		     
		     
			<table class="table cart_infos">
				<thead>
					<tr>
						<th></th>
						<th>Image</th>
						<th>Title</th>
						<th>Quantity</th>
						<th>Card Type</th>
						<th>Price</th>
						
					</tr>
				</thead>
				<tbody class="cart_data">
					
					<!-- @foreach($cart_data as $cart_item)
						<?php

							$card_data = DB::table('cards')->where('id',$cart_item->card_id)->get();
							$card_sizes = DB::table('card_sizes')->where('id',$cart_item->sizes)->get();
							$card_price = $card_sizes[0]->card_price;
							$cart_qty = $cart_item->qty;
							$cart_total_price = $card_price * $cart_qty;
							
							$card_size_quantity = DB::table('card_sizes')->where('id',$cart_item->sizes)->where('card_id',$cart_item->card_id)->get();
							//print_r($card_size_quantity);
							$size_quantity = $card_size_quantity[0]->card_size_qty;
							$cart_qty = $cart_item->qty;
							$remaining_quantity = $size_quantity - $cart_qty;

						?>
						<tr>
							<td>
								<span class="delete_icon" onclick="deleteCartItem('{{ $cart_item->cart_id }}')">
									<i class="fa fa-trash"></i>
								</span></td>
								<td class="product-thumbnail"><img src="{{ url('public/upload/cards') }}/{{ $card_data[0]->card_image }}" style="width:100px;"></td>
							<td class="product-title">{{ $card_data[0]->card_title }}</td>
							<td class="qty_td-{{ $cart_item->cart_id }} qty-box">
								
								<button class="min-{{ $cart_item->cart_id }} button min-qty" onclick="qtyInc('minus','{{ $cart_item->cart_id }}','{{ $card_price }}','{{ $size_quantity }}')" @if($cart_item->qty < 2) disabled @endif>
								-
								</button>

								<input class="qty-cen" type="text" name="qty-{{ $cart_item->cart_id }}" id="qty-{{ $cart_item->cart_id }}" value="{{ $cart_item->qty }}" readonly />
								<button class="plus-{{ $cart_item->cart_id }} button plus-qty" onclick="qtyInc('plus','{{ $cart_item->cart_id }}','{{ $card_price }}','{{ $size_quantity }}')">
								+
								</button>

								<?php
									if($remaining_quantity < 1){
										echo "<p>Card quantity is not available</p>";		
									}
								?>
							</td>
							<td>
								{{ $card_sizes[0]->card_type }}
							</td>
							<td>
								<span class="cart_price cart_price-{{ $cart_item->cart_id }}">
								<?php
									
									echo "$".number_format((float)$cart_total_price, 2, '.', '');
								?>
							    </span>
							</td>
						</tr>
					@endforeach -->
					
					<tr>
						<td colspan="5">Total</td>
						<td class="total_price">
							
						</td>
					</tr>
				</tbody>
			</table>
			
				<div class="empty-cart" style="display: none">
					<span>No item available.</span>
					<span><a href="{{ url('birthday-cards') }}">Continue Shopping</a></span>
				</div>
				

			
			
			<div class="checkout_btn" style="text-align: right">
				<a href="{{ url('checkout') }}">Checkout</a>
			</div>
			
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript">
	var cart_id_array = localStorage.getItem("cart_id_array");
	var arry_json = JSON.parse(cart_id_array);
		
	if(!cart_id_array || arry_json.length<1){
		$(".checkout_btn").hide();
		$(".cart_infos").hide();
		$(".empty-cart").show();
	}

	var sum = 0;
	$.each(arry_json,function(i,val){
	    

		$.ajax({
		  type: "GET",
		  url: "{{ url('cart_data') }}",
		  data: {cart_id:val},
		  cache: false,
		  success: function(data){
		  	//console.log("data",data);
		  	if(data){
		  		$(".cart_data").prepend(data);
			  	var card_price = $.trim($(".cart_price-"+val).html()).replace("$","");
			  	
			  	sum = parseInt(sum) + parseInt(card_price);

			  	console.log("cart_price2",sum);

			  	$(".total_price").html("$"+sum.toFixed(2));
			  }else{
			  	$(".empty-cart").show();
			  	$(".cart_infos").hide();
			  }
		  	
		  }
		});
		
	});

	function deleteCartItem(cart_id){
		
		$.ajax({
		  type: "GET",
		  url: "{{ url('delete_cart_item') }}",
		  data: {cart_id:cart_id},
		  cache: false,
		  success: function(data){
		  	//alert(data);
		  	window.location.href = "{{ url('cart') }}"; 
		  }
		});

		var cart_id_array = localStorage.getItem("cart_id_array");
  		var arry_json = JSON.parse(cart_id_array);
  		
  		arry_json.pop(cart_id);
  		console.log("arry_json",arry_json);

  		var new_json = JSON.stringify(arry_json);
  		localStorage.setItem("cart_id_array",new_json);
	}
	
  
	

</script>
@endsection