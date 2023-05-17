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

					
						
					
					<!-- <tr>
						<td colspan="4">Total</td>
						<td class="total_price">
							
						</td>
					</tr> -->
				</tbody>
			</table>
			
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript">
	var cart_id_array = localStorage.getItem("cart_id_array");
	var arry_json = JSON.parse(cart_id_array);

	
	
    if(cart_id_array){
		$.each(arry_json,function(i,val){
			
			
			console.log("val",val);
			

			$.ajax({
			  type: "GET",
			  url: "{{ url('cart_table') }}",
			  data: {cart_id:val},
			  cache: false,
			  success: function(data){
			  	
			  	//var data1 = JSON.stringify(data);
			  	console.log("data",data);
			  	 $html = "<tr><td><img style='width:100px' src='{{ url('public/upload/cards')}}/"+data.card_data[0].card_image +"'></td><td>"+data.card_data[0].card_title+"</td><td></td><td>"+data.card_size_data[0].card_type+"</td><td>$"+data.card_size_data[0].card_price.toFixed(2)+"</td></tr>";

			  	 
			    $(".cart_data").append($html);
			  }
			});
			
		});
		
    }else{
    	$(".cart_content table").remove();
    }
	

</script>
@endsection