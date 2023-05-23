<!DOCTYPE html>

<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Meta, title, CSS, favicons, etc. -->

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('public/images/favicon.ico')}}" type="image/ico" />
    <title>Payment History | BirthdayCards</title>
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

                            <h3>Payment History</small></h3>

                        </div>
                        <div class="title_right">
                            <!-- <div class="col-md-5 col-5 col-xs-12m pull-right top_search">
                                <ul class="breadcrumb">
                                    <li><a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard"></i>Home</a>
                                    </li>
                                 <li><a href="{{url('admin/payment-list') }}"></i>Payment History</a></li> -->
                            <!-- <li class="active"> Payment History</li>
                                </ul> -->
                            <!-- </div> -->
                        </div>


                    </div>





                    <div class="clearfix"></div>



                    <div class="row">



                        <div id="sumess"></div>



                        @if(Session::has('success'))

                        <div class="alert alert-success alert-block">

                            <button type="button" class="close" data-dismiss="alert">×</button>

                            <strong>{{ Session::get('success')}}</strong>

                        </div>

                        @endif

                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <div class="x_panel">

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
                                                <!-- <th>id#</th> -->
                                                <th>S.no#</th>
                                                <th>Transaction Id</th>
                                                <th>Order Id</th>
                                                <th>Customer</th>
                                                <th>Amount</th>
                                                <th>Payment Status</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if (!$payhisList->isEmpty())
                                        <?php $i = 1; ?>
                                        @foreach ($payhisList as $arr)
                                         <tr id="row{{ $arr->id }}">
                                            <td>{{ $i }}</td>
                                            <td>{{$arr->transaction_id}}</td>
                                            <td>{{$arr->order_id1}}</td>
                                            <td>{{$arr->firstname ." ". $arr->lastname}}</td>
                                            <td>${{number_format($arr->total_amount, 2)}}</td>
                                            <td>{{$arr->payment_status}}</td>
                                            <td>{{date('Y-m-d', strtotime($arr->created_at))}}</td>
                                            <td><button class="btn btn-dark p-2">
                                            <a href="{{route('view.payment.detail',[$arr->id])}}" class="text-white" style=" color: #FFFFFF;"><i class="fa fa-eye" ></i>View</button></a></td>
                                         </tr>
                                        @endforeach 
                                        @endif
                                        </tbody>
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

    //     $('#example').DataTable({

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



    //         ajax: '{{route("get.paymentranstlist")}}',



    //         "columns": [{
    //                 "data": "id",

    //                 "name": 'id',

    //                 "searchable": false,

    //                 "visible": false,

    //                 orderable: false

    //             },
    //             {

    //                 "data": "srno",

    //                 name: 'srno',

    //                 searchable: false,

    //                 orderable: false

    //             },
    //             {

    //                 "data": "trans_id",

    //                 "name": 'trans_id',

    //                 "searchable": false,

    //                 "visible": true,

    //                 orderable: false


    //             },

    //             {

    //                 "data": "order_id",

    //                 name: 'order_id',

    //                 searchable: false,

    //                 orderable: false

    //             },
    //             {

    //                 "data": "customer",

    //                 orderable: false



    //             },

    //             {

    //                 "data": "amount",

    //                 name: 'amount',

    //                 searchable: false,

    //                 "orderable": false

    //             },



    //             {

    //                 "data": "payment_status",

    //                 orderable: false

    //             },
    //             {

    //                 "data": "date",

    //                 orderable: false

    //             },

    //             {

    //                 "data": "action",

    //                 orderable: false

    //             }
    //         ],
    //         "rowId": "id",
    //     });

    // });

    $(document).ready(function() {
    $('#example').DataTable({
    'columnDefs': [{
            'targets': [], // column index (start from 0)
            'orderable': false, // set orderable false for selected columns
        }]
    });
    });

//  delete card
 function check(id) {
     if (confirm('Are you sure delete this card ?')) {
         var cardid = $('.delete-card' + id).data('id');
         $.ajax({
             type: 'post',
             url: "{{ route('delete.card.post') }}",
             data: {
                 _token: "{{csrf_token()}}",
                 'id': cardid
             },
             success: function(data) {
                 location.reload();
             }

         });

     }

 };

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