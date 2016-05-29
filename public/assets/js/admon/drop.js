$(function(){
	dataFotos=[];
	files=[];
	// Selector de drop
	var obj=$('.drop-images');
	obj.on('dragover',function(e){
		e.stopPropagation();
		e.preventDefault();
		$(this).addClass('drop-active');
	});
	obj.on('dragleave',function(e){
		e.stopPropagation();
		e.preventDefault();
		$(this).removeClass('drop-active');
	});
	
	obj.on('drop',function(e){
		e.stopPropagation();
		e.preventDefault();
		$(this).removeClass('drop-active');
		files= e.originalEvent.dataTransfer.files;
		var file=files[0];
		if (files.length<2) {
			$('.circle-effect').find('p').text(files.length+' foto seleccionada')
		}else{
			$('.circle-effect').find('p').text(files.length+' fotos seleccionadas')
		}
		if ( typeof(dataGallery) != 'undefined' ) {
			if (files.length>1) {
				$('.cant-new-imagenes').text(files.length+' Imágenes nuevas');
			}else{
				$('.cant-new-imagenes').text(files.length+' Imágen nueva');
			}
		};
	});
	


});