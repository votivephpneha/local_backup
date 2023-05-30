<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
        <a href="{{route('dashboard')}}" class="site_title logo"><img src=" {{asset('public/images/logo.png')}}"></a>
            <!-- <a href="{{route('dashboard')}}" class="site_title"><i class="fa fa-paw"></i> <span>Birthday Cards !</span></a> -->
        </div>
        <div class="clearfix"></div>
        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{ asset('public/upload/user').'/'. Session::get('proimg')}}" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Session::get('name')}}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        <br />
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-edit"></i> Card Management <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('cardlist')}}">List</a></li>
                        </ul>
                    </li>
                    <!-- <li><a><i class="fa fa-edit"></i> Custom Card Text <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('textfontlist')}}">Text Font</a></li>
                            <li><a href="{{route('textcolorlist')}}">Text Color</a></li>
                            <li><a href="{{route('textsizelist')}}">Text Size</a></li>
                        </ul>
                    </li> -->
                    <li><a><i class="fa fa-pencil-square"></i> Message Managment <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('messagelist')}}">List</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-user"></i>Customer Management<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('userlist')}}">List</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i>Card Category<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('categorylist')}}">List</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i>Card Sizes<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('cardsizelist')}}">List</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-heart"></i>Favourite Cards<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('favorite-card-list')}}">List</a></li>
                    </ul>
                    </li>
                    <li><a><i class="fa fa-exchange"></i>Order Management<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('order-list')}}">List</a></li>
                    </ul>
                    </li>
                    <!-- <li><a><i class="fa fa-tag"></i>Voucher Codes<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('vouchercodelist')}}">List</a></li>
                    </ul>
                    </li> -->
                    <li><a><i class="fa fa-gbp"></i>Payment History<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('paymentlist')}}">List</a></li>
                    </ul>
                    </li>
                    <li><a><i class="fa fa-edit"></i>Content Management<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('content-pagelist')}}">List</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>