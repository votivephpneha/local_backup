@extends('Admin.layout.layout')

@section('title', 'Order Details')


@section('current_page_css')


@endsection


@section('current_page_js')
<script type="text/javascript">
$('#order_status').on('change', function() {

    var val = $('#order_status').val();

    if (val == 2) {
        $('#cancel_area').html(
        '<textarea style="width: 337px;" class="form-control animated"  id="cancel_reason" name="cancel_reason" placeholder="Enter cancel reason..." rows="3"></textarea>'
        );

    }

});
</script>

@endsection


@section('content')
<!-- page content -->
<div class="right_col" role="main">

    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Order Detail</h3>
            </div>
            <div class="title_right">
            <div class=" form-group pull-right top_search">
            <a href="{{route('order-list')}}" class="btn btn-default" style="background: #2A3F54;color:#FFFFFF">Go Back</a> 
            </div>
            </div>
        </div>
       
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                @if(Session::has('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ Session::get('success')}}</strong>
                </div>
                @endif
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                        <form id="supdate" role="form" method="POST" action="{{ route('order.status.change') }}">
                                {!! csrf_field() !!}
                            <input type="hidden" name="order_id" id="order_id"
                                value="{{$orderdetail[0]->order_id}}">
                            <input type="hidden" name="return_flag" id="return_flag" value="0">
                            <input type="hidden" name="id" id="id" value="{{$orderdetail[0]->id}}">
                            <div class="col-lg-8">
                            <label>Order Status: </label> 
                                    <select class="select2_group form-control" name="order_status" id="order_status">
                                    <!-- <optgroup label="Select order status"> -->
                                    <option value="0" @if($orderdetail[0]->order_status == 0) selected @endif
                                            >Pending</option>
                                        <option value="1" @if($orderdetail[0]->order_status == 1) selected @endif
                                            >Accept</option>
                                        <option value="2" @if($orderdetail[0]->order_status == 2) selected @endif
                                            >Cancelled</option>
                                        <option value="3" @if($orderdetail[0]->order_status == 3) selected @endif >On
                                            the way</option>
                                        <option value="4" @if($orderdetail[0]->order_status == 4) selected @endif
                                            >Delivered</option>
                                  </optgroup>
                                 </select> 
                                 <div id="cancel_area"></div>
                            </div>
                            <div class="col-lg-4">
                            <button class="btn btn-dark btn_submit mt-5" style="margin-top : 24px;" type="submit" id="extraSearch">Submit</button>
                            </div>  
                          </form>                     
                        </div>
                        <!-- <div class="order_status_form">
                            <form id="supdate" role="form" method="POST" action="{{ route('order.status.change') }}">
                                {!! csrf_field() !!}
                                <input type="hidden" name="order_id" id="order_id"
                                    value="{{$orderdetail[0]->order_id}}">
                                <input type="hidden" name="return_flag" id="return_flag" value="0">
                                <input type="hidden" name="id" id="id" value="{{$orderdetail[0]->id}}">
                                <h4>Order Status:</h4>
                                <div class="input-group">
                                    <select name="order_status" id="order_status" class="form-control">
                                        <option value="0" @if($orderdetail[0]->order_status == 0) selected @endif
                                            >pending</option>
                                        <option value="1" @if($orderdetail[0]->order_status == 1) selected @endif
                                            >Accept</option>
                                        <option value="2" @if($orderdetail[0]->order_status == 2) selected @endif
                                            >Cancelled</option>
                                        <option value="3" @if($orderdetail[0]->order_status == 3) selected @endif >On
                                            the way</option>
                                        <option value="4" @if($orderdetail[0]->order_status == 4) selected @endif
                                            >Delivered</option>
                                    </select>
                                    <div id="cancel_area"></div>
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit">submit</button>
                                    </span>
                                    </submit>
                                </div>
                        </div> -->

                        
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <section class="content invoice">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-xs-12 invoice-header">
                                    <h1>
                                        <!-- <i class="fa fa-globe"></i> -->
                                        Order Detail
                                        <small class="pull-right">Date:
                                            {{ date('d/m/Y', strtotime($orderdetail[0]->created_at))}}</small>
                                    </h1>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                        <strong>{{$admindata->fname}} {{$admindata->lname}}</strong>
                                        <br>Address: {{$admindata->address}}
                                        <!-- <br> -->
                                        <br>Phone: {{$admindata->phone}}
                                        <br>Email: {{$admindata->email}}<br><br>
                                        <b>Order Status:</b> @if($orderdetail[0]->order_status ==0) Pending @endif
                                        @if($orderdetail[0]->order_status ==1) Accept @endif
                                        @if($orderdetail[0]->order_status ==2) Cancelled @endif
                                        @if($orderdetail[0]->order_status ==3) On the way @endif
                                        @if($orderdetail[0]->order_status ==4) Delivered @endif
                                        @if($orderdetail[0]->order_status ==5) Requested for return @endif
                                        @if($orderdetail[0]->order_status ==6) Return request accepted @endif
                                        @if($orderdetail[0]->order_status ==7) Return request declined @endif <br>
                                        <?php if(!empty($orderdetail[0]->cancel_reason)){ ?>
                                        <b>Cancel Reason:</b> {{$orderdetail[0]->cancel_reason  }}
                                        <?php } ?>
                                        <?php if(!empty($orderdetail[0]->order_notes)){ ?>
                                        <b>Order Note:</b> {{$orderdetail[0]->order_notes  }}
                                        <?php } ?>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                        <strong>{{$orderdetail[0]->fname}} {{$orderdetail[0]->lname }}</strong>
                                        <br>Address: {{$orderdetail[0]->address}},{{$orderdetail[0]->city}},{{$orderdetail[0]->state}} {{$orderdetail[0]->postal_code}}
                                        <br>Phone: {{$orderdetail[0]->phone_no}}
                                        <br>Email: {{$orderdetail[0]->email}}
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <!-- <b>Invoice #007612</b> -->
                                    <!-- <br>
            <br> -->
                                    <b>Order ID:</b>{{$orderdetail[0]->order_id}}
                                    <br>
                                    <!-- <b>Payment Due:</b> 2/22/2014 -->
                                    <!-- <br> -->
                                    <!-- <b>Account:</b> 968-34567 -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-sm-4 invoice-col">

                                </div>

                            </div>

                            <!-- Table row -->
                            <div class="row">
                                <div class="col-xs-12 table">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Qty</th>
                                                <th>Card Title</th>
                                                <th>Card Size</th>
                                                <th>Price</th>
                                                <th style="width: ">Qr link</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @if (!$card_details->isEmpty())
                                           @foreach($card_details as $data)
                                            <tr>
                                                <td>{{$data->qty}}</td>
                                                <td>{{$data->card_title}}</td>
                                                <td>{{$data->card_size}}</td>
                                                <td>${{number_format($data->price, 2)}}</td>
                                                @if($data->qr_image_link == "")
                                                <td>No link
                                                </td>
                                                @else
                                                <td><a href="{{ $data->qr_image_link }}" target="_blank">Qr Link</a>
                                                </td>
                                                @endif
                                                <td>${{number_format($data->card_price, 2)}}
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                           
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <div class="row">
                                <!-- accepted payments column -->
                                <div class="col-xs-6">
                                    <p class="lead">Payment Information:</p>
                                    <b>Payment method:</b> {{$orderdetail[0]->payment_method}}
                                    <p><strong>Payment Status:</strong> {{$orderdetail[0]->pay_status}}</p>
                                </div>
                                <!-- /.col -->
                                <div class="col-xs-6">
                                    <!-- <p class="lead">Amount Due 2/22/2014</p> -->
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th style="width:50%">Subtotal:</th>
                                                    <td> ${{number_format($orderdetail[0]->sub_total, 2)}}</td>
                                                </tr>
                                                <tr>
                                                    <th>Tax(%):</th>
                                                    <td> $0.00</td>
                                                </tr>
                                                <tr>
                                                    <th>Shipping:</th>
                                                    <td> 0.00</td>
                                                </tr>
                                                <tr>
                                                    <th>Total:</th>
                                                    <td>${{number_format($orderdetail[0]->total, 2)}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-xs-12">
                                    <!-- <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button> -->
                                    <!-- <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
            <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button> -->
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
@endsection