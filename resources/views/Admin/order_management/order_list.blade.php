<!DOCTYPE html>

<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Meta, title, CSS, favicons, etc. -->

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('public/images/newicon.ico')}}" type="image/ico" />
    <title>Order List | BirthdayCards</title>
    <div class="main_container">
        @include('Admin.layout.datatable_css')
</head>

<body class="nav-md">

    <div class="container body">

        <div class="main_container">

            <!-- Sidebar -->
            @include('Admin.layout.sidebar')
            <!-- Navbar Header -->
            @include('Admin.layout.header')
            <!-- page content -->

            <div class="right_col" role="main">

                <div class="">

                    <div class="page-title">

                        <div class="title_left">

                            <h3>Order List</small></h3>

                        </div>

                    </div>





                    <div class="clearfix"></div>



                    <div class="row">



                        <div id="sumess"></div>



                        @if(Session::has('success'))

                        <div class="alert alert-success alert-block">

                            <button type="button" class="close" data-dismiss="alert">×</button>

                            <strong>{{ Session::get('success')}}</strong>
                            @php
                            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
                            header("Cache-Control: post-check=0, pre-check=0", false);
                            header("Pragma: no-cache");
                            @endphp

                        </div>

                        @endif

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            

                            <div class="x_panel">
                            <!-- <form method="" id="search-form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Filter By Order status: </label> 
                                    <select class="select2_group form-control" id="status_id" name="status_id">
                                    <optgroup label="Select order status">
                                        <option value="">All</option>
                                        <option value="0">pending</option>
                                        <option value="1">Accept</option>
                                        <option value="2">Cancelled</option>
                                        <option value="3">On the way</option>
                                        <option value="4">Delivered</option>
                                  </optgroup>
                                 </select>
                                </div> -->

                                <!-- <div class="col-lg-4 mt-10"> -->
                                <!-- <div class="search_button" style="margin-top : 24px;">
                                <button class="btn btn-dark btn_submit mt-5" type="submit" id="extraSearch">Search</button>
                                    <a class="btn btn-dark btn_reset mt-5" href="#">Reset</a>
                                </div>  -->
                                <!-- </div>                                -->
                            <!-- </div>
                             </form> -->
                                <div class="x_title">



                                    <ul class="nav navbar-right panel_toolbox">

                                        <!-- <a href="{{route('create.card')}}" class="btn btn-default"
                                            style="background: #2A3F54;color:#FFFFFF"> Add New Card</a> -->

                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>

                                        </li>
                                    </ul>

                                    <div class="clearfix"></div>

                                </div>

                                <div class="x_content table-responsive">

                                    <table id="example" class="table table-striped table-bordered ">

                                        <thead>
                                            <tr>
                                                
                                                <th>S.no#</th>
                                                <th>Order Id#</th>
                                                <!-- <th>Card Title</th> -->
                                                <th>Customer Id</th>
                                                <th>Customer name</th>
                                                <th>Order Price</th>
                                                <th>Order Status</th>
                                                <th>Order Date</th>
                                                <th>Action</th>
                                            </tr>
                                            <tbody>
                                            @if (!$orderList->isEmpty())
                                            <?php $i = 1; ?>
                                            @foreach ($orderList as $arr)
                                            <tr id="row{{ $arr->id }}">
                                                <td>{{$i}}</td>
                                                <td>{{$arr->order_id}}</td>
                                                <!-- <td></td> -->
                                                <td>{{$arr->customer_id}}</td>
                                                <td>{{$arr->fname." ".$arr->lname}}</td>
                                                <td>${{number_format($arr->total, 2)}}</td>
                                                @if($arr->order_status == 0)
                                                <td>Pending</td>
                                                @elseif ($arr->order_status == 1)
                                                <td>Accept</td>
                                                @elseif ($arr->order_status == 2)
                                                <td>Cancelled</td>
                                                @elseif ($arr->order_status == 3)
                                                <td>On the way</td>
                                                @else
                                                <td>'Delivered</td>
                                                @endif
                                                <td> {{ date('d/m/Y', strtotime($arr->created_at))}}</td>
                                                <td><button class="btn btn-dark p-2">
                                                <a href="{{route('order-detail',[$arr->id])}}" class="text-white" style=" color: #FFFFFF;"><i class="fa fa-eye" ></i>View</button></a>   
                                            </td>                                                
                                            </tr>
                                            <?php $i++; ?>
                                            @endforeach
                                            @endif
                                            </tbody>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        @include('Admin.layout.footer')
        <!-- /footer content -->
    </div>

    </div>
    @include('Admin.layout.datatable_script')
     <script>
    // $(document).ready(function() {

    // var orderTable =  $('#example').DataTable({

    //         processing: true,

    //         serverSide: true,

    //         "lengthMenu": [

    //             [10, 20, 50, 100, 500],

    //             [10, 20, 50, 100, 500]

    //         ],



    //         pageLength: 10,

    //         "order": [

    //             [0, "desc"],

    //             [0, 'desc']

    //         ],

    //         ajax: {
    //          url:"{{route('get.orderlist')}}",
    //          data: function(data){
    //             data.status_id = $('#status_id').val();
    //          }
    //        },
    //         // ajax: '{{route("get.orderlist")}}',

    //         "columns": [



    //             {

    //                 "data": "id",

    //                 name: 'id',

    //                 searchable: false,

    //                 orderable: false,

    //                 visible: false

    //             },
    //             {
    //                 "data": "srno",

    //                 name: 'srno',

    //                 searchable: false,

    //                 orderable: false
    //             },
    //             {

    //                 "data": "booking_id",

    //                 "name": 'booking_id',

    //                 "searchable": false,

    //                 "visible": true,

    //                 orderable: false


    //             },

    //             {

    //                 "data": "card_title",

    //                 name: 'card_title',

    //                 searchable: false,

    //                 orderable: false

    //             },
    //             {

    //                 "data": "customer_id",

    //                 orderable: false

    //             },

    //             {
    //                 "data": "customer_name",

    //                 name: 'customer_name',

    //                 searchable: false,

    //                 "orderable": false
    //             },
    //             {

    //                 "data": "booking_price",

    //                 orderable: false

    //             },
    //             {

    //                 "data": "booking_status",

    //                 orderable: false

    //             },

    //             {

    //                 "data": "action",

    //                 orderable: false

    //             }



    //         ],



    //         "rowId": "id",

    //     });

    //    $('#status_id').change(function(){
    //         orderTable.draw();
    //    });

    // }); 
    
    $(document).ready(function() {
    $('#example').DataTable({
        'columnDefs': [ {
               'targets': [], // column index (start from 0)
               'orderable': false, // set orderable false for selected columns
         }]
    });
   });




    //Active Inactive status change 
    function StatusChange(id) {

        var Statusvalue = $(".change-status" + id).text();
        if (Statusvalue == 'Active') {
            Statusvalue = "Inactive";
        } else {
            Statusvalue = "Active";
        }

        $.ajax({
            type: 'post',
            url: "{{ route('status.change') }}",
            data: {
                _token: "{{csrf_token()}}",
                'status_id': id,
                'status': Statusvalue
            },

            success: function(data) {
                $('#sumess').html('<div class="alert alert-success alert-block">' +
                    '<button type="button" class="close" data-dismiss="alert">×</button>' +
                    '<strong>' + data + '</strong>' +
                    '</div>').fadeIn('slow');
                if (Statusvalue == 'Active') {
                    $('.changediv' + id).html('<span class="label label-success change-status' + id +
                        '"  onClick="StatusChange(' + id + ')">' + Statusvalue + '</span>').fadeIn(
                        'slow');
                } else {
                    $('.changediv' + id).html('<span class="label label-danger change-status' + id +
                        '"  onClick="StatusChange(' + id + ')">' + Statusvalue + '</span>').fadeIn(
                        'slow');
                }
            }
        });



    }
    </script>



</body>

</html>