<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Birthday Cards | </title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <!-- <div class="animate form login_form">
          <section class="login_content">
            <form>
              <h1>Login Form</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <a class="btn btn-default submit" href="index.html">Log in</a>
                <a class="reset_pass" href="#">Lost your password?</a>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
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

        <div>
          @if(Session::has('success'))
           <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ Session::get('success')}}</strong>
          </div>        
          @endif
          <section class="login_content">
            
            <form action="{{ route('register.post') }}" method="POST">
              @csrf
              <h1>Create Account</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username"   name="username"/>
                @if($errors->has('username'))
                <span class="text-danger">{{$errors->first('username')}}<span>
                @endif
              </div>
              
              <div>
                <input type="email" class="form-control" placeholder="Email" name="email" />
                @if($errors->has('email'))
                <span class="text-danger">{{$errors->first('email')}}<span>
                @endif
              </div>
               
              <div>
                <input type="password" class="form-control" placeholder="Password"  name="password"/>
               @if($errors->has('password'))
              <span class="text-danger">{{$errors->first('password')}}<span>
              @endif
              </div>

              <div>
                <input type="password" class="form-control" placeholder="Password"  name="confirmed_password"/>
               @if($errors->has('confirmed_password'))
              <span class="text-danger">{{$errors->first('confirmed_password')}}<span>
              @endif
              </div>
             
              <div>
                <button type="submit" class="btn btn-default">
                  Register
                </button>
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="{{route('login')}}" class="to_register"> Log in </a>
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
        </div>
      </div>
    </div>
     
  </body>
</html>
