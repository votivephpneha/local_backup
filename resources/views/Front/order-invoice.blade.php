@extends('Front.layout.video_page_scripting')
@section('title', 'Video Page')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<div class="order_summry" style="border: 1px solid #e7e7e7; padding: 25px; border-radius: 7px;">
	<div class="order_invoice_mail">
		<?php
			$order = DB::table('order')->where('order_id',$order_id)->get();
		?>
		<p><b>Hello <span style="color: #ff0091;">{{ $order[0]->fname }} {{ $order[0]->lname }}</span></b></p>
		<div class="info-invoice" style="display: flex;background: rgb(248, 248, 249);padding: 25px;border-radius: 12px;">
		<p style="display: grid;font-size: 12px;margin-right: 2em;text-transform: uppercase;line-height: 1.4;border-right: 1px dashed #d3ced2;    padding-right: 2em;margin-left: 0;padding-left: 0;margin-bottom: 0px;margin-top: 0px;">Order ID: <b>{{ $order[0]->order_id }}</b></p>
		<p style="display: grid;font-size: 12px;margin-right: 2em;text-transform: uppercase;line-height: 1.4;border-right: 1px dashed #d3ced2;    padding-right: 2em;margin-left: 0;padding-left: 0;margin-bottom: 0px;margin-top: 0px;">To: <b>{{ $order[0]->fname }} {{ $order[0]->lname }}</b></p>
		<p style="display: grid;font-size: 12px;margin-right: 2em;text-transform: uppercase;line-height: 1.4;border-right: 1px dashed #d3ced2;    padding-right: 2em;margin-left: 0;padding-left: 0;margin-bottom: 0px;margin-top: 0px;">Address: <b>{{ $order[0]->address }}</b></p>
		<p style="display: grid;font-size: 12px;margin-right: 2em;text-transform: uppercase;line-height: 1.4;padding-right: 2em;margin-left: 0;padding-left: 0;margin-bottom: 0px;margin-top: 0px;">Phone No: <b>{{ $order[0]->phone_no }}</b></p >
		</div>	
	</div>
	<h2 style="font-size: 18px;color: #ff0091;margin-bottom: 5px;">Order Details</h2>
	<table style="width:100%;">
		<thead>
			<tr>
				<th style="padding: 15px 20px;font-size: 12px;color: #313131;font-weight: 600;border: 0px !important;background: rgb(248, 248, 249);line-height: 1.5em;border-radius: 20px 0 0 20px;">#</th>
				<th style="padding: 15px 20px;font-size: 12px;color: #313131;font-weight: 600;border: 0px !important;background: rgb(248, 248, 249);line-height: 1.5em;">Card Title</th>
				<th style="padding: 15px 20px;font-size: 12px;color: #313131;font-weight: 600;border: 0px !important;background: rgb(248, 248, 249);line-height: 1.5em;">Card Type</th>
				<th style="padding: 15px 20px;font-size: 12px;color: #313131;font-weight: 600;border: 0px !important;background: rgb(248, 248, 249);line-height: 1.5em;">Quantity</th>
				<th style="padding: 15px 20px;font-size: 12px;color: #313131;font-weight: 600;border: 0px !important;background: rgb(248, 248, 249);line-height: 1.5em;">Unit Price</th>
				<th style="padding: 15px 20px;font-size: 12px;color: #313131;font-weight: 600;border: 0px !important;background: rgb(248, 248, 249);line-height: 1.5em;border-radius: 0px 20px 20px 0px;">Amount</th>
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
					<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;">{{ $i }}</td>
					<td style="color: #ff0091;padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;">{{ $card_detail[0]->card_title }}</td>
					<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;">{{ $card_size_detail[0]->card_type }}<br>{{ $card_size_detail[0]->card_size }}</td>	
						
					<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;">{{ $o_det->qty }}</td>	
					<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;">
						<?php
							$card_price = $card_size_detail[0]->card_price;	
							echo "$".number_format((float)$card_price, 2, '.', '');
						?>
						
					</td>	
					<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;">
						<?php
							$card_total_price = $o_det->card_price;	
							echo "$".number_format((float)$card_total_price, 2, '.', '');
						?>
					</td>	
					
				</tr>
			@endforeach
			<tr>
				<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;"></td>
				<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;"></td>
				<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;"></td>
				<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;"></td>
				<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;"><b>Total</b></td>
				<td style="padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; border-bottom: 1px solid #ececec !important; vertical-align: middle;text-align: center !important;">
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
				<td style="padding-top: 15px;color: #ff0091;padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; vertical-align: middle;text-align: center !important;"><b>Sub Total</b></td>
				<td style="padding-top: 15px;color: #ff0091;padding: 10px 20px; font-size: 16px; border: 0px !important; text-align: left !important; background: transparent !important; vertical-align: middle;text-align: center !important;">
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
@endsection
