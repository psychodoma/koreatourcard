<?php
$mobile_agent = array("Mozilla/5.0 ", "Ipone","Ipod","Android","Blackberry","SymbianOS|SCH-M\d+","Opera Mini", "Windows ce", "Nokia", "sony" );
$check_mobile = false;

for($i=0; $i<count($mobile_agent); $i++){
		
	if(stripos( $_SERVER['HTTP_USER_AGENT'], $mobile_agent[$i] )){

	$check_mobile = true;
	break;
	}
}

if($check_mobile) { 
	header("location: ./mobile.html");
}
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="Generator" content="EditPlus®">
<meta name="Author" content="">
<meta name="Keywords" content="">
<meta name="Description" content="">


<script  src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="js/jquery.bxslider.js"></script>
<script type="text/javascript" src="js/javascript.js"></script>

<script type="text/javascript" src="js/jquery.easing-1.3.js"></script>
<script type="text/javascript" src="js/jquery.iosslider.min.js"></script>


<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/sub.css">
<link rel="stylesheet" href="css/jquery.bxslider.css">



<script>
//메인1슬라이드
$(document).ready(function(){
	var slider = "";
		slider = $('.bxslider').bxSlider({
		mode:'fade',
		auto: true
	});
	$(document).on('click','.bx-next, .bx-prev, .bx-pager-link',function() {
		slider.stopAuto();
		slider.startAuto();
	});
});


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
});


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

</script>

<title>Document</title>
</head>
<body>

<!--헤드 시작-->
<div class="top_header">
	<div class="language">
		<ul>
			<li class="lanAtive"><a href="">한국어</a></li>
			<li><a href="">English</a></li>
			<li><a href="">日本語</a></li>
			<li><a href="">中文(简体)</a></li>
			<li><a href="">中文(繁體)</a></li>
		</ul>
	</div>

	<div class="logo_search">
		<h1><a href="index.html"><img src="img/main/logo.jpg" alt="로고"/></a></h1>

		<form name="fsearchbox" method="get" action="" onsubmit="return fsearchbox_submit(this);" class="">
			<fieldset>
				<input type="hidden" name="sfl" value="wr_subject||wr_content">
				<input type="hidden" name="sop" value="and">
				<label for="sch_stx" class="sound_only hide">검색어<strong class="sound_only"> 필수</strong></label>

				<ul id="search">
					<li class="search_input">
						<label for="" class="hide">검색창</label>
						<input type="text" class="searchbar" name="stx" id="sch_stx" maxlength="" placeholder="검색어를 입력하세요.">
					</li>

					<li class="search_btn">
						<input type="image" class="loginbtn" id="sch_submit" src="img/main/serach_btn.jpg" alt="검색" title="검색" />
					</li>
				</ul>
           

				<script>
					function fsearchbox_submit(f)
					{
						if (f.stx.value.length < 2) {
							alert("검색어는 두글자 이상 입력하십시오.");
							f.stx.select();
							f.stx.focus();
							return false;
						}

						// 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
						var cnt = 0;
						for (var i=0; i<f.stx.value.length; i++) {
							if (f.stx.value.charAt(i) == ' ')
								cnt++;
						}

						if (cnt > 1) {
							alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
							f.stx.select();
							f.stx.focus();
							return false;
						}

						return true;
					}
				</script>
			</fieldset>
		</form>
	</div>
</div>
<!--헤드 끝-->




<!--컨텐츠 시작-->
<div class="main_slide">
	<ul class="bxslider" >
		<li style="min-width: 1270px;"><img src="img/main/main_visual1.jpg" style="width:100%;" alt="메인1"/></li>
		<li style="min-width: 1270px;"><img src="img/main/main_visual2.jpg" style="width:100%;" alt="메인2"/></li>
		<li style="min-width: 1270px;"><img src="img/main/main_visual3.jpg" style="width:100%;" alt="메인3"/></li>
	</ul>
</div>

<div class="navi">
	<ul>
		<li class="icon1"><a href="sub1_1.html"><img src="img/main/navi1.png" alt=""/>카드소개</a></li>
		<li class="icon2"><a href="sub2_1.html"><img src="img/main/navi2.png" alt=""/>판매점안내</a></li>
		<li class="icon3"><a href="sub3_1list.html"><img src="img/main/navi3.png" alt=""/>카드사용혜택</a></li>
		<li class="icon4"><a href="sub4_1.html"><img src="img/main/navi4.png" alt=""/>여행정보 & 커뮤니티</a></li>
	</ul>
