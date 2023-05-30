@extends('Front.layout.video_page_scripting')
@section('title', 'Video Page')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<div class="container continue_item">
  <div class="cont_inner">
	@if ($message = Session::get('success'))
    <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {{ $message }}
    </div>
     @endif
	<div class="cart_countinue_page">
	<div class="success-box">
         <img src="https://votiveinfo.in/Birthdaycards/public/assets/img/tick.png">
		<p>Do you want to design another card?</p>
		<div class="abtns_y_n">
		<a href="{{ url('birthday-cards') }}" class="cont-yes btn btn-success">Yes</a><br>
		<a href="{{ url('cart') }}" class="cont-no btn btn-danger">No</a>
		</div>
	</div>
	</div>
  </div>	
</div>
@endsection