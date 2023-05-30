<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('public/images/newicon.ico')}}" type="image/ico" />

    <title>Admin|Login </title>
    @include('Admin.custom_css')
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        @if(Session::has('failed'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ Session::get('failed')}}</strong>
          </div>   
        @endif
        @if(Session::has('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ Session::get('success')}}</strong>
          </div>   
        @endif
        <div class="animate form login_form">
          <section class="login_content">
            <form method="POST" action="{{route('login.post')}}">
              @csrf
              <h1>Login Form</h1>
              <div class="form_m_20">
                <input type="text" class="form-control" placeholder="Email" name="email" />
                @if($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email')}}</span>
                @endif
              </div>
              <div class="form_m_20">
                <input type="password" class="form-control" placeholder="Password" name="password"/>
                @if($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password')}}</span>
                @endif
              </div>
              <div>
                <button type="submit" class="btn btn-default submit "  style="float:left!important;">
                  Log in
                 </button>
                <!-- <a class="" href="index.html"></a> -->
                <!-- <a class="reset_pass" href="">Lost your password?</a> -->
              </div>

              <div class="clearfix"></div>

              <div class="">
                <!-- <p class="change_link">New to site?
                  <a href="" class="to_register"> Create Account </a>
                </p> -->

                <div class="clearfix"></div>
                <br />

                <!-- <div>
                  <h1><i class="fa fa-paw"></i> Birthday Cards !</h1>
                  <p>©2016 All Rights Reserved. Birthday Cards ! is a Bootstrap 3 template. Privacy and Terms</p>
                </div> -->
              </div>
            </form>
          </section>
        </div>

      <!--   <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form action="" method="POST">
              @csrf
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username"   name="username"/>
              </div>
              @if($errors->has('username'))
              <span style="color: red">{{$errors->first('username')}}<span>
              @endif
              <div>
                <input type="email" class="form-control" placeholder="Email" required="" name="email" />
              </div>
               @if($errors->has('email'))
              <span style="color: red">{{$errors->first('email')}}<span>
              @endif
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" name="password"/>
              </div>
              @if($errors->has('password'))
              <span style="color: red">{{$errors->first('password')}}<span>
              @endif
              <div>
                <button type="submit" class="btn btn-default">
                                  Register
                </button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-paw"></i> Birthday Cards !</h1>
                  <p>©2016 All Rights Reserved. Birthday Cards ! is a Bootstrap 3 template. Privacy and Terms</p>
                </div>
              </div>
            </form>
          </section>
        </div> -->
      </div>
    </div>
    @include('Admin.custom_js')
  </body>
</html>
