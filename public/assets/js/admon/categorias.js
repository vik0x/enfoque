$(document).ready(function () {
	categoriaSelected={};
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
	$('.btn-edit-categoria').click(function(){
		nombre=$(this).parents('tr').find('td').eq(0).text();
		categoriaSelected=$(this);
		$('.nombre-categoria').val(nombre);
		$('.overlay-modals').css('animation-name','slideInLeft').fadeIn();
		$('.modal-categoria').fadeIn();
	});
	
	$('.btn-cancel--').click(function(){
		$('.overlay-modals').css('animation-name','slideOutUp').fadeOut();
		$('.modals--').fadeOut();
		$('.wrong').removeClass('wrong');
	})
	/*================ GUARDAR CATEGORIA ===============*/
	$('.save-categoria').click(function(){
		MasterF=new MasterForm;
		MasterF.status=MasterF.validationForm('.modal-categoria');
		nombre=$('.nombre-categoria').val();
		if (MasterF.status==false) {
			return false;
		}else
		{
			$.ajax({
				url:window.location.origin+ '/modificar/tipogaleria/'+categoriaSelected.attr('data-id')+'.html',
				type:'post',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				data:{
					nombre:nombre,
					_method:'PATCH',
					_token:$('meta[name="csrf-token"]').attr('content')
				},
				success:function(data){
					console.log(data);
					$('.modals--').fadeOut();
					$('.overlay-modals').css('animation-name','slideOutUp').fadeOut();
					$('.modals--').fadeOut();
					categoriaSelected.parents('tr').find('td').eq(0).text(nombre);
					$('.modal-categoria').find('input').val('');
				}
			});//end AJAX

		}//else
	});
	/*================ ELIMINAr CATEGORIA ===============*/
	$('.btn-delete-categoria').click(function(){
		categoriaSelected=$(this);

		proced=false;
		$('.overlay-modals').css('animation-name','slideInLeft').fadeIn();
		$('.modal-confirm').fadeIn();
		
			
	});
});
$('.acept').on('click',function(){
	deleteCategoria();
	$('.overlay-modals').css('animation-name','slideOutUp').fadeOut();
	$('.modals--').fadeOut();
});
$('.DONT').on('click',function(){
	$('.overlay-modals').css('animation-name','slideOutUp').fadeOut();
	$('.modals--').fadeOut();
	return false;
	
});
function deleteCategoria(){
	$.ajax({
		url:window.location.origin+ '/eliminar/tipogaleria/'+categoriaSelected.attr('data-id')+'.html',
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
			categoriaSelected.parents('tr').remove();
		}
	});//end AJAX
}