<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="base_url" content="{{url()}}">
  <meta name="author" content="Víctor Manuel Gutiérrez Carrilo, Raul Ochoa Álvarez, Alan Sinue Pastor Piña">
  <title>@yield('titulo','Sistema de Información Ejecutiva')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dist/css/AdminLTE.min.css')}}">
  <!-- <link rel="stylesheet" href="{{asset('assets/css/common/commonS.css')}}"> -->

  <link href="//cdn.bootcss.com/animate.css/3.4.0/animate.css" rel="stylesheet">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
        -->
        <link rel="stylesheet" href="{{asset('assets/dist/css/skins/skin-black.min.css')}}">
        @yield('link')

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
      </head>
  <!--
  BODY TAG OPTIONS:
  =================
  Apply one or more of the following classes to get the
  desired effect
  |---------------------------------------------------------|
  | SKINS         | skin-blue                               |
  |               | skin-black                              |
  |               | skin-purple                             |
  |               | skin-yellow                             |
  |               | skin-red                                |
  |               | skin-green                              |
  |---------------------------------------------------------|
  |LAYOUT OPTIONS | fixed                                   |
  |               | layout-boxed                            |
  |               | layout-top-nav                          |
  |               | sidebar-collapse                        |
  |               | sidebar-mini                            |
  |---------------------------------------------------------|
-->
<body class="hold-transition skin-black sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="{{url()}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>BRE</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Gestor </b>BRE</span>
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
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <!-- <img src="{{asset('assets/dist/img/user3-128x128.jpg')}}" class="user-image" alt="User Image"> -->
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">Anonymous</span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <!-- <img src="{{asset('assets/dist/img/user3-128x128.jpg')}}" class="img-circle" alt="User Image"> -->
                  <p>
                   Raúl Ochoa - Desarrollador Web Front-End
                   Víctor Carrillo - Desarrollador Web
                   Alan Sinue - Desarrollador Web
                   <small>{{date('d/m/Y')}}</small>
                 </p>
               </li>
               <!-- Menu Body -->
                 <!--  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li> -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <!-- <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div> -->
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Cerrar Sesión</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQUFl1aNkAqY0p6YMOyQKIpw-13fG99eQFZWHYDQrNfm3C7ZJQsqA" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Anonymous</p>
              <!-- Status -->
            </div>
          </div>

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">MENÚ</li>
            <!-- Optionally, you can add icons to the links -->
            <!-- Recuerda agergar class="active" -->
             <li class="treeview">
              <a href="#"><i class="fa fa-search"></i> <span>Consultas</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{url('consulta/documento.html')}}">Documentos</a></li>
                <li><a href="{{url('consulta/epa.html')}}">EPA's</a></li>
              </ul>
            </li>
            <li><a href="{{url('reuniones.html')}}"><i class="fa fa-group"></i> <span>Reuniones</span></a></li>
            <li><a href="{{url('archivos.html')}}"><i class="fa fa-file-pdf-o"></i> <span>Documentos</span></a></li>
            <li><a href="{{url('inegi.html')}}"><i class="fa fa-bar-chart"></i> <span>INEGI </span></a></li>
            <li><a href="{{url('videos.html')}}"><i class="fa fa-video-camera"></i> <span>Videos Aguascalientes</span></a></li>
            <li><a href="{{url('dependencias.html')}}"><i class="fa fa-institution"></i> <span>Dependencias</span></a></li>
            
            <li><a href="{{url('sectores.html')}}"><i class="fa fa-sitemap"></i> <span>Sectores</span></a></li>
            <li class="treeview">
              <a href="#"><i class="fa fa-black-tie"></i> <span>Directorio</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{url('contactos.html')}}">Administración</a></li>
                <!-- <li><a href="#">Contactos</a></li> -->
               <!--  <li><a href="#">Anfitriones</a></li>
                <li><a href="#">Responsables EPA's</a></li> -->
              </ul>
            </li>
            <!-- <li><a href="{{url('usuarios.html')}}"><i class="fa fa-user"></i> <span>Usuarios </span></a></li> -->
          </ul><!-- /.sidebar-menu -->
          <div class="container-logo-estado">
            <img src="{{asset('assets/images/escudocolima.png')}}" alt="" class="img-responsive">
          </div>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <a href="{{url()}}"><span class="fa fa-home"></span></a>@yield('page_header','page_header')
            <small>@yield('desc_opc','desc_opc')</small>
          </h1>
          <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
          </ol> -->
        </section>

        <!-- Main content -->
        <section class="content">
          @yield('contenido')
          <!-- Your Page Content Here -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          <div class="container-logo">
            <img src="{{asset('assets/images/devcraft.png')}}" alt="" class="logo-devcraft">
          </div>
          @yield('pull-right','')
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; {{date('Y')}} <a href="#">ITC</a>.</strong> Todos los derechos reservados.
      </footer>

      
      <!-- Add the sidebar's background. This div must be placed
      immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="{{asset('assets/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets/dist/js/app.min.js')}}"></script>
    @yield('js')

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
       </body>
       </html>