</div>






<div class="benefit">
	<div class="benefit_content">
		<div class="benefit_title">
			<p>교통카드 기능 플러스 쇼핑, 관광지, 공연 할인까지!</p>
			<h2>코리아투어카드 혜택</h2>
		</div>

		<ul class="benefit_btn">
			<li class="benefit1">
				<a href="sub3_1list.html" class="benLink1">
					<div class="benefitBtn_txt">
						<img src="img/main/benefit_icon1_shoping.jpg" alt="쇼핑아이콘"/>
						<h4>쇼핑</h4>
						<p>유명 쇼핑몰 5~10% 할인<br/>
						음료쿠폰 증정</p>
					</div>
				</a>
				<a href="" class="benLink2">
					<div class="benefitBtn_photo">
						<img src="img/main/benefit_photo1.jpg" alt="한강따라 쇼핑코스 이미지"/>
						<div>
							<p>한강따라 쇼핑코스 <span>></span></p>
						</div>
					</div>
				</a>
			</li>

			<li class="benefit2">
				<a href="sub3_1list.html" class="benLink1">
					<div class="benefitBtn_txt">
						<img src="img/main/benefit_icon2_store.jpg" alt="면세아이콘"/>
						<h4>면세점</h4>
						<p>금액할인권,선불카드 증정<br/>
						사은품 증정</p>
					</div>
				</a>
				<a href="" class="benLink2">
					<div class="benefitBtn_photo">
						<img src="img/main/benefit_photo2.jpg" alt="전통 기념관 쇼핑코스 이미지"/>
						<div>
							<p>전통 기념관 쇼핑코스 <span>></span></p>
						</div>
					</div>
				</a>
			</li>

			<li class="benefit3">
				<a href="sub3_1list.html" class="benLink1">
					<div class="benefitBtn_txt">
						<img src="img/main/benefit_icon3_food.jpg" alt="식품아이콘"/>
						<h4>식품</h4>
						<p>오설록 10%할인<br/>
						쿠킹클래스 10%할인</p>
					</div>
				</a>
				<a href="" class="benLink2">
					<div class="benefitBtn_photo">
						<img src="img/main/benefit_photo3.jpg" alt="한국의맛, 전통체험코스 이미지"/>
						<div>
							<p>한국의맛, 전통체험코스 <span>></span></p>
						</div>
					</div>
				</a>
			</li>

			<li class="borderRight_no benefit4">
				<a href="sub3_1list.html" class="benLink1">
					<div class="benefitBtn_txt">
						<img src="img/main/benefit_icon4_travel.jpg" alt="관광지아이콘"/>
						<h4>관광지</h4>
						<p>놀이동산 30% 할인<br/>
						한복체험 10% 할인</p>
					</div>
				</a>
				<a href="" class="benLink2">
					<div class="benefitBtn_photo">
						<img src="img/main/benefit_photo4.jpg" alt="한국의놀이공원,한류코스 이미지"/>
						<div>
							<p>한국의놀이공원,한류코스 <span>></span></p>
						</div>
					</div>
				</a>
			</li>

			<li class="benefit5">
				<a href="sub3_1list.html" class="benLink1">
					<div class="benefitBtn_txt">
						<img src="img/main/benefit_icon5_hanryu.jpg" alt="한류아이콘"/>
						<h4>한류</h4>
						<p>SM타운 가맹 카페 10~20% 할인<br/>
						기념상품 할인</p>
					</div>
				</a>
				<a href="" class="benLink2">
					<div class="benefitBtn_photo">
						<img src="img/main/benefit_photo5.jpg" alt="세계의 문화 한류코스 이미지"/>
						<div>
							<p>세계의 문화 한류코스 <span>></span></p>
						</div>
					</div>
				</a>
			</li>

			<li class="benefit6">
				<a href="sub3_2.html" class="benLink1">
					<div class="benefitBtn_txt">
						<img src="img/main/benefit_icon6_show.jpg" alt="공연아이콘"/>
						<h4>공연</h4>
						<p>유명 공연 20~30% 할인</p>
					</div>
				</a>
				<a href="" class="benLink2">
					<div class="benefitBtn_photo">
						<img src="img/main/benefit_photo6.jpg" alt="멋진아티스트 공연코스 이미지"/>
						<div>
							<p>멋진아티스트 공연코스 <span>></span></p>
						</div>
					</div>
				</a>
			</li>

			<li class="benefit7">
				<a href="sub3_2.html" class="benLink1">
					<div class="benefitBtn_txt">
						<img src="img/main/benefit_icon7_etc.jpg" alt="기타아이콘"/>
						<h4>기타</h4>
						<p>핫트랙스 10% 할인<br/>
						1만원이상 구매시 사은품 증정</p>
					</div>
				</a>
				<a href="" class="benLink2">
					<div class="benefitBtn_photo">
						<img src="img/main/benefit_photo7.jpg" alt="더 많은 혜택 다양한 코스 이미지"/>
						<div>
							<p>더 많은 혜택 다양한 코스 <span>></span></p>
						</div>
					</div>
				</a>
			</li>

			<li class="borderRight_no">
				<a href="">
					<img src="img/main/benefit_banner.jpg" alt="호텔엔조이 5% HP적립"/>
				</a>
			</li>
		</ul>
		
	</div>
