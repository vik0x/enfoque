$(document).ready(function(){
    $IMAGE_START={};
    $CHILDRENS_GALLERY=$('.image-gallery').length;
    'use strict';
    $('.image-gallery').click(function(){
        $IMAGE_START=$(this);
        seeImage($(this));
    });
    $('.js-close').click(function(){
          $('.js-overlay').fadeOut();
        $('.js-slider').fadeOut();
    });
    //controles del slider
    $('.carousel-control').click(function(){
        var option=$(this).data('slide');
        controlSlider(option);
    });
    $('body').keyup(function(e){
            if(e.keyCode == 37){
                $('.left.carousel-control').click();
            }else if(e.keyCode == 39){
                $('.right.carousel-control').click();
            }
            if (e.keyCode == 27) {
                $('.js-close').click();
            };
        });

});// END EXEC
function controlSlider($option){
    if ($option == 'next') {
        if ($IMAGE_START.index()+1 < $CHILDRENS_GALLERY) {
            nextImage=$('.image-gallery').eq($IMAGE_START.index()+1);
            $url=nextImage.find('img').attr('src');
            $('.js-slider').find('img').attr('src',$url);
            $IMAGE_START=nextImage;
        };
    }else if($option == 'prev'){
            if ($IMAGE_START.index()-1 > 0) {
                backImage=$('.image-gallery').eq($IMAGE_START.index()-1);
                $url=backImage.find('img').attr('src');
                $('.js-slider').find('img').attr('src',$url);
                $IMAGE_START=backImage;
            };
    }
}
function seeImage($element){
    $url=$element.find('img').attr('src');
    $('.js-slider').find('img').attr('src',$url);
    $('.js-overlay').fadeIn().css('display','block');
    $('.js-slider').fadeIn();
}