@extends('Admin.layout.layout')

@section('title', 'Edit Card')


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
          <h3>Edit Card</h3>
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
      @if(Session::has('success'))
        <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ Session::get('success')}}</strong>
      </div>        
      @endif
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
              <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ route('edit.card.post',$carddata->id)}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price"><Title></Title> <span class="required">Title*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="title" name="title"  class="form-control col-md-7 col-xs-12" value="{{$carddata->card_title}}">
                    @if($errors->has('title'))

                  <span class="text-danger">{{ $errors->first('title')}}</span>

                  @endif
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Price <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="number" id="price" name="price"  class="form-control col-md-7 col-xs-12" value="{{$carddata->price}}">
                    @if($errors->has('price'))

                  <span class="text-danger">{{ $errors->first('price')}}</span>

                  @endif
                  </div>
                </div> -->
                <!-- <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Quantity <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="qty" name="qty"  class="form-control col-md-7 col-xs-12" value="{{$carddata->qty}}">
                    @if($errors->has('qty'))

                  <span class="text-danger">{{ $errors->first('qty')}}</span>

                  @endif
                  </div>
                </div> -->
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description">Description <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  <textarea id="des" name="description" rows="4" cols="50" class="form-control col-md-7 col-xs-12">{{$carddata->description}}
                  </textarea>
                    <!-- <input type="text" id="last-name" name="last_name"  class="form-control col-md-7 col-xs-12"> -->
                    @if($errors->has('description'))

                  <span class="text-danger">{{ $errors->first('description')}}</span>

                  @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Category</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <select name="category_id" id="category_id" class="form-control">
                          <option value=""@if($carddata->category_id==null) selected @endif>No Category</option>
                          @foreach($categorydata as $data)
                          <option value="{{$data->id}} "@if($carddata->category_id!=null && $carddata->category_id == $data->id) selected @endif>{{$data->name}}</option>

                          @endforeach

                      </select>
                      @if($errors->has('category_id'))

                      <span class="text-danger">{{ $errors->first('category_id')}}</span>

                      @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12"> Sub Category</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <select name="subcategory_id" id="subcategory_id" class="form-control">
                          <option value=""@if($carddata->sub_category_id==null) selected @endif>No Category</option>
                          @foreach($subcategory as $data)
                          <option value="{{$data->id}} "@if($carddata->sub_category_id!=null && $carddata->sub_category_id == $data->id) selected @endif>{{$data->name}}</option>

                          @endforeach

                      </select>
                      @if($errors->has('subcategory_id'))

                      <span class="text-danger">{{ $errors->first('subcategory_id')}}</span>

                      @endif
                  </div>
                </div>
                
                
                <div class="form-group">
                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Card Status</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <select name="card_status" id="card_status"  class="form-control">

                        <option value="1" {{ $carddata->status == 'Active' ? 'selected' : '' }} >Active</option>

                        <option value="0"  {{ $carddata->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>

                      </select>
                      @if($errors->has('card_status'))

                      <span class="text-danger">{{ $errors->first('card_status')}}</span>

                      @endif
                  </div>
                </div>
                <div class="form-group">
                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Card Thumb image</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="card_image" class="form-control col-md-7 col-xs-12" type="file" name="card_image"  accept="image/png, image/gif, image/jpeg"> 

                    
                      @if($errors->has('card_image'))

                  <span class="text-danger">{{ $errors->first('card_image')}}</span>

                  @endif 
                  </div>
                  
                </div>                      
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Thumb Image  Preview <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  @if($carddata->card_image == "")
                  <img src="{{ url('public/images/imageicon.png')}}" height="50" width="50">
                  @else
                  <img src="{{ asset('public/upload/cards').'/'. $carddata->card_image}}" height="50" width="50">
                  @endif
                  
                  </div>                       
                </div>
                <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Card Back image</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="card_back_image" class="form-control col-md-7 col-xs-12" type="file" name="card_back_image"  accept="image/png, image/gif, image/jpeg"> 
                @if($errors->has('card_back_image'))

                <span class="text-danger">{{ $errors->first('card_back_image')}}</span>

                @endif 
                </div>
                
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Back Image Preview <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  @if($carddata->card_back_image == "")
                  <img src="{{ url('public/images/imageicon.png')}}" height="50" width="50">
                  @else
                  <img src="{{ asset('public/upload/cards').'/'. $carddata->card_back_image}}" height="50" width="50">
                  @endif
                  
                  </div>                       
                </div>

                <div class="form-group">
                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Card Gallery image</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="card_gall_image" class="form-control col-md-7 col-xs-12" type="file" name="card_gall_image[]"  accept="image/png, image/gif, image/jpeg" multiple> 

                    
                      @if($errors->has('card_image'))

                  <span class="text-danger">{{ $errors->first('card_image')}}</span>

                  @endif 
                  </div>
                  
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Card Gallery Preview <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  @if((!empty($carddata->card_gell_images)))
                    @foreach ($carddata->card_gell_images as $data)
                    <img src="{{ asset('public/upload/gallery_images').'/'. $data->gall_images}}" height="50" width="50">
                    <a href="{{route('delete-card-images',$data->id)}}"><i class="fa fa-times" aria-hidden="true"></i></a>
                  @endforeach
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