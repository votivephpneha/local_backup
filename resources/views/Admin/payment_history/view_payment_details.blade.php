@extends('Admin.layout.layout')

@section('title', 'Customer Payment Details')


@section('current_page_css')
<style type="text/css">
   .deepmd{ width: 100%; }
   .deepmd strong{ float: right; }
   .deepon{ font-size: 14px; } 
</style>
<style>
   table {
   font-family: arial, sans-serif;
   border-collapse: collapse;
   width: 100%;
   }
   td, th {
   border: 1px solid #dddddd;
   text-align: left;
   padding: 8px;
   }
   .order_date{
   margin-top :15px;
   }
   
</style>
@endsection


@section('current_page_js')

@endsection

@section('content')
<!-- page content -->
<div class="right_col" role="main">
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Customer Payment Detail</h3>
    </div>

    <div class="title_right">
         <!-- <div class="col-md-8 col-sm-8 col-xs-12m pull-right top_search">     
         <ul class="breadcrumb">
         <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i>Home</a></li>
         <li><a href="{{url('admin/payment-list') }}"></i>Payment History</a></li>
         <li class="active">Customer Payment Detail</li>
         </ul>    
         </div> -->
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
          </ul>
          <section class="content-header">    
   </section>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <div class="myOrder payment-detail-box">
               <div class="myOrderDtelBox">
                  <div class="myOrderID project_detail">
                  <p class="title">Order ID:</p>
                  <p>{{$paytrandata[0]->order_id}}</p>
                  
                  </div>
                  <div class="myOrderDtel project_detail">
                  <p class="title">Order By:</p>
                  <p>{{$paytrandata[0]->fname." ". $paytrandata[0]->lname}}</p>
                  
                  <ul class="list-unstyled Myorderadd">
                     <li><i class="fa fa-building"></i> Address#: {{$paytrandata[0]->address}},{{$paytrandata[0]->city}},{{$paytrandata[0]->state}} {{$paytrandata[0]->postal_code}} </li>
                     <li><i class="fa fa-phone"></i> Phone #: {{$paytrandata[0]->phone_no}} </li>
                     <li><i class="fa fa-envelope"></i> Email #: {{$paytrandata[0]->email}} </li>
                  </ul>                 
                  </div>
                 
                  <div class="myOrderstatus project_detail">
                  <p class="title order_status">Order Status:</p>
                  <p>@if($paytrandata[0]->order_status ==0) Pending @endif
                                        @if($paytrandata[0]->order_status ==1) Accept @endif
                                        @if($paytrandata[0]->order_status ==2) Cancelled @endif
                                        @if($paytrandata[0]->order_status ==3) On the way @endif
                                        @if($paytrandata[0]->order_status ==4) Delivered @endif
                                        @if($paytrandata[0]->order_status ==5) Requested for return @endif
                                        @if($paytrandata[0]->order_status ==6) Return request accepted @endif
                                        @if($paytrandata[0]->order_status ==7) Return request declined @endif </p>
                  </div>
				  <div class="myOrderDtel order_date">
                  <p><strong>Order Date: </strong> {{date('Y-m-d', strtotime($paytrandata[0]->created_at))}} </p>
                  </div>
                  <!-- <div class="myOrderDtel">
                     <label>Order Status</label>
                     </span></strong>
                  </div> -->
                  
                  <!--<div class="myOrderDtel">
                     <label>Comment</label>
                     <strong></strong>
                     </div>-->
                  <div class="myOrderActnBox">
                     <div class="myOrderDtelBtn">
                         <a href="{{route('view.payment.invoice',request()->route('id'))}}" class="btn btn-dark  active" role="button">Download Invoice</a>
                     </div>
                     </div>
               </div>
            </div>
			
			<div class="table-status-pay">
				<div class="table-responsive">
                  <table class="table-responsive order_details">
                     <tr>
                        <th>Subtotal</th>
                        <th>Discount</th>
                        <th>Tax(%):</th>
                        <th>Total  Amount</th>
                        <th>Payment Type</th>
                        <!-- <th>Transaction ID</th> -->
                        <th>Payment Status</th>
                     </tr>
                     <tr>
                        <td>${{number_format($paytrandata[0]->sub_total, 2)}}</td>
                        <td>$0.00</td>
                        <!-- <td>${{number_format($paytrandata[0]->postage_costs, 2)}}</td> -->
                        <td>$0.00</td>
                        <td>${{number_format($paytrandata[0]->total, 2)}}</td>
                        <td>{{$paytrandata[0]->payment_method}}</td>
                        <!-- <td>{{$paytrandata[0]->transaction_id}}</td> -->
                        <td style="color: green;">{{$paytrandata[0]->pay_status}}</td>
                     </tr>
                  </table>
                  </div>
				 </div>
			
        </div>
      </div>
    </div>
  </div>

</div>
</div>
<!-- /page content -->
@endsection