@extends('Front.layout.layout')
@section('title', 'Birthdaycards')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<style type="text/css">
	.checkout_page{
		margin-top: 50px;
	}
</style>
<div class="checkout_titlebar">
<div class="container checkout_header">
		<h2>Checkout</h2>
	</div>
	<?php
		$user = Auth::user();
		
	?>
</div>
<div class="container checkout_page">
	
	<form method="post" name="checkout_form" action="{{ url('post_checkout') }}">
		@csrf
		<div class="row">
			
				<div class="bill_details_form col-md-7">
					<h3>Billing Details</h3>
					
						<div class="row bill-info">
							<div class="col-md-6">
								<div class="form-group">
						  	      <label for="first_name">First Name</label>
						  	      <input type="hidden" name="cart_id_array" class="cart_id_array" value="">
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
						  	      <label for="city">Country / Region</label>
						  	     <!--  <input type="text" class="form-control" id="country" placeholder="" name="country"> -->
						  	      <select class="form-control" id="country" placeholder="" name="country" onchange="changeCountry()">
						  	      	<option value="">Select Countries</option>
						  	      	@foreach($countries as $country)
						  	      		<option value="{{ $country->id }}">{{ $country->name }}</option>
						  	      	@endforeach
						  	      </select>
						  	    </div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
						  	      <label for="state">State</label>
						  	      <!-- <input type="text" class="form-control" id="state" placeholder="" name="state"> -->
						  	      <select class="form-control" id="state" placeholder="" name="state" onchange="changeState()">
						  	      	<option value="">Select State</option>
						  	      	
						  	      </select>
						  	    </div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
						  	      <label for="city">Town / City</label>
						  	      <select class="form-control" id="city" placeholder="" name="city">
						  	      	<option value="">Select Cities</option>
						  	      	
						  	      </select>
						  	      <!-- <input type="text" class="form-control" id="city" placeholder="" name="city"> -->
						  	    </div>
							</div>
							
							<div class="col-md-12">
								<div class="form-group">
						  	      <label for="address">Street address </label>
						  	      <input type="text" class="form-control" id="address" placeholder="" name="address" value="{{ $user->address }}" autocomplete="off">
						  	    </div>
							</div>
							
							
							
							
							
							<div class="col-md-12">
								<div class="form-group">
						  	      <label for="post_code">Postcode / ZIP</label>
						  	      <input type="text" class="form-control" id="post_code" placeholder="" name="post_code">
						  	    </div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
						  	      <label for="phone_no">Phone</label>
						  	      <input type="text" class="form-control" id="phone_no" placeholder="" name="phone_no" value="{{ $user->phone }}">
						  	    </div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
						  	      <label for="email_address">Email Address</label>
						  	      <input type="text" class="form-control" id="email_address" placeholder="" name="email_address" value="{{ $user->email }}">
						  	    </div>
							</div>
						</div>
							
						<div class="row addi-info">
							<div class="col-md-12 additional-fields">
							<div class="additional-title">
								<h3>Additional information</h3>
							</div>
								<div class="form-group">
						  	      <label for="order_notes">Order Notes (Optional)</label>
						  	      
						  	      <textarea class="form-control" id="order_notes" placeholder="Notes about your order, e.g. special notes for delivery." name="order_notes" rows="2" cols="5" name="order_notes"></textarea>
						  	    </div>
							</div>
						</div>
					
				</div>
				<div class="amt_details_form col-md-5">
					<div class="order_div">
						<h3>Your Order</h3>
						<div class="total_cost_div">
							
							<div class="checkout_items">
								<table style="width:100%" class="checkout_table_data">
									<!-- @foreach($cart_data as $c_data)
									<?php
										$card_data = DB::table('cards')->where(['id' => $c_data->card_id])->get();
									?>
									<tr class="orderlist_tbl">
										<td class="imgqty_info">
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
								
									@endforeach -->
									<tr class="order_amt">
										<th>Total Cost</th>
										<td class="total_cost_order">
											<input type="hidden" name="order_total_price" class="order_total_price" value="">
											<span class="pay_now_price">
												
											</span>
										</td>
									</tr>
								</table>
							</div>
							
							<div class="total-submit">
							<button type="submit" name="btn" class="place-order-btn">Pay Now</button>
							</div>
							
						</div>
					</div>

				</div>
			
		</div>
	</form>
</div>	
@endsection