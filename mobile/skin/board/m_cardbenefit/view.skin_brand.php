<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

$sql_result_benefit = sql_query( "select * from g5_board_file where wr_id = ".$wr_id." order by bf_no" );
$sql_result_benefit_cnt = sql_fetch( "select count(*) cnt from g5_board_file where wr_id = ".$wr_id." order by bf_no" );

$v_img_count = count($view['file']);

if($_SESSION['lang'] == 'ko_KR'){
   $hl = "ko"; 
}else if($_SESSION['lang'] == 'en_US'){
   $hl = "en"; 
}else if($_SESSION['lang'] == 'ja_JP'){
   $hl = "ja";  
}else if($_SESSION['lang'] == 'zh_CN'){
   $hl = "zh-CN";  
}else if($_SESSION['lang'] == 'zh_TW'){
   $hl = "zh-TW";  
}

//$me_sql = "select * from g5_write_cardbenefit"


$metro_ids = explode("|", $view['wr_metro']);

if($_SESSION['lang'] == 'ko_KR'){
	$service_txt = get_view_thumbnail($view['wr_service']);
}else{
	$service_txt = get_view_thumbnail($view['wr_service_'.$_SESSION['lang']]);
}
$service_txt = explode("\r", $service_txt );


if($_SESSION['lang'] == 'ko_KR'){
	$waring_txt = get_view_thumbnail($view['wr_waring']);
}else{
	$waring_txt = get_view_thumbnail($view['wr_waring_'.$_SESSION['lang']]);
}
$waring_txt = explode("\r", $waring_txt );



if($_SESSION['lang'] == 'ko_KR'){
	//$guide_txt = get_view_thumbnail($view['wr_guide']);
}else{
	//$guide_txt = get_view_thumbnail($view['wr_guide_'.$_SESSION['lang']]);
}
//$guide_txt = explode("\r", $guide_txt );




if($_SESSION['lang'] == 'ko_KR'){
	$content_txt = get_view_thumbnail($view['wr_content']);
}else{
	$content_txt = get_view_thumbnail($view['wr_content_'.$_SESSION['lang']]);
}
$content_txt = explode("\r", $content_txt );

?>
<script src="/plugin/ask_banner/js/clipboard.min.js"></script>
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

    <div class="moble_wrap">
		<div class="sub_title1">
			<h2 style='color:#333; <?if( $view['wr_id'] == 145 ) echo "font-size:12px;"; ?> '><?echo cut_str(get_text($view['wr_subject_'.$_SESSION['lang']]), 70);?></h2>
		</div>

        <?
        $thumb1 = get_list_thumbnail_ktc($board['bo_table'], $view['wr_id'], '200', '',true, false, 'left', false,'80/0.5/3',0);
        $thumb1_logo = get_list_thumbnail_ktc($board['bo_table'], $view['wr_id'], '200', '',"", "", '', "",'',1);
        $thumb = get_list_thumbnail_ktc($board['bo_table'], $view['wr_id'], $thumb1['width'],$thumb1['height'],true, false, 'left', false,'80/0.5/3',0);
        $thumb_logo = get_list_thumbnail_ktc($board['bo_table'], $view['wr_id'], $thumb1_logo['width'],$thumb1_logo['height'],"", "", '', "",'',1);

        //$thumb = get_list_thumbnail($board['bo_table'], $view['wr_id'], '200', '',true, false, 'left', false,'80/0.5/3',0);
        //$thumb1 = get_list_thumbnail($board['bo_table'], $view['wr_id'], '200', '',true, false, 'left', false,'80/0.5/3',1);

        ?>

		<div class="sub3_1view_area">
			<?if( $thumb['src'] ){?>
				<div class="sub3_1view_top" style='background-image: url("<?=$thumb['src']?>");'>
			<?}else{?>
				<div class="sub3_1view_top" style='background-image: url("/img/default/ktc_cardbenefit_view.png");'>
			<?}?>
				<p class="sub3_1view_topBlack"></p>
				<h2>
					<?if($view['wr_homepage_'.$_SESSION['lang']]){?>
						<a href="<?=$view['wr_homepage_'.$_SESSION['lang']]?>" target='_blank'><img src="/img/mobile/sub/home_Icon.png" alt="홈버튼"/></a>
					<?}else if( $view['wr_homepage_en_US'] ){?>
						<a href="<?=$view['wr_homepage_en_US']?>" target='_blank'><img src="/img/mobile/sub/home_Icon.png" alt="홈버튼"/></a>
					<?}else{?>
						<a href="<?=$view['wr_homepage_ko_KR']?>" target='_blank'><img src="/img/mobile/sub/home_Icon.png" alt="홈버튼"/></a>
					<?}?>



				</h2>
			</div>
			
			<div class="sub3_1topTxt">
				<div class="logoArea">

					<?if($_SESSION['lang'] != "ko_KR"){?>
						<?if(  strpos( $view['wr_img_append_'.$_SESSION['lang']], "src=" ) ){?>
							<?=$view['wr_img_append_'.$_SESSION['lang']]?>
						<?}else if($thumb_logo['src']){?>
							<img src="<?=$thumb_logo['src']?>" alt=""/>
						<?}else{?>
							<img src="/img/default/ktc_cardbenefit_list.png" alt="" />
						<?}?>
					<?}else{?>
						<?if($thumb_logo['src']){?>
							<img src="<?=$thumb_logo['src']?>" alt=""/>
						<?}else{?>
							<img src="/img/default/ktc_cardbenefit_list.png" alt="" />
						<?}?>
					<?}?>

				</div>
				<h4>
                    <?for($i=0; $i<count($content_txt); $i++){?>
                        <?=$content_txt[$i]?><br>
                    <?}?>
                </h4>
			</div>

