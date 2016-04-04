<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('assets/admin/bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/admin/dist/css/AdminLTE.min.css')}}">
    <!-- My Css-->

    <link rel="stylesheet" type="text/css" href="{{asset('assets/jquery-ui/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/dist/css/skins/skin-blue.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
      .backtoback{
        margin-bottom: .5em;
      }
    </style>
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="{{url('kitchen')}}" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>Dπ</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Admin </b>Digino's Pizza</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                
                  <!-- The user image in the navbar-->
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <a href="{{url('kitchen/logout')}}">Logout</a>
                <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown"></a>-->
              </li>
              <li>
                {{-- <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> --}}
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li id="dashboard">
              <a href="{{url('kitchen')}}">
                <i class="fa fa-tachometer">
                </i>
                <span>Dashboard
                </span>
              </a>
            </li>

            <li id="items">
              <a href="{{url('kitchen/items')}}">
                <i class="fa fa-cutlery">
                </i>
                <span>Items
                </span>
              </a>
            </li>
            
            <li id="users">
              <a href="{{url('kitchen/users')}}">
                <i class="fa fa-group">
                </i>
                <span>Users
                </span>
              </a>
            </li>
            
            <li id="category" class="treeview"> <!-- class="active" -->
              
              <a href="#">
                <i class="fa fa-tag">
                </i>
                <span>Category
                </span>
                <i class="fa fa-angle-left pull-right">
                </i>
              </a>

              <ul  class="treeview-menu">
                <li id="categories"> <!-- class="active" -->
                  <a href="{{url('kitchen/categories')}}">Categories
                  </a>
                </li>
                <li id="groups">
                  <a href="{{url('kitchen/groups')}}">Groups
                  </a>
                </li>
                <!-- <li>
                  <a href="{{url('kitchen/choose_category')}}">Choose
                  </a>
                </li> -->  

              </ul>
              
            </li>

            <li id="orders">
              <a href="{{url('kitchen/orders')}}">
                <i  class="fa fa-shopping-cart">
                </i>
                <span>Orders
                </span>
              </a>
            </li>


            <li id="coupons">
              <a href="{{url('kitchen/coupons')}}">
                <i  class="fa fa-money">
                </i>
                <span>Coupons
                </span>
              </a>
            </li>

            <li id="config">
              <a href="{{url('kitchen/config')}}">
                <i  class="fa fa-gear">
                </i>
                <span>Config
                </span>
              </a>
            </li>

            <li id="email">
              <a href="{{url('kitchen/emails')}}">
                <i  class="fa fa-envelope-o">
                </i>
                <span>Emails
                </span>
              </a>
            </li>

            <li id="logs">
              <a href="{{url('kitchen/logs')}}">
                <i  class="fa fa-book">
                </i>
                <span>Logs
                </span>
              </a>
            </li>



            </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        

        <!-- Main content -->
        <section class="content">
                @yield('content')
          </div>
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="#">Company</a>.</strong> All rights reserved.
      </footer>


      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('assets/admin/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('assets/admin/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/admin/dist/js/app.min.js')}}"></script>

    <!-- My Js -->

    <script src="{{asset('assets/admin/plugins/chartjs/Chart.min.js')}}"></script>

    <script src="{{asset('assets/jquery-ui/jquery-ui.min.js')}}"></script>
    
    @yield('script')
  
  </body>
</html>
