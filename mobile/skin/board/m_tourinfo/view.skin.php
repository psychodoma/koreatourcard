<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

$mainlist_sql = sql_query(" select * from g5_write_tourinfo where wr_id != ".$wr_id." and ca_name = '".$sca."'");
$course_sql = sql_query(" select * from g5_write_course where wr_course = ".$wr_id." order by wr_cnt");
$course_sql1 = sql_query(" select * from g5_write_course where wr_course = ".$wr_id." order by wr_cnt");
$course_sql_cnt = sql_fetch(" select count(*)cnt from g5_write_course where wr_course = ".$wr_id);

if($course_sql_cnt['cnt'] != 0){
    $course_cnt = 100/($course_sql_cnt['cnt'])-1;
}

$url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
?>
<script src="/plugin/ask_banner/js/clipboard.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?echo G5_TMPL_URL;?>/js/printThis.js"></script>
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>
<script src="<?echo G5_TMPL_URL;?>/js/slick.js"></script><!-- 추가됨 -->
<link rel="stylesheet" href="<?echo G5_TMPL_URL;?>/css/slick.css"><!-- 추가됨 -->



<div style="margin-top:55px;"></div>

<?
$thumb1 = get_list_thumbnail($board['bo_table'], $view['wr_id'], 100,100);

