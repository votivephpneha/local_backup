<div class="col-md-3 left_col">

          <div class="left_col scroll-view">

            <div class="navbar nav_title" style="border: 0;">

              <a href="{{route('dashboard')}}" class="site_title"><i class="fa fa-paw"></i> <span>Birthday Cards !</span></a>

            </div>



            <div class="clearfix"></div>



            <!-- menu profile quick info -->

            <div class="profile clearfix">

              <div class="profile_pic">

                <img src="{{ asset('public/images/img.jpg')}}" alt="..." class="img-circle profile_img">

              </div>

              <div class="profile_info">

                <span>Welcome,</span>

                <h2>{{ Session::get('name')}}</h2>

              </div>

            </div>

            <!-- /menu profile quick info -->



            <br />



          <!-- sidebar menu -->

          @include('Admin.template.sidebar')

          <!-- /sidebar menu -->



            <!-- /menu footer buttons -->

            <div class="sidebar-footer hidden-small">

              <!-- <a data-toggle="tooltip" data-placement="top" title="Settings">

                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>

              </a>

              <a data-toggle="tooltip" data-placement="top" title="FullScreen">

                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>

              </a>

              <a data-toggle="tooltip" data-placement="top" title="Lock">

                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>

              </a>

              <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">

                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>

              </a> -->

            </div>

            <!-- /menu footer buttons -->

          </div>

        </div>