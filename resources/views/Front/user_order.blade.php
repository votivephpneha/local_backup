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
        <h2>My Orders</h2>
        <div class="order-details-div">
          <p>No orders yet</p>
          <a href="#">Make your first order</a>
        </div>
      </div>
    </div>
  </div>
  
</div>  
@endsection
