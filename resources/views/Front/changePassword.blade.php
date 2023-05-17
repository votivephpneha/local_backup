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
        <h2>Change Password</h2>
       @if ($message = Session::get('password_error'))
        <div class="alert alert-danger">
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
        <form name="change_password" method="post" action="{{ url('user/postuser_ChangePassword') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group mb-tm">
            <label for="old_password">Old Password</label>
            <input type="password" class="form-control" id="old_password" placeholder="Enter Old Password" name="old_password">
          </div>
          <div class="form-group mb-tm">
            <label for="new_password">New Password</label>
            <input type="password" class="form-control" id="new_password" placeholder="Enter New Password" name="new_password">
          </div>
          <div class="form-group mb-tm">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" placeholder="Enter Confirm Password" name="confirm_password">
          </div>
          
          <button type="submit" class="btn btn-default profile_upd">Submit</button>
        </form>
      </div>
    </div>
  </div>
  
</div>  
@endsection
