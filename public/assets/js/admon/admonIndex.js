$(document).ready(function(){
	videos=[];
	id_galeria=0;
	dataFotos=[];
	
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

	$('.container-option').on('click',shoModal);
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
	})
	// Disparador : click on wrong class    
	$('.input-form').focus(function(){
		$(this).removeClass('wrong');
	});
	/*
	******************************* MODULO DE  GALERIAS *************************
	*/
	/* *========================STEP1=================================* */
	$('.save-galeria').click(function(){
		MasterF=new MasterForm;
		MasterF.status=MasterF.validationForm('.modal-gallery');
		nombre=$('.title-galeria').val();
		descripcion=$('.descripcion-galeria').val();
		tipo=$('.tipo-galeria').val();
		nextStep=$(this).attr('data-step');
		if (MasterF.status==false) {
			return false;
		}else
		{
			$.ajax({
				url:window.location.origin+ '/guardar/inf_principal.html',
				type:'post',
				headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        },
				data:{
					titulo:nombre,
					descripcion:descripcion,
					tipo:tipo,
					_method:'PUT',
					_token:$('meta[name="csrf-token"]').attr('content')
				},
				success:function(data){
					console.log(data);
					id_galeria=JSON.parse(data);
					if(id_galeria.id_galeria){
						$('.id_galeria--').val(id_galeria.id_galeria);
						$('.modals--').fadeOut();
						$(nextStep).css('animation-name','flipInX').fadeIn();
						$(nextStep).addClass('.modal-active');
					}
				}
			});//end AJAX
			
		}//else
	});//guardar-galeria
	/*=========================STEP 2=================================*/
	$('.container-choose').click(function(){
		$('.container-choose').css('border-color','#222');
		$('#portada-album').click();
	});
	$('#portada-album').on('change',function(){
		$('.container-choose').removeClass('unchoose').addClass('selected');
		$('.container-choose').find('p').text($('#portada-album')[0].files[0].name);
	});
	$('.save-portada').click(function(){
		console.log('veamos');
		MasterF=new MasterForm;
		MasterF.status=MasterF.validationForm('.modal-choose-portada');
		portada=$('#portada-album')[0].files[0];
		var portada=new FormData($('#form-portada-album')[0]);

		nextStep=$(this).attr('data-step');
		identGal=id_galeria.id_galeria;
		if (MasterF.status==false) {
			$('.container-choose').css('border-color','#EF5151');
			return false;
		}else
		{
			$.ajax({
				url:window.location.origin+ '/guardar/portada.html',
				xhr: function () {
					$('.progress-container').fadeIn('fast');
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
			url:window.location.origin+ '/guardar/videos.html',
			type:'post',
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			data:{
				id_galeria:id_galeria.id_galeria,
				videos:videos,
				_method:'PUT',
				_token:$('meta[name="csrf-token"]').attr('content')
			},
			success:function(data){
				console.log(data);
				if(id_galeria.id_galeria){
					$('.modals--').fadeOut();
					$(nextStep).css('animation-name','bounceInDown').fadeIn();
					$(nextStep).addClass('.modal-active');
				}
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
			$('.container-videos').prepend(structureYotube);
			$('.title-video').val('').focus();
			$('.url-video').val('');
		}
		
	});//agregar etiqueta del video
	$('.container-videos').on('click','.delete-video',function(){
		$(this).parents('.video').remove();
		videos.splice($(this).index('.delete-video'),1);
	});
	/*
		*************************** CATEGORIAS ****************************
	*/
	//agregar una nueva categoria
	$('.save-categoria').click(function(){
		MasterF=new MasterForm;
		MasterF.status=MasterF.validationForm('.modal-categoria');
		nombre=$('.nombre-categoria').val();
		if (MasterF.status==false) {
			return false;
		}else
		{
			$.ajax({
				url:window.location.origin+ '/agregar/tipogaleria.html',
				type:'post',
				headers: {
				            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				        },
				data:{
					nombre:nombre,
					_method:'PUT',
					_token:$('meta[name="csrf-token"]').attr('content')
				},
				success:function(data){
					console.log(data);
					Rid_categoria=JSON.parse(data);
					$('.modals--').fadeOut();
					$('.overlay-modals').css('animation-name','slideOutUp').fadeOut();
					$('.modals--').fadeOut();
					$('.modal-categoria').find('input').val('');
					$('.tipo-galeria').append('<option value="'+Rid_categoria.id+'">'+nombre+'</option>');

				}
			});//end AJAX
			
		}//else
	});//agregar categoria
	$('.save-imagenes').click(function(){
		$('.progress-container').fadeIn();
		gallery=new FormData();
		gallery.append('imagenes[]',files);
		$.each(files,function(index,val){
			gallery.append('imagenes['+index+']',val) ;
		});
		gallery.append('_token',$('meta[name="csrf-token"]').attr('content'));
		gallery.append('_method','PUT');
		gallery.append('id_galeria',id_galeria.id_galeria);
		$.ajax({
			url:window.location.origin+ '/guardar/imagenes.html',
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
				files={};
			}
			});//end AJAX
	});
});//END EXE


/*========================================
	Descripción:    Funcion para mostrar el modal correspondiente a la opcion seleccionada

	Diccionario de datos:   
=========================================*/
function    shoModal (){

	$('.overlay-modals').css('animation-name','slideInLeft').fadeIn();
	$($(this).attr('target-modal')).css('animation-name','slideInLeft').fadeIn().addClass('modal-active');

} //   shoModal
