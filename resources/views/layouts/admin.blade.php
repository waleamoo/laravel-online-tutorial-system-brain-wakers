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
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ URL::to('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::to('/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/dist/css/skins/_all-skins.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ URL::to('/dist/css/AdminLTE.min.css') }}">    
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ URL::to('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  </head>
<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
  <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b><img src="{{ URL::to('images/logo.png') }}" style="border-radius: 30px;" width="100%" height="auto" class="img-responsive"></b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b><img src="{{ URL::to('images/logo.png') }}" style="border-radius: 30px;" width="100%" height="auto" class="img-responsive"></b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel (optional) -->
      
      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">What to do?</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        <li class="active"><a href="{{ route('admin.addCourse') }}"><i class="fa fa-pie-chart"></i> <span>Course</span></a></li>
        <li class="active"><a href="{{ route('admin.comment') }}"><i class="fa fa-comment"></i> <span>Comments</span></a></li>
        <li class="active"><a href="{{ route('admin.lecture') }}"><i class="fa fa-plus-square"></i> <span>Lecture</span></a></li>
        <!--<li class="active"><a href="#"><i class="fa fa-book"></i> <span>Orders</span></a></li>
        <li class="active"><a href="#"><i class="fa fa-user"></i> <span>User</span></a></li>
        <li class="active"><a href="#"><i class="fa fa-registered"></i> <span>Admin</span></a></li>-->
        <li class="active"><a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
        <!--
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li> -->
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Main content -->
    <section class="content container-fluid">

        @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      The Brain Wakers Team
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date('Y'); ?> Brain Wakers Inc.</strong> All rights reserved.
  </footer>
</div>
<script src="{{ URL::to('/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ URL::to('/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ URL::to('/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<!-- ChartJS -->
<script src="{{ URL::to('/bower_components/chart.js/Chart.js') }}"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="{{ URL::to('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ URL::to('/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ URL::to('/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::to('/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ URL::to('/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ URL::to('/dist/js/demo.js') }}"></script>
<!-- CK Editor -->
<script src="{{ URL::to('/bower_components/ckeditor/ckeditor.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ URL::to('/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ URL::to('/js/Chart.min.js') }}"></script>
<script src="{{ URL::to('/js/create-chart.js') }}"></script>
<script>
  // dynamic dropdown 
  $('.dynamic').change(function(){
    if($(this).val() != ''){
      var select = $(this).attr('id'); // subject
      var value = $(this).val(); // 1
      var dependent = $(this).data('dependent'); // course
      //var _token = $('input[name="_token"]').val();
      //alert(select + ' ' + value + ' ' + dependent );
      $.ajax({
        url: "{{ route('admin.dynamic') }}",
        method: "GET",
        data: {select:select, value:value, dependent:dependent},
        success:function(result){
          $('#'+dependent).html(result);
        }
      })
    }
      //alert('hello');
    });

    $('.dynamic').change(function(){
    if($(this).val() != ''){
      var select = $(this).attr('id'); // subject
      var value = $(this).val(); // 1
      var dependent = $(this).data('dependent'); // course
      $.ajax({
        url: "{{ route('admin.dynamicTopic') }}",
        method: "GET",
        data: {select:select, value:value, dependent:dependent},
        success:function(result){
          $('#topics'+dependent).html(result);
        }
      })
    }
    });

</script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
</body>
</html>