;(function($) {

//메인1슬라이드
$(document).ready(function(){
	var slider = "";
		slider = $('.bxslider').bxSlider({
		mode:'fade',
		auto: true,
        onSliderLoad: function(){ 
        
        }
	});
	$(document).on('click','.bx-next, .bx-prev, .bx-pager-link',function() {
		slider.stopAuto();
		slider.startAuto();
	});
});

})(jQuery);







$(function(){

  $('.topImg img').css('width','100%');
	$('.grid').hover(function(){
		$(this).find('.bgss').css('opacity',0.7);
		$('.bgss').css('z-index',10);
	},function(){
		$(this).find('.bgss').css('opacity',0);
	})


	//$('.figcap').mouseenter($('.figcaps').fadeOut(200)).mouseleave($('.figcaps').fadeIn(200));



	$('.bgss').each(function(index){
		var src = $(this).attr('valid');

		var str = "<style>.effect-bubba .figcap.bg"+index+"::before{ background-image:url('"+src+"');background-repeat:no-repeat;background-position:center center; background-size:255px 255px; }</style>";

		$(str).appendTo('head');

	})




	//메인 코리아투어카드 테마여행정보 동그라미 버튼
	//$('.thema_btn_txt p').wordBreakKeepAll();
	//$('.sub4_thum_slide a p').wordBreakKeepAll();
	//$('.hover_more1').wordBreakKeepAll();
	//$('.sub3_1view1 .sub3_benefit li p').wordBreakKeepAll();

})





//메인 중간 카드소개 슬라이드
$(document).ready(function(){
	var slider = "";
		slider = $('#slider1').bxSlider({
		mode:'fade',
		auto: true,
		controls: false,
		autoControls: false,
		pager: true
	});
	$(document).on('click','.bx-pager-link',function() {
		slider.stopAuto();
		slider.startAuto();
	});



	var slider1 = "";
	slider1 = $('#weather').bxSlider({
		mode:'fade',
		auto: true,
		controls: false,
		autoControls: false,
		pager: false
	});
	$(document).on('click','.bx-pager-link',function() {
		slider1.stopAuto();
		slider1.startAuto();
	});



	$('.weather_all_show').on('click',function(){
		
		if( $('.winter_all').css('display') == "none" ){
			$('.winter_all').css('display','block');
			$('.winter').css('display','none');
			slider1.stopAuto();
		}else{
			$('.winter_all').css('display','none');
			$('.winter').css('display','block');
			slider1.startAuto();   
		}
		 
	});

});



/**
 * 팝업 창 호출
 **/
var new_win = function(href, title) {
    var win = window.open(href, title, option);
}



//메인 하단 제휴 슬라이드
$(document).ready(function(){
	$('.slider1').bxSlider({
		slideWidth: 170,
		minSlides: 2,
		maxSlides: 7,
		moveSlides: 1,
		//slideMargin: 1,
		//autoHover: true,
        //useCSS: false,
		auto: true,
		controls: false,
		pager: false,
		autoControls: true,
		speed: 1200
	});
});