<style>
.useguide ul{
	width: 100%;
    margin-bottom: 30px;
	text-align: center;
}
a:link, a:visited{
    text-decoration: none;
    color: #333;
}
.useguide ul li{
    display: inline-block;
    width: 44%;
    height: 45px;
    padding: 0 8px;
    text-align: center;
    background-color: #ebebeb;
    margin-left: 2px;
    margin-bottom: 2px;
    line-height: 45px;
    border: 1px solid #fff;
	overflow:hidden;text-overflow:ellipsis;white-space:nowrap;
}
.useguide ul li.selected{
    background: #415d72;
    color: #fff;
}
</style>

			<div class="useguide">
				<?=get_group_benefit($view['wr_group'],$view['wr_id'], $_SESSION['lang'] );?>
			</div>

            <div class='map_info' valTable='<?=$board['bo_table']?>'  valInfoName='<?=$view['wr_subject']?>'  valInfoLat='<?=$view['wr_lat']?>' valInfoLng='<?=$view['wr_lng']?>'></div>

			<div class="sub3_1view">
				<div class="sub31_view_area">

					<ul class="benefit_searchTab">
						<li><a id='ktc_tab1' class="tab_link active" href="#tab1"><?=_t('혜택안내')?></a></li>
						<li><a id='ktc_tab2' href="#tab2" ids="1" class="tab_link info_focus5"  valTable='<?=$board['bo_table']?>'  valInfoName='<?=$view['wr_subject']?>'  valInfoLat='<?=$view['wr_lat']?>' valInfoLng='<?=$view['wr_lng']?>'  ><?=_t('이용안내')?></a></li>
					</ul>

					<div class="tabDetails">


                        <script>
                            new Clipboard('.clipboard_btn');
                        </script>     

						<div id="tab1" class="tabContents1">


							<div class="sub31_viewTab">

								<table class="sub3_benefit">
                                    <?if($v_img_count) {
                                        for ($i=4; $i<count($view['file']); $i++) {
                                            if ($view['file'][$i]['bf_content']) {?>
                                                <tr>
													<td class="sub3_benefitIMG">

															<?
															$file_result = sql_fetch( "select * from g5_board_file where bo_table = 'cardbenefit' and wr_id = ".$wr_id." and bf_no = ".$i);
															if($file_result['bf_ck']  ==  0){
																get_default_img(1);
															}else{
																get_default_img($file_result['bf_ck']);
															}
															?>
												
													</td>
													<td class="sub3_benefitTXT">
													
														<p>
															<?
																if($_SESSION['lang'] == 'ko_KR'){
																	echo $view['file'][$i]['bf_content'];
																}else{
																	echo $view['file'][$i]['bf_content_'.$_SESSION['lang']];
																}
															?>

														</p>
													</td>

                                                </tr>
                                            <?}
                                        }
                                    }?>

								</table>
								<link rel="stylesheet" href="/tmpl/theme_basic/css/font-awesome.css">

								
								<style>
									.tit_m{font-size:18px;margin-bottom:10px;}
									.tit_m i {margin-right:8px;}
									h4 span{word-break:break-all; white-space: normal !important;}
								</style>
								 
								 
								 
								 <div class="tit_m"><i class="fa fa-check-circle" aria-hidden="true"></i><?=_t('혜택 적용 안내')?></div>
								 

								 
								<h4  style="border-bottom: 1px dotted #ccc; margin-bottom:20px;padding-bottom:20px;" class='sub31_viewEX_guide'>
					
										<p class='sub31_viewEX sub31_viewEX_guide'>
											<!-- <?=$guide_txt[$i]?><br> -->
											<?if($_SESSION['lang'] == "ko_KR"){?>
												<?=$view['wr_guide'];?>
											<?}else{?>
												<?=$view['wr_guide_'.$_SESSION['lang']];?>
											<?}?>
										</p>
									
								</h4>
								
								<div class="tit_m"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i><?=_t('유의사항!')?></div>
								
								<?for($i=0; $i<count($waring_txt); $i++){?>
									<p class='sub31_viewEX'>
										<?=$waring_txt[$i]?><br>
									</p>
								 <?}?>
							</div><!-- sub31_viewTab 끝 -->

						</div><!--탭2 끝-->





						<div id="tab2" class="tabContents1">




							<div class="sub31_viewTab_map">
                                <div id='map' style='width:100%; height:300px;'></div>
							</div>

							<div class="sub31_viewTab">
								<div class="sub31_viewTab_area">
									<h3 class="sub31_guideTitle"><?=_t('이용안내')?></h3>

									<ul class="sub31_guideBtn">
										<li>
											<a href="tel:<?=$service_txt[0]?>">
												<h3><img src="/img/mobile/sub/sub3/sub3_1/guideBtn1.jpg" alt="전화걸기"/></h3>
												<p><?=_t('전화')?></p>
											</a>
										</li>

										<?
											$copy_add = "";
											if($_SESSION['lang'] == 'ko_KR'){
												$copy_add = $view['wr_address_txt'];
											}else{
												$copy_add = $view['wr_address_txt_'.$_SESSION['lang']];
											}	
										?>

										<li>
											<a class="clipboard_btn" data-clipboard-text="<?=$copy_add?>" onclick='alert("<?=_t('주소가 복사되었습니다.')?>")'>
												<h3><img src="/img/mobile/sub/sub3/sub3_1/guideBtn2.jpg" alt="주소복사"/></h3>
												<p class="<?=set_class('clipboard_btn_us','en_US')?>"><?=_t('주소복사')?></p>
											</a>
										</li>
                               

										<li>
											<a href="http://maps.google.com/maps?daddr=<?=$copy_add?>?&hl=<?=$hl?>" class="sub3_1view2_btn2" target='_blank'>
												<h3><img src="/img/mobile/sub/sub3/sub3_1/guideBtn3.jpg" alt="길찾기"/></h3>
												<p>
												<?if($_SESSION['lang']!="en_US"){?>
													<?=_t('길찾기 안내')?>
												<?}else{?>
													 directions
												<?}?>
												</p>
											</a>
										</li>

										<!--<li>
											<?
												$add = explode( '(', $view['wr_address_txt'] );
											?>
											<a href="https://m.map.daum.net/actions/carRoute?startLoc=&sxEnc=MOVRUSHMPYWQTSPOSS&syEnc=QNOSPRLIMPWRTLUWVS&endLoc=<?=$view['wr_address_txt']?>&exEnc=&eyEnc=&ids=%2CP22484179&service=" class="sub3_1view2_btn2" target='_blank'>
												<h3><img src="/img/mobile/sub/sub3/sub3_1/guideBtn3.jpg" alt="길찾기"/></h3>
												<p>길찾기</p>
											</a>
										</li>-->




									</ul>

									<ul class="sub31_guideInfo">
										
										<?if( strlen($copy_add) > 1 ){?>
										<li>
											<p class="guideInfo_icon1"></p>
											<p class="guideInfo_info"><?=$copy_add?></p>
										</li>
										<?}?>


										<?if( strlen($service_txt[1]) > 1 ){?>
											<li>
												<p class="guideInfo_icon3"></p>
												<p class="guideInfo_info"><?=$service_txt[1]?></p>
											</li>
										<?}?>
										<?if( strlen($service_txt[2]) > 1 ){?>
											<li>
												<p class="guideInfo_icon4"></p>
												<p class="guideInfo_info"><?=$service_txt[2]?></p>
											</li>
										<?}?>
									</ul>
								</div>


								<?if( $metro_ids[0] ){?>
									<div class="sub31_viewTab_area">
										<h3 class="sub31_guideTitle"><?=_t('교통정보')?> - <?=_t('지하철')?></h3>

										<ul class="sub31_guideTraffic <?=set_class('sub31_guideTraffic_us','en_US')?>">
											<?for($i=0; $i<count($metro_ids); $i++){
												$me_result = sql_fetch("select * from g5_write_cardbenefit_metro where metro_id = ".$metro_ids[$i]);?>
												<li style='<?if($i%2==0) echo "float:left; clear: both;";?>'>
													<h3 class="guideTraffic_icon"><img src="/img/sub/sub3/sub3_1/sub3_train<?=$me_result['metro_hosun'];?>.gif" alt="2호선"/></h3>
													<div class="guideTraffic_txt">
														<p class="Traffic_txt1"><?echo hosun($me_result['metro_hosun'],"_".$_SESSION['lang'])?></p>
														<p class="Traffic_txt2">
															<?if($_SESSION['lang'] == 'ko_KR'){?>
																(<?=$me_result['metro_info']?>)
															<?}else{?>
																(<?=$me_result['metro_info_'.$_SESSION['lang']]?>)
															<?}?>
															
														</p>
													</div>
												</li>
											<?}?>
										</ul>
									</div>
								<?}?>


								<?if( $view['wr_bus_1'] || $view['wr_bus_2'] || $view['wr_bus_3'] || $view['wr_bus_4'] || $view['wr_bus_5'] || $view['wr_bus_6'] || $view['wr_bus_7'] || $view['wr_bus_8_'.$_SESSION['lang']]    || $view['wr_bus_9_'.$_SESSION['lang']]    ){?>

									<div class="sub31_viewTab_area">
										<h3 class="sub31_guideTitle"><?=_t('교통정보')?> - <?=_t('버스')?></h3>

										<ul class="sub31_guideBus <?=set_class('sub31_guideBus_us','en_US')?>">

											<?if($view['wr_bus_1']){?>
											<li>
												<h3 class="guideBus_name">
													<p class="guideBus_name_icon"><img src="/img/mobile/sub/sub3/sub3_1/sub3g1.jpg" alt=""/></p>
													<p class="guideBus_name_txt"><?=_t('지선버스')?></p>
												</h3>

												<div class="guideBus_info"><?=$view['wr_bus_1']?></div>
											</li>
											<?}?>


											<?if($view['wr_bus_5']){?>
											<li>
												<h3 class="guideBus_name">
													<p class="guideBus_name_icon"><img src="/img/mobile/sub/sub3/sub3_1/sub3g1.jpg" alt=""/></p>
													<p class="guideBus_name_txt"><?=_t('일반버스')?></p>
												</h3>

												<div class="guideBus_info"><?=$view['wr_bus_5']?></div>
											</li>
											<?}?>

											<?if($view['wr_bus_2']){?>
											<li>
												<h3 class="guideBus_name">
													<p class="guideBus_name_icon"><img src="/img/mobile/sub/sub3/sub3_1/sub3g2.jpg" alt=""/></p>
													<p class="guideBus_name_txt"><?=_t('간선버스')?></p>
												</h3>

												<div class="guideBus_info"><?=$view['wr_bus_2']?></div>
											</li>
											<?}?>

											<?if($view['wr_bus_6']){?>
											<li>
												<h3 class="guideBus_name">
													<p class="guideBus_name_icon"><img src="/img/mobile/sub/sub3/sub3_1/sub3g2.jpg" alt=""/></p>
													<p class="guideBus_name_txt"><?=_t('좌석버스')?></p>
												</h3>

												<div class="guideBus_info"><?=$view['wr_bus_6']?></div>
											</li>
											<?}?>



											<?if($view['wr_bus_3']){?>
											<li>
												<h3 class="guideBus_name">
													<p class="guideBus_name_icon"><img src="/img/mobile/sub/sub3/sub3_1/sub3g3.jpg" alt=""/></p>
													<p class="guideBus_name_txt"><?=_t('광역버스')?></p>
												</h3>

												<div class="guideBus_info"><?=$view['wr_bus_3']?></div>
											</li>
											<?}?>




											<?if($view['wr_bus_7']){?>
											<li>
												<h3 class="guideBus_name">
													<p class="guideBus_name_icon"><img src="/img/mobile/sub/sub3/sub3_1/sub3g3.jpg" alt=""/></p>
													<p class="guideBus_name_txt"><?=_t('직행버스')?></p>
												</h3>

												<div class="guideBus_info"><?=$view['wr_bus_7']?></div>
											</li>
											<?}?>


											<?if($view['wr_bus_4']){?>
											<li>
												<h3 class="guideBus_name">
													<p class="guideBus_name_icon"><img src="/img/mobile/sub/sub3/sub3_1/sub3g4.jpg" alt=""/></p>
													<p class="guideBus_name_txt"><?=_t('공항버스')?></p>
												</h3>

												<div class="guideBus_info"><?=$view['wr_bus_4']?></div>
											</li>
											<?}?>



											<?if($view['wr_bus_8_ko_KR']){?>
											<li>
												<h3 class="guideBus_name">
													<p class="guideBus_name_icon"><img src="/img/mobile/sub/sub3/sub3_1/sub3g1.jpg" alt=""/></p>
													<p class="guideBus_name_txt"><?=_t('마을버스')?></p>
												</h3>

												<div class="guideBus_info">
													<?if($view['wr_bus_8_'.$_SESSION['lang']]){?>
														<?=$view['wr_bus_8_'.$_SESSION['lang']]?>
													<?}else{?>
														<?=$view['wr_bus_8_ko_KR']?>
													<?}?>
												</div>
											</li>
											<?}?>


											<?if($view['wr_bus_9_ko_KR']){?>
											<li>
												<h3 class="guideBus_name">
													<p class="guideBus_name_icon"><img src="/img/mobile/sub/sub3/sub3_1/sub3g1.jpg" alt=""/></p>
													<p class="guideBus_name_txt"><?=_t('버스')?></p>
												</h3>

												<div class="guideBus_info">
													<?if($view['wr_bus_9_'.$_SESSION['lang']]){?>
														<?=$view['wr_bus_9_'.$_SESSION['lang']]?>
													<?}else{?>
														<?=$view['wr_bus_9_ko_KR']?>
													<?}?>
												</div>
											</li>
											<?}?>


										</ul>
									</div>

								<?}?>


							</div><!-- sub31_viewTab 끝 -->



						</div><!--탭1 끝-->


					</div><!-- tabDetails 끝 -->
					
				</div><!-- sub31_view_area 끝 -->
			</div>
		</div>



