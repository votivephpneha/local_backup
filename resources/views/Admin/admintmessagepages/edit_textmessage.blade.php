@extends('Admin.layout.layout')

@section('title', 'Edit Text Message')


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
      <h3>Edit Text Message</h3>
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
          <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ route('edit.message.post',$messdata->id)}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description"> Text Message <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
              <textarea id="text_mess" name="text_mess" rows="4" cols="50" class="form-control col-md-7 col-xs-12">{{$messdata->text_message}}
              </textarea>
                <!-- <input type="text" id="last-name" name="last_name"  class="form-control col-md-7 col-xs-12"> -->
                @if($errors->has('text_mess'))

              <span class="text-danger">{{ $errors->first('text_mess')}}</span>

              @endif
              </div>
            </div>
            <div class="form-group">
                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Select Card(optional)</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <select name="card" id="card" class="form-control">
                          <option value=""@if($messdata->card_id==null) selected @endif>Select Card</option>
                          @foreach($carddata as $data)
                          <option value="{{$data->id}} "@if($messdata->card_id!=null && $messdata->card_id == $data->id) selected @endif>{{$data->card_title}}</option>

                          @endforeach

                      </select>
                      @if($errors->has('card'))

                      <span class="text-danger">{{ $errors->first('card')}}</span>

                      @endif
                  </div>
                </div>
            
            
            <div class="form-group">
              <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Message Status</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                  <select name="mess_status" id="mess_status"  class="form-control">

                    <option value="1" {{ $messdata->status == 'Active' ? 'selected' : '' }}>Active</option>

                    <option value="0" {{ $messdata->status == 'Inactive' ? 'selected' : '' }} >Inactive</option>

                  </select>
                  @if($errors->has('mess_status'))

                  <span class="text-danger">{{ $errors->first('mess_status')}}</span>

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