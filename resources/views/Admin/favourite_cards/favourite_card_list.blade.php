<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('public/images/favicon.ico')}}" type="image/ico" />

    <title>Favourite Cards List | BirthCards</title>

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
                <h3>Favourite Cards List</small></h3>
              </div>

              <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Search</button>
                    </span>
                  </div>
                </div>
              </div> -->

            </div>


            <div class="clearfix"></div>

            <div class="row">
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
                      <!-- <a href="" class="btn btn-default" style="background: #2A3F54;color:#FFFFFF"> Add New Sub Category</a> -->
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <!-- <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li> -->
                      <!-- <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li> -->
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content table-responsive">                   
                    <table id="example" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          
                          <th>S.no#</th>
                          <th>Card title</th>
                          <th>User Name</th>
                          <!-- <th>Parent category</th> -->
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if(!$favList->isEmpty())
                        <?php $i =1 ;?>
                        @foreach($favList as $arr)
                        <tr id="row{{ $arr->id }}">
                          <td>{{$i}}</td>
                          <td>{{$arr->card_title}}</td>
                          <td>{{$arr->fname ." ". $arr->lname }}</td>
                          <td>
                          <button class="btn  btn-dark p-2" >
                         <a href="javascript:void(0);" onClick="delete_favcard('{{$arr->favourite_card_id}}')" data-id="{{$arr->favourite_card_id}}" class="text-white delete-favcard{{$arr->favourite_card_id}}" style=" color: #FFFFFF;"><i class="fa fa-trash-o"></i> Delete </button></a>
                          </td>
                        </tr>
                        <?php $i++ ;?>
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
  //   $(document).ready(function () {
  //   $('#example').DataTable({
  //     processing: true,
  //     serverSide: true,
  //     "lengthMenu": [
  //         [10, 20, 50, 100, 500],
  //         [10, 20, 50, 100, 500]
  //     ],

  //     pageLength: 10,
  //     "order": [
  //         [0, "desc"],
  //         [0, 'desc']
  //     ],

  //     ajax: '{{route("get.favouritecardlist")}}',
      
  //     "columns": [
  //             {
  //               "data": "id",
  //               name: 'id',
  //               searchable: false,
  //               visible: false
  //             },
  //             {
  //               "data": "srno",
  //               name: 'srno',
  //               searchable: false,
  //               "orderable": false
  //             },
              
  //             {
  //               "data": "card_title",
  //               "orderable": false
  //             },
  //             {
  //               "data": "user_name",
  //               name: 'user_name',
  //               searchable: false,
  //               "orderable": false
  //             },
              
  //             {
  //               "data": "action",
  //               "orderable": false
  //             }

  //             ],

  //             "rowId": "id",
  //   });
  //  });

$(document).ready(function() {
$('#example').DataTable({
    'columnDefs': [ {
            'targets': [], // column index (start from 0)
            'orderable': false, // set orderable false for selected columns
      }]
});
});

//  delete category
function delete_favcard(id) {
    toastDelete.fire({}).then(function(e) {
        if (e.value === true) {
            var favcardid = $('.delete-favcard' + id).data('id');
            $.ajax({
                type: 'post',
                url: "{{ route('delete.fav.card.post') }}",
                data: {
                    _token: "{{csrf_token()}}",
                    'id': favcardid

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
        // location.reload();
    });
};
   </script>
  
  </body>
</html>