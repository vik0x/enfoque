/*
	* Nombre del proyecto: Enfoque Colima
	* Desarrollador: Raul Eduardo Ochoa Alvarez
	* Fecha de última actualización:13/11/2015
	* Correo:
*/
$(document).ready(function(){
	'use strict';
		$EXPLORADOR = navigator.userAgent.toLowerCase();
		if ($EXPLORADOR.search(/iphone|ipod|ipad|android|windows/) > -1) {
				$.each($('.js-slider-publicity'),function(){
					$URL=$(this).attr('src');
					$URL_TEMP=$(this).attr('src');
					$EXTENSION=$URL_TEMP.split('.').pop();
					$URL=$URL.split('.');
					$URL.pop();
					$URL=$URL+'_movil.'+$EXTENSION;
					$URL=$URL.replace(',','.');
					$(this)	.attr('src',$URL);
				});
		};
		if(typeof(publicidad) !='undefined'){
			$.each(publicidad,function(index,val){
				var $element=$('.container-gallery').eq(val.posicion-1);
				$element.removeClass('js-gallery').find('img').attr('src',val.url);
				$element.addClass('js-publicity');
				$element.find('.container-info-album').css('display','none');
			});
		};

		/*
			* Relleno de las galerias
		*/
		if(typeof(galerias) !='undefined'){
			$.each($('.js-gallery'),function(index,val){
				var $element=$(this);
				if (galerias[index]) {
					$element.find('img').attr('src',galerias[index].portada);
					$element.attr('data-id',galerias[index].id);
					$element.find('.info-images').prepend(galerias[index].cantidad_imagen);
					$element.find('.info-videos').prepend(galerias[index].cantidad_video);
					$element.find('strong').text(galerias[index].nombre);
					$element.find('.date').text(galerias[index].fecha);
				}else{
					$(this).css('display','none');
				}

			});
		};
		/* == Evento para ver una gañería ==*/
		$('.container-gallery').click(function(){
			if ($(this).hasClass('js-gallery')) {
				console.log('entramos');
				window.location.href=window.location.origin+'/galeria/'+$(this).attr('data-id')+'.html';                
			};
		});
		/*VIDEOS*/
		$('.cont-video').click(function(){
			console.log('quepod');
			$('#frame-video').attr('src','https://www.youtube.com/embed/'+$(this).data('youtube')+'?list=PL812FB1ADE84BC15F');
			$('.js-video-ov').css('display','block');
		});
		$('.js-close-video').click(function(){
			 $('.js-video-ov').fadeOut();
			$('#frame-video').attr('src','');
		});
	
});