</div>





<div class="thema">
	<div class="thema_content">
		<div class="thema_title">
			<p>한국 관광의 필수품!</p>
			<h2>코리아투어카드 테마여행정보</h2>
		</div>

		<ul class="thema_btn">
			<li class="li_margin_l">
				<a href="">
					<div class="grid">
						<div class="effect-duke">
							<img src="img/main/thema_btn1.jpg" alt="테마유형버튼1"/>
							<div class="figcap">
								<!--<h2>Messy <span>Duke</span></h2>
								<p>Duke is very bored. When he looks at the sky, he feels to run.</p>
								<a href="#">View more</a>-->
							</div>		
						</div>
					</div>
					<div class="thema_btn_txt">
						<h3>롯데월드 재밌어요!</h3>
						<p>카드한장으로 잠실역도 갈 수 있고<br/>
						자유이용권도 30%할인 받아서 기분...</p>
					</div>
				</a>
			</li>

			<li>
				<a href="">
					<div class="grid">
						<div class="effect-duke">
							<img src="img/main/thema_btn2.jpg" alt="테마유형버튼2"/>
							<div class="figcap"></div>		
						</div>
					</div>

					<div class="thema_btn_txt">
						<h3>면세점 할인권 받았어요~</h3>
						<p>여행갈때 면세점을 항상<br/>
						들리는데 할인권도 주는군요!</p>
					</div>
				</a>
			</li>

			<li>
				<a href="">
					<div class="grid">
						<div class="effect-duke">
							<img src="img/main/thema_btn3.jpg" alt="테마유형버튼3"/>
							<div class="figcap"></div>		
						</div>
					</div>

					<div class="thema_btn_txt">
						<h3>녹차매니아 친구와</h3>
						<p>녹차를 엄청 좋아하는 친구 따라<br/>
						가봤는데 녹차의 매력에 빠졌...</p>
					</div>
				</a>
			</li>

			<li>
				<a href="">
					<div class="grid">
						<div class="effect-duke">
							<img src="img/main/thema_btn4.jpg" alt="테마유형버튼4"/>
							<div class="figcap"></div>		
						</div>
					</div>

					<div class="thema_btn_txt">
						<h3>편의점 털기</h3>
						<p>카드만 있으면 뭐든 할수 있는거<br/>
						같아요! 편의점도 털었네요</p>
					</div>
				</a>
			</li>

			<li class="li_margin_r">
				<a href="">
					<div class="grid">
						<div class="effect-duke">
							<img src="img/main/thema_btn5.jpg" alt="테마유형버튼5"/>
							<div class="figcap"></div>		
						</div>
					</div>

					<div class="thema_btn_txt">
						<h3>공항철도 타고 숙소로</h3>
						<p>공항에서 카드를 구입해서<br/>
						바로 공항철도 이용했어요</p>
					</div>
				</a>
			</li>

		</ul>
	</div>
</div>


