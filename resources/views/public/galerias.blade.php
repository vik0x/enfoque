@extends('layout.enfoque')
	<!-- Incrustación de CSS -->
	@section('link')
		<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	@stop
	@section('js')
		<script src="{{asset('assets/js/public/see_gallery.js')}}"></script>
	@stop
	@section('contenido')
		@if(isset($galeria))
			<?php $time =0; ?>
			@foreach($galeria as $val)
			<?php $time=$time+.2;?>
			<div class="col-lg-4 col-sm-12 col-xs-12  col-md-4 container-gallery animated zoomIn js-gallery" style="animation-delay:{{$time}}s" data-id="{{$val->id_galeria}}">
				<?php 
				$url = explode(".", $val->portada);
				$ext = array_pop($url);
				$url = implode(".",$url);
				$url .= "_2." . $ext;

				?>
				<img src="{{$url}}" alt="" class="img-responsive">
				<div class="container-title centrado-porcentual"><strong>{{$val->nombre}}</strong><p class="date">{{$val->fecha_subida}}</p></div>
				<div class="container-info-album">
					<span class="info-images">
						<span class="icons ion-ios-camera"></span>
					</span>

					<span class="info-videos">
						<span class="icons ion-ios-videocam"></span>
					</span>
				</div>
			</div>
			@endforeach
		@endif
		<?php $time =0?>
		@if(isset($imagenes)) 
			@foreach($imagenes as $val)
				<?php $time=$time+.2;?>
				<div class="col-lg-3 col-sm-12 col-xs-12  col-md-4 animated zoomIn image-gallery" style="animation-delay:{{$time}}s;height:180px;overflow:hidden;margin-top:10px;margin-bottom:10px;" data-id="">
				<?php 
				$url = explode(".", $val->url);
				$ext = array_pop($url);
				$url = implode(".",$url);
				$url .= "_2." . $ext;

				?>
					<img src="{{$url}}" alt="" class="img-responsive">
				</div>
			@endforeach
		@endif
		<?php $time =0;?>
		@if(isset($videos)) 
			@foreach($videos as $val)
				<?php $time=$time+.2;?>
				<?php
					$ruta=explode('/',$val->url);
					$id_V=array_pop($ruta);
				?>
				<div class="col-lg-3 col-sm-12 col-xs-12  col-md-4 animated zoomIn cont-video" style="animation-delay:{{$time}}s;height:180px;overflow:hidden;margin-top:10px;margin-bottom:10px;" data-id="{{$val->id_elemento}}" data-youtube="{{$id_V}}">
					<img src="https://img.youtube.com/vi/{{$id_V}}/0.jpg" alt="" class="img-responsive">
					<span class="icons ion-ios-play centrado-porcentual"></span>
				</div>
			@endforeach
		@endif
	@stop
	@section('modals')
		<div class="overlay-video js-video-ov animated flipInX">
			<div class="contenedor-video centrado-porcentual">
				<div class="control-video">
					<span class="icons ion-close-round js-close-video"></span>
				</div>
				<iframe  id="frame-video" width="100%" height="415" src="" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>
		<div class="overlay-- js-overlay aniamted slideInUp">
			<div class="container-slider-gallery js-slider animated flipInX">
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<div class="close-control">
						<span class="icons ion-close-round js-close"></span>
					</div>
					<!-- Wrapper for slides -->
					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<img src="" alt="" class="img-responsive">
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
		</div>
		
	@stop

@stop