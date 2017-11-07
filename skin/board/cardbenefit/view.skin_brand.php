<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
include_once(G5_LIB_PATH.'/ktc_common.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<script src="https://cdn.jsdelivr.net/clipboard.js/1.5.3/clipboard.min.js"></script>
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
<!-- div id="bo_v_table"><?php echo $board['bo_subject']; ?></div -->
<?
$next_page_info_result = sql_fetch("select * from g5_write_".$bo_table."  where wr_id < ".$wr_id." order by wr_id desc");
$prev_page_info_result = sql_fetch("select * from g5_write_".$bo_table."  where wr_id > ".$wr_id." ");
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
if($_SESSION['lang'] == "ko_KR"){
	$service_txt = get_view_thumbnail($view['wr_service']);
	$waring_txt = get_view_thumbnail($view['wr_waring']);
	$content_txt = get_view_thumbnail($view['wr_content']);
	//$guide_txt = get_view_thumbnail($view['wr_guide']);
}else{
	$service_txt = get_view_thumbnail($view['wr_service_'.$_SESSION['lang']]);
	$waring_txt = get_view_thumbnail($view['wr_waring_'.$_SESSION['lang']]);
	$content_txt = get_view_thumbnail($view['wr_content_'.$_SESSION['lang']]);
	//$guide_txt = get_view_thumbnail($view['wr_guide_'.$_SESSION['lang']]);
}
$service_txt = explode("\r", $service_txt );
$waring_txt = explode("\r", $waring_txt );
$content_txt = explode("\r", $content_txt );
//$guide_txt = explode("\r", $guide_txt );

if($_SERVER["REMOTE_ADDR"] == "210.96.212.116" ){ 
	//print_R($board);
	//print_r($view);
	//echo caNameShift($view['ca_name']);
}




?>
<script>
    $(function(){
        $('.topImg img').css('width','976px');
        $('.topImg img').css('height','300px');
    })

</script>



<!--
 <li>
	<h3>
		<a href="" target="_blank" class="view_image"><img src="" alt="프리미엄쿠폰북 1부 증정(점 내 조건부 할인 혜택 모음)       "  width="150" height="49" ></a>
	</h3>
	<p>프리미엄쿠폰북 1부 증정(점 내 조건부 할인 혜택 모음)                                   
</li>
</ul>
-->


<div class='map_info' valTable='<?=$board['bo_table']?>'  valInfoName='<?=$view['wr_subject_'.$_SESSION['lang']]?>'  valInfoLat='<?=$view['wr_lat']?>' valInfoLng='<?=$view['wr_lng']?>'></div>

<div class="sub2_2center">
	
    <div class="sub3_1view">

        <?if($view['file'][0]['view']) {?>

			<div class="badge">
				<div class="ico <?echo caNameShift($view['ca_name']);?>"> </div>
				<span class="<?=set_class('badgeTxt_us','en_US')?>"><?=_t(ck_category($view['ca_name']))?></span>
			</div>

            <div class="topImg" style='border: 0; '>
                <?if($v_img_count) {
                    for ($i=0; $i<1; $i++) {  
                        echo get_view_thumbnail($view['file'][$i]['view'],"976px","300px");
                    }
                }?>
            </div>
        <?}else{?>
            <div class="topImg">
				
                <?if($v_img_count) {
                    for ($i=0; $i<1; $i++) {
                        echo "<img src='/img/default/ktc_cardbenefit_view.png' style='width:976px; height:300px;' >";
                    }
                }?>
            </div>
        <?}?>

        <div class="topTxt" style="padding-top:30px;">
			 
			
			
			<div style="display:block;clear:both;">
            <h3 onclick='return false;'>
                <?if($v_img_count) {
                    for ($i=1; $i<2; $i++) {


                            // if ($view['file'][$i]['view']) {
                            //     echo get_view_thumbnail($view['file'][$i]['view'],"360px");
                            // }else{
                            //     echo "<img src='/img/default/ktc_cardbenefit_list.png' style='width:200px;' >";
                            // }



					if($_SESSION['lang'] != "ko_KR"){
						if(  strpos( $view['wr_img_append_'.$_SESSION['lang']], "src=" ) ){
							echo $view['wr_img_append_'.$_SESSION['lang']];
						}else if($view['file'][$i]['view']){
							echo get_view_thumbnail($view['file'][$i]['view'],"360px");
						}else{
							echo "<img src='/img/default/ktc_cardbenefit_list.png' style='width:200px;' >";
						}
					}else{
						if($view['file'][$i]['view']){
							echo get_view_thumbnail($view['file'][$i]['view'],"360px");
						}else{
							echo "<img src='/img/default/ktc_cardbenefit_list.png' style='width:200px;' >";
						}
					}









                    }
                }?>  
            </h3>
			</div>
            <p>
				<?if($_SESSION['lang'] == 'ko_KR'){?>
					<?=get_textarea_br($view['wr_content'])?>
				<?}else{?>
					<?=get_textarea_br($view['wr_content_'.$_SESSION['lang']])?>
				<?}?>
            </p>
        </div>
    </div>



    <div class="sub3_1view1">
        <h3 class="title"><?=_t('혜택안내')?></h3>


			<ul class="sub3_benefit_ly2">
                <?if($v_img_count) {
                    for ($i=4; $i<count($view['file']); $i++) {
                        if ($view['file'][$i]['bf_content'] || $view['file'][$i]['bf_content_'.$_SESSION['lang']]) {?>
                            <li <? if($i%2 ==1) echo 'class=w'; ?>>
                                <dt>
									<?if( true ){
                                        $file_result = sql_fetch( "select * from g5_board_file where bo_table = 'cardbenefit' and wr_id = ".$wr_id." and bf_no = ".$i);
                                        if($file_result['bf_ck']  ==  0){
                                            get_default_img(1);
                                        }else{
                                            get_default_img($file_result['bf_ck']);
                                        }
                                    }else{
                                        echo get_view_thumbnail($view['file'][$i]['view'],"195px");
                                    }?>
                                </dt>

                                <dd>
									<?if($_SESSION['lang'] == 'ko_KR'){?>
										- <?=get_textarea_br($view['file'][$i]['bf_content'])?> 
									<?}else{?>
										- <?=get_textarea_br($view['file'][$i]['bf_content_'.$_SESSION['lang']])?> 
									<?}?>
								</dd>
                            </li>
                        <?}
                    }
                }?>
            </ul>

		<!-- 이용조건 & 유의사항 안내-->
		<h4 class="subtitle"><?=_t('이용조건 안내 & 유의사항')?></h4>
            <div class="sub3_note">
				
				<?if($view['wr_guide']){?>
				<div class="sub3_note_area">
                    <p class="sub3_note_icon"><img src="/img/sub/sub3/sub3_2/checked_icon.png" alt=""/></p>

                    <div class="sub3_note_txt sub3_note_txt_guide">
                        <h4><?=_t('혜택 적용 안내')?></h4>
 
							<p>
							<?if($_SESSION['lang'] == "ko_KR"){?>
								<?=$view['wr_guide']?>
							<?}else{?>
								<?=$view['wr_guide_'.$_SESSION['lang']]?>
							<?}?>
							</p>
							
                    </div>
				</div>
				<?}?>

                <div class="sub3_note_area" <?if(!$view['wr_guide']){ echo "style='margin-bottom:0; padding-bottom:0;'"; }?>   >
                    <p class="sub3_note_icon"><img src="/img/sub/sub3/sub3_1/sub3_note_icon.jpg" alt=""/></p>

                    <div class="sub3_note_txt">
                        <h4><?=_t('유의사항!')?></h4>
                        <ul>
							<?for($i=0; $i<count($waring_txt); $i++){?>
								<li>
									<?=$waring_txt[$i];?>
								</li>
							<?}?>
                        </ul>
                    </div>
                </div>
            </div>



			<!-- 혜택 안내-->
			<div class="travel_info">
				<h4 class="subtitle"><?=_t('혜택은 이렇게 받으세요!')?></h4>
					<ul>
						<li class="info1">
							<a href="/bbs/board.php?bo_table=tourinfo&sca=테마여행%20추천코스&info=event&me_code=40&num=3<?=lang_url_a($_SESSION['lang'])?>">
								<dt>
									<div class="Num"> </div> 
									<div class="btn"><?=_t('여행 코스 알아보기')?>  <span class="btn_bull">></span></div>
								<dt>

								<dd>	
									 <?=_t('멋진 한국 여행을 준비한다면?!<br>한국의 다양한 여행지를 보고 여행코스를 짠다!')?>
								</dd>
							</a>
						</li>

						<li class="info2"> 
							<a href="/bbs/board.php?bo_table=map&info=search&me_code=20&num=1<?=lang_url_a($_SESSION['lang'])?>">
								<dt>
									<div class="Num"> </div> 
									<div class="btn"><?=_t('카드 판매처 알아보기')?> <span class="btn_bull">></span></div>
								<dt>
								<dd>	
									 <?=_t('다양한 할인혜택을 받기 위해 코리아투어카드를<br>한 장 준비해서 여행지로 떠난다!')?>
								</dd>
							</a>
						</li>

						<li class="info3"> 
							<a href="/bbs/faq.php?&info=qa&me_code=40&num=3<?=lang_url_a($_SESSION['lang'])?>">
								<dt >
									<div class="Num"> </div> 
									<div class="btn"><?=_t('더 궁금한 사항 보기')?> <span class="btn_bull">></span> </div>
								<dt>
								<dd>	
									<?=_t('여행지에서 입장권, 쇼핑 등 결제 시 코리아투어<br>카드를 보여주세요! 할인에 선물은 덤~')?>
								</dd>
							</a>
						</li>
					</ul>
			</div>
			
			<!-- 이용안내 -->
			<h3 class="title"><?=_t('매장안내')?></h3>	
			

			<div class="useguide">
				<?=get_group_benefit($view['wr_group'],$view['wr_id'], $_SESSION['lang'] );?>
			</div>

			<div class="sub3_1view2_txt">
					
					<div class="shop_img">
						<?echo get_view_thumbnail($view['file'][3]['view'],"320px");?>
					</div>

					<div class="view2_txtArea">
						<ul>
							<li class="view_tit">

								<?if($_SESSION['lang'] == 'ko_KR'){?>
									<?=$view['wr_subject']?>
								<?}else{?>
									<?=$view['wr_subject_'.$_SESSION['lang']]?>
								<?}?>
							


							</li>

							<li class="s31_add">
								<?$addres_copy = "";?>
								<?if($_SESSION['lang'] == 'ko_KR'){?>
									<?=$view['wr_address_txt'];
										$addres_copy = $view['wr_address_txt'];
									?>
								<?}else{?>
									<?=$view['wr_address_txt_'.$_SESSION['lang']];
										$addres_copy = $view['wr_address_txt_'.$_SESSION['lang']];
									?>
								<?}?>	
							</li>
							<li class="s31_tel">
                                <?=$service_txt[0]?>
                            </li>
							<li class="s31_sto">
                                <?=$service_txt[1]?>
                            </li>
							<li class="s31_hol">
                                <?=$service_txt[2]?>
                            </li>
						</ul>
						
					
						
						<!--홈페이지 버튼-->
						<?if( $view['wr_homepage_'.$_SESSION['lang']] ){?>
							<a href="<?=$view['wr_homepage_'.$_SESSION['lang']]?>" target='_blank' class="sub3_1view2_btn3 <?=set_class('view2_btn3_us','en_US')?> <?=set_class('view2_btn3_jp','ja_JP')?>"><?=_t('홈페이지')?></a>
						<?}else if( $view['wr_homepage_en_US'] ){?>
							<a href="<?=$view['wr_homepage_en_US']?>" target='_blank'  class="sub3_1view2_btn3 <?=set_class('view2_btn3_us','en_US')?> <?=set_class('view2_btn3_jp','ja_JP')?>"><?=_t('홈페이지')?></a>
						<?}else{?>
							<a href="<?=$view['wr_homepage_ko_KR']?>" target='_blank'  class="sub3_1view2_btn3 <?=set_class('view2_btn3_us','en_US')?> <?=set_class('view2_btn3_jp','ja_JP')?>"><?=_t('홈페이지')?></a>
						<?}?>
						
						<!--길찾기 버튼-->
						<a href="https://www.google.co.kr/maps/dir//<?=$addres_copy?>?hl=<?=$hl?>" class="sub3_1view2_btn2 <?=set_class('view2_btn2_us','en_US')?> <?=set_class('view2_btn2_jp','ja_JP')?>" target='_blank'><?=_t('길찾기 안내')?></a>

						<!--주소복사 버튼-->
						<a  href="" valadd="<?=$addres_copy?>" onclick="copy_trackback(this); return false;" class="sub3_1view2_btn1 <?=set_class('view2_btn1_us','en_US') ?>  <?=set_class('view2_btn1_jp','ja_JP')?>"><?=_t('주소복사')?></a>
					</div>
				</div>


			<div class="sub3_1view2">
				<h3 class="title"><?=_t('교통안내')?></h3>

				<div class="sub3_1view2_map">
                    <div id='map' style='width:100%; height:550px;'></div>
				</div>

				

                <?if( $metro_ids[0] ){?>
                    <div class="sub3_1view2_txt1">
                        <h3 class="<?=set_class('sub31view2_txt1_us','en_US')?>"><?=_t('교통정보')?> - <?=_t('지하철')?></h3>
                        <div class="view2_txtArea1">
                            <?for($i=0; $i<count($metro_ids); $i++){
                                $me_result = sql_fetch("select * from g5_write_cardbenefit_metro where metro_id = ".$metro_ids[$i]);?>
                                <div class="line2">
                                    <p><img src="/img/sub/sub3/sub3_1/sub3_train<?=$me_result['metro_hosun'];?>.gif" alt="호선"/></p>
                                    <h4>

										<?if($_SESSION['lang'] == 'ko_KR'){?>
											<span><?echo hosun($me_result['metro_hosun'],"_".$_SESSION['lang'])?></span>(<?=$me_result['metro_info']?>)
										<?}else{?>
											<span><?echo hosun($me_result['metro_hosun'],"_".$_SESSION['lang'])?></span>(<?=$me_result['metro_info_'.$_SESSION['lang']]?>)
										<?}?>


									
									
									
									</h4>
                                </div>
                            <?}?>
                        </div>
                    </div>
                <?}?>
                
   



					<?if( $view['wr_bus_1'] || $view['wr_bus_2'] || $view['wr_bus_3'] || $view['wr_bus_4'] || $view['wr_bus_5'] || $view['wr_bus_6'] || $view['wr_bus_7'] || $view['wr_bus_8_'.$_SESSION['lang']]    || $view['wr_bus_9_'.$_SESSION['lang']]    ){?>
    

                    <div class="sub3_1view2_txt1">
                        <h3 class="<?=set_class('sub31view2_txt1_us','en_US')?>"><?=_t('교통정보');?> - <?=_t('버스');?></h3>
                        
                        <ul class="view2_txtArea2 <?=set_class('view2_txtArea2_us','en_US')?>">

                            <?if($view['wr_bus_1']){?>
                                <li>
                                    <p class="Area2_icon"><img src="/img/sub/sub3/sub3_1/sub3g1.jpg" alt="아이콘"/></p>
                                    <h3><?=_t('지선버스');?></h3>
                                    <p class="Area2_num"><?=$view['wr_bus_1']?></p>
                                </li>
                            <?}?>


                            <?if($view['wr_bus_5']){?>
                                <li>
                                    <p class="Area2_icon"><img src="/img/sub/sub3/sub3_1/sub3g1.jpg" alt="아이콘"/></p>
                                    <h3><?=_t('일반버스');?></h3>
                                    <p class="Area2_num"><?=$view['wr_bus_5']?></p>
                                </li>
                            <?}?>


                            <?if($view['wr_bus_2']){?>
                            <li>
                                <p class="Area2_icon"><img src="/img/sub/sub3/sub3_1/sub3g2.jpg" alt="아이콘"/></p>
                                <h3><?=_t('간선버스');?></h3>
                                <p class="Area2_num"><?=$view['wr_bus_2']?></p>
                            </li>
                            <?}?>


                            <?if($view['wr_bus_6']){?>
                                <li>
                                    <p class="Area2_icon"><img src="/img/sub/sub3/sub3_1/sub3g2.jpg" alt="아이콘"/></p>
                                    <h3><?=_t('좌석버스');?></h3>
                                    <p class="Area2_num"><?=$view['wr_bus_6']?></p>
                                </li>
                            <?}?>


                            <?if($view['wr_bus_3']){?>
                            <li>
                                <p class="Area2_icon"><img src="/img/sub/sub3/sub3_1/sub3g3.jpg" alt="아이콘"/></p>
                                <h3><?=_t('광역버스');?></h3>
                                <p class="Area2_num"><?=$view['wr_bus_3']?></p>
                            </li>
                            <?}?>

                            <?if($view['wr_bus_7']){?>
                                <li>
                                    <p class="Area2_icon"><img src="/img/sub/sub3/sub3_1/sub3g3.jpg" alt="아이콘"/></p>
                                    <h3><?=_t('직행버스');?></h3>
                                    <p class="Area2_num"><?=$view['wr_bus_7']?></p>
                                </li>
                            <?}?>


                            <?if($view['wr_bus_4']){?>
                            <li>
                                <p class="Area2_icon"><img src="/img/sub/sub3/sub3_1/sub3g4.jpg" alt="아이콘"/></p>
                                <h3><?=_t('공항버스');?></h3>
                                <p class="Area2_num"><?=$view['wr_bus_4']?></p>
                            </li>
                            <?}?>

                            <?if($view['wr_bus_8_ko_KR']){?>
                                <li>
                                    <p class="Area2_icon"><img src="/img/sub/sub3/sub3_1/sub3g1.jpg" alt="아이콘"/></p>
                                    <h3><?=_t('마을버스');?></h3>
                                    <p class="Area2_num">
										<?if($view['wr_bus_8_'.$_SESSION['lang']]){?>
											<?=$view['wr_bus_8_'.$_SESSION['lang']]?>
										<?}else{?>
											<?=$view['wr_bus_8_ko_KR']?>
										<?}?>
									</p>
                                </li>
                            <?}?>

                            <?if($view['wr_bus_9_ko_KR']){?>
                                <li>
                                    <p class="Area2_icon"><img src="/img/sub/sub3/sub3_1/sub3g1.jpg" alt="아이콘"/></p>
                                    <h3><?=_t('버스');?></h3>
                                    <p class="Area2_num">
										<?if($view['wr_bus_9_'.$_SESSION['lang']]){?>
											<?=$view['wr_bus_9_'.$_SESSION['lang']]?>
										<?}else{?>
											<?=$view['wr_bus_9_ko_KR']?>
										<?}?>
									</p>
                                </li>
                            <?}?>


                        </ul>
                    </div>

               <?}?>
            </div>









<!-- } 게시판 읽기 끝 -->

