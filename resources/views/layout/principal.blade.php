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
	<title>@yield('titulo','Gestor de enfoque')</title>
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
				<span class="logo-mini"><b>ECA</b></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>Enfoque </b>Colimas</span>
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
						<li ><a href="{{url('admin/')}}"><i class="fa fa-home"></i> <span>Home</span> </a> </li>
						<li ><a href="{{url('admin/galerias.html')}}"><i class="fa fa-image"></i> <span>Galerías</span> </a> </li>
						<li>
							<a href="{{url('admin/tipogaleria.html')}}"><i class="fa fa-group "></i> <span>Categorías</span> </a>
						</li>
						<li>
							<a href="{{url('admin/publicidad.html')}}"><i class="fa fa-bullhorn "></i> <span>Publicidades</span> </a>
						</li>
						<li>
							<a href="{{substr( url(),0)}}:2095" target="target_blank"><i class="fa fa-envelope-o "></i> <span>Correo</span> </a>
						</li>
					</ul>
				</li>

			</ul><!-- /.sidebar-menu -->
		</section>
		<!-- /.sidebar -->
	</aside>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
					</h1>
					
				</section>

				<!-- Main content -->
				<section class="content">
					@yield('contenido')
					<!-- Your Page Content Here -->
					<div class="row ">
						<div class="  overlay-modals animated zoomIn">
							<div class="modals-- modal-gallery  animated">
								<div class="header-modal"><h4>Agregar Galería</h4></div>
								<div class="body-modal">
									<form action="">
										<div class="form-group">
											<label for="nombre">
												Nombre 
											</label>
											<input class="input-form title-galeria" type="text">
										</div>
										<div class="form-group">
											<label for="nombre">
												Descripción 
											</label>
											<textarea class="input-form descripcion-galeria" name="" id="" cols="10" rows="4"></textarea>
										</div>
										<div class="form-group">
											<select name="" id="" class=" input-form tipo-galeria">
												<option value="">Seleccione una opción</option>
												@if(isset($categorias))
												@foreach($categorias as $val)
												<option value="{{$val->id}}" >{{$val->nombre}}</option>
												@endforeach
												@endif  
											</select>
										</div>
									</form>
								</div>
								<div class="footer-modal">
									<div class="btn btn-save-- save-galeria" data-validation=".modal-gallery"data-step=".modal-choose-portada"><strong>Guardar</strong></div>
									<div class="btn btn-cancel-- cancel-gallery" data-clean=".modal-gallery"><strong>Cancelar</strong></div>
								</div>
							</div>
							<div class="modals-- modal-choose-portada  animated">
								<div class="header-modal"><h4>Portada de la Galería</h4></div>
								<div class="body-modal">
									<form action="" id="form-portada-album" enctype="multipart/form-data">
										<input type="hidden" name="_method" value="PUT" id="metodo-portada"><input type="hidden" name="_token" value="{{ csrf_token() }}">
										<input type="hidden" name="id_galeria" value="" class="id_galeria--">
										<div class="form-group">
											<label for="portada">
												Escoge una portada para tu album
											</label>
											<input class="input-form file-hidden" id="portada-album" type="file" name="portada">
											<div class="container-choose unchoose">
												<div class="container-icon center-porcent"><span class="fa fa-image"></span></div>
												<p></p>
											</div>
										</div>
										
									</form>
									<div class="progress-container">
										<div class="progress-bar--"></div>
									</div>
								</div>
								<div class="footer-modal">
									<button type="button" class="btn btn-save-- save-portada"data-validation=".modal-choose-portada" data-step=".modal-youtube"><strong>Guardar</strong></button>
									<button type="button" class="btn btn-cancel-- cancel-gallery" data-clean=".modal-choose-portada"><strong>Cancelar</strong></button>
								</div>
							</div>
							<div class="modals-- modal-youtube  animated">
								<div class="header-modal">
									<h4>
										<span class="fa fa-youtube"></span> Videos
									</h4>
								</div>
								<div class="body-modal">
									<form action="">
										<div class="form-group">
											<div class="youtube-container">
												<div class="form-group">
													<label for="">Título</label>
													<input class="input-form form-control title-video" type="text">
													<input class="input-form form-control url-video" type="text" placeholder="URL del video">
													<button type="button" class="btn btn-default btn-add-youtube">Agregar</button type="button">
												</div>
												<div class="container-videos">
												</div>
											</div>
										</div>
											
									</form>
								</div>
								<div class="footer-modal">
									<div class="btn btn-save-- save-videos"data-validation=".dropable-container" data-step=".modal-dropable">
										<strong>Guardar</strong>
									</div>
									<div class="btn btn-cancel-- cancel-gallery" data-clean="">
										<strong>Cancelar</strong>
									</div>
								</div>
							</div>
							<div class="modals-- modal-dropable  animated">
								<div class="header-modal"><h4>Imagenes</h4></div>
								<div class="body-modal">
									<div class="content-options-edit">
										<div class="option-delete-images options-edit animated">
											<div class="container-icon">
												<span class="icons ion-ios-trash-outline"></span>
											</div>
											<div class="text-option">
												<strong class="center-porcent"> ELIMINAR </strong>
											</div>
										</div>
										<div class="option-save-images options-edit animated">	
											<div class="container-icon">
												<span class="icons ion-checkmark"></span>
											</div>
											<div class="text-option">
												<strong class="center-porcent"> LISTO! </strong>
											</div>
										</div>
									</div>
									<form action="">

										<div class="form-group">
											<div class="drop-images ">

												<div class="circle-effect center-porcent">
													<div class="container-icon center-porcent">
														<span class="fa fa-image"></span>
														<p>Arrastra las fotos Aquí</p>
													</div>
												</div>
											</div>
										</div>

									</form>
									<p class="cant-new-imagenes"></p>
									<div class="progress-container">
										<div class="progress-bar--"></div>
									</div>
								</div>
								<div class="footer-modal">
									<div class="btn btn-save-- save-imagenes"data-validation=".dropable-container" data-step=""><strong>Guardar</strong></div>
									<div class="btn btn-cancel-- cancel-gallery" data-clean=""><strong>Cancelar</strong></div>
								</div>
							</div>
							<div class="modals-- modal-categoria  animated">
								<div class="header-modal"><h4>Nueva Categoría</h4></div>
								<div class="body-modal">
									<form action="" id="form-publicity">

										<div class="form-group">
											<div class="form-group">
												<label for="">Nombre</label>
												<input class="input-form form-control nombre-categoria" type="text">
											</div>
										</div>
									</form>
								</div>
								<div class="footer-modal">
									<div class="btn btn-save-- save-categoria"data-validation=".dropable-container" data-step=".modal-dropable"><strong>Guardar</strong></div>
									<div class="btn btn-cancel-- cancel-categoria" data-clean=""><strong>Cancelar</strong></div>
								</div>
							</div>
							<div class="modal-publicidad modals--">
								<div class="header-modal"><h4>Publicidad</h4></div>
								<div class="body-modal">
									<form action="">
										<div class="step1 steps-- active animated ">
											<div class="form-group">
												<label for="">Nombre del cliente</label>
												<input class="input-form form-control nombre-cliente" type="text">
											</div>

											<div class="form-group">
												<label for="">Categoría</label>
												<select name="categoria" class=" input-form  categoria-publicidad" id="">
													<option value="">Seleccione una opción</option>
													<option value="-1">Slider</option>
													<option value="0">Página principal</option>
													@if(isset($categorias))
														@foreach($categorias as $val)
															<option value="{{$val->id}}">{{$val->nombre}}</option>
														@endforeach
													@endif
												</select>
											</div>
											<div class="form-group form-position-slider">
												<label for="">Posición en el slider</label>
												<input class="input-form form-control posicion-slider" type="number" max="7" min="2" onlyread="true">
											</div>
											<div class="form-group">
												<label for="">Link</label>
												<input class="input-form form-control link-cliente" type="text">
											</div>
										</div>
										<div class="form-group steps-- step2 animated">
											<label for="">Archivo</label>
											<p class="js-arrastrable">Selecciona la Imágen de la publicidad <strong style="color:#2478C1;"></strong></p>
											<input class="form-control imagen-publicidad file-hidden" type="file">
											<input class="form-control  file-hidden" type="file" id="image-mobile">
											<div class="container-btn-image" title="versión escritorio">
												<span class="center-porcent fa fa-image"></span>
												<p class="name-image"></p>
											</div>
											<div class="container-btn-image-mobile" title="versión móvil">
												<span class="center-porcent fa fa-mobile-phone"></span>
												<p class="name-image"></p>
											</div>
										</div>
										
									</form>
								</div>
								<div class="footer-modal">
									<div class="btn btn-save-- save-publicidad"><strong>Siguiente</strong></div>
									<div class="btn btn-cancel-- cancel-publicity" data-clean=""><strong>Cancelar</strong></div>
								</div>
							</div>
							@if(isset($publicidades))
							<div class="modal-publicity-position modals-- animated bounceInDown">
								<div class="container-publicitys col-lg-12">
									@for( $i=0; $i < 12; $i++ )
										<div class="col-lg-4"><div class="space-publicity space-free"><span class=" center-porcent fa fa-bullhorn"></span></div></div>
									@endfor
								</div>
							</div>
							@endif
							<div class="modal-confirm  modals--">
								<div class="">
									<h4>¿Estas seguro de querer eliminar?</h4>
									<p>Esta acción eliminará el elemento permanentemente del sistema</p>
								</div>
								<div class="btn btn-default DONT">Cancelar</div>
								<div class="btn btn-danger acept">Aceptar</div>
							</div>
						</div>
					</div>
				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->

			<!-- Main Footer -->
			<footer class="main-footer">
				<!-- To the right -->
				<div class="pull-right hidden-xs">
					<div class="container-logo">
						<!-- <img src="{{asset('assets/img/devcraft.png')}}" alt="" class="logo-devcraft"> -->
					</div>
					@yield('pull-right','')
				</div>
				<!-- Default to the left -->
				<strong>Copyright &copy; {{date('Y')}} <a href="#">FRAGMENTS</a>.</strong> Todos los derechos reservados.
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
		<script src="{{asset('assets/js/admon/drop.js')}}"></script>
		@yield('js')
			
		<!-- Optionally, you can add Slimscroll and FastClick plugins.
				 Both of these plugins are recommended to enhance the
				 user experience. Slimscroll is required when using the
				 fixed layout. -->
				
			 </body>
			 </html>