<script>
$(function() {
	$('.sub31_viewTab span').each(function(index){
		$(this).html($(this).text().replace(/\\/g,'<i class="fa fa-krw" style="font-size:10px;" aria-hidden="true"></i>'));
	});

	$('.sub31_viewEX').each(function(index){
		//$(this).html($(this).text().replace(/\\/g,'<i class="fa fa-krw" style="font-size:10px;" aria-hidden="true"></i>'));
	});

	$('.sub3_benefit p').each(function(index){
		$(this).html($(this).text().replace(/\\/g,'<i class="fa fa-krw" style="font-size:10px;" aria-hidden="true"></i>'));
	});

})

<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("<?php echo _t('다운로드 권한이 없습니다.').'\n'._t('회원이시라면 로그인 후 이용해 보십시오.'); ?>");
            return false;
        }

        var msg = "<?php echo _t('파일을 다운로드 하시면 포인트가 차감'); ?>(<?php echo number_format($board['bo_download_point']) ?><?php echo _t('점'); ?>)<?php echo _t('됩니다.'); ?>\n\n<?php echo _t('포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.').'\n\n'._t('그래도 다운로드 하시겠습니까?'); ?>";

        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);

            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function copy_trackback(obj) {
    var address = $('.sub3_1view2_btn1').attr('valadd');
	var IE=(document.all)?true:false;
	if (IE) {
			window.clipboardData.setData("Text", address);
            alert('복사되었습니다.')
	} else {
		temp = prompt("이 글의 주소입니다. Ctrl+C를 눌러 클립보드로 복사하세요", address);
	}
}


