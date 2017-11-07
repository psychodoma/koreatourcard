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
    $course_cnt = 100/($course_sql_cnt['cnt'])-0.2;
}


$thumb_me = get_list_thumbnail($board['bo_table'], $wr_id, '179', '',false, true, 'center', true,'80/0.5/3',0);



?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/printThis.js"></script>
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>
<script src="/js/slick.js"></script><!-- 추가됨 -->
<link rel="stylesheet" href="/css/slick.css"><!-- 추가됨 -->
<!-- 게시물 읽기 시작 { -->
<!-- div id="bo_v_table"><?php echo $board['bo_subject']; ?></div -->

<script>
/*썹네일 슬라이드 메뉴*/
$(document).ready(function(){
	var slider = "";
		slider = $('.slider2').bxSlider({
		slideWidth: 179,
		minSlides: 1,
		maxSlides: 4,
		moveSlides: 4,
		//autoHover: true,
		//auto: true,
		controls: true,
		pager: false,
		autoControls: false
	});

    $('.single-item').slick({
        arrows: false,
        autoplay: true,
    });

});

</script>


        <div class='lang' valLang='<?=$_SESSION['lang']?>'></div>   


		<div class="sub4_1topTxt">
			<h4><?php echo $board['bo_subject'] ?></h4>
		</div>


		<div class="sub4_trafficTab">

            <?php if ($is_category) { ?>
                <ul class="traffic_searchTab">
                    <?php echo $category_option_tourinfo ?>
                </ul>
            <?php } ?>



			<div class="tabDetails">
				<div id="tab1">
					<div class="sub4_1thum"> <!-- 슬라이드 썹메뉴 -->

						<div class="sub41thumHold">
							<div class="hold_color"></div>
							<div class="hold_title">
								<h3><?=$view['wr_subject_'.$_SESSION['lang']]?></h3>
							</div>
							<img src="<?php echo $thumb_me['src']?>" alt=""/>
						</div><!-- 고정 -->

                        <?$cnt=0;while($row = sql_fetch_array($mainlist_sql) ){
                            $thumb = get_list_thumbnail($board['bo_table'], $row['wr_id'], '179', '',false, true, 'center', true,'80/0.5/3',0);
                        ?>
                            <div class="slider2">
                                <div class="slide sub4_thum_slide">
                                    <a href="<?php echo "board.php?bo_table=".$bo_table."&wr_id=".$row['wr_id']."&sca=".urlencode($sca)."&info=".$info."&me_code=".$me_code."&num=".$num; ?>">
                                        <div></div>
                                        <img src="<?php echo $thumb['src']?>" alt=""/>
                                        <p><?=$row['wr_subject_'.$_SESSION['lang']]?></p>
                                    </a>
                                </div>
                            </div>

                        <?$cnt++;}?>

					</div> <!-- 슬라이드 썹메뉴 끝 -->




					<ul class="sub4_1snsBtn">
                        <?php
                        include_once(G5_SNS_PATH."/view.sns.skin.php");
                        ?>
						<li><a><img id='btnPrint' src="/img/sub/Btn_print.jpg" alt="프린트"/></a></li>
					</ul>


					<div class="sub4_1title">
						<h2><?=$view['wr_subject_'.$_SESSION['lang']]?></h2>
						<p class="sub4_1title_txt">작성일 : <?=substr($view['wr_datetime'],0,10);?> <span>조회 : <?=$view['wr_hit']?></span></p>
					</div>


					<div class="sub4_1info_top tabContents1 div1">
                        <?if($_SESSION['lang'] == "ko_KR"){?>
                            <p class="sub4_1info_top_txt"><?=$view['wr_content']?></p>
                        <?}else{?>
                            <p class="sub4_1info_top_txt"><?=$view['wr_content_'.$_SESSION['lang']]?></p>
                        <?}?>



						<div class="sub4_1info_top_course">
							<ul>
                                <?$cnt=1;while($row = sql_fetch_array($course_sql1) ){?> 
                                    <div style='display:none;' class='map_info' valInfoNameko='<?=$row['wr_subject_ko_KR']?>' valInfoNameen='<?=$row['wr_subject_en_US']?>' valInfoNameja='<?=$row['wr_subject_ja_JP']?>' valInfoNamech1='<?=$row['wr_subject_zh_CN']?>' valInfoNamech2='<?=$row['wr_subject_zh_TW']?>'   valId='<?=$row['wr_id']?>' valTable='<?=$bo_table?>'  valInfoName='<?=$row['wr_subject_'.$_SESSION['lang']]?>'  valInfoLat='<?=$row['wr_lat']?>' valInfoLng='<?=$row['wr_lng']?>'></div>
                                    <li style='width:<?=$course_cnt?>%;' >
                                        <h3><?=$row['wr_subject_'.$_SESSION['lang']]?></h3>
                                        <p></p>
                                    </li>
                                <?$cnt++;}?>
							</ul>
							<div class="sub41_locaLine"></div>
						</div>

                        <div id='map' style='width:100%; height:481px;'></div>
                        <div class="sub4_1info_top_map"></div>

						<ul class="sub4_1info_top_list">
                            <?$cnt=0;while($row = sql_fetch_array($course_sql) ){
                                $sql_qu_re_cnt = sql_fetch( " select count(*)cnt from g5_board_file where bo_table ='course' and wr_id=".$row['wr_id'] );
                            ?>
                                <li class="sub41_list <?if($cnt%2 == 0) echo 'fl_left'; else echo 'fl_right';?>">
                                    <div class="sub41_listImg">





                                        <?if($sql_qu_re_cnt['cnt'] <= 1){
                                            $sql_qu_re = sql_fetch( " select * from g5_board_file where bo_table ='course' and wr_id=".$row['wr_id'] );
                                            $thumb = get_list_thumbnail('course', $row['wr_id'], '473', '297',false, true, 'center', true,'80/0.5/3',0);
                                        ?>
                                                <div><img src="<?php echo $thumb['src']?>" alt=""/></div>
                                        <?}else{?>
                                            <div class="single-item">
                                                <?$sql_qu_re = sql_query( " select * from g5_board_file where bo_table ='course' and wr_id=".$row['wr_id'] );
                                                $th_cnt = 0;
                                                while( $th_row = sql_fetch_array($sql_qu_re) ){
                                                    $thumb = get_list_thumbnail('course', $row['wr_id'], '473', '297',false, true, 'center', true,'80/0.5/3',$th_cnt);?>
                                                    <div><img src="<?php echo $thumb['src']?>" alt=""/></div>
                                                <?$th_cnt++;}?>
                                            </div>
                                        <?}?>




                                    </div>


                                    <a class='info_focus' onclick="fnMove('1')" style='cursor:pointer;' valLink='<?=$row['wr_link1']?>'  valInfoLat='<?=$row['wr_lat']?>' valCnt='<?=$cnt?>' valId='<?=$row['wr_id']?>' valInfoLng='<?=$row['wr_lng']?>'  valInfoNameko='<?=$row['wr_subject_ko_KR']?>' valInfoNameen='<?=$row['wr_subject_en_US']?>' valInfoNameja='<?=$row['wr_subject_ja_JP']?>' valInfoNamech1='<?=$row['wr_subject_zh_CN']?>' valInfoNamech2='<?=$row['wr_subject_zh_TW']?>'>
                                        <div class="sub41_listTxt">
                                            <h3>0<?=$cnt+1?>. <?=$row['wr_subject_'.$_SESSION['lang']]?></h3>
                                            <ul>
                                                <li><span>주소</span><?=$row['wr_address_'.$_SESSION['lang']]?></li>
                                                <li><span>지하철역</span><?=$row['wr_metro_'.$_SESSION['lang']]?></li>
                                                <li><span>이용시간</span><?=$row['wr_time_'.$_SESSION['lang']]?></li>
                                                <?if($_SESSION['lang'] == "ko_KR"){
                                                    $service_txt = get_view_thumbnail($row['wr_content']);
                                                    $service_txt = explode("\r", $service_txt );
                                                ?>
                                                    <li><span>비용 & 혜택</span>
                                                        <?for($i=0; $i<count($service_txt); $i++){
                                                            if($i==0){?>
                                                                <?=$service_txt[$i]?>
                                                            <?}else{?>
                                                                <br><?=$service_txt[$i]?>
                                                            <?}?>
                                                        <?}?>
                                                    </li>
                                                <?}else{
                                                    $service_txt = get_view_thumbnail($row['wr_content_'.$_SESSION['lang']]);
                                                    $service_txt = explode("\r", $service_txt );
                                                ?>
                                                    <li><span>비용 & 혜택</span>
                                                    
                                                        <?for($i=0; $i<count($service_txt); $i++){
                                                            if($i==0){?>
                                                                <?=$service_txt[$i]?>
                                                            <?}else{?>
                                                                <br><?=$service_txt[$i]?>
                                                            <?}?>
                                                        <?}?>
                                                    </li>
                                                <?}?>
                                            </ul>
                                        </div>

                                    </a>
                                </li>
                            <?$cnt++;}?>
                        </ul>

                    </div>



                </div>
        </div>










<!-- } 게시판 읽기 끝 -->








<script>


function fnMove(seq){
    var offset = $(".div" + seq).offset();
    var top = offset.top+100;
    $('html, body').animate({scrollTop : top},300);
}







<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
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
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDeGSv9G_NwSkiiG7C314_JALnZ-uaDuQQ&language=<?=$map_lang[0]?>&region=<?=$map_lang[1]?>"></script>