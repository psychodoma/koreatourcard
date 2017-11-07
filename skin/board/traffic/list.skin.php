<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
$categories = explode('|', $board['bo_category_list']); // 구분자가 , 로 되어 있음
?>

		<div class="sub4_2topTxt">
			<h4><?php echo $board['bo_subject_'.$_SESSION['lang']] ?></h4>
		</div>
	

        <ul class="sub4_2_list">    
            <?for ($i=0; $i<count($categories); $i++) {
                $sql_traffic = sql_query( "select * from g5_write_traffic where ca_name = '".$categories[$i]."'" );
            ?>
                <li class="sub42_list <?if($i==0) echo 'li_margin_l';?>">
                    <div>
                        <img src="/img/sub/sub4/sub4_2/sub42_icon<?=$i+1?>.jpg" alt="지하철"/>

                        <h3><?=_t($categories[$i])?></h3>

                        <ul class="sub42_btn">
                            <?while( $row = sql_fetch_array($sql_traffic) ){?>
                                <li>
                                    <?if($_SESSION['lang'] == "ko_KR" || $_SESSION['lang'] == ""){?>
                                        <a href="<?=$row['wr_1']?>" target='_blank'><?=$row['wr_subject_'.$_SESSION['lang']]?></a>
                                    <?}else if($_SESSION['lang'] == "en_US" && $row['wr_2'] ){?>
                                        <a href="<?=$row['wr_2']?>" target='_blank'><?=$row['wr_subject_'.$_SESSION['lang']]?></a>
                                    <?}else if($_SESSION['lang'] == "ja_JP" && $row['wr_3'] ){?>
                                        <a href="<?=$row['wr_3']?>" target='_blank'><?=$row['wr_subject_'.$_SESSION['lang']]?></a>
                                    <?}else if($_SESSION['lang'] == "zh_CN" && $row['wr_4'] ){?>
                                        <a href="<?=$row['wr_4']?>" target='_blank'><?=$row['wr_subject_'.$_SESSION['lang']]?></a>
                                    <?}else if($_SESSION['lang'] == "zh_TW" && $row['wr_5'] ){?>
                                        <a href="<?=$row['wr_5']?>" target='_blank'><?=$row['wr_subject_'.$_SESSION['lang']]?></a>
                                    <?}else{?>
										<a href="<?=$row['wr_1']?>" target='_blank'><?=$row['wr_subject_'.$_SESSION['lang']]?></a>
									<?}?>
                                </li>
                            <?}?>
                        </ul>
                    </div>
                </li>
             <?}?>
        </ul>

<!--여기서부터가 기본 소스-->

<!--<h2 id="container_title"><?php echo $board['bo_subject'] ?><span class="sound_only"> 목록</span></h2>-->

<!-- 게시판 목록 시작 { -->



<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<!-- 페이지 -->



<!-- 게시판 검색 시작 { -->

<!-- } 게시판 검색 끝 -->

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->


<?php  
    if(!($sca)){
       // echo "<script>alert('1');</script>";
        echo "<script>$('.benefitall').addClass('s32_act');</script>";
    }
?>