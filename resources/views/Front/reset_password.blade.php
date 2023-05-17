@extends('Front.layout.layout')
@section('title', 'Home')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')
<div class="container">
	<div class="row background-login">
		<div class="col-md-6">
  <div class="user_registration section-title-signup">
      <h2>Reset Password</h2>
      @if ($message = Session::get('error'))
        <div class="alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ $message }}
        </div>
      @endif
      @if ($message = Session::get('password_success'))
        <div class="alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ $message }}
        </div>
      @endif
	  <form name="resetPassword" method="post" action="{{ url('postreset_password') }}">
	  	@csrf
	    <div class="form-group">
        <label for="Email">Email</label>
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="email" class="form-control" id="email" placeholder="Enter Your Email" name="email">
      </div>
	    <div class="form-group">
        <label for="new_password">New Password</label>
        <input type="password" class="form-control" id="new_password" placeholder="Enter New Password" name="new_password">
      </div>
      <div class="form-group">
        <label for="confirm_password">Confirm Password</label>
        <input type="password" class="form-control" id="confirm_password" placeholder="Enter Confirm Password" name="confirm_password">
      </div>
      
      <button type="submit" class="btn btn-default">Submit</button>
	  </form>
    
  </div>	
</div>  

<div class="col-md-6 site-work">
  <div class="handyreman">
    <div class="res-box">
    <div class="res-icon">
     <img src="{{ url('public/assets/img/tick.png') }}">
    </div>
    <div class="res-text">
    <h4> Free Delivery Within UK</h4>
    <p>No minimum order required, order only what you need when you need it and never worry about shipping! </p>
    </div>
    </div>

      <div class="res-box">
    <div class="res-icon">
     <img src="{{ url('public/assets/img/tick.png') }}">
    </div>
    <div class="res-text">
    <h4>Satisfied or Refunded</h4>
    <p>If you not happy with your order, rest assure we will cover returns shipment! </p>
    </div>
    </div>

      <div class="res-box">
    <div class="res-icon">
     <img src="{{ url('public/assets/img/tick.png') }}">
    </div>
    <div class="res-text">
    <h4> Top-notch Support</h4>
    <p>Call Us, Email Us, Or Text Us We are here for you!</p>
    </div>
    </div>
      <div class="res-box">
    <div class="res-icon">
     <img src="{{ url('public/assets/img/tick.png') }}">
    </div>
    <div class="res-text">
    <h4>Secure Payments</h4>
    <p>Shopping on our store is secure and easy, with military grade payment gateway!</p>
    </div>
    </div>
    </div>
</div>
</div>
</div>
@endsection

