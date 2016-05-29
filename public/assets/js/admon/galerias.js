/*
	* Nombre del proyecto: Enfoque Colima
	* Desarrollador: Raul Eduardo Ochoa Alvarez
	* Fecha de última actualización:10/11/2015
	* Correo:
*/
$(document).on('ready',function  () {
	/*Variables globales*/
	galeriaSelected={};
	videos=[];
	videosEliminados=[];
	$imagenesEliminadas=[];
	cantImages=0;
	function MasterForm(selector){
		this.status=true;
		this.validationForm=function(selector){
			status=true;
			$.each($(selector).find('.input-form'),function(index,val){
				if($(this).val()==''){
					$(this).addClass('wrong');
					status=false;
				}
			});
			if (status=='false') {

				return false;
			}else{
				return true;
			}
		}
	};

	$(".container-gallery").draggable({
		revert:true,
		containment:'body',
		start:function(){
			$('.drop-active').removeClass('drop-active');
			galeriaSelected=$(this);
			$('.overlay-options').css({'z-index':1050})
			$(this).css({'z-index':1051})
			$(this).find('.container-gallery').addClass('grabbing');
			$('.overlay-options').fadeIn('fast');
			$(this).css('left',0);
		}        

	});
	$( ".option" ).droppable({ 
		accept:'.container-gallery',
		tolerance:'fit',
		drop:function(event,ui){
			$(this).addClass('drop-active');
			if($(this).attr('data-option')=='editar'){
				$.ajax({
					url:window.location.origin+ '/editar/galeria.html',
					type:'post',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					data:{
						id:galeriaSelected.find('.gallery').attr('data-gallery'),
						_method:'PATCH',
						_token:$('meta[name="csrf-token"]').attr('content')
					},
					success:function(data){
						dataGallery=JSON.parse(data);
						if(dataGallery)
						{
							if(dataGallery.galerias.step==1)
							{
								$('.overlay-modals').css('animation-name','slideInLeft').fadeIn();
								$('.modal-gallery').fadeIn();
								$('.title-galeria').val(dataGallery.galerias.nombre);
								$('.descripcion-galeria').val(dataGallery.galerias.descripcion);
								$('.tipo-galeria').val(dataGallery.galerias.id_tipo_galeria);
							}
							if(dataGallery.galerias.step==2)
							{
								$('.overlay-modals').css('animation-name','slideInLeft').fadeIn();
								$('.modal-choose-portada').fadeIn();
								if (dataGallery.galerias.portada) {
									$('.container-choose').find('p').text('Cambiar Portada');
									$('.container-choose').removeClass('unchoose').addClass('selected');
									$('.container-choose').css('background','url('+window.location.origin+dataGallery.galerias.portada+') center')
								};
							}
							if(dataGallery.galerias.step==3)
							{
								$('.overlay-modals').css('animation-name','slideInLeft').fadeIn();
								$('.modal-youtube').fadeIn();
							}
							
							if(dataGallery.galerias.step==4)
							{
								
								$('.overlay-modals').css('animation-name','slideInLeft').fadeIn();
								$('.modal-gallery').fadeIn();
								$('.title-galeria').val(dataGallery.galerias.nombre);
								$('.descripcion-galeria').val(dataGallery.galerias.descripcion);
								$('.tipo-galeria').val(dataGallery.galerias.id_tipo_galeria);
								$('.circle-effect').fadeOut();
								$('.drop-images').css({'overflow':'hidden','height':'initial'})
								$.each(dataGallery.imagenes,function(index,val){
									structure='<div class="element-image" data-ident="'+val.id_elemento+'" style="background:url('+window.location.origin+val.url+')"></div>';
									$('.drop-images').append(structure);
								});
								//botones de eliminar imagenes
								$('.option-delete-images').fadeIn();
								//PORTADA
								if (dataGallery.galerias.portada) {
									$('.container-choose').find('p').text('Cambiar Portada');
									$('.container-choose').removeClass('unchoose').addClass('selected');
									$('.container-choose').css('background','url('+window.location.origin+dataGallery.galerias.portada+') center')
								};
								$.each(dataGallery.videos,function(index,val){
									structureYotube='<div class="video animated slideInLeft">\
									<span class="fa fa-close delete-video" data-id="'+val.id_elemento+'"></span>\
									<div class="container-icon">\
									<span class="fa fa-youtube center-porcent"></span>\
									</div>\
									<div class="title-video"><strong class="center-porcent"> '+val.titulo+'</strong></div>\
									</div>';
									$('.container-videos').append(structureYotube);
								});

							}
						}
						$(this).removeClass('drop-active');
					}
				});//end AJAX
			}
			if($(this).attr('data-option')=='eliminar'){
				$.ajax({
					url:window.location.origin+ '/eliminar/galeria.html',
					type:'post',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					data:{
						id:galeriaSelected.find('.gallery').attr('data-gallery'),
						_method:'DELETE',
						_token:$('meta[name="csrf-token"]').attr('content')
					},
					success:function(data){
						console.log(data);
						$(this).removeClass('drop-active');
						galeriaSelected.remove();
						galeriaSelected={};
					}
								});//end AJAX
			}

		}

	});

	$('.container-gallery').on('dragstop',function(){
		$(this).find('.container-gallery').removeClass('grabbing');
		$('.overlay-options').fadeOut('fast'); 
		$(this).css('z-index',1);

	});
	/******************************** MODULO DE  GALERIAS *************************
	*/
	/* *========================STEP1=================================* */
	$('.save-galeria').click(function(){
		MasterF=new MasterForm;
		MasterF.status=MasterF.validationForm('.modal-gallery');
		nombre=$('.title-galeria').val();
		galeriaSelected.find('p').text(nombre);
		descripcion=$('.descripcion-galeria').val();
		tipo=$('.tipo-galeria').val();
		nextStep=$(this).attr('data-step');
		if (MasterF.status==false) {
			return false;
		}else
		{
			$.ajax({
				url:window.location.origin+ '/modificar/inf_principal.html',
				type:'post',
				headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        },
				data:{
					id:dataGallery.galerias.id_galeria,
					titulo:nombre,
					descripcion:descripcion,
					tipo:tipo,
					_method:'PATCH',
					_token:$('meta[name="csrf-token"]').attr('content')
				},
				success:function(data){
					console.log(data);
					$('.id_galeria--').val(dataGallery.galerias.id_galeria);
					$('.modals--').fadeOut();
					$(nextStep).css('animation-name','flipInX').fadeIn();
					$(nextStep).addClass('.modal-active');
					
				}
			});//end AJAX
			
		}//else
	});//modificar-galeria
	/*=========================STEP 2=================================*/
	$('.container-choose').click(function(){
		$('.container-choose').css('border-color','#222');
		$('#portada-album').click();
	});
	$('#portada-album').on('change',function(){
		$('.container-choose').removeClass('unchoose').addClass('selected');
	});
	$('.save-portada').click(function(){
		$('#metodo-portada').val('PATCH');
		console.log('veamos');
		MasterF=new MasterForm;
		MasterF.status=MasterF.validationForm('.modal-choose-portada');
		portada=$('#portada-album')[0].files[0];
		var portada=new FormData($('#form-portada-album')[0]);

		nextStep=$(this).attr('data-step');
		identGal=dataGallery.galerias.id_galeria;
		
		if (MasterF.status==false) {
			$('.container-choose').css('border-color','#EF5151');
			$('.modals--').fadeOut();
			$(nextStep).css('animation-name','flipInX').fadeIn();
			$(nextStep).addClass('.modal-active');
			// return false;
		}else
		{
			$('.progress-container').fadeIn('fast');
			$.ajax({
				url:window.location.origin+ '/modificar/portada.html',
				xhr: function () {
					var xhr = new window.XMLHttpRequest();
					xhr.upload.addEventListener("progress", function (evt) {
						if (evt.lengthComputable) {
							var percentComplete = (evt.loaded / evt.total)*100;
							console.log(percentComplete);
							$('.progress-bar--').css({
								width: percentComplete + '%'
							});
							if (percentComplete === 1) {
								$('.progress-container').fadeOut();
							}
						}
					}, false);
					xhr.addEventListener("progress", function (evt) {
						if (evt.lengthComputable) {
							var percentComplete = evt.loaded / evt.total;
							console.log(percentComplete);
							$('.progress').css({
								width: percentComplete * 100 + '%'
							});
						}
					}, false);
					return xhr;
				},
				type:'post',
				headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        },
				contentType: false,
				processData:false,
				data:portada,
				success:function(data){
					console.log(data);
					Change=JSON.parse(data);
					if (Change.portada) {

						galeriaSelected.find('img').attr('src',window.location.origin+Change.portada);
					};
					$('.progress-container').fadeOut('fast');
					$('.progress-bar--').css({
						width: 0+'px'
					});

					$('.modals--').fadeOut();
					$(nextStep).css('animation-name','flipInX').fadeIn();
					$(nextStep).addClass('.modal-active');

				}
			});//end AJAX
			
		}//else
	});
	/*================================STEP 3=========================*/
	$('.save-videos').click(function(){
		nextStep=$(this).attr('data-step');
		$.ajax({
			url:window.location.origin+ '/modificar/videos.html',
			type:'post',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				id_galeria:dataGallery.galerias.id_galeria,
				videos:videos,
				videosEliminados:videosEliminados,
				_method:'PATCH',
				_token:$('meta[name="csrf-token"]').attr('content')
			},
			success:function(data){
				console.log(data);
				if(dataGallery.galerias.id_galeria){
					$('.modals--').fadeOut();
					$(nextStep).css('animation-name','bounceInDown').fadeIn();
					$(nextStep).addClass('.modal-active');
				}
				videosEliminados=[];
				galeriaSelected.find('.cant-videos').text($('.video').length);
				$('.container-videos').html('');
			}
			});//end AJAX
	});
	/*================================ STEP 4==============================*/
	$('.save-imagenes').click(function(){
		$('.progress-container').fadeIn();
		gallery=new FormData();
		gallery.append('_token',$('meta[name="csrf-token"]').attr('content'));
		gallery.append('_method','PATCH');
		gallery.append('id_galeria',dataGallery.galerias.id_galeria);
		$.each(files,function(index,val){
			gallery.append('imagenes['+index+']',val) ;
			
		});//endeach
		//Ajax para mandar a guardar las imágenes de una galería editada
		$.ajax({
			url:window.location.origin+ '/modificar/imagenes.html',
			xhr: function () {
				$('.progress-container').fadeIn('fast');
				var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener("progress", function (evt) {
					if (evt.lengthComputable) {
						var percentComplete = (evt.loaded / evt.total)*100;
						$('.progress-bar--').css({
							width: percentComplete + '%'
						});
						if (percentComplete === 1) {
							$('.progress-container').fadeOut();
						}
					}
				}, false);
				xhr.addEventListener("progress", function (evt) {
					if (evt.lengthComputable) {
						var percentComplete = evt.loaded / evt.total;
						console.log(percentComplete);
						$('.progress').css({
							width: percentComplete * 100 + '%'
						});
					}
				}, false);
				return xhr;
			},
			type:'post',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			processData:false,
			contentType:false,
			cache:false,
			data:gallery,
			success:function(data){
				console.log(data);
				$('.progress-container').fadeOut('fast');
				$('.progress-bar--').css({
					width: 0+'px'
				});
				$('.modals--').fadeOut();
				$('.overlay-modals').css('animation-name','slideOutUp').fadeOut();
				if (typeof(files.length) != 'undefined') {
					cantImages=$('.element-image').length+files.length;
				}else{
					cantImages=$('.element-image').length;
				}
				galeriaSelected.find('.cant-imagenes').text(cantImages);
				$('.element-image').remove();
				$('.cant-new-imagenes').text('');
				files={};
				cantImages=0;
				$imagenesEliminadas=[];
				$('.option-delete-images').fadeIn();
				$('.option-save-images').fadeOut();
				
				
			}
			});//end AJAX
		
		
	});
	//AGREGAR UNA NUEVA ETIQUETA DE YOUTUBE
	$('.btn-add-youtube').click(function(){
		MasterF=new MasterForm;
		MasterF.status=MasterF.validationForm('.modal-youtube');
		if (MasterF.status==false) {
			return false;
		}else
		{
			titulo_video=$('.title-video').val();
			url_video=$('.url-video').val();
			videos.push({'titulo':titulo_video,'url':url_video});
			structureYotube='<div class="video animated slideInLeft">\
			<span class="fa fa-close delete-video"></span>\
			<div class="container-icon">\
			<span class="fa fa-youtube center-porcent"></span>\
			</div>\
			<div class="title-video"><strong class="center-porcent"> '+titulo_video+'</strong></div>\
			</div>';
			$('.container-videos').append(structureYotube);
			$('.title-video').val('').focus();
			$('.url-video').val('');
		}
		
	});//agregar etiqueta del video
	$('.btn-cancel--').click(function(){
		$('.overlay-modals').css('animation-name','slideOutUp').fadeOut();
		$('.modals--').fadeOut();
		$('.wrong').removeClass('wrong');
	})
	$('.cancel-gallery').click(function(){
		videos=[];
		$('.modal-gallery').find('input,textarea,select').val('');
		$('.modal-youtube').find('input,textarea,select').val('');
		$('.modal-choose-portada').find('.input-form').val('');
		$('.container-choose').addClass('unchoose').removeClass('selected');
		$('.container-videos').html('');
		$('.element-image').remove();
	})
	$('.container-videos').on('click','.delete-video',function(){
		console.log($(this));
		if ($(this).attr('data-id')) {
			videosEliminados.push($(this).attr('data-id'));
		};
		$(this).parents('.video').remove();
		videos.splice($(this).index('.delete-video'),1);
	});
	$('.option-delete-images').click(function(){
		$('.element-image').addClass('sacudir');
		$('.element-image').find('span').fadeIn();
		$(this).fadeOut();
		$('.option-save-images').fadeIn();

	});
	$('.modal-dropable').on('click','.sacudir',function(){
		element=$(this);
		$imagenesEliminadas.push($(this).attr('data-ident'));
		element.remove();
	
	});
	$('.option-save-images').click(function(){
		$('.sacudir').removeClass('sacudir');
		$(this).fadeOut('fast')
		$('.option-delete-images').fadeIn('fast');
		if ($imagenesEliminadas.length) {
			
			$.ajax({
				url:window.location.origin+ '/eliminar/imagen.html',
				type:'post',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data:{
					imagenesEliminadas:$imagenesEliminadas,
					_method:'DELETE',
					_token:$('meta[name="csrf-token"]').attr('content')
				},
				success:function(data){
					console.log(data);
					$imagenesEliminadas=[];
				}
			});//end AJAX
		};
	});

});