@extends('layout.enfoque')
@section('contenido')
    @if(isset($galeria))
        <?php $time =0?>
        @for($i=0; $i< 12; $i++ )
        <?php $time=$time+.2;?>
        <div class="col-lg-4 col-sm-12 col-xs-12  col-md-4 container-gallery animated zoomIn js-gallery" style="animation-delay:{{$time}}s" data-id="">
            <img src="" alt="" class="img-responsive">
            <div class="container-title centrado-porcentual"><strong></strong><p class="date"></p></div>
            <div class="container-info-album">
                <span class="info-images">
                    <span class="icons ion-ios-camera"></span>
                </span>
                
                <span class="info-videos">
                    <span class="icons ion-ios-videocam"></span>
                </span>
            </div>
        </div>
        @endfor
    @endif
@stop
@stop