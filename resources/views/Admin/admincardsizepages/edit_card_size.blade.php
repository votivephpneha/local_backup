@extends('Admin.layout.layout')

@section('title', 'Edit card  Size')


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
        <h3>Edit Card Size</h3>
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
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ route('edit.card.size.post',$findcardsize->id)}}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Card Type<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="card_type" name="card_type"  class="form-control col-md-7 col-xs-12" value="{{$findcardsize->card_type}}">
                  @if($errors->has('card_type'))

                <span class="text-danger">{{ $errors->first('card_type')}}</span>

                @endif
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Card Size<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12"> 
                  <input type="text" id="card_size" name="card_size"  class="form-control col-md-7 col-xs-12" value="{{$findcardsize->card_size}}">
                  @if($errors->has('card_size'))

                <span class="text-danger">{{ $errors->first('card_size')}}</span>

                @endif
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Card Quantity<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="number" id="card_quantity" name="card_quantity"  class="form-control col-md-7 col-xs-12" value="{{$findcardsize->card_size_qty}}">
                  @if($errors->has('card_quantity'))

                <span class="text-danger">{{ $errors->first('card_quantity')}}</span>

                @endif
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Card Price<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="card_price" name="card_price"  class="form-control col-md-7 col-xs-12" value="{{number_format($findcardsize->card_price, 2)}}">
                  @if($errors->has('card_price'))

                <span class="text-danger">{{ $errors->first('card_price')}}</span>

                @endif
                </div>
              </div>
              <div class="form-group">
                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Select Card</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <select name="card" id="card" class="form-control">
                          <option value=""@if($findcardsize->card_id==null) selected @endif>Select Card</option>
                          @foreach($carddata as $data)
                          <option value="{{$data->id}} "@if($findcardsize->card_id!=null && $findcardsize->card_id == $data->id) selected @endif>{{$data->card_title}}</option>

                          @endforeach

                      </select>
                      @if($errors->has('card'))

                      <span class="text-danger">{{ $errors->first('card')}}</span>

                      @endif
                  </div>
                </div>
              <!-- <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Of Birth <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="birthday" name="Dob" class="date-picker form-control col-md-7 col-xs-12"  type="date">
                    @if($errors->has('Dob'))

                <span class="text-danger">{{ $errors->first('Dob')}}</span>

                @endif
                </div>
                
              </div> -->
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