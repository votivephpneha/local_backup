@extends('Admin.layout.layout')

@section('title', 'View Card')


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
            <h3>View Card</h3>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
              <ul class="nav navbar-right panel_toolbox">
                      <a href="javascript:history.back()" class="btn btn-default" style="background: #2A3F54;color:#FFFFFF">Go Back</a>
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                <div class="clearfix"></div>
              </div>
              <div class="x_content">
                <br />
                <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="" enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Title<span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="title" name="title"  class="form-control col-md-7 col-xs-12" value="{{$viewdata->card_title}}" readonly>
                      @if($errors->has('title'))

                    <span class="text-danger">{{ $errors->first('title')}}</span>

                    @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Price <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="price" name="price"  class="form-control col-md-7 col-xs-12" value="{{$viewdata->price}}" readonly>
                      @if($errors->has('price'))

                    <span class="text-danger">{{ $errors->first('price')}}</span>

                    @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Quantity <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" id="qty" name="qty"  class="form-control col-md-7 col-xs-12" value="{{$viewdata->qty}}" readonly>
                      @if($errors->has('price'))

                    <span class="text-danger">{{ $errors->first('price')}}</span>

                    @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description">Description <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea id="des" name="description" rows="4" cols="50" class="form-control col-md-7 col-xs-12" readonly>{{$viewdata->description}}
                    </textarea>
                      <!-- <input type="text" id="last-name" name="last_name"  class="form-control col-md-7 col-xs-12"> -->
                      @if($errors->has('description'))

                    <span class="text-danger">{{ $errors->first('description')}}</span>

                    @endif
                    </div>
                  </div>
                  <?php if(isset($viewdata->category) AND !empty($viewdata->category) ){?>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description">Category <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="qty" name="qty"  class="form-control col-md-7 col-xs-12" value="{{$viewdata->category->name}}" readonly>
                    </div>
                  </div>
                  <?php } ?>
                  <?php if(isset($viewdata->subcategory) AND !empty($viewdata->subcategory) ){?>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description">Sub Category <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="qty" name="qty"  class="form-control col-md-7 col-xs-12" value="{{$viewdata->subcategory->name}}" readonly>
                    </div>
                  </div>
                  <?php } ?>
                  <div class="form-group">
                    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Card Status</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        @if($viewdata->status == 'Active')
                        <button type="button" class="btn btn-success">{{$viewdata->status}}</button> 
                    @else   
                    <button type="button" class="btn btn-danger">{{$viewdata->status}}</button>  
                    @endif
                    </div>
                  </div>

                  
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Card Thumb Image <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="mt-5">
                    <img src="{{ asset('public/upload/cards').'/'. $viewdata->card_image}}" 
                    style="height: 50px;width:50px;"></div>
                    </div>
                    
                  </div>
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Card Gallery Image <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="mt-5">
                    @if((!empty($viewdata->card_gell_images)))
                      @foreach ($viewdata->card_gell_images as $dataimg)
                    <img src="{{ asset('public/upload/gallery_images').'/'. $dataimg->gall_images}}" 
                      style="height: 50px;width:50px;">
                      @endforeach
                    @endif
                    </div>
                    </div>
                    
                  </div>
                  <div class="ln_solid"></div>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      
                      <!-- <button type="submit" class="btn btn-dark">Submit</button> -->
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