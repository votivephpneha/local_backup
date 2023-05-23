@extends('Front.layout.layout')
@section('title', 'Birthdaycards')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<style>
	.cart_page{
		margin-top:134px;
	}
</style>
<div class="container cart_page">
	<div class="cart_header">
		<h2>Cart</h2>
	</div>
	<div class="cart_content">
		    @if ($message = Session::get('message'))
		      <div class="alert alert-success">
		          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		      {{ $message }}
		    </div>
		     @endif
		     
		     @if(count($cart_data) > 0)
			<table class="table table-bordered">
				<thead>
					<tr>
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
								</span>
								<img src="{{ url('public/upload/cards') }}/{{ $card_data[0]->card_image }}" style="width:100px;"></td>
							<td>{{ $card_data[0]->card_title }}</td>
							<td class="qty_td-{{ $cart_item->cart_id }}">
								
								<button class="min-{{ $cart_item->cart_id }} button" onclick="qtyInc('minus','{{ $cart_item->cart_id }}','{{ $card_price }}','{{ $size_quantity }}')" @if($cart_item->qty < 2) disabled @endif>
								-
								</button>

								<input type="text" name="qty-{{ $cart_item->cart_id }}" id="qty-{{ $cart_item->cart_id }}" value="{{ $cart_item->qty }}" readonly />
								<button class="plus-{{ $cart_item->cart_id }} button" onclick="qtyInc('plus','{{ $cart_item->cart_id }}','{{ $card_price }}','{{ $size_quantity }}')">
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
						<td colspan="4">Total</td>
						<td class="total_price">
							
						</td>
					</tr>
				</tbody>
			</table>
			@else
				<div>
					<span>No item available.<a href="{{ url('birthday-cards') }}">Continue Shopping</a></span>
				</div>
			@endif
			<?php
				$user = Auth::user();
				$cart_count = DB::table('cart_table')->where('user_id',$user->id)->where('status',1)->get();
				
			?>
			@if(count($cart_count) > 0)
			<div class="checkout_btn" style="text-align: right">
				<a href="{{ url('checkout') }}">Checkout</a>
			</div>
			@endif
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript">
	var cart_id_array = localStorage.getItem("cart_id_array");
	var arry_json = JSON.parse(cart_id_array);

	
	$.each(arry_json,function(i,val){
	    console.log("val",val);

		$.ajax({
		  type: "GET",
		  url: "{{ url('cart_data') }}",
		  data: {cart_id:val},
		  cache: false,
		  success: function(data){
		  	$(".cart_data").prepend(data);
		  	
		  }
		});
		
	});
	var sum = 0;
 $(".cart_price").each(function(i,val){
   console.log("cart_price1",val);
    // var card_price = $.trim($(this).html()).replace("$","");
    // sum = parseInt(sum) + parseInt(card_price);
    // console.log("cart_price",$.trim($(this).html()).replace("$",""));

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
	}
	
  
	

</script>
@endsection