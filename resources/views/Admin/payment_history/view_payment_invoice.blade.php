<!DOCTYPE html>
<html>
<head>
    <title>Payment Invoice</title>
</head>
<style type="text/css">
    body{
        font-family: 'Roboto Condensed', sans-serif;
    }
    .m-0{
        margin: 0px;
    }
    .p-0{
        padding: 0px;
    }
    .pt-5{
        padding-top:5px;
    }
    .mt-10{
        margin-top:10px;
    }
    .text-center{
        text-align:center !important;
    }
    .w-100{
        width: 100%;
    }
    .w-50{
        width:50%;   
    }
    .w-85{
        width:85%;   
    }
    .w-15{
        width:15%;   
    }
    .logo img{
        width:200px;
        height:60px;        
    }
    .gray-color{
        color:#5D5D5D;
    }
    .text-bold{
        font-weight: bold;
    }
    .border{
        border:1px solid black;
    }
    table tr,th,td{
        border: 1px solid #d2d2d2;
        border-collapse:collapse;
        padding:7px 8px;
    }
    table tr th{
        background: #F4F4F4;
        font-size:15px;
    }
    table tr td{
        font-size:13px;
    }
    table{
        border-collapse:collapse;
    }
    .box-text p{
        line-height:10px;
    }
    .float-left{
        float:left;
    }
    .total-part{
        font-size:16px;
        line-height:12px;
    }
    .total-right p{
        padding-right:20px;
    }
    .float-right{
        float:right;
    }
</style>
<body>
<div class="head-title">
    <h1 class="text-center m-0 p-0">Invoice</h1>
    <!-- <h1 class="text-center m-0 p-0">Invoice12</h1> -->
</div>
<div class="add-detail mt-10">
    <div class="w-50 float-left mt-10">
        <p class="m-0 pt-5 text-bold w-100">Invoice Id - <span class="gray-color">{{$invoicenum }}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Order Id - <span class="gray-color">{{$paymentdata[0]->order_id1 }}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Order Date - <span class="gray-color">{{date('Y-m-d', strtotime($paymentdata[0]->created_at))}}</span></p>
    </div>
    <div class="float-right" style="">
            <h1>Birthday Store!</h1>
        <!-- <img src="" alt="" style="width: 150px; height: 150px;"> -->
    </div>
    <div style="clear: both;"></div>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">From</th>
            <th class="w-50">To</th>
        </tr>
        <tr>
            <td>
                <div class="box-text">
                    <p><strong>{{$authdata->fname}}<strong></p>
                    <p>{{$authdata->address}}</p>
                    <p>Email: {{$authdata->email}} </p>                    
                    <p>Contact: {{$authdata->phone}}</p>
                </div>
            </td>
            <td>
                <div class="box-text">
                    <p><strong>{{$paymentdata[0]->firstname ." ". $paymentdata[0]->lastname}}</p>
                    <p>{{ $paymentdata[0]->address }}</p>
                    <p>Email: {{$paymentdata[0]->email}} </p>                     
                    <p>Contact:{{$paymentdata[0]->phone}}</p>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Payment Method</th>
            <th class="w-50">Shipping Method</th>
        </tr>
        <tr>
            <td>{{ $paymentdata[0]->payment_type }}</td>
            <td>Free Shipping - Free Shipping</td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>    
            <th class="w-50">Product Name</th>
            <th class="w-50">Price</th>
            <th class="w-50">Qty</th>
            <th class="w-50">Subtotal</th>
            <th class="w-50">Tax Amount</th>
            <th class="w-50">Grand Total</th>
        </tr>
        <tr align="center">
            <!-- <td>M101</td> -->
            <td>{{$paymentdata[0]->card_title}}</td>
            <td>${{number_format($paymentdata[0]->card_price, 2)}}</td>
            <td>{{$paymentdata[0]->card_qty}}</td>
            <td>${{number_format($paymentdata[0]->sub_total, 2)}}</td>
            <td>0.00</td>
            <td>${{number_format($paymentdata[0]->total, 2)}}</td>
        </tr>
      
        <tr>
            <td colspan="7">
                <div class="total-part">
                    <div class="total-left w-85 float-left" align="right">
                        <p>Sub Total</p>
                        <p>Tax (%)</p>
                        <p>Total Payable</p>
                    </div>
                    <div class="total-right w-15 float-left text-bold" align="right">
                        <p>${{number_format($paymentdata[0]->sub_total, 2)}}</p>
                        <p>$0.00</p>
                        <p>${{number_format($paymentdata[0]->total, 2)}}</p>
                    </div>
                    <div style="clear: both;"></div>
                </div> 
            </td>
        </tr>
    </table>
</div>
</html>