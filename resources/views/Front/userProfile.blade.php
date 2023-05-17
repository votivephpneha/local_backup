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
        <h2>User Profile</h2>
       @if ($message = Session::get('success'))
        <div class="alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ $message }}
        </div>
         @endif
        <form name="registration" method="post" action="{{ url('user/postuserProfile') }}" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-md-6">
          <div class="form-group mb-tm">
            <label for="email">First Name:</label>
            <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname" value="{{ $user_data['fname'] }}">
          </div>
        </div>
          <div class="col-md-6">
          <div class="form-group mb-tm">
            <label for="email">Last Name</label>
            <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname" value="{{ $user_data['lname'] }}">
          </div>
        </div>
        </div>
          <div class="form-group mb-tm">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{ $user_data['email'] }}" readonly="">
          </div>
          <div class="form-group mb-tm">
            <label for="phone_no">Phone No:</label>
            <input type="text" class="form-control" id="phone_no" placeholder="Enter Phone Number" name="phone_no" value="{{ $user_data['phone'] }}">
          </div>
          <div class="form-group mb-tm">
            <label for="phone_no">Address</label>
            <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" value="{{ $user_data['address'] }}">
          </div>
          <div class="form-group mb-tm">
            <label for="email">Profile Image:</label>
            <input type="file" class="form-control" id="profile_image" name="profile_image">
            <input type="hidden" name="hidden_profile_image" value="{{ $user_data['user_image'] }}">
            <div class="user_img">
              <?php if($user_data['user_image']){
                ?>
                <img src="{{ url('/public/upload/user') }}/{{ $user_data['user_image'] }}">
                <?php
              }else{
                ?>
                <img src="{{ url('/public/upload/user') }}/1683023289_user.jpg">
                <?php
              }
              ?>
              
            </div>
          </div>
          
          
        <center>  <button class="profile_upd" type="submit" class="btn btn-default">Update Profile</button></center>
        </form>
      </div>
    </div>
  </div>
  
</div>  

<script>
  document.getElementById("profile_image")
  .onchange = function(event) {
    let file = event.target.files[0];

    console.log("file","{{ url('/uploads') }}/"+file.name);
    let blobURL = URL.createObjectURL(file);
   
    $(".user_img img").attr("src",blobURL);
  }
</script>
@endsection