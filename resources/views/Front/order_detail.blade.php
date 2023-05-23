@extends('Front.layout.layout')
@section('title', 'Home')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<div class="container">
	<div class="row user_profile_div">
		<div class="col-md-3">
	      @include('Front.user_header')
	    </div>
	    <div class="col-md-9">
	    	<div class="user-profile-tab">
		    	<h2>Order Details</h2>
		    	<div class="order-details-div">
					<table style="width:100%;" class="table table-bordered">
						<thead>
							<tr>
								<th>#</th>
								<th>Card Title</th>
								<th>Card Type</th>
								<th>Quantity</th>
								<th>Unit Price</th>
								<th>Amount</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$order = DB::table('order')->where('order_id',$order_id)->get();
								$order_details = DB::table('order_details')->where('order_id',$order_id)->get();
								
								$i = 0;
							?>
							@foreach($order_details as $o_det)
							    <?php
							    	$i++;
							    	$card_size_detail = DB::table('card_sizes')->where('id',$o_det->card_size_id)->get();	
							    	$card_detail = DB::table('cards')->where('id',$o_det->card_id)->get();	
							    ?>
								<tr>
									<td>{{ $i }}</td>
									<td>{{ $card_detail[0]->card_title }}</td>
									<td>{{ $card_size_detail[0]->card_type }}<br>{{ $card_size_detail[0]->card_size }}</td>	
										
									<td>{{ $o_det->qty }}</td>	
									<td>
										<?php
											$card_price = $card_size_detail[0]->card_price;	
											echo "$".number_format((float)$card_price, 2, '.', '');
										?>
										
									</td>	
									<td>
										<?php
											$card_total_price = $o_det->card_price;	
											echo "$".number_format((float)$card_total_price, 2, '.', '');
										?>
									</td>	
									
								</tr>
							@endforeach
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td><b>Total</b></td>
								<td>
									<b>
									<?php
										$order_total = $order[0]->total;	
										echo "$".number_format((float)$order_total, 2, '.', '');
									?>
									</b>
								</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td><b>Sub Total</b></td>
								<td>
									<b>
									<?php
										$order_sub_total = $order[0]->sub_total;	
										echo "$".number_format((float)$order_sub_total, 2, '.', '');
									?>
									</b>
								</td>
							</tr>
						</tbody>
						
					</table>
				</div>
			</div>
	    </div>
	</div>
</div>
@endsection