@extends('layout.enfoque')
    @section('link')
        <link rel="stylesheet" href="{{asset('assets/css/enfoque/conocenos.css')}}">
    @stop
    @section('contenido')
            <div class="box" >
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 ">
                            <img src="{{asset('assets/img/enfoquelogo.png')}}" alt="" class="img-responsive animated fadeInDown" style="animation-delay:2s; margin:auto; width:200px ;margin-top:40px">
                            <h3 style="margin-top:20px;animation-delay:2.3s ;text-align:justify;color:white;margin-top:40px;" class="animated fadeInLeft
                            "> ENFOQUE COLIMA UN CONCEPTO NUEVO QUE NACE CON LA IDEA DE DOS AMIGOS LA CUAL ES OFRECER LA MEJOR OPCIÓN TANTO EN LO SOCIAL COMO EN LO PUBLICITARIO BRINDANDO UN SERVICIO SERIO Y DE CALIDAD PARA TUS FIESTAS Y EVENTOS CONOCENOS Y SÍGUENOS EN NUESTRO SITIO WEB Y REDES SOCIALES.</h3>   
                        </div>
                        <div class="col-lg-3 animated zoomIn" >
                            <img src="{{asset('assets/img/neto.jpg')}}" alt="" class="img-responsive animated zoomIn" style="margin-top:20px;animation-delay:2s">
                            <img src="{{asset('assets/img/daniel.jpg')}}" alt="" class="img-responsive animated zoomIn" style="margin-top:20px;animation-delay:2.3s">
                        </div>
                    </div>
                    <div class="row" >
                         
                    </div>
                </div>
            </div>
    @stop
@stop