<script>

$('.sub_contents img').click(function(){
    return false;
})
$('.sub_contents img').attr('alt', '');
$('.sub_contents img').css('cursor', 'default');


function copy_trackback(obj) {
    var address = $('.sub3_1view2_btn1').attr('valadd');
	var IE=(document.all)?true:false;
	if (IE) {
			window.clipboardData.setData("Text", address);
            alert('<?=_t("주소가 복사되었습니다.")?>')
	} else {
		   temp = prompt("<?=_t('이 브랜드의 주소입니다. Ctrl+C를 눌러 복사하세요.')?>", address);
	}
}




<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    

    var clipboard = new Clipboard('.clipboard');//로드 시 한번 선언 
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }

        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

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

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}
</script>

<script>


$(function() {

	$('.sub3_benefit_ly2 dd').each(function(index){
		$(this).html($(this).text().replace(/\\/g,'<i class="fa fa-krw" style="font-size:10px;" aria-hidden="true"></i>'));
	})


	$('.sub3_note_txt li').each(function(index){
		$(this).html($(this).text().replace(/\\/g,'<i class="fa fa-krw" style="font-size:10px;" aria-hidden="true"></i>'));
	})



    $('.view2_txtArea ul li').each(function(){
        if($(this)[0].innerHTML.match('<br>')){
            var result = $(this)[0].innerHTML.split('<br>');
             //= explode("<br>", $(this)[0].innerHTML );
            $(this).text(result[1]);
           // $service_txt = explode("\r", $service_txt );
        }
    })


    $('.sub_titleHead h2').html("<?=$view['wr_subject_'.$_SESSION['lang']]?>");
    $('.sub_titleHead ul').append('<li><a href="" class="hover"><?=$view["wr_subject_".$_SESSION['lang']]?></a></li>');
    $('.hover_if').removeClass('hover');



    //resetPositon({ lat: parseFloat($('.map_info').attr('valInfoLat')), lng: parseFloat($('.map_info').attr('valInfoLng')) });
    $('.info_focus').click(function () {
        
    })
setTimeout(function(){ 
    resetPositon1({ lat: parseFloat($('.map_info').attr('valInfoLat')), lng: parseFloat($('.map_info').attr('valInfoLng')) });
}, 700);


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
                    $tx.text("이 글을 비추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                } else {
                    $tx.text("이 글을 추천하셨습니다.");
                    $tx.fadeIn(200).delay(2500).fadeOut(200);
                }
            }
        }, "json"
    );
}



</script>
<!-- } 게시글 읽기 끝 -->

<?
$map_lang = explode("_", $_SESSION['lang']);
?>
    
<script src="/skin/board/map/map.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIX9g1T3yPSC5_ewJO25c7mCiRs0clTU8&language=<?=$map_lang[0]?>&region=<?=$map_lang[1]?>"></script>
