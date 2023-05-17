@extends('Admin.layout.layout')

@section('title', 'Create Voucher Code')


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
        <h3>Create Voucher Code</h3>
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
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="{{ route('create.voucher.code.post')}}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Name <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="voucher_name" name="voucher_name"  class="form-control col-md-7 col-xs-12">
                  @if($errors->has('voucher_name'))
                  <span class="text-danger">{{ $errors->first('voucher_name')}}</span>
                  @endif
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="price">Voucher code <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="voucher_code" name="voucher_code"  class="form-control col-md-7 col-xs-12">
                  @if($errors->has('voucher_code'))

                <span class="text-danger">{{ $errors->first('voucher_code')}}</span>

                @endif
                </div>
              </div>
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Discount</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="discount" id="discount"  class="form-control">
                      
                      <option value="0" selected="selected">Flat</option>

                      <option value="1" >Percentage</option>

                    </select>
                    @if($errors->has('discount'))

                    <span class="text-danger">{{ $errors->first('discount')}}</span>

                    @endif
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qty">Voucher  amount <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="number" id="amount" name="amount"  class="form-control col-md-7 col-xs-12">
                  @if($errors->has('amount'))

                <span class="text-danger">{{ $errors->first('amount')}}</span>

                @endif
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qty">Apply on minimum amount<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="number" id="mamount" name="mamount"  class="form-control col-md-7 col-xs-12">
                  @if($errors->has('mamount'))

                <span class="text-danger">{{ $errors->first('mamount')}}</span>

                @endif
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qty">Expiry Date<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="date" id="valid_till" name="valid_till"  class="form-control col-md-7 col-xs-12">
                  @if($errors->has('valid_till'))

                <span class="text-danger">{{ $errors->first('valid_till')}}</span>

                @endif
                </div>
              </div>
              <input type="hidden" id="usage_limit" name="usage_limit" value="1" />
              <input type="hidden" id="per_user" name="per_user" value="1"/>
              <!-- <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Description">Description <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="des" name="description" rows="4" cols="50" class="form-control col-md-7 col-xs-12">
                </textarea> -->
                  <!-- <input type="text" id="last-name" name="last_name"  class="form-control col-md-7 col-xs-12"> -->
                  <!-- @if($errors->has('description'))

                <span class="text-danger">{{ $errors->first('description')}}</span>

                @endif
                </div>
              </div> -->          
              <div class="form-group">
                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="voucher_status" id="voucher_status"  class="form-control">

                      <option value="1" >Active</option>

                      <option value="0" >Inactive</option>

                    </select>
                    @if($errors->has('voucher_status'))

                    <span class="text-danger">{{ $errors->first('voucher_status')}}</span>

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