@extends('layout.principal')
	@section('link')
	<link rel="stylesheet" href="{{asset('assets/css/admon/admonIndex.css')}}">
	<link rel="stylesheet" href="{{asset('assets/css/admon/galerias/galerias.css')}}">
	@stop
	@section('js')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
	<script src="{{asset('assets/js/admon/galerias.js')}}"></script>
	@stop
	@section('contenido')
		<div class="row">
			<div class="container-wrapper">
			<?php $delay=0 ?>
				@foreach($galeria as $val)
				<?php $delay=$delay+.1 ?>
				<div class=" col-lg-3 container-gallery animated fadeInUp" style="animation-delay:{{$delay}}s">
					<div class="gallery" data-gallery="{{$val['id']}}">

						@if(isset($val['portada']))

							<img src="{{asset( $val['portada'] )}}" alt="" class="centrado-porcentual"> 
						@endif
						<p>{{$val['nombre']}}</p>
						@if($val['step'] == 4)
							<span class="icons ion-ios-checkmark-empty centrado-porcentual"></span>
						@else
							<span class="icons ion-alert-circled centrado-porcentual failed-gallery"></span>
						@endif
						<div class="info-content">
							<span><span class="cant-imagenes">{{$val['cantidad_imagen']}}</span><span class="icons ion-ios-camera"></span></span>
							<span class='info-videos'><span class="cant-videos">{{$val['cantidad_video']}}</span><span class="icons ion-ios-videocam"></span></span>
						</div>
					</div>

				</div>
				@endforeach
				
				<div class="overlay-options animated zoomIn">
				<div class="content-options centrado-porcentual">
					<div class="option editar-option" data-option="editar"><span class="icons ion-compose centrado-porcentual"></span></div>
					<div class="option eliminar-option" data-option="eliminar"><span class="icons ion-trash-b centrado-porcentual"></span></div>
				</div>
				</div>
			</div>
			<div>
			@if (method_exists($galeria,'render'))
					{!! $galeria->render() !!}
					@endif
			</div>
		</div>

	@stop
@stop