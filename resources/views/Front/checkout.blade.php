@extends('Front.layout.layout')
@section('title', 'Birthdaycards')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<style type="text/css">
	.checkout_page{
		margin-top: 141px;
	}
</style>
<div class="container checkout_page">
	<div class="checkout_header">
		<h2>Checkout</h2>
	</div>
	<?php
		$user = Auth::user();
		$total_price = 0;
		foreach ($cart_data as $c_data) {
			
			$total_price = $total_price + $c_data->price;
		}
		

	?>
	<form method="post" name="checkout_form" action="{{ url('post_checkout') }}">
		@csrf
		<div class="row">
			
				<div class="billing_details_form col-md-8">
					<h3>Billing Details</h3>
					
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="first_name">First Name</label>
						  	      <input type="text" class="form-control" id="fname" placeholder="" name="fname" value="{{ $user->fname }}">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="last_name">Last Name</label>
						  	      <input type="text" class="form-control" id="lname" placeholder="" name="lname" value="{{ $user->lname }}">
						  	    </div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
						  	      <label for="address">Address</label>
						  	      <input type="text" class="form-control" id="address" placeholder="" name="address" value="{{ $user->address }}">
						  	    </div>
							</div>
							
							<div class="col-md-4">
								<div class="form-group">
						  	      <label for="city">Country</label>
						  	      <input type="text" class="form-control" id="country" placeholder="" name="country">
						  	    </div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
						  	      <label for="state">State</label>
						  	      <input type="text" class="form-control" id="state" placeholder="" name="state">
						  	    </div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
						  	      <label for="city">City</label>
						  	      <input type="text" class="form-control" id="city" placeholder="" name="city">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="post_code">Post Code</label>
						  	      <input type="text" class="form-control" id="post_code" placeholder="" name="post_code">
						  	    </div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="phone_no">Phone No</label>
						  	      <input type="text" class="form-control" id="phone_no" placeholder="" name="phone_no" value="{{ $user->phone }}">
						  	    </div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
						  	      <label for="email_address">Email Address</label>
						  	      <input type="text" class="form-control" id="email_address" placeholder="" name="email_address" value="{{ $user->email }}">
						  	    </div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
						  	      <label for="order_notes">Order Notes</label>
						  	      
						  	      <textarea class="form-control" id="order_notes" placeholder="" name="order_notes"></textarea>
						  	    </div>
							</div>
						</div>
					
				</div>
				<div class="billing_details_form col-md-4">
					<div class="order_div">
						<h3>Your Order</h3>
						<div class="total_cost_div">
							<?php
								$user_id = Auth::user()->id;
								$cart_data = DB::table('cart_table')->where(['user_id' => $user_id])->get();
							?>
							<div class="checkout_items">
								<table style="width:100%">
									@foreach($cart_data as $c_data)
									<?php
										$card_data = DB::table('cards')->where(['id' => $c_data->card_id])->get();
									?>
									<tr>
										<td>
											<img src="{{ url('public/upload/cards') }}/{{ $card_data[0]->card_image }}" style="width:100px;">
											<div class="item_qty">{{ $c_data->qty }}</div>
										</td>
										<td>
											<h5>{{ $card_data[0]->card_title }}</h5>
											<?php
						                        $price = $c_data->price;  
						                        echo "$".number_format((float)$price, 2, '.', '');
						                    ?>
											
										</td>
									</tr>
									@endforeach
									<tr>
										<th>Total Cost</th>
										<td class="total_cost_order">
											<input type="hidden" name="order_total_price" value="{{ $total_price }}">
											<?php
												echo "$".number_format((float)$total_price, 2, '.', '');
											?>
										</td>
									</tr>
								</table>
							</div>
							
							<button type="submit" name="btn" class="place-order-btn">Pay Now</button>
							
						</div>
					</div>

				</div>
			
		</div>
	</form>
</div>	
@endsection