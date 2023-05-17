<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{asset('public/images/favicon.ico')}}" type="image/ico" />

    <title>Text Color List | BirthdayCards</title>

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
                <h3>Text Color List</small></h3>
              </div>

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
                      <a href="{{route('create.textcolor')}}" class="btn btn-default" style="background: #2A3F54;color:#FFFFFF"> Add Color</a>
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
                          <th>Id#</th>
                          <th>S.no#</th>
                          <th>Text message</th>
                          <th>Action</th>
                        </tr>
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
    $(document).ready(function () {
    $('#example').DataTable({
      processing: true,
      serverSide: true,
      "lengthMenu": [
          [10, 20, 50, 100, 500],
          [10, 20, 50, 100, 500]
      ],

      pageLength: 10,
      "order": [
          [0, "desc"],
          [0, 'desc']
      ],

      ajax: '{{route("get.textcolorlist")}}',

      "columns": [
              {
                "data": "id",
                "name": 'id',
                "searchable": false,
                "visible": false
              },
              {
                "data": "srno",
                name: 'srno',
                searchable: false,
                orderable: false
              },

              {
                "data": "color_name",
                orderable: false
              },
              {
                "data": "action",
                orderable: false
              }

              ],

              "rowId": "id",
    });
   });


  //  delete card
   function delete_message(id){
      if(confirm('Are you sure delete this ?')){
         var messid = $('.delete-text-mess'+ id).data('id');

            $.ajax({
            type: 'post',
            url: "{{ route('delete.textcolor.post') }}",
            data: {
              _token : "{{csrf_token()}}",
                 'id' : messid

            },
            success: function(data) {
                  location.reload();
            }
         });
      }
   };
   </script>

  </body>
</html>