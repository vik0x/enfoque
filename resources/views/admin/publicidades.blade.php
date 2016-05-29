@extends('layout.principal')
	@section('link')
		<link rel="stylesheet" href="{{asset('assets/css/admon/admonIndex.css')}}">
	@stop
	@section('js')
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
		<script src="{{asset('assets/js/admon/editPubli.js')}}"></script>
	@stop
	@section('contenido')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-striped">
						<thead style="background:#444; color:white;" class="head-table">
							<tr>
								<th style="">Nombre</th>
								<th style="">Fecha de Inicio</th>
								<th style="">Ubicación</th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody class="container-epas">
							@foreach($publicidades as $val)
							<tr >
								<td class="publicidad-cliente" style=";">{{$val->cliente}}</td>
								<td class="publicidad-fecha" style=";">{{$val->fecha_inicio}}</td>
								<td class="publicidad-ubicacion" style=";">{{$val->seccion}}</td>
								<td>
									<button type="button"class="btn-options btn  btn-default btn-edit-publicidad " data-id="{{$val->id_publicidad}}" title="Editar"><span class="fa  fa-edit"></span></button>
									<button type="button"class="btn-options btn  btn-default btn-delete-publicidad " data-id="{{$val->id_publicidad}}" title="Eliminar"><span class="fa  fa-close"></span></button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- Columna -->
	</div> <!-- row -->
	@stop
@stop