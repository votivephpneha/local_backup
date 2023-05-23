<!DOCTYPE html>

<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Meta, title, CSS, favicons, etc. -->

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('public/images/favicon.ico')}}" type="image/ico" />
    <title>Cards List | BirthdayCards</title>
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
                            <h3>Cards List</small></h3>
                        </div>

                    </div>
                    <div class="clearfix"></div>

                    <div class="row">


                        <div id="sumess1"></div>
                        <div id="sumess"></div>

                        @if(Session::has('success'))
                        <div class="alert alert-success alert-block">

                            <button type="button" class="close" data-dismiss="alert">×</button>

                            <strong>{{ Session::get('success')}}</strong>

                        </div>
                        @elseif(Session::has('failed'))
                        <div class="alert alert-danger alert-block">

                            <button type="button" class="close" data-dismiss="alert">×</button>

                            <strong>{{ Session::get('failed')}}</strong>

                        </div>
                        @endif

                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <div class="x_panel">

                                <div class="x_title">



                                    <ul class="nav navbar-right panel_toolbox">

                                        <a href="{{route('create.card')}}" class="btn btn-default"
                                            style="background: #2A3F54;color:#FFFFFF"> Add New Card</a>

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

                                                <th>Ids</th>

                                                <th>Title</th>

                                                <th>Image</th>

                                                <!-- <th>Price</th> -->

                                                <th>Status</th>

                                                <th>Action</th>

                                            </tr>

                                        </thead>
                                        <tbody>
                                            @if (!$cardList->isEmpty())
                                            <?php $i = 1; ?>
                                            @foreach ($cardList as $arr)
                                            <tr id="row{{ $arr->id }}">
                                                <td>{{ $i }}</td>
                                                <td>{{ $arr->id }}</td>
                                                <td>{{ $arr->card_title }}</td>
                                                <td><img src="{{url('public/upload/cards').'/'.$arr->card_image}}"
                                                        height="55" width="55"></td>
                                                <td class="project-state">
                                                    @if($arr->status == "Active")
                                                    <div class="changediv{{$arr->id}} status-change"><button
                                                            type="button"
                                                            class="btn btn-success change-status{{$arr->id}}"
                                                            onClick="StatusChange('{{$arr->id}}')">{{$arr->status}}</button>
                                                    </div>
                                                    @else
                                                    <div class="changediv{{$arr->id}} status-change"><button
                                                            type="button"
                                                            class="btn btn-danger change-status{{$arr->id}}"
                                                            onClick="StatusChange('{{$arr->id}}')">{{$arr->status}}</button>
                                                    </div>
                                                    @endif
                                                </td>
                                                <td class=" align-middle">
                                                    <button class="btn btn-dark p-2">
                                                        <a href="{{route('edit.card',[$arr->id])}}" class="text-white"
                                                            style=" color: #FFFFFF;"><i
                                                                class="fa fa-edit"></i>Edit</button></a>
                                                    <button class="btn btn-dark p-2">
                                                        <a href="{{route('view.card',[$arr->id])}}" class="text-white"
                                                            style=" color: #FFFFFF;"><i
                                                                class="fa fa-eye"></i>View</button></a>
                                                    <button class="btn  btn-dark p-2">
                                                        <a href="javascript:void(0);" onClick="check('{{$arr->id}}')"
                                                            data-id="{{$arr->id}}"
                                                            class="text-white delete-card{{$arr->id}}"
                                                            style=" color: #FFFFFF;"><i class="fa fa-trash-o"></i>
                                                            Delete </button></a>
                                                </td>
                                            </tr>

                                            <?php $i++; ?>

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



//         ajax: '{{route("get.cardlist")}}',



//         "columns": [



//             {

//                 "data": "srno",

//                 name: 'srno',

//                 searchable: false,

//                 orderable: false

//             },
//             {

//                 "data": "id",

//                 "name": 'id',

//                 "searchable": false,

//                 "visible": true,

//                 orderable: false


//             },

//             {

//                 "data": "title",

//                 name: 'title',

//                 searchable: false,

//                 orderable: false

//             },



//             {

//                 "data": "image",

//                 orderable: false



//             },

//             // {

//             //     "data": "price",

//             //     name: 'price',

//             //     searchable: false,

//             //     "orderable": false

//             // },



//             {

//                 "data": "status",

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
        'columnDefs': [ {
               'targets': [], // column index (start from 0)
               'orderable': false, // set orderable false for selected columns
         }]
    });
});

//  delete card
function check(id) {

// if (confirm('Are you sure delete this card ?')) {
toastDelete.fire({

}).then(function(e) {

    if (e.value === true) {
        var cardid = $('.delete-card' + id).data('id');
        $.ajax({
            type: 'post',
            url: "{{ route('delete.card.post') }}",
            data: {
                _token: "{{csrf_token()}}",
                'id': cardid
            },
            success: function(data) {

                const obj = JSON.parse(data);
                console.log(obj.msg);
                $("#row" + id).remove();
                success_noti(obj.msg);
                // location.reload();
            }

        });

    } else {

        e.dismiss;

    }
}, function(dismiss) {

    return false;

});
// }

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

        // $('#sumess').fadeIn().html('<div class="alert alert-success alert-block">' +

        //     '<button type="button" class="close" data-dismiss="alert">×</button>' +

        //     '<strong>' + data + '</strong>' +

        //     '</div>');

        // setTimeout(function() {

        //     $('#sumess').fadeOut("slow");

        // }, 300);

        success_noti(data);
        if (Statusvalue == 'Active') {

            $('.changediv' + id).html('<button type="button" class="btn btn-success change-status' +
                id +
                '"  onClick="StatusChange(' + id + ')" >' + Statusvalue + '</button>');

        } else {

            $('.changediv' + id).html('<button type="button" class="btn btn-danger change-status' +
                id +
                '"  onClick="StatusChange(' + id + ')" >' + Statusvalue + '</button>');
        }
    },
    error: function(errorData) {

        console.log(errorData);

        alert('Please refresh page and try again!');

    }

});

}
</script>



</body>

</html>