<!--------------------------------------------------------------------------------------->
<div class="card">
	<div class="card_area">
		<script>
		cur_num=0;
		$(function(){
			total_num=$(".slideSelectors").find("a").length-1
				
			$("#next_btn").click(function(){
				cur_num++;
				//cur_num=cur_num+1;
				if(total_num<cur_num)
				{
					cur_num=0;
				}
				$(".slideSelectors").find("a").eq(cur_num).parent().click();
			//	if(cur_num)
			})
			
			/* 포트폴리오
				$("#next_btn").click(function(){
				$(".ei-slider-thumbs").click();
			})
			*/
			
			
			$("#prev_btn").click(function(){
				cur_num--;
				if(0>cur_num)
				{
					cur_num=total_num;
				}
				$(".slideSelectors").find("a").eq(cur_num).parent().click();
			//	if(cur_num)
			})
		})
		</script>
		<div id="ei-slider" class="ei-slider">
    
			<div class="sliderContainer">
				<div id="prev_btn">prev</div>
				<div id="next_btn">next</div>

				<div class="iosSlider">
					<div class="slider">
						<div class="item item1">
							<div class="inner">
								<a href="" class="inner_link">
									<div class="card_img"><img src="img/main/main_card1.jpg" alt=""></div>
									<div class="text1"><span>코라아투어 카드는?1</span></div>
									<div class="text2">
										<span>외국인 전용 교통관광카드 코리아투어카드로 지하철,버스, 택시 등<br/>
										대한민국의 교통수단을 더욱 편리하게 이용할 수 있습니다.</span>
									</div>
									<p class="text3">자세히보기 <span class="inArro">></span></p>
								</a>
							</div>
						</div>
			
						<div class="item item2">
							<div class="inner">
								<a href="" class="inner_link">
									<div class="card_img"><img src="img/main/main_card2.jpg" alt=""></div>
									<div class="text1"><span>코라아투어 카드는?2</span></div>
									<div class="text2">
										<span>외국인 전용 교통관광카드 코리아투어카드로 지하철,버스, 택시 등<br/>
										대한민국의 교통수단을 더욱 편리하게 이용할 수 있습니다.</span>
									</div>
									<p class="text3">자세히보기 <span class="inArro">></span></p>
								</a>
							</div>
						</div>
						
						<div class="item item3">
							<div class="inner">
								<a href="" class="inner_link">
									<div class="card_img"><img src="img/main/main_card3.jpg" alt=""></div>
									<div class="text1"><span>코라아투어 카드는?3</span></div>
									<div class="text2">
										<span>외국인 전용 교통관광카드 코리아투어카드로 지하철,버스, 택시 등<br/>
										대한민국의 교통수단을 더욱 편리하게 이용할 수 있습니다.</span>
									</div>
									<p class="text3">자세히보기 <span class="inArro">></span></p>
								</a>
							</div>
						</div>
	
					</div>
				</div>
				
				<div class="slideSelectors">
					<div class="item selected"><a href=""></a></div>
					<div class="item"><a href=""></a></div>
					<div class="item"><a href=""></a></div>
				</div>
			</div>

		</div>

		<script type="text/javascript">
			$(document).ready(function() {
				
				$('.iosSlider').iosSlider({
					desktopClickDrag: true,
					snapToChildren: true,
					navSlideSelector: '.sliderContainer .slideSelectors .item',
					onSlideComplete: slideComplete,
					onSliderLoaded: sliderLoaded,
					onSlideChange: slideChange,
					scrollbar: false,
					autoSlide: true,
					autoSlideTimer: 3000,
					infiniteSlider: true
				});
				
			});

			function slideChange(args) {
						
				$('.sliderContainer .slideSelectors .item').removeClass('selected');
				$('.sliderContainer .slideSelectors .item:eq(' + (args.currentSlideNumber - 1) + ')').addClass('selected');

			}

			function slideComplete(args) {
				
				if(!args.slideChanged) return false;
				
				$(args.sliderObject).find('.text1, .text2, .text3').attr('style', '');
				
				$(args.currentSlideObject).find('.text1').animate({
					right: '100px',
					opacity: '0.8'
				}, 1500, 'easeOutQuint');
				
				$(args.currentSlideObject).find('.text2').delay(200).animate({
					right: '28px',
					opacity: '0.8'
				}, 1500, 'easeOutQuint');

				$(args.currentSlideObject).find('.text3').delay(400).animate({
					right: '317px',
					opacity: '0.8'
				}, 1500, 'easeOutQuint');
				
			}

			function sliderLoaded(args) {
					
				$(args.sliderObject).find('.text1, .text2, .text3').attr('style', '');
				
				$(args.currentSlideObject).find('.text1').animate({
					right: '100px',
					opacity: '0.8'
				}, 1500, 'easeOutQuint');
				
				$(args.currentSlideObject).find('.text2').delay(200).animate({
					right: '28px',
					opacity: '0.8'
				}, 1500, 'easeOutQuint');

				$(args.currentSlideObject).find('.text3').delay(400).animate({
					right: '317px',
					opacity: '0.8'
				}, 1500, 'easeOutQuint');
				
				slideChange(args);
				
			}
		</script>

	</div>
