$(function(){

  $('.topImg img').css('width','100%');
	$('.grid').hover(function(){
		$(this).children('.effect-bubba').children('.bgss').css('opacity',0.7);
		$('.bgss').css('z-index',10);
	},function(){
		$(this).children('.effect-bubba').children('.bgss').css('opacity',0);
	})

	//$('.figcap').mouseenter($('.figcaps').fadeOut(200)).mouseleave($('.figcaps').fadeIn(200));

	$('.bgss').each(function(index){
		var src = $(this).attr('valid');
		var str = "<style>.effect-bubba .figcap.bg"+index+"::before{ background-image:url('"+src+"');background-repeat:no-repeat;background-position:center center; background-size:255px 255px; }</style>";
		$(str).appendTo('head');
	})

	//���� �ڸ�������ī�� �׸��������� ���׶�� ��ư
	//$('.slideTop_txt p').wordBreakKeepAll();
	//$('.themaBan2_txt p').wordBreakKeepAll();
	//$('.sub11_txt11,.sub11_txt22').wordBreakKeepAll();
	//$('.sub22_board_info p').wordBreakKeepAll();
	//$('.sub3_1topTxt h4,.sub31_viewTab h4').wordBreakKeepAll();
	//$('.sub3_1List p').wordBreakKeepAll();






})



//����1�����̵�
$(document).ready(function(){
		$('.bxslider').bxSlider({
			mode:'fade',
			autoControls: false,
			auto: true,
			onSliderLoad:function(){
				$('body').loadingModal('destroy') ;
			}
		});


	var slider1 = "";
	slider1 = $('#m_weather').bxSlider({
		mode:'fade',
		auto: true,
		controls: false,
		autoControls: false,
		pager: false
	});
	$(document).on('click','.bx-pager-link',function() {
		
		slider1.startAuto();
	});



	$( ".weather_all_show1" ).click(function() {
		if( $(this).attr('val') != "1" ){
			$(this).attr('val', 1);
			$('#m_weather_all').css('z-index','0');
			$(this).html('<i class="fa fa-plus" aria-hidden="true"></i>');
			slider1.startAuto();
			slider2.startAuto();
			$('#m_weather li').css('border','0');
			var h = $('.weather-temp').css('height');
			$( ".weatehr_bg_img" ).css( 'height', $('.weather-temp').css('height') );

			$('#m_weather_all').css('display','none');
			$('#m_weather').css('display','block');
			$('.exchage').css('display','block');


			$('.exchage').animate({
				width: "50%",
				//height: $('.weather-temp').css('height'),
			}, 300, function (){
				
				//$('#m_weather_all').css('display','block');
			});

			$('.weather-temp').css('right',0);

			$('#m_weather_all').animate({
				"width": "50%",
				//height: $('.weather-temp').css('height'),
			}, 300 );


			$('.weather-temp').animate({
				width: "50%",
				//height: $('.weather-temp').css('height'),
				border: "0px solid #ccc",
			}, 300 );

		}else{
			$(this).attr('val', 0);
			$(this).html('<i class="fa fa-times" aria-hidden="true"></i>');
			slider1.stopAuto();
			slider2.stopAuto();
			$('#m_weather li').css('border','0');
			var h = $('.weather-temp').css('height');
			var w = $('.weather-temp').css('width');
			$( ".weatehr_bg_img" ).css( 'height', $('.weather-temp').css('height') );

			$('#m_weather_all').css('display','block');
			$('#m_weather').css('display','none');

			$('.exchage').animate({
				width: "0%",
				//height: $('.weather-temp').css('height'),
			}, 300, function (){
				$('.exchage').css('display','none');
				//$('#m_weather_all').css('display','block');
			});

			
			$('#m_weather_all').animate({
				"width": "100%",
			}, 300 );


			$('.weather-temp').animate({
				width: "100%",
				//height: $('.weather-temp').css('height'),
				border: "0px solid #ccc",
				float: "right"
			}, 300 );
		}
	});







	$( ".exchage_all_show" ).click(function() {
		if( $(this).attr('val') != 1 ){
			$(this).attr('val', 1);
			$(this).html('<i class="fa fa-plus" aria-hidden="true"></i>');
			slider1.startAuto();
			slider2.startAuto();
			$('#m_exchage li').css('border','0');
			var h = $('.weather-temp').css('height');
			$( ".weatehr_bg_img" ).css( 'height', $('.weather-temp').css('height') );

			$('#m_exchange_all').css('display','none');
			$('#m_exchage').css('display','block');
			$('.weather').css('display','block');



			$('.exchage').animate({
				width: "50%",
				//height: $('.weather-temp').css('height'),
			}, 300, function (){
				
				//$('#m_weather_all').css('display','block');
			});

			//$('.exchage').css('right',0);

			$('#m_exchange_all').animate({
				"width": "50%",
				//height: $('.weather-temp').css('height'),
			}, 300 );


			$('.weather').animate({
				width: "50%",
				//height: $('.weather-temp').css('height'),
				border: "0px solid #ccc",
			}, 300 );

		}else{
			$(this).attr('val', 0);
			$(this).html('<i class="fa fa-times" aria-hidden="true"></i>');
			slider1.stopAuto();
			slider2.stopAuto();
			//$('#m_weather li').css('border','0');
			//var h = $('.weather-temp').css('height');
			var w = $('.weather-temp').css('width');
			$( ".weatehr_bg_img" ).css( 'height', $('.weather-temp').css('height') );

			$('#m_exchange_all').css('display','block');
			$('#m_exchage').css('display','none');
			$('.exchage').css('z-index','7777');

			$('.weather').animate({
				width: "0%",
				//height: $('.weather-temp').css('height'),
				zIndex: 0
			}, 300, function (){
				$('.weather').css('display','none');
				//$('#m_weather_all').css('display','block');
			});

			$('.weatehr_bg_img').animate({
				"width": "100%",
				//height: $('.weather-temp').css('height'),
			}, 300 );
			
			$('#m_exchange_all').animate({
				"width": "100%",
				//height: $('.weather-temp').css('height'),
			}, 300 );


			$('.exchage').animate({
				width: "100%",
				//height: $('.exchage').css('height'),
				border: "0px solid #ccc",
			}, 300 );
		}
	});














	var slider2 = "";
	slider2 = $('#m_exchage').bxSlider({
		mode:'fade',
		auto: true,
		controls: false,
		autoControls: false,
		pager: false
	});
	$(document).on('click','.exchage .bx-viewport',function() {
		slider2.stopAuto();
		slider2.startAuto();
	});


});



