@extends('Admin.layout.layout')

@section('title', 'Create Page')


@section('current_page_css')

@endsection


@section('current_page_js')
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>

@endsection


@section('content')
<!-- page content -->
<div class="right_col" role="main">
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Create Page</h3>
    </div>

    <!-- <div class="title_right">
      <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for...">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div> -->
  </div>
  <div class="clearfix"></div>
  <div class="row">
  @if(Session::has('failed'))
      <div class="alert alert-danger alert-block">

          <button type="button" class="close" data-dismiss="alert">×</button>

          <strong>{{ Session::get('failed')}}</strong>

      </div>
      @endif
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ route('create.new.page.post')}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Title <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="title" name="title"  class="form-control col-md-7 col-xs-12">
                @if($errors->has('title'))

              <span class="text-danger">{{ $errors->first('title')}}</span>

              @endif
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">Slug <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="slug" name="slug"  class="form-control col-md-7 col-xs-12">
                @if($errors->has('slug'))

              <span class="text-danger">{{ $errors->first('slug')}}</span>

              @endif
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="slug">SubTitle <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="sub_title" name="sub_title"  class="form-control col-md-7 col-xs-12">
                @if($errors->has('sub_title'))

              <span class="text-danger">{{ $errors->first('sub_title')}}</span>

              @endif
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description">Description <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea  name="page_content"  class="form-control ckeditor" rows="12" cols="50"></textarea>
                <!-- <input type="text" id="last-name" name="last_name"  class="form-control col-md-7 col-xs-12"> -->
                @if($errors->has('page_content'))

              <span class="text-danger">{{ $errors->first('page_content')}}</span>

              @endif
              </div>
            </div>
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Card Status</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="page_status" id="page_status"  class="form-control">

                    <option value="1" >Active</option>

                    <option value="0" >Inactive</option>

                  </select>
                  @if($errors->has('page_status'))

                  <span class="text-danger">{{ $errors->first('page_status')}}</span>

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