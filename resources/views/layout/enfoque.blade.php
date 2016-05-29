<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('titulo','Enfoque Colima')</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  	<link rel="stylesheet" href="{{asset('assets/css/enfoque/Sindex.css')}}" >
  	<link href="//cdn.bootcss.com/animate.css/3.4.0/animate.css" rel="stylesheet">

	@yield('link')
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<img src="{{asset('assets/img/enfoquelogo.png')}}" class="img-logo img-responsive " alt="">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{url('/index.html')}}">INICIO</a></li>
					<li><a href="{{url('/galerias.html')}}">GALERÍAS</a></li>

					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">EVENTOS<span class="caret"></span></a>
						<ul class="dropdown-menu">
							@if(isset($categorias))
								@foreach($categorias as $val)
									<li role="separator" class="divider"></li>	
									<li data-id=""><a href="{{url('/seccion/' . $val->id . '.html')}}">{{$val->nombre}}</a></li>
								@endforeach
							@endif
							
						</ul>
					</li>
					<li><a href="{{url('/conocenos.html')}}">CONOCENOS</a></li>
					<li><a href="{{url('/videos.html')}}">VIDEOS</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a><strong>Siguenos en:</strong></a></li>
					<li><a href="https://www.facebook.com/EnfoqueColima/?fref=ts" class="icons ion-social-facebook" target="target_blank"></a></li>
					<li><a href="https://twitter.com/enfoquecolima" class="icons ion-social-twitter"></a></li>
					<li><a href="https://www.instagram.com/enfoquecolima/" class="icons ion-social-instagram" target="target_blank"></a></li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
	@if(isset($publiSlider))
		<div class="container-fluid container-slider-principal-- animated flipInX">
			<div id="myCarousel" class="carousel slide" data-ride="carousel">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<?php $loop=1?>
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					@if(isset($publiSlider))
						@foreach($publiSlider as $val)
						<li data-target="#myCarousel" data-slide-to="{{$loop}}"></li>
						<?php $loop=$loop+1;?>
						@endforeach
					@endif
					
				</ol>

				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<!-- <div class="carousel-content"> -->
							<!-- <div> -->
								<!-- <h1>ENFOQUE COLIMA</h1>                            
								<p>ENFOQUE COLIMA UN CONCEPTO NUEVO QUE NACE CON LA IDEA DE DOS AMIGOS LA CUAL ES OFRECER LA MEJOR OPCIÓN  TANTO EN LO SOCIAL COMO EN LO PUBLICITARIO BRINDANDO UN SERVICIO SERIO Y DE CALIDAD PARA TUS FIESTAS Y EVENTOS CONOCENOS Y SÍGUENOS EN NUESTRO SITIO WEB Y REDES SOCIALES.</p>
								<a href="{{url('conocenos.html')}}" ><div class="btn-conocenos">CONOCENOS</div></a> -->
								<img src="{{asset('assets/img/about.jpg')}}" alt="" class="img-responsive js-slider-publicity">
								
							<!-- </div> -->
						<!-- </div> -->
						<!-- <img src="https://www.google.com.mx/imgres?imgurl=https://upload.wikimedia.org/wikipedia/commons/0/07/Government_Palace_of_Colima_at_night.jpg&imgrefurl=https://en.wikipedia.org/wiki/Colima&h=1536&w=2048&tbnid=Lc3aP3Uwz2xMrM:&docid=UaiFlHaZIpOBNM&ei=vY1kVuOiL-bzjgSVoIaQBg&tbm=isch&ved=0ahUKEwij9bOe_cfJAhXmuYMKHRWQAWIQMwgiKAgwCA" alt="" class="img-responsive"> -->
					</div>
					@if(isset($publiSlider))
						@foreach($publiSlider as $val)
						<a class="item" href="{{$val->link}}" target="target_blank">
							<img src="{{$val->url}}" alt="" class="img-responsive js-slider-publicity">
						</a>
						@endforeach
					@endif
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
	@endif
	<div class="wrapper">
		<div class="container " >
			<div class="row">
				@yield('contenido')
				
			</div>
		</div>
	</div>
        	@yield('modals')
        	<div class="we-in-construction animated slideOutUp" style="animation-delay:1.9s">
                   <img src="{{asset('assets/img/enfoquelogo.png')}}" class=" img-responsive animated rollIn" alt="">
                   <h3 class="animated flipInX">Cargando..</h3>
              </div>
	<footer>	
		<strong>Contacto</strong>
		<p>contacto@enfoquecolima.com</p>
	</footer>
	<?php
	echo '<script>';
		if(isset($publicidad))
		{
			echo "publicidad=[";
			foreach($publicidad as $val){
				echo '{id:"' . $val->id_publicidad . '",posicion:"' . $val->posicion . '",url:"' . $val->url . '",link:"' . $val->link . '"},';
			}
			echo "]"."\n";
		}
		if (isset($galeria)) {
			echo "galerias=[";
			foreach($galeria as $val){

				$url = explode(".", $val->portada);
				$ext = array_pop($url);
				$url = implode(".",$url);
				$url .= "_2." . $ext;
				echo '{nombre:"' . $val->nombre. '",id:"' . $val->id . '",portada:"' . $url . '",url:"' . $val->url . '",cantidad_imagen:"' . $val->cantidad_imagen . '",cantidad_video:"' . $val->cantidad_video. '",fecha:"' . $val->fecha . '"},';
			}
			echo "]";
		}
		echo'</script>';
        	?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-alpha1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="{{asset('assets/js/public/script_control.min.js')}}"></script>
	@yield('js')
</body>
</html>