</div>




<div class="banner">
	<div class="banner_content">
		<p class="banner_content_Ban1"><a href=""><img src="img/main/banner1.jpg" alt=""/></a></p>
		
		<div class="banner_content_store">
			<div class="banner_content_storeArea">
				<div class="banner_title">
					<div class="banner_title_Btxt">
						<h3>코리아 투어 카드 판매점</h3>
						<p>80여곳이 넘는 판매점에서 만나실 수 있습니다.</p>

						<a href="sub2_1.html">자세히보기</a>
					</div>

					<div class="banner_title_Stxt">
						<p class="title">* 충전안내</p>
						<p class="info">편의점, 카드자판기(지하철 1~4호선), 지하철 유/무인충전기<br/>
						지하철역 티머니 서비스 데스크(서울 1~8호선, 인천지하철), 은행ATM</p>
					</div>
				</div>

				<ul class="banner_content_storePhoto">
					<li class="li_margin_l">
						<a href="sub2_2.html">
							<div><img src="img/main/store1.jpg" alt=""/></div>
							<p>세븐일레븐 편의점</br/>
							(서울/경기/제주 등 일부 지점)</p>
						</a>
					</li>	

					<li>
						<a href="sub2_2.html">
							<div><img src="img/main/store2.jpg" alt=""/></div>
							<p>제주항공</br/>
							(40개 정기 국제노선)</p>
						</a>
					</li>	

					<li>
						<a href="sub2_2.html">
							<div><img src="img/main/store3.jpg" alt=""/></div>
							<p>공항철도 (인천국제공항/</br/>
							서울역 트래블스토어)</p>
						</a>
					</li>	
				</ul>
			</div>
		

			<ul class="banner_content_Ban2">
				<li><a href=""><img src="img/main/banner2.jpg" alt=""/></a></li>
				<li><a href=""><img src="img/main/banner3.jpg" alt=""/></a></li>
				<li class="li_margin_b"><a href=""><img src="img/main/banner4.jpg" alt=""/></a></li>
			</ul>
		</div>



		<div class="banner_content_date">
			<ul class="banner_content_date_area">
				<li class="date bckimg1">
					<a href="sub4_3.html">
						<div class="dateTxt_area">
							<h3>2017 축제 / 행사 일정</h3>
							<p>모두가 함께하는 현장으로 초대합니다.</p>
						</div>
					</a>
				</li>

				<li class="date bckimg2" style="border-bottom:0;">
					<a href="sub4_1.html">
						<div class="dateTxt_area">
							<h3>지자체 여행 추천 코스</h3>
							<p>대한민국 곳곳에 숨어있는곳을 추천합니다.</p>
						</div>
					</a>
				</li>

				<li class="date_roll">
					<div class="date_roll_area">
						<h3>코리아투어카드 홍보센터</h3>
						<ul id="slider1" >
							<li>
								<a href="sub1_3list.html">
									<img src="img/main/main_promotion_img1.jpg" alt="" style="width:100%"/>
									<p>
										한국방문위원회, 외국인 전용 교통<br/>
										관광카드'코리아투어카드'출시1
									</p>
								</a>
							</li>
							<li>
								<a href="sub1_3list.html">
									<img src="img/main/main_promotion_img2.jpg" alt="" style="width:100%"/>
									<p>
										한국방문위원회, 외국인 전용 교통<br/>
										관광카드'코리아투어카드'출시2
									</p>
								</a>
							</li>
							<li>
								<a href="sub1_3list.html">
									<img src="img/main/main_promotion_img3.jpg" alt="" style="width:100%"/>
									<p>
										한국방문위원회, 외국인 전용 교통<br/>
										관광카드'코리아투어카드'출시3
									</p>
								</a>
							</li>
							<li>
								<a href="sub1_3list.html">
									<img src="img/main/main_promotion_img4.jpg" alt="" style="width:100%"/>
									<p>
										한국방문위원회, 외국인 전용 교통<br/>
										관광카드'코리아투어카드'출시4
									</p>
								</a>
							</li>
						</ul>
					</div>
				</li>
			</ul>

			<div class="banner_content_date_Ban">
				<p class="li_margin_l"><a href=""><img src="img/main/banner5.jpg" alt=""/></a></p>
				<p><a href=""><img src="img/main/banner6.jpg" alt=""/></a></p>
			</div>
		</div>



		<div class="banner_content_footer">
			<ul class="banner_content_footer_area">
				<li class="winter">
					<!-- <div>날씨불러오기 영역</div> -->
					<a href=""><img src="img/main/test_img2.jpg" alt=""/></a>
				</li>

				<li class="exchange">
					<div>
						<!--<h3>오늘의 환율</h3>-->
						<a href=""><img src="img/main/test_img1.jpg" alt=""/></a>
					</div>
				</li>

				<li class="traffic">
					<div>
						<a href="sub4_2.html">
							<h3>교통정보 안내</h3>
							<!--<img src="img/main/main_traffic.jpg" alt=""/>-->
							<p class="traffic_btn"></p>
						</a>
					</div>
				</li>

				<li class="others">
					<ul class="others_btn">
						<li>
							<a href="http://www.k-smile.org/" target="_blank">
								<img src="img/main/others_1_ksmail.jpg" alt="k스마일 캠페인"/>
								<p>K스마일 캠페인</p>
							</a>
						</li>

						<li>
							<a href="http://khandsfree.com/ko/" target="_blank">
								<img src="img/main/others_2_handsfree.jpg" alt="핸즈프리 서비스"/>
								<p>핸즈프리 서비스</p>
							</a>
						</li>

						<li>
							<a href="">
								<img src="img/main/others_3_facebook.jpg" alt="페이스북"/>
								<p>페이스북</p>
							</a>
						</li>

						<li>
							<a href="">
								<img src="img/main/others_4_YouTube.jpg" alt="유튜브"/>
								<p>유튜브</p>
							</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>


	</div><!-- banner_content -->

