<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin C-Panel | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('adminlte/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/skins/_all-skins.min.css')}}">
    @yield('Extra_Css')
</head>
<body class="hold-transition skin-black-light sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="" class="logo"> <span class="logo-mini"><b>A</b>LT</span> <span
                    class="logo-lg"><b>Admin</b>C-Panel</span> </a>
        <nav class="navbar navbar-static-top"><a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                        class="icon-bar"></span> <span class="icon-bar"></span> </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu"><a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('images/admin/administrator.png')}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{Auth::user()->email}} </span> </a>
                        <ul class="dropdown-menu">
                            <li class="user-header"><img src="{{asset('images/admin/administrator.png')}}"
                                                         class="img-circle" alt="User Image">
                                <p> {{Auth::user()->email}}
                                    <small>Member since {{Auth::user()->created_at}}</small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left"><a href="#" class="btn btn-default btn-flat">Profile</a></div>
                                <div class="pull-right"><a href="{{route('logout')}}" class="btn btn-default btn-flat">Sign
                                        out</a></div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image"><img src="{{asset('images/admin/administrator.png')}}" class="img-circle"
                                                  alt="User Image"></div>
                <div class="pull-left info">
                    <p>{{Auth::user()->name}}</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a></div>
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                                            class="fa fa-search"></i> </button>
                            </span></div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">MAIN NAVIGATION</li>
                <li class="treeview"><a href="{{route('welcome')}}"> <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span> </a>

                </li>
                <li class="treeview{{isset($active) && $active=='mainCategory'?' active':''}}">
                    <a href="#">
                        <i class="fa fa-files-o"></i>
                        <span>Main Category</span>
                        <span class="pull-right-container">
                            <span class="label label-primary pull-right">{{mainCategoriesAll()->count()}}</span>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{route('mainCategory.index')}}">
                                <i class="fa fa-circle-o"></i> Main Categories Manager
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview{{isset($active) && $active=='category'?' active':''}}">
                    <a href=""> <i class="fa fa-th"></i>
                        <span>Categories</span>
                        <span class="pull-right-container">
                            <small class="label pull-right bg-green">{{categoriesAll()->count()}}</small>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{route('category.index')}}">
                                <i class="fa fa-circle-o"></i> Categories Manager
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview{{isset($active) && $active=='item'?' active':''}}">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>Items</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="{{route('item.index')}}">
                                <i class="fa fa-circle-o"></i> Items Manager
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="treeview"><a href="#"> <i class="fa fa-laptop">
                        </i> <span>Topics</span> <span class="pull-right-container"> <i
                                    class="fa fa-angle-left pull-right"></i> </span> </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ route('Topics.index') }}"><i class="fa fa-circle-o"></i> Topics Manger</a></li>
                    </ul>
                </li>
                <li class="treeview"><a href="{{route('Transfers.index')}}"> <i class="fa fa-car"></i>
                        <span>Transfer</span> </a>

                </li>
                <li class="treeview"><a href="{{route('Reservation.index')}}"> <i class="fa fa-cart-arrow-down"></i>
                        <span>Reservation</span> </a>

                </li>
                <li class="treeview"><a href="#"> <i class="fa fa-cog"></i> <span>Setting</span> <span
                                class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                    <ul class="treeview-menu">
                        <li><a href=""><i class="fa fa-circle-o"></i> Admin Profile</a></li>
                        <li><a href="{{ route('Paypal.index') }}"><i class="fa fa-circle-o"></i>PayPal Settings</a></li>
                        <li><a href="{{ route('leftsSide.index') }}"><i class="fa fa-circle-o"></i>Left Side Icons</a>
                        </li>
                        <li><a href="{{ route('vars.index') }}"><i class="fa fa-circle-o"></i>Languages</a></li>

                    </ul>
                </li>


            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <!-- Body Content -->
@yield('content')
<!-- end Body Content -->
    <!-- footer -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs"><b>Version</b> 2.3.7</div>
        <strong>Copyright &copy; 2016 <a href="mialto:info.matrixcode@gmail.com"> Matrix Code Micro
                Systems</a>.</strong> All rights
        reserved.
    </footer>
    <!-- end footer -->
    <div class="control-sidebar-bg"></div>
</div>
<script src="{{asset('adminlte/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<script src="{{asset('adminlte/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/fastclick/fastclick.js')}}"></script>
<script src="{{asset('adminlte/dist/js/app.min.js')}}"></script>


@yield('Extra_Js')
</body>
</html>
