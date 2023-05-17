@extends('Admin.layout.layout')







@section('title', 'Admin|Dashboard')







@section('current_page_css')



@endsection







@section('current_page_js')



@endsection











@section('content')

<!-- page content -->



<div class="right_col" role="main">



  <div class="">



    <div class="page-title">



      <div class="title_left">



        <h3>Change Password</h3>



      </div>







      <div class="title_right">



        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">



          <div class="input-group">



            



          </div>



        </div>



      </div>



    </div>



    <div class="clearfix"></div>



    <div class="row">



      <div class="col-md-12 col-sm-12 col-xs-12">



        <div class="x_panel">



          <div class="x_title">



            



            <ul class="nav navbar-right panel_toolbox">



              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>



              </li>



              <li class="dropdown">



                <a href="asset('')#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>



                <ul class="dropdown-menu" role="menu">



                  <li><a href="#">Settings 1</a>



                  </li>



                  <li><a href="#">Settings 2</a>



                  </li>



                </ul>



              </li>



              <li><a class="close-link"><i class="fa fa-close"></i></a>



              </li>



            </ul>



            <div class="clearfix"></div>



          </div>



          <div class="x_content">



            <br />



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



            <form  method="POST" action="{{ route('chagepassword.post')}}" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">



              @csrf







              <div class="form-group">



                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Old Password <span class="required">*</span>



                </label>



                <div class="col-md-6 col-sm-6 col-xs-12">



                  <input type="password"  name="old_password"  class="form-control col-md-7 col-xs-12">



                @if($errors->has('old_password'))







                <span class="text-danger">{{ $errors->first('old_password')}}</span>







                @endif



                </div>



              </div>



              <div class="form-group">



                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">New Password<span class="required">*</span>



                </label>



                <div class="col-md-6 col-sm-6 col-xs-12">



                  <input type="password" id="new_password" name="new_password"  class="form-control col-md-7 col-xs-12">







                 @if($errors->has('new_password'))







                <span class="text-danger">{{ $errors->first('new_password')}}</span>







                @endif



                </div>



              </div>







              <div class="form-group">



                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Confirm New Password</label>



                <div class="col-md-6 col-sm-6 col-xs-12">



                  <input id="middle-name" class="form-control col-md-7 col-xs-12" type="password" name="Cpassword">



                @if($errors->has('Cpassword'))







                <span class="text-danger">{{ $errors->first('Cpassword')}}</span>







                @endif



                </div>



              </div>



               



              <div class="ln_solid"></div>



              <div class="form-group">



                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">



                  <button type="submit" class="btn btn-dark">Submit</button>
                  <input type="button"   class="btn btn-dark" value="Go Back" onClick="history.go(-1);"  />


                </div>



              </div>







            </form>



          </div>



        </div>



      </div>



    </div>



  </div>



</div>



<!-- /page content -->

@endsection         