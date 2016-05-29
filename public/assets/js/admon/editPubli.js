$(document).ready(function(){
	$( "body" ).tooltip('disable');
	/*------------------VARIABLES----------------*/
		posicionPublicidad=0;
		publicidadSelected={};
	/*=================
		SLIDER CONTORLS
	==================*/
	$('.categoria-publicidad').on('change',function(){
		if($(this).val() == 0 )
		{
			$('.form-position-slider').fadeOut('fast');
			$('.posicion-slider').val(0);
		}
		else
		{
			$('.form-position-slider').fadeIn('slow');
		}
	});
	/*=================
		GET PUBLICITY
	===================*/
	$('.drop-active').removeClass('drop-active');
	$.ajax({
		url:window.location.origin+ '/admin/publicidad.html',
		type:'post',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		data:{
			_method:'POST',
			_token:$('meta[name="csrf-token"]').attr('content')
		},
		success:function(data){
			PublicidadesExistentes=JSON.parse(data);
			$.each(PublicidadesExistentes,function(index,val){
				if (val.seccion==0) {
					$('.space-publicity').eq(val.posicion-1).removeClass('space-free').addClass('drop-active');
				};

			});
		}
		});//end AJAX
	/*=================
		STEPS CONTROLS
	==================*/
	$('.save-publicidad').click(function(){
			if($('.steps--.active').hasClass('step1'))
			{
				if ($('.posicion-slider').val() != 0) {
					$('.container-btn-image-mobile').css('display','inline-block');
				}
				else
				{
					$('.container-btn-image-mobile').css('display','none');	
					posicionPublicidad=0;
				}
				AdminStep('step1');
				return false;
			}
			if($('.steps--.active').hasClass('step2'))
			{
				AdminStep('step2');
				return false;
			}
	});
	/*==========================
		MODE UPDATE
	=============================*/
	$('.btn-edit-publicidad').click(function(){
		$('.overlay-modals,.modal-publicidad').css('animation-name','slideInLeft').fadeIn();
		publicidadSelected=$(this);
		$.ajax({
			url:window.location.origin+ '/editar/publicidad/'+$(this).attr('data-id')+'.html',
			type:'post',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				_method:'PATCH',
				_token:$('meta[name="csrf-token"]').attr('content')
			},
			success:function(data){
				console.log(data);
				DataEdit=JSON.parse(data);
				$('.nombre-cliente').val(DataEdit.cliente);
				if (DataEdit.seccion != 0) {
					$('.form-position-slider').fadeIn('fast');
					$('.posicion-slider').val(DataEdit.posicion);
					posicionPublicidad=DataEdit.posicion;
					$('.container-btn-image-mobile').css({
					'display':'inline-block',
					'background':'url('+DataEdit.url_movil+')',
					'background-size': '140%',
					'background-repeat': 'no-repeat'});
				};
				$('.categoria-publicidad').val(DataEdit.seccion);
				$('.link-cliente').val(DataEdit.link);
				$('.container-btn-image').css({
					'background':'url('+DataEdit.url+')',
					'background-size': '140%',
					'background-repeat': 'no-repeat'});
				$('.container-btn-image').addClass('selected').find('span').removeClass('fa-image').addClass('fa-check');
				if (posicionPublicidad == 0) {
					$('.js-arrastrable').find('strong').text('O ARRASTRA LA IMAGEN PARA SELECCIONAR UNA POSICIÓN');
					$('.container-btn-image').draggable({
						disabled:false,
						helper:'clone',
						revert:true,
						appendTo:'.modal-publicity-position',
						zIndex:3000,
						start:function(){
							if($('.choosed')){
								$('.choosed').addClass('space-free').removeClass('drop-active');
							}
							$('.modal-publicity-position').fadeIn();
						},
						stop:function(){
							$('.modal-publicity-position').fadeOut();
							
						}
					});
				};
			}
		});//end AJAX

	});
	/*========================
		CANCELAR LA PUBLICIDAD
	=========================*/
	$('.cancel-publicity').click(function(){
		$('.steps--').removeClass('active');
		$('.step1').addClass('active');
		$('.step1').css('animation-name','slideInLeft').fadeOut();
		$('.form-position-slider').fadeOut();
		$('.form-position-slider').val('');
		$('.input-form').val('');
		$('.container-btn-image').removeClass('selected').find('span').removeClass('fa-check').addClass('fa-image');
		$('.container-btn-image').draggable({disabled: true});
		posicionPublicidad=0;
		$('.js-arrastrable').find('strong').text('');
		$('.container-btn-image-mobile').fadeOut();

	});
	/*================
		IMAGEN PUBLICIDAD
	=================*/
	$('.container-btn-image').click(function(){
		$('.imagen-publicidad').click();
	});
	$('.imagen-publicidad').on('change',function(){
		$('.container-btn-image').addClass('selected').find('span').removeClass('fa-image').addClass('fa-check');
		if (posicionPublicidad == 0) {
			$('.container-btn-image').draggable({
				disabled:false,
				helper:'clone',
				revert:true,
				appendTo:'.modal-publicity-position',
				zIndex:3000,
				start:function(){
					if($('.choosed')){
						$('.choosed').addClass('space-free').removeClass('drop-active');
					}
					$('.modal-publicity-position').fadeIn();
				},
				stop:function(){
					$('.modal-publicity-position').fadeOut();
					
				}
			});
		};
	});
	$('.btn-cancel--').click(function(){
		$('.overlay-modals').css('animation-name','slideOutUp').fadeOut();
		$('.modals--').fadeOut();
		$('.wrong').removeClass('wrong');
	})
	/*==============================
		DROPABLES ELEMENTS
	===============================*/
	$('.space-free').droppable({
		drop:function(){
			if($(this).hasClass('space-free'))
			{
				$(this).addClass('drop-active').removeClass('space-free').addClass('choosed');
				posicionPublicidad=$(this).index('.space-publicity')+1;
			}
			$('.modal-publicity-position').fadeOut();
		}
	});
	$('.posicion-slider').on('focusout',function(){
		if($(this).val() >= 8){
			$(this).val(7)
		}else if($(this).val() <= 1){
			$(this).val(2)
		}
	});
	/*==========================
		ELIMINAR PUBLICIDAD
	============================*/
	$('.btn-delete-publicidad').click(function(){
		publicidadSelected=$(this);
		proced=false;
		$('.overlay-modals').css('animation-name','slideInLeft').fadeIn();
		$('.modal-confirm').fadeIn();
		
			
	});
	$('.acept').on('click',function(){
		deletePublicidad();
		$('.overlay-modals').css('animation-name','slideOutUp').fadeOut();
		$('.modals--').fadeOut();
	});
	$('.DONT').on('click',function(){
		$('.overlay-modals').css('animation-name','slideOutUp').fadeOut();
		$('.modals--').fadeOut();
		return false;
		
	});
});//END OF EXE
function AdminStep(step){
		switch(step){
				case 'step1':
					if (posicionPublicidad == 0) {
						$('.js-arrastrable').find('strong').text('O ARRASTRA LA IMAGEN PARA SELECCIONAR UNA POSICIÓN');
						$('.container-btn-image').draggable({
							disabled:false,
							helper:'clone',
							revert:true,
							appendTo:'.modal-publicity-position',
							zIndex:3000,
							start:function(){
								if($('.choosed')){
									$('.choosed').addClass('space-free').removeClass('drop-active');
								}
								$('.modal-publicity-position').fadeIn();
							},
							stop:function(){
								$('.modal-publicity-position').fadeOut();
								
							}
						});
					};
					if ($('.form-position-slider').css('display') == 'none') {
						$('.posicion-slider').removeClass('input-form');
					}else if($('.form-position-slider').css('display') == 'block'){
						$('.posicion-slider').addClass('input-form');
					}
					inputs=$('.modal-publicidad').find('.input-form');
					$.each(inputs,function(){
						if($(this).val() == ''){

							$(this).addClass('wrong');
							inputs=false;
							return false;
						}
					})
					if (inputs != false) {
						$('.step1').css('animation-name','slideOutLeft').fadeOut();
						$('.step1').removeClass('active');
						$('.step2').addClass('active');
						$('.step2').css('animation-name','slideInRight');
						if ($('.posicion-slider').val()!=0 ){
							posicionPublicidad=$('.posicion-slider').val();
						};
					};
				break;
				case 'step2':
					publicityData=new FormData();
					publicityData.append('url_movil',$('#image-mobile')[0].files[0]);
					publicityData.append('nombre',$('.nombre-cliente').val());
					publicityData.append('categoria',$('.categoria-publicidad').val());
					publicityData.append('url',$('.imagen-publicidad')[0].files[0]);
					publicityData.append('link',$('.link-cliente').val());
					if (posicionPublicidad == 0) {
						posicionPublicidad=DataEdit.posicion;
					};
					publicityData.append('posicion',posicionPublicidad);
					publicityData.append('_token',$('meta[name="csrf-token"]').attr('content'));
					publicityData.append('_method','PATCH');
					$.ajax({
						url:window.location.origin+ '/modificar/publicidad/'+DataEdit.id_publicidad+'.html',
						type:'post',
						headers: {
									'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
						contentType: false,
						processData:false,
						data:publicityData,
						success:function(data){
							console.log(data);
							$('.cancel-publicity').click();
							$('.js-arrastrable').find('strong').text('');
							posicionPublicidad=0;
							window.location.reload();
						}
					});//end AJAX
					/*=================
						GET PUBLICITY
					===================*/
					$.ajax({
						url:window.location.origin+ '/admin/publicidad.html',
						type:'post',
						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						},
						data:{
							_method:'POST',
							_token:$('meta[name="csrf-token"]').attr('content')
						},
						success:function(data){
							PublicidadesExistentes=JSON.parse(data);
							$.each(PublicidadesExistentes,function(index,val){
								if (val.seccion==0) {
									$('.space-publicity').eq(val.posicion-1).removeClass('space-free').addClass('drop-active');
								};

							});
						}
						});//end AJAX
				break;
				
		}
		
}
function deletePublicidad(){
	$.ajax({
		url:window.location.origin+ '/eliminar/publicidad/'+publicidadSelected.attr('data-id')+'.html',
		type:'post',
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		data:{
			_method:'DELETE',
			_token:$('meta[name="csrf-token"]').attr('content')
		},
		success:function(data){
			console.log(data);
			publicidadSelected.parents('tr').remove();
		}
	});//end AJAX
}