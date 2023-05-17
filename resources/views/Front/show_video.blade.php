@extends('Front.layout.video_page_scripting')
@section('title', 'Video Page')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<div class="container video_page">
	<div class="video_image_content">
		<div class="video_qr">
			<video width="100%" height="auto" controls>
			  <source src="{{ url('public/upload/videos') }}/{{ $db_card_data->video }}" type="video/mp4">
			  
			  Your browser does not support the video tag.
			</video>
			
		</div>
		
		<div class="video_btns_qr">
			<div class="add_video_btn">
				<form class="replace_btn" id="attachUpload" method="post" action="{{ url('post_video') }}" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="qr_img_val" value="" class="qr_image">
					<input type="hidden" name="card_id" value="{{ $db_card_data->card_id }}">
					<input type="hidden" name="card_size_id" value="{{ $card_size_id }}">
					<input type="file" name="add_video_file" id="replace_video">
					<label class="label-add-video" for="replace_video">Replace Video</label>
					<!-- <input type="submit" name="add_video_btn" value="Replace Video"> -->
				</form>
				<form class="del_video_btn" method="post" action="{{ url('delete_video') }}">
					@csrf
					<input type="hidden" name="card_id" value="{{ $db_card_data->card_id }}">
					<input type="hidden" name="card_size_id" value="{{ $card_size_id }}">
					<input type="submit" name="delete_video_btn" value="Delete Video">
				</form>
			</div>	
		</div>
		<div class="agree_bx">
		  <div class="chk_cond">
			<input id="checkbox" type="checkbox" />
			<label for="checkbox"> I agree to these <a href="#">Terms and Conditions</a>.</label>

		  </div>
		</div>
		<div class="footer-ctn">
			<div class="countinue_btn">
				<a href="#">Continue</a>
			</div>
		</div>
	</div>
</div>	
<script src =  
    "https://code.jquery.com/jquery-3.5.1.js">  
</script>
<script type="text/javascript">
	document.getElementById("replace_video")
	.onchange = function(event) {
	  let file = event.target.files[0];

	  console.log("file","{{ url('public/upload/videos') }}/"+file.name);
	  
	  let finalURL =  
'https://chart.googleapis.com/chart?cht=qr&chl=' +  
        htmlEncode("{{ url('public/upload/videos') }}/"+file.name) +  
        '&chs=160x160&chld=L|0' 
        console.log("finalURL",finalURL);
        $('.qr-code').attr('src', finalURL);  
       $(".qr_image").val(finalURL); 
	   $('#attachUpload').trigger('submit');
	}

	function htmlEncode(value) {  
    return $('<div/>').text(value)  
        .html();  
    }  
    $(".countinue_btn").click(function(){
    	if($("#checkbox").prop('checked') != true){
	    	$(".agree_bx .chk_cond").append("<div style='color:red;'>Please check Terms & Conditions checkbox</div>");
		}else{
			$(".countinue_btn a").attr("href","{{ url('/card_editor') }}/{{ $db_card_data->card_id }}/{{ $card_size_id }}");
		}
    });
    
</script>
@endsection
