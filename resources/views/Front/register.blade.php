@extends('Front.layout.layout')
@section('title', 'Home')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')

<section class="registration-page">
  <div class="container reg-page">
    <div class="row background-login">
      <div class="col-md-12 col-lg-12 m-auto">
    <div class="user_registration section-title-signup">
        <h2 class="pt-3 mb-3">Create an Account</h2>
        @if ($message = Session::get('email_error'))
        <div class="alert alert-danger">
        	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  		  {{ $message }}
  	  </div>
  	   @endif
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
        	  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  		  {{ $message }}
  	  </div>
  	   @endif
  	  <form name="registration" method="post" action="{{ url('submitUser') }}">
  	  	@csrf
  	    <div class="form-group">
  	      <label for="email">First Name</label>
  	      <input type="text" class="form-control" id="fname" placeholder="" name="fname">
  	    </div>
  	    <div class="form-group">
  	      <label for="email">Last Name</label>
  	      <input type="text" class="form-control" id="lname" placeholder="" name="lname">
  	    </div>
  	    <div class="form-group">
  	      <label for="email">Email</label>
  	      <input type="email" class="form-control" id="email" placeholder="" name="email">
  	    </div>
  	    <div class="form-group">
  	      <label for="pwd">Password</label>
  	      <input type="password" class="form-control" id="password" placeholder="" name="password">
  	    </div>
  	    
  	    <button type="submit" class="btn btn-default">Submit</button>
  	  </form>
      <div class="note-div">
        <p>Already have an account? <a href="{{ url('/loginUser') }}" data-action="show-popover-panel" aria-controls="header-login-panel" class="auth-link">Login here</a></p>
      </div>
    </div>	
  </div>


  <!-- <div class="col-md-6 site-work">
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
</div> -->
  </div>


  </div>  
</div>
</section>
@endsection