//��� �����̵�
$(document).ready(function(){
	var slider = "";
		slider = $('#slider1').bxSlider({
		auto: true,
		controls: false,
		autoControls: false,
		pager: true
	});
	$(document).on('click','.storeBan1 .bx-wrapper .bx-pager-link',function() {
		slider.stopAuto();
		slider.startAuto();
	});
});

$(document).ready(function(){
	var slider = "";
		slider = $('#slider2').bxSlider({
		auto: true,
		controls: true,
		autoControls: false,
		pager: false
	});
	$(document).on('click','.storeBan2 .bx-wrapper .bx-next, .storeBan2 .bx-wrapper .bx-prev',function() {
		slider.stopAuto();
		slider.startAuto();
	});
});




//�׸� �����̵�
$(document).ready(function(){
	var slider = "";
		slider = $('#slider3').bxSlider({
		mode:'fade',
		auto: true,
		controls: true,
		autoControls: false,
		pager: true
	});
	$(document).on('click','.thema .bx-wrapper .bx-next, .thema .bx-wrapper .bx-prev, .thema .bx-pager-link',function() {
		slider.stopAuto();
		slider.startAuto();
	});
});






//���� �ϴ� ���� �����̵�
$(document).ready(function(){
	$('.slider1').bxSlider({
		slideWidth: 144,
		minSlides: 1,
		maxSlides: 4,
		moveSlides: 1,
		slideMargin: 17,
		//autoHover: true,
        //useCSS: false,
		auto: true,
		controls: false,
		pager: false,
		autoControls: true,
		speed: 1200
	});





});



