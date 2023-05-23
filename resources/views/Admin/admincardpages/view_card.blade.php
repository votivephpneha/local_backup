@extends('Admin.layout.layout')

@section('title', 'View Card Details')


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
                <h3>View Card Details</h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                            <a href="javascript:history.back()" class="btn btn-default"
                                style="background: #2A3F54;color:#FFFFFF">Go Back</a>
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left"
                            method="POST" action="" enctype="multipart/form-data">
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" id="title" name="title"
                                            class="form-control col-md-7 col-xs-12" value="{{$viewdata->card_title}}"
                                            readonly>
                                    </div>
                                </div>
                                <?php if(isset($viewdata->category) AND !empty($viewdata->category) ){?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <input type="text" id="qty" name="qty" class="form-control col-md-7 col-xs-12"
                                            value="{{$viewdata->category->name}}" readonly>
                                    </div>
                                </div>
                                <?php } ?>
                                <?php if(isset($viewdata->subcategory) AND !empty($viewdata->subcategory) ){?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sub Category</label>
                                        <input type="text" id="qty" name="qty" class="form-control col-md-7 col-xs-12"
                                            value="{{$viewdata->subcategory->name}}" readonly>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea id="des" name="description" rows="2" cols="10"
                                            class="form-control col-md-7 col-xs-12" readonly>{{$viewdata->description}}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Card Status</label><br>
                                        @if($viewdata->status == 'Active')
                                        <button type="button" class="btn btn-success">{{$viewdata->status}}</button>
                                        @else
                                        <button type="button" class="btn btn-danger">{{$viewdata->status}}</button>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Card Thumb Image </label><br>
                                        @if($viewdata->card_image == "")
                                        <img src="{{ url('public/images/imageicon.png')}}" height="50" width="50" >
                                        @else
                                        <img src="{{ asset('public/upload/cards').'/'. $viewdata->card_image}}"
                                            style="height: 50px;width:50px;">
                                        @endif
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="row">    
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Card Back Image </label><br>
                                        @if($viewdata->card_back_image == "")
                                        <img src="{{ url('public/images/imageicon.png')}}" height="50" width="50" >
                                        @else
                                        <img src="{{ asset('public/upload/cards').'/'. $viewdata->card_back_image}}"
                                            style="height: 50px;width:50px;">
                                        @endif
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Card Gallery Image</label><br>
                                        @if((!empty($viewdata->card_gell_images)))
                                        @foreach ($viewdata->card_gell_images as $dataimg)
                                        <img src="{{ asset('public/upload/gallery_images').'/'. $dataimg->gall_images}}" 
                                        style="height: 50px;width:50px;">
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
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