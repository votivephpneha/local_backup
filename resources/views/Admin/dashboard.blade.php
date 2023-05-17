@extends('Admin.layout.layout')







@section('title', 'Admin|Dashboard')







@section('current_page_css')



@endsection







@section('current_page_js')



@endsection











@section('content')

<div class="right_col" role="main">

  <div class="">

    <div class="row top_tiles">
      <a href="{{route('userlist')}}">

      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">

        <div class="tile-stats">

          <div class="icon"><i class="fa fa-user"></i></div>

          <div class="count">{{ !empty($totaluser) ? $totaluser : 0  }}</div>

          <h3>Total Users</h3>

        </div>
       </a>

      </div>

      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a href="{{route('cardlist')}}">

        <div class="tile-stats">

          <div class="icon"><i class="fa fa-edit"></i></div>

          <div class="count">{{ !empty($totalcard) ? $totalcard : 0  }}</div>

          <h3>Total Cards</h3>
        </div>
       </a>
      </div>

      <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
      <a href="{{route('order-list')}}">
        <div class="tile-stats">

          <div class="icon"><i class="fa fa-exchange"></i></div>

          <div class="count">{{ !empty($totalorder) ? $totalorder : 0  }}</div>

          <h3>Total Orders</h3>

        </div>
        </a>
      </div> 

      <!-- <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">

        <div class="tile-stats">

          <div class="icon"><i class="fa fa-check-square-o"></i></div>

          <div class="count">179</div>

          <h3>New Sign ups</h3>

          <p>Lorem ipsum psdea itgum rixt.</p>

        </div>

      </div> -->

    </div>

  </div>

</div>

@endsection         