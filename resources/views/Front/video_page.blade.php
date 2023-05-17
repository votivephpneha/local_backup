@extends('Front.layout.video_page_scripting')
@section('title', 'Video Page')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')

<div class="container video_page">
	
	<div class="video_image_content">
		<div class="video_qr_image">
			<img src="{{ url('public/upload/cards') }}/{{ $db_card_data->card_image }}" style="width:200px;">
			<img alt="" src="https://static.web-personalise.prod.moonpig.net/_next/static/images/P2-47a781fcb5be06de21053471503c5bbd.jpg"style="width:200px;">
			<img src="https://static.web-personalise.prod.moonpig.net/_next/static/images/P3Default-1a23a70b0f9cca20268230eb2f6d18a9.jpg" style="width:200px;">
			
		</div>
		<div class="video_content">
			<h1>Surprise Them With a Free Video Message!</h1>
			<!--<ol type="1">
				<li>You <span class="sc-hMqMXs elyeFD">upload </span>a video</li>
				<li>We print a <span class="sc-hMqMXs elyeFD">QR code inside </span>the card</li>
				<li>They <span class="sc-hMqMXs elyeFD">scan it </span>to play the video message</li>
			</ol>-->
			
			<div class="process-wrap active-step1">
  <div class="process-main">
    <div class="col-3 ">
      <div class="process-step-cont">
        <div class="process-step step-1"></div>
        <span class="process-label">You <span class="sc-hMqMXs elyeFD">upload </span>a video</span>
      </div>
    </div>
    <div class="col-3 ">
      <div class="process-step-cont">
        <div class="process-step step-2"></div>
        <span class="process-label">We print a <span class="sc-hMqMXs elyeFD">QR code inside </span>the card</span>
      </div>
    </div>
    <div class="col-3">
      <div class="process-step-cont">
        <div class="process-step step-3"></div>
        <span class="process-label">They <span class="sc-hMqMXs elyeFD">scan it </span>to play the video message</span>
      </div>
    </div>
  </div>
</div>
			
			<p color="textOne" class="sc-hMqMXs eGmMiT">It's <span class="sc-hMqMXs elyeFD">FREE </span>(our gift to you).</p>
			
			<div class="video_btns">
			<div class="add_video_btn">
				@if ($message = Session::get('error'))
		        <div class="alert alert-danger">
		          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		          {{ $message }}
		        </div>
		         @endif
				<form id="attachUpload" method="post" action="{{ url('post_video') }}" enctype="multipart/form-data">
					@csrf
					<input type="hidden" name="qr_img_val" value="" class="qr_image">
					<input type="hidden" name="card_id" value="{{ $db_card_data->id }}">
					<input type="hidden" name="card_size_id" value="{{ $c_size_id }}">
					<input type="file" name="add_video_file" id='videoUpload'>
					<label class="label-add-video" for="videoUpload">Add Video</label>
					<!--<input type="submit" name="add_video_btn" value="Add Video">-->
				</form>
			</div>
			<div class="no_thanks_btn">
				<a href="{{ url('/card_editor') }}/{{ $db_card_data->id }}/{{ $c_size_id }}">No Thanks</a>
			</div>
		</div>
			
		</div>
		
	</div>
</div>	
<script src =  
    "https://code.jquery.com/jquery-3.5.1.js">  
</script>
<script type="text/javascript">
	document.getElementById("videoUpload")
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
</script>
@endsection