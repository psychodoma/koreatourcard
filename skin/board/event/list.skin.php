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
?>


<div class="sub2_2center">
        <!--<ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn btn-default">목록</a></li><?php } ?>
        </ul>-->
    <div class="sub1_3topTxt">
        <h4><?php echo $board['bo_subject_'.$_SESSION['lang']] ?></h4>
    </div>

    <?if( count($list) != 0){?>
        <ul class="sub44_list">
            <?php
            for($i=0; $i<count($list); $i++){
                //썸네일 이미지 가져오기
                $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'],976, 220);
                
                //본문내용 텍스트만 가져오기
                $str_subject = cut_str(strip_tags($list[$i]['wr_subject_'.$_SESSION['lang']]),$board['bo_subject_len']);
                $str_content = cut_str(strip_tags($list[$i]['wr_content_'.$_SESSION['lang']]),$board['bo_content_len']);
            ?>

                <li>
                    <a href="<?php echo $list[$i]['href']."&me_code=".$me_code."&info=".$info."&num=".$num.lang_url_a($_SESSION['lang']); ?>" class="sub44_list_link">
                        <?if($thumb['src']){?>
                            <img src="<?=$thumb['src']?>" alt=""/>
                        <?}else{?>
                            <img src="/img/default/ktc_event1.png" alt=""/>
                        <?}?>
                        
                        <div class="sub44_list_txt">
                            <h3><?=$str_subject?></h3>
                            <p class="sub44_txt"><?=$str_content?></p>

                            <p class="sub44_btn"><?=_t('자세히보기')?> <span>></span><p>
                        </div>
                    </a>
                </li>

            <?}?>
        </ul>
    <?}else{?>
        <?if( $stx ){?>
            <p class="sub5_search_false"><?=_t('검색 결과가 없습니다.')?></p>
        <?}else{?>
         <p class="sub5_search_false"><?=_t('게시물이 없습니다.')?></p>
         <?}?>
    <?}?>	



<?php 
$write_pages = get_paging_ktc($config[cf_write_pages], $page, $total_page, "./board.php?bo_table=$bo_table".$qstr."&info=".$info."&page=","&me_code=".$me_code."&num=".$num.lang_url_a($_SESSION['lang']));
echo $write_pages; 
?>

</div>





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
