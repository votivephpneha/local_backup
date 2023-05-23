@extends('Front.layout.layout')
@section('title', 'Birthdaycards')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<style type="text/css">
	.order_status_page{
		margin-top: 141px;
	}
</style>
<div class="container order_status_page">
	<div class="order_status_header">
		<h2>Thank You!</h2>
		<p>Your order has been submitted.</p>
	</div>
	<div class="order_details">
		<div class="order_summry">
	<div class="order_invoice">
		<?php
			$order = DB::table('order')->where('order_id',$order_id)->get();
		?>
		<p><b>Order ID</b>:{{ $order[0]->order_id }}</p>
		<p><b>To</b>:{{ $order[0]->fname }} {{ $order[0]->lname }}</p>
		<p>
			<b>Address</b>:{{ $order[0]->address }}
		</p>
		<p>
			<b>Phone No</b>:{{ $order[0]->phone_no }}
		</p>
	</div>
	<h2>Order Details</h2>
	<table style="width:100%;text-align: center">
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

@endsection