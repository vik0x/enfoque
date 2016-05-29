<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Enfoque Colima</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  	<link rel="stylesheet" href="{{asset('assets/css/Sindex.css')}}">
  	<link href="//cdn.bootcss.com/animate.css/3.4.0/animate.css" rel="stylesheet">


</head>
<body>
	
	<nav class="navbar navbar-default" role="navigation">
	  <!-- El logotipo y el icono que despliega el menú se agrupan
	  para mostrarlos mejor en los dispositivos móviles -->
	  <div class="navbar-header">
	  	<img src="{{asset('assets/img/enfoquelogo.png')}}" class="img-logo img-responsive " alt="">
	  	<button type="button" class="navbar-toggle" data-toggle="collapse"
	  	data-target=".navbar-ex1-collapse">
	  	<span class="sr-only">Desplegar navegación</span>
	  	<span class="icon-bar"></span>
	  	<span class="icon-bar"></span>
	  	<span class="icon-bar"></span>
	  </button>
	  <!-- <a class="navbar-brand" href="#">Logotipo</a> -->
	</div>

	  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
	  otro elemento que se pueda ocultar al minimizar la barra -->
	  <div class="collapse navbar-collapse navbar-ex1-collapse">
	  	<ul class="nav navbar-nav">
	  		<li><a href="#">INICIO</a></li>
	  		<li><a href="#">GALERÍAS</a></li>
	  		<li class="dropdown">
	  			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">EVENTOS<span class="caret"></span></a>
	  			<ul class="dropdown-menu">
	  				<li><a href="#">Action</a></li>
	  				<li role="separator" class="divider"></li>	
	  				<li><a href="#">Another action</a></li>
	  				<li role="separator" class="divider"></li>
	  				<li><a href="#">Something else here</a></li>
	  				<li role="separator" class="divider"></li>
	  				<li><a href="#">Separated link</a></li>
	  				<li role="separator" class="divider"></li>
	  				<li><a href="#">One more separated link</a></li>
	  			</ul>
	  		</li>
	  		<li><a href="#">CONOCENOS</a></li>
	  		<li><a href="#">VIDEOS</a></li>
	  	</ul>

	  	

	  	<ul class="nav navbar-nav navbar-right">
	  		<li><a><strong>Siguenos en:</strong></a></li>
	  		<li><a href="#" class="icons ion-social-facebook"></a></li>
	  		<li><a href="#" class="icons ion-social-twitter"></a></li>
	  		<li><a href="#" class="icons ion-social-instagram"></a></li>
	  	</ul>
	  </div>
	</nav>
	<div class="container-fluid container-slider-principal-- animated fadeInLeft">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
				<li data-target="#myCarousel" data-slide-to="3"></li>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
				<div class="item active">
					<img src="http://www.gofreestyle.cz/wp-content/gallery/skate-wallpapers/desktopwallpaperfactory_skateboarding_15.jpg" alt="" class="img-responsive">
				</div>

				<div class="item">
					<img src="http://www.gofreestyle.cz/wp-content/gallery/skate-wallpapers/desktopwallpaperfactory_skateboarding_15.jpg" alt="" class="img-responsive">
				</div>

				<div class="item">
					<img src="http://www.gofreestyle.cz/wp-content/gallery/skate-wallpapers/desktopwallpaperfactory_skateboarding_15.jpg" alt="" class="img-responsive">
				</div>

				<div class="item">
					<img src="http://www.gofreestyle.cz/wp-content/gallery/skate-wallpapers/desktopwallpaperfactory_skateboarding_15.jpg" alt="" class="img-responsive">
				</div>
			</div>

			<!-- Left and right controls -->
			<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>
	<div class="container ">
		<div class="row">
			<div class="col-lg-4 col-sm-12 col-xs-12  col-md-4 container-gallery animated zoomIn" style="animation-delay:.3s">
				<img src="http://cuadrotv.com/wp-content/uploads/2015/06/skate.jpg" alt="" class="img-responsive">
				<div class="container-title centrado-porcentual"><strong>SOME TITLE</strong><p class="date">10/05/2015</p></div>
				<div class="container-info-album">
					<span class="info-images">15
						<span class="icons ion-ios-camera"></span>
					</span>
					<span class="info-videos">10
						<span class="icons ion-ios-videocam"></span>
					</span>
				</div>
			</div>
			<div class="col-lg-4 col-sm-12 col-xs-12  col-md-4 container-gallery animated zoomIn" style="animation-delay:.5s">
				<img src="http://cuadrotv.com/wp-content/uploads/2015/06/skate.jpg" alt="" class="img-responsive">
				<div class="container-title centrado-porcentual"><strong>SOME TITLE</strong><p class="date">10/05/2015</p></div>
				<div class="container-info-album">
					<span class="info-images">15
						<span class="icons ion-ios-camera"></span>
					</span>
					<span class="info-videos">10
						<span class="icons ion-ios-videocam"></span>
					</span>
				</div>
			</div>
			<div class="col-lg-4 col-sm-12 col-xs-12  col-md-4 container-gallery">
				<img src="http://cuadrotv.com/wp-content/uploads/2015/06/skate.jpg" alt="" class="img-responsive">
				<div class="container-title centrado-porcentual"><strong>SOME TITLE</strong><p class="date">10/05/2015</p></div>
				<div class="container-info-album">
					<span class="info-images">15
						<span class="icons ion-ios-camera"></span>
					</span>
					<span class="info-videos">10
						<span class="icons ion-ios-videocam"></span>
					</span>
				</div>
			</div>
			<div class="col-lg-4 col-sm-12 col-xs-12  col-md-4 container-gallery">
				<img src="http://cuadrotv.com/wp-content/uploads/2015/06/skate.jpg" alt="" class="img-responsive">
				<div class="container-title centrado-porcentual"><strong>SOME TITLE</strong><p class="date">10/05/2015</p></div>
				<div class="container-info-album">
					<span class="info-images">15
						<span class="icons ion-ios-camera"></span>
					</span>
					<span class="info-videos">10
						<span class="icons ion-ios-videocam"></span>
					</span>
				</div>
			</div>
			<div class="col-lg-4 col-sm-12 col-xs-12  col-md-4 container-gallery">
				<img src="http://cuadrotv.com/wp-content/uploads/2015/06/skate.jpg" alt="" class="img-responsive">
				<div class="container-title centrado-porcentual"><strong>SOME TITLE</strong><p class="date">10/05/2015</p></div>
				<div class="container-info-album">
					<span class="info-images">15
						<span class="icons ion-ios-camera"></span>
					</span>
					<span class="info-videos">10
						<span class="icons ion-ios-videocam"></span>
					</span>
				</div>
			</div>
			<div class="col-lg-4 col-sm-12 col-xs-12  col-md-4 container-gallery">
				<img src="http://cuadrotv.com/wp-content/uploads/2015/06/skate.jpg" alt="" class="img-responsive">
				<div class="container-title centrado-porcentual"><strong>SOME TITLE</strong><p class="date">10/05/2015</p></div>
				<div class="container-info-album">
					<span class="info-images">15
						<span class="icons ion-ios-camera"></span>
					</span>
					<span class="info-videos">10
						<span class="icons ion-ios-videocam"></span>
					</span>
				</div>
			</div>
			<div class="col-lg-4 col-sm-12 col-xs-12  col-md-4 container-gallery">
				<img src="http://cuadrotv.com/wp-content/uploads/2015/06/skate.jpg" alt="" class="img-responsive">
				<div class="container-title centrado-porcentual"><strong>SOME TITLE</strong><p class="date">10/05/2015</p></div>
				<div class="container-info-album">
					<span class="info-images">15
						<span class="icons ion-ios-camera"></span>
					</span>
					<span class="info-videos">10
						<span class="icons ion-ios-videocam"></span>
					</span>
				</div>
			</div>
			<div class="col-lg-4 col-sm-12 col-xs-12  col-md-4 container-gallery">
				<img src="http://cuadrotv.com/wp-content/uploads/2015/06/skate.jpg" alt="" class="img-responsive">
				<div class="container-title centrado-porcentual"><strong>SOME TITLE</strong><p class="date">10/05/2015</p></div>
				<div class="container-info-album">
					<span class="info-images">15
						<span class="icons ion-ios-camera"></span>
					</span>
					<span class="info-videos">10
						<span class="icons ion-ios-videocam"></span>
					</span>
				</div>
			</div>
			<div class="col-lg-4 col-sm-12 col-xs-12  col-md-4 container-gallery">
				<img src="http://cuadrotv.com/wp-content/uploads/2015/06/skate.jpg" alt="" class="img-responsive">
				<div class="container-title centrado-porcentual"><strong>SOME TITLE</strong><p class="date">10/05/2015</p></div>
				<div class="container-info-album">
					<span class="info-images">15
						<span class="icons ion-ios-camera"></span>
					</span>
					<span class="info-videos">10
						<span class="icons ion-ios-videocam"></span>
					</span>
				</div>
			</div>
		</div>
	</div>	
	
	<footer>	
		<strong>Contacto</strong>
	</footer>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>