$thumb = get_list_thumbnail($board['bo_table'], $view['wr_id'], $thumb1['width'],$thumb1['height']);
?>
<div class='lang' valLang='<?=$_SESSION['lang']?>'></div>

        <div class="moble_wrap">
            <div class="sub_title2" >
                <h2><?=$view['wr_subject_'.$_SESSION['lang']]?></h2>
            </div>


			<div class="sub4_1view">

                <div class="sub4_1view_img">

                    <?if( $thumb['src'] ){?>
                        <img src="<?php echo $thumb['src']?>" />
                    <?}else{?>
                        <img src="/img/default/ktc_cardbenefit_background.png" alt="<?=$list[$i]['wr_subject']?>"/>
                    <?}?>

                </div>


                <div class="sub4_1view_txt" style='word-break: break-all;'>
                    <p style='word-break: break-all;' ><?php echo get_view_thumbnail($view['wr_content_'.$_SESSION['lang']]); ?></p>
                </div>



                <div class="sub4_1view_loca">
                    <ul>
                        <?$cnt=1;while($row = sql_fetch_array($course_sql1) ){?>
                            <li style='width: <?=$course_cnt?>%;'>
                                <div style='display:none;' class='map_info' valInfoNameko='<?=$row['wr_subject_ko_KR']?>' valInfoNameen='<?=$row['wr_subject_en_US']?>' valInfoNameja='<?=$row['wr_subject_ja_JP']?>' valInfoNamech1='<?=$row['wr_subject_zh_CN']?>' valInfoNamech2='<?=$row['wr_subject_zh_TW']?>'   valId='<?=$row['wr_id']?>' valTable='<?=$bo_table?>'  valInfoName='<?=$row['wr_subject_'.$_SESSION['lang']]?>'  valInfoLat='<?=$row['wr_lat']?>' valInfoLng='<?=$row['wr_lng']?>'></div>
                                <h3><?=$row['wr_subject_'.$_SESSION['lang']]?></h3>
                                <p></p>
                            </li>
                        <?$cnt++;}?>
                    </ul>
                    <div class="sub41_locaLine" style='width:100%;'></div>
                </div>


                <div class="sub41_locaMap div1">
                    <div id='map' style='width:100%; height:400px;'></div>
                </div>


			    <div class="sub41_locaList_img">
                    <?$cnt=0;while($row = sql_fetch_array($course_sql) ){
                        $sql_qu_re_cnt = sql_fetch( " select count(*)cnt from g5_board_file where bo_table ='course' and wr_id=".$row['wr_id'] );
                    ?>
                        <div>


                            <?if(  $sql_qu_re_cnt['cnt'] != 1 ){?>

                            <div class="center">
                                <?$sql_qu_re = sql_query( " select * from g5_board_file where bo_table ='course' and wr_id=".$row['wr_id'] );
                                $th_cnt = 0;
                                while( $th_row = sql_fetch_array($sql_qu_re) ){

                                    $thumb1 = get_list_thumbnail($board['bo_table'], $view['wr_id'], 100,100);


                                    $thumb = get_list_thumbnail('course', $row['wr_id'], 380,250,false, true, 'center', true,'80/0.5/3',$th_cnt);?>

                                    <div><h3><img src="<?=$thumb['src']?>" alt=""/></h3></div>

                                <?$th_cnt++;}?>
                            </div>

                            <?}else{?>
                                <?$sql_qu_re = sql_query( " select * from g5_board_file where bo_table ='course' and wr_id=".$row['wr_id'] );
                                $th_cnt = 0;
                                while( $th_row = sql_fetch_array($sql_qu_re) ){

                                    $thumb1 = get_list_thumbnail($board['bo_table'], $view['wr_id'], 100,100);


                                    $thumb = get_list_thumbnail('course', $row['wr_id'], 380,250,false, true, 'center', true,'80/0.5/3',$th_cnt);?>

                                    <img src="<?=$thumb['src']?>" alt="" style='width:100%;' />

                                <?$th_cnt++;}?>

                            <?}?>




                            <div class="sub41_locaList_txt info_focus <?=set_class('sub41_locaList_txt_us','en_US')?> <?=set_class('sub41_locaList_txt_kan','ja_JP/zh_CN/zh_TW')?>" onclick="fnMove('1')" style='cursor:pointer;' valLink='<?=$row['wr_link1']?>'  valInfoLat='<?=$row['wr_lat']?>' valCnt='<?=$cnt?>' valId='<?=$row['wr_id']?>' valInfoLng='<?=$row['wr_lng']?>'  valInfoNameko='<?=$row['wr_subject_ko_KR']?>' valInfoNameen='<?=$row['wr_subject_en_US']?>' valInfoNameja='<?=$row['wr_subject_ja_JP']?>' valInfoNamech1='<?=$row['wr_subject_zh_CN']?>' valInfoNamech2='<?=$row['wr_subject_zh_TW']?>'>
                                <h2>0<?=$cnt+1?>. <?=$row['wr_subject_'.$_SESSION['lang']]?></h2>
                                <ul>
									<?if( $row['wr_1'] ){?>
										<li>
											<h4><?=_t('주소')?></h4>
											<p><?=$row['wr_address_'.$_SESSION['lang']]?></p>
										</li>
									<?}?>

                                    <?if($row['wr_metro_'.$_SESSION['lang']]){?>
                                        <li>
                                            <h4><?=_t('지하철')?></h4>
                                            <p><?=$row['wr_metro_'.$_SESSION['lang']]?></p>
                                        </li>
                                    <?}?>

                                    <?if($row['wr_subway_'.$_SESSION['lang']]){?>
                                        <li>
                                            <h4><?=_t('교통')?></h4>
											<div>
                                            <p class=""><?=$row['wr_subway_'.$_SESSION['lang']]?></p>
											</div>
                                        </li>
                                    <?}?>

                                    <?if($row['wr_time_'.$_SESSION['lang']]){?>
                                        <li>
                                            <h4><?=_t('이용시간')?></h4>
                                            <p><?=$row['wr_time_'.$_SESSION['lang']]?></p>
                                        </li>
                                    <?}?>

                                    <?if($_SESSION['lang'] == "ko_KR"){
                                        $service_txt = get_view_thumbnail($row['wr_content']);
                                        $service_txt = explode("\r", $service_txt );
                                    }else{
                                        $service_txt = get_view_thumbnail($row['wr_content_'.$_SESSION['lang']]);
                                        $service_txt = explode("\r", $service_txt );
									}?>


									<?for($i=0; $i<count($service_txt); $i++){?>
                                    <li style='margin-bottom:5px;'>
                                        <h4><?if($i==0){  echo _t('코리아투어카드 혜택'); }else{ echo "&nbsp;&nbsp;&nbsp;&nbsp;"; }?></h4>

                                        <p>
                                            <?if($i==0){?>
                                                <?=$service_txt[$i]?>
                                            <?}else{?>
                                                <?=$service_txt[$i]?>
                                            <?}?>
                                        </p>
                                    </li>
									<?}?>
                                    <li style='margin-bottom:-5px;'>
                                        <h4>&nbsp;&nbsp;&nbsp;&nbsp;</h4>
                                        <p></p>
                                    </li>

                                    <?if($row['wr_near_'.$_SESSION['lang']]){?>
                                        <li>
                                            <h4><?=_t('주변 관광지')?></h4>
											<div>
                                            <p class=""><?=$row['wr_near_'.$_SESSION['lang']]?></p>
											</div>
                                        </li>
                                    <?}?>

                                    <?if($row['wr_item_'.$_SESSION['lang']]){?>
                                        <li>
                                            <h4><?=_t('취급품목')?></h4>
											<div>
                                            <p class=""><?=$row['wr_item_'.$_SESSION['lang']]?></p>
											</div>
                                        </li>
                                    <?}?>

                                    <?if($row['wr_main_'.$_SESSION['lang']]){?>
                                        <li>
                                            <h4><?=_t('주요 메뉴')?></h4>
											<div>
                                            <p class=""><?=$row['wr_main_'.$_SESSION['lang']]?></p>
											</div>
                                        </li>
                                    <?}?>

                                    <?if($row['wr_link1']){?>
                                        <li style='word-break:break-all;'>
                                            <h4><?=_t('홈페이지')?></h4>

											<?if($_SESSION['lang'] == "ko_KR"){?>
												<a href='<?=$row['wr_link1']?>' target='_blank' ><?=$row['wr_link1']?></a>
											<?}else{?>
												<a href='<?=$row['wr_link_'.$_SESSION['lang']]?>' target='_blank' ><?=$row['wr_link_'.$_SESSION['lang']]?></a>
											<?}?>
                                        </li>
                                    <?}?>

                                    <?if($row['wr_recom_'.$_SESSION['lang']]){?>
                                        <li>
                                            <h4><?=_t('추천해요')?></h4>
											<div>
                                            <p class=""><?=$row['wr_recom_'.$_SESSION['lang']]?></p>
											</div>
                                        </li>
                                    <?}?>

                                    <?if($row['wr_etc_'.$_SESSION['lang']]){?>
                                        <li>
                                            <h4><?=_t('기타')?></h4>
											<div>
                                            <p class=""><?=$row['wr_etc_'.$_SESSION['lang']]?></p>
											</div>
                                        </li>
                                    <?}?>

                                </ul>
                            </div>
                        </div>
                    <?$cnt++;}?>
                </div>

				<!--<ul class="sub4_1snsBtn">
					<li><a href=""><img src="img/sub/Btn_facebook.jpg" alt="페이스북"/></a></li>
					<li><a href=""><img src="img/sub/Btn_twit.jpg" alt="트위터"/></a></li>
					<li><a href=""><img src="img/sub/Btn_share.jpg" alt="주소복사"/></a></li>
				</ul>-->
                <script>
                    new Clipboard('.clipboard_btn');
                </script>

                <ul class="sub4_1snsBtn">
                    <?php
                    include_once(G5_SNS_PATH."/view.sns.skin.php");
                    ?>
                    <li><a class="clipboard_btn" data-clipboard-text="<?=$url?>" onclick='alert("<?=_t('주소가 복사되었습니다.')?>")'><img src="/img/mobile/sub/Btn_share.jpg" alt="주소복사"/></a></li>
                </ul>

				<!--<table class="sub1_3table_view">
					<tr>
						<td class="title">
							<h2><?echo cut_str(get_text($view['wr_subject']), 70);?></h2>
							<p><?=substr($view['wr_datetime'],0,10);?></p>
						</td>
					</tr>
					<tr>
						<td class="content">
							<div class="">

                                <div id="bo_v_con"><?php echo get_view_thumbnail($view['content']); ?></div>

							</div>
						</td>
					</tr>
				</table>-->
			</div>


			<!--<div class="board_btn">
				<a href="<?php echo $list_href."&me_code=".$me_code."&info=".$info."&num=".$num."&sca=".$sca; ?>" class="list">목록</a>
			</div>-->
		</div>





<script>

	$('li p').each(function(index){
		//$(this).html($(this).text().replace(/\\/g,'<i class="fa fa-krw" style="font-size:10px;" aria-hidden="true"></i>'));
	})

    $(document).ready(function(){
        $('.center').slick({
            infinite: true,
            centerMode: true,
            variableWidth: true,
            arrows: false,
            centerPadding: '60px',
            slidesToShow: 1,
            //focusOnSelect:true,
            responsive: [
            {
                breakpoint: 768,
                settings: {
                arrows: false,
                centerMode: true,
                variableWidth: true,
                centerPadding: '40px',
                slidesToShow: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                arrows: false,
                centerMode: true,
                variableWidth: true,
                centerPadding: '40px',
                slidesToShow: 1
                }
            }
            ]
        });
    });
</script>


<script>


    function fnMove(seq){
        var offset = $(".div" + seq).offset();
        var top = offset.top-140;
        $('html, body').animate({scrollTop : top},300);
    }

</script>


<script>



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

<?
$map_lang = explode("_", $_SESSION['lang']);
?>

<script src="/skin/board/map/map.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIX9g1T3yPSC5_ewJO25c7mCiRs0clTU8&language=<?=$map_lang[0]?>&region=<?=$map_lang[1]?>"></script>
