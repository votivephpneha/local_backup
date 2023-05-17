<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{asset('public/images/favicon.ico')}}" type="image/ico" />


    <title>@yield('title')</title>

    <!-- Bootstrap -->
    <link href="{{ asset('public/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('public/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('public/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">


    <!-- Custom Theme Style -->
    <link href="{{ asset('public/build/css/custom.min.css')}}" rel="stylesheet">



    @yield('current_page_css')



<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <!-- Sidebar -->
            @include('Admin.layout.sidebar')
            <!-- Navbar Header -->
            @include('Admin.layout.header')



            @yield('content')

            <!-- /.Footer -->
            @include('Admin.layout.footer')

        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('public/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('public/vendors/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    
    <!-- Chart.js -->
    <script src="{{asset('public/vendors/Chart.js/dist/Chart.min.js')}}"></script>    
    <script src="{{asset('public/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script> 
    <!-- Custom Theme Scripts -->
    <script src="{{ asset('public/build/js/custom.min.js') }}"></script>
    <!-- DATA TABLE JS-->
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script>
    setTimeout(function() {
    $('.alert-success').fadeOut('fast');
     }, 1000); //
     
    

    setTimeout(function() {
    $('.alert-danger').fadeOut('fast');
     }, 1000); //
    </script>

    @yield('current_page_js')
</body>

</html>