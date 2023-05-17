@extends('Front.layout.video_page_scripting')
@section('title', 'Video Page')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<div class="container">
	@if ($message = Session::get('success'))
    <div class="alert alert-success">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {{ $message }}
    </div>
     @endif
	<div class="cart_countinue_page">
		<p>Do you want to design another card?</p>
		<a href="{{ url('birthday-cards') }}" class="btn btn-success">Yes</a>
		<a href="{{ url('cart') }}" class="btn btn-danger">No</a>
	</div>
</div>
@endsection