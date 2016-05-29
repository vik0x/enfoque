@extends('layout.principal')
	@section('link')
		<link rel="stylesheet" href="{{asset('assets/css/admon/admonIndex.css')}}">
	@stop
	@section('js')
		<script src="{{asset('assets/js/admon/categorias.js')}}"></script>
	@stop
	@section('contenido')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body table-responsive no-padding">
					<table class="table table-hover table-striped">
						<thead style="background:#444; color:white;" class="head-table">
							<tr>
								<th style="width:80%;">Nombre</th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody class="container-epas">
							@foreach($categorias as $val)
							<tr >
								<td class="categoria-nombre" style="width:80%;">{{$val->nombre}}</td>
								<!-- <td clas="epa-dependencia">{{$val->sector}}</td> -->
								<td>
									<button type="button"class="btn-options btn  btn-default btn-edit-categoria " data-id="{{$val->id}}" title="Editar"><span class="fa  fa-edit"></span></button>
									<button type="button"class="btn-options btn  btn-default btn-delete-categoria " data-id="{{$val->id}}" title="Eliminar"><span class="fa  fa-close"></span></button>
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