@extends('layout.enfoque')
@section('contenido')
   <?php $time =0;?>
   @if(isset($videos)) 
    @foreach($videos as $val)
        <?php $time=$time+.2;?>
        <?php
            $ruta=explode('/',$val->url);
            $id_V=array_pop($ruta);
        ?>
        <div class="col-lg-3 col-sm-12 col-xs-12  col-md-4 animated zoomIn cont-video" style="animation-delay:{{$time}}s;height:180px;overflow:hidden;margin-top:10px;margin-bottom:10px;" data-id="{{$val->id_elemento}}"data-youtube="{{$id_V}}">
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
  @stop
@stop