function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<!-- 게시글 보기 끝 -->

<script>
$(function() {
    
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx;
        if(this.id == "good_button")
            $tx = $("#bo_v_act_good");
        else
            $tx = $("#bo_v_act_nogood");

        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});

function excute_good(href, $el, $tx)
{
    $.post(
        href,
        { js: "on" },
        function(data) {
            if(data.error) {
                alert(data.error);
                return false;
            }

            if(data.count) {
                $el.find("strong").text(number_format(String(data.count)));
                if($tx.attr("id").search("nogood") > -1) {
                    $tx.text("<?php echo _t('이 글을 비추천하셨습니다.'); ?>");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("<?php echo _t('이 글을 추천하셨습니다.'); ?>");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}
</script>


<script>
$(function(){
	resize_fn();
	$(window).resize(function(){
		resize_fn();
	})
})

var img_width=976;
var img_height=300;
function resize_fn()
{
	par_num=$(document).width()/img_width*100;
	if(par_num>100)
	{	
		par_num=100;
	}
	height_number=par_num/100*img_height;
	$(".sub3_1view_top").height(height_number)
}
</script>




<script src="/skin/board/map/map.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIX9g1T3yPSC5_ewJO25c7mCiRs0clTU8&language=<?=$hl?>&region=<?=$hl?>"></script>