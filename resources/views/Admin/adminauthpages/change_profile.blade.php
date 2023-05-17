@extends('Admin.layout.layout')

@section('title', 'Change Profile')


@section('current_page_css')
<style>
.profile-img{
max-width: 100%!important;
height: auto !important;
border-radius: 50% !important;
border: 3px solid #adb5bd;
margin: 0 auto;
padding: 3px;
width: 100px;
}
</style>

@endsection

@section('current_page_js')
<script>

function previewFile(input){

    var file = $("input[type=file]").get(0).files[0];
   
    if(file){
        var reader = new FileReader();
        // alert('check');
        reader.onload = function(){
            $("#previewImg").attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}
</script>


@endsection

@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="">
    <div class="page-title">
        <div class="title_left">
        <h3>Change Profile</h3>
        </div>

        <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
            <!-- <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">Go!</button>
            </span> -->
            </div>
        </div>
        </div>
    </div>
    <div class="clearfix"></div>
    
    @if(Session::has('success'))
        <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
         <strong>{{ Session::get('success')}}</strong>
    </div>        
    @endif
    <div class="row">
        <div class="col-md-4 col-xs-12">
        <div class="x_panel">
            
            <div class="x_content">
               <div class="text-center"> 
               @if($getdata[0]->image == "")
                  <img src="{{ asset('public/images/user.png')}}"  class="img-circle profile-img" >
                  @else
                <img src="{{ asset('public/upload/user').'/'. $getdata[0]->image}}" class="img-circle profile-img" id="previewImg">
                @endif   
                <!-- <img src="{{asset('public/images/user.png')}}" class="img-circle" id="previewImg"> -->
                <h2><strong>{{ ucfirst($getdata[0]->fname) }}</strong></h2>
            </div>
            </div>
        </div>
        </div>

        <div class="col-md-8 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
            <h2>Change Profile</h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
               
            </ul>
            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <form id="demo-form" data-parsley-validate method="POST" action="{{ route('change-profile-post')}}" enctype="multipart/form-data">
                    @csrf 
                    <label for="fullname">Name* :</label>
                      <input type="text" id="name" class="form-control" name="name" value="{{$getdata[0]->fname}}" />
                      @if($errors->has('name'))
                      <span class="text-danger">{{ $errors->first('name')}}</span> <br>   
                      @endif

                      <label for="email">Email * :</label>
                      <input type="email" id="email" class="form-control" name="email" data-parsley-trigger="change" readonly value="{{$getdata[0]->email}}"/>

                      <label for="email">Profile Image (Optional) * :</label>
                      <input type="file" id="file" class="" name="profile" data-parsley-trigger="change"  onchange="previewFile(this);"/>
                      <input type="hidden" name="old_img" value="{{$getdata[0]->image}}">
                      <br/>
                          <button class="btn btn-dark" type="submit">Submit</button>
                    </form>
            </div>
        </div>
        </div>
    </div>

 
    </div>
</div>
<!-- /page content -->
@endsection