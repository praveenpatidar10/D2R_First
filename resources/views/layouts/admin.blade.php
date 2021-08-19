<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>DFB CENTERAL| {{$title}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}" type="text/css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}" type="text/css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}" type="text/css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('admin/plugins/jqvmap/jqvmap.min.css')}}" type="text/css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}" type="text/css">
   <link rel="stylesheet" href="{{asset('js/jquery-ui/jquery-ui.min.css')}}">
  <!-- overlayScrollbars --> 
  <link rel="stylesheet" href="{{asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}" type="text/css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('admin/plugins/daterangepicker/daterangepicker.css')}}" type="text/css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('admin/plugins/summernote/summernote-bs4.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('admin/plugins/select2/css/select2.min.css')}}" type="text/css">
   <!-- DataTables -->
   <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="{{asset('admin/plugins/ekko-lightbox/ekko-lightbox.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('js/toastr/toastr.min.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('js/confirm/css/jquery-confirm.css')}}" type="text/css">
  <link rel="stylesheet" href="{{asset('admin/plugins/datetimePicker/jquery.datetimepicker.css')}}" >
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
      .error{
            color: red;
            font-size: 14px;
            font-weight: normal;
        }
      .jconfirm .jconfirm-box div.jconfirm-content-pane .jconfirm-conten{
          overflow-x: hidden !important;
      }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    

    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i> {{ Auth::user()->name }}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
          <div class="dropdown-divider"></div>
          <a  class="dropdown-item dropdown-footer" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">Logout</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      
      <span class="brand-text font-weight-light">DBF CENTRAL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         
          <li class="nav-item">
            <a href="{{url('admin/dashboard')}}" class="nav-link <?=($Link=='Dashoard')?'active':'';?>" >
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p> Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/blogs')}}" class="nav-link <?=($Link=='blogs')?'active':'';?>">
              <i class="fas fa-blog nav-icon"></i>
              <p>Blogs Management</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/events')}}" class="nav-link <?=($Link=='events')?'active':'';?>">
              <i class="fas fa-calendar-alt nav-icon"></i>
              <p>Events Management</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/collaborators')}}" class="nav-link <?=($Link=='collaborators')?'active':'';?>">
              <i class="nav-icon far fa-user"></i>
              <p class="text">Collaborators Management</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/subscribers')}}" class="nav-link <?=($Link=='subscriber')?'active':'';?>">
              <i class="nav-icon far fa-user"></i>
              <p class="text">Subscriber Management</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/ministries')}}" class="nav-link <?=($Link=='ministries')?'active':'';?>">
              <i class="nav-icon fas fa-hand-holding-heart"></i>
              <p class="text">Ministries Management</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/galleries')}}" class="nav-link <?=($Link=='galleries')?'active':'';?>">
              <i class="nav-icon fas fa-images"></i>
              <p class="text">Gallery Management</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/groups')}}" class="nav-link <?=($Link=='groups')?'active':'';?>">
              <i class="nav-icon fas fa-layer-group"></i>
              <p class="text">Groups Management</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/templates')}}" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>Email Management</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/mail-box')}}" class="nav-link">
              <i class="nav-icon fas fa-mail-bulk"></i>
              <p>Send Mail</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('admin/settings')}}" class="nav-link <?=($Link=='settings')?'active':'';?>">
              <i class="nav-icon fas fa-cogs"></i>
              <p>Settings</p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{$title}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">{{$title}}</a></li>
              <li class="breadcrumb-item active">{{$subtitle}}</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
          @yield('content')
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; {{date('Y')}} <a href="">DBF CENTRAL</a>.</strong>
  <!--  All rights reserved.-->
  <!--  <div class="float-right d-none d-sm-inline-block">-->
  <!--    <b>Version</b> 3.0.0-->
  <!--  </div>-->
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('js/jquery/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/jquery/jquery.validate.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('js/jquery-ui/jquery-ui.min.js')}}" type="text/javascript"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script type="text/javascript">
  
 </script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
<!-- ChartJS -->
<script src="{{asset('admin/plugins/chart.js/Chart.min.js')}}" type="text/javascript"></script>
<!-- Sparkline -->
<script src="{{asset('admin/plugins/sparklines/sparkline.js')}}" type="text/javascript"></script>
<!-- JQVMap -->
<script src="{{asset('admin/plugins/jqvmap/jquery.vmap.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js')}}" type="text/javascript"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('admin/plugins/jquery-knob/jquery.knob.min.js')}}" type="text/javascript"></script>
<!-- daterangepicker -->
<script src="{{asset('admin/plugins/moment/moment.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}" type="text/javascript"></script>

<!-- overlayScrollbars -->
<script src="{{asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.js')}}" type="text/javascript"></script>
<script src="{{asset('js/toastr/toastr.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/confirm/js/jquery-confirm.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/plugins/datetimePicker/php-date-formatter.min.js')}}"></script>
<script src="{{asset('admin/plugins/datetimePicker/jquery.datetimepicker.js')}}"></script>
<script src="{{asset('admin/plugins/select2/js/select2.full.min.js')}}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="{{asset('admin/dist/js/pages/dashboard.js')}}"></script>-->
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}" type="text/javascript"></script>
<!-- Summernote -->
<script src="{{asset('admin/plugins/summernote/summernote-bs4.min.js')}}" type="text/javascript"></script>
<!-- DataTables -->
<script type="text/javascript"> var base_url = "{{url('/')}}"; </script>  
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}" type="text/javascript"></script>
    @isset($scripts)
         @foreach($scripts as $_script)
            <script src="{{$_script}}" type="text/javascript"></script> 
         @endforeach
        @endisset
</body>

</html>