</div>

<!--컨텐츠 끝-->




<!-- 푸터 -->
<!--<div class="top_btn"><a href="#"><img src="img/main/top_btn.jpg" alt="TOP"/></a></div>-->
<div class="partner">
	<div class="slider1">
		<div class="slide"><a href="http://www.7-eleven.co.kr/" target="_black"><img src="img/main/f_ban1.jpg" alt="1"/></a></div>
		<div class="slide"><a href="http://cu.bgfretail.com/index.do" target="_black"><img src="img/main/f_ban2.jpg" alt="2"/></a></div>
		<div class="slide"><a href="http://www.shinsegae.com/" target="_black"><img src="img/main/f_ban3.jpg" alt="3"/></a></div>
		<div class="slide"><a href="http://www.doota-mall.com/index.do" target="_black"><img src="img/main/f_ban4.jpg" alt="4"/></a></div>
		<div class="slide"><a href="http://www.ehyundai.com/newPortal/outlet/main.do" target="_black"><img src="img/main/f_ban5.jpg" alt="5"/></a></div>
		<div class="slide"><a href="http://www.iparkmall.co.kr/main/main.asp" target="_black"><img src="img/main/f_ban6.jpg" alt="6"/></a></div>
		<div class="slide"><a href="http://www.lwt.co.kr/tower/main/main.do" target="_black"><img src="img/main/f_ban7.jpg" alt="7"/></a></div>
		<div class="slide"><a href="http://www.smtown.com/" target="_black"><img src="img/main/f_ban8.jpg" alt="8"/></a></div>
	</div>
</div>

<div class="footer">
	<div class="footer_area">
		<div class="top_btn"><a href="#"><img src="img/main/top_btn.jpg" alt="TOP"/></a></div>
		<p class="address">
			(재)한국방문위원회(고유번호 : 104-82-10669)<br/>
			서울틀별시 종로구 인사동 5길 29 (인사동 194-27) 태화빌딩 802호 ㅣ Tel : 02-6272-7300 ㅣ Fax : 02-6272-7400
		</p>
		<p class="copy">Copyright 2017. ⓒ Korea Tour Card. All Right Reserved.</p>
	</div>
</div>
<!-- 푸터 끝 -->



</body>
</html>
