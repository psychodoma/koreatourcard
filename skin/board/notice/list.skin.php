<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;
$result_board = sql_fetch(" select * from g5_board where bo_table = 'knotice' ");
$notice_id = explode(',',$result_board['bo_notice']);


// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>



<div class="sub2_2center">
    <div class="sub4_6form_area">
        <form name="fsearch" method="get" class="sub_search" onsubmit="return fsearchbox_submit(this);">
            <fieldset>
                <ul>
                    <li>
                        <label for="" class="hide">검색창</label>
                        <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" id="stx" class="sub46_input" size="15" maxlength="20">
                    </li>

                    <li>
                        <input type="submit" value="<?=_t('검색')?>" class="sub46_search" id="" title="<?=_t('검색')?>" />
                    </li>
                <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                <input type="hidden" name="sca" value="<?php echo $sca ?>">
                <input type="hidden" name="me_code" value="<?php echo $me_code ?>">
                <input type="hidden" name="info" value="<?php echo $info ?>">
                <input type="hidden" name="num" value="<?php echo $num ?>">
                <input type="hidden" name="sop" value="and">  
				<input type='hidden' name='lang' value='<?=lang_url($_SESSION['lang'])?>'>
                </ul>
            </fieldset>
        </form>

            <script>
            function fsearchbox_submit(f)
            {
                if (f.stx.value.length < 2) {
                    alert("<?=_t('검색어는 두글자 이상 입력하십시오.')?>");
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
                    alert("<?php echo _t('빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.'); ?>");
                    f.stx.select();
                    f.stx.focus();
                    return false;
                }

                return true;
            }
            </script>


    </div>

 
 
    <?if( count($list) != 0){?>
        <table class="sub4_6table" width="100%;">
            <thead>
                <th width="140px"><?=_t('번호')?></th>
                <th width=""><?=_t('내용')?></th>
                <th width="220px">
					<?if($_SESSION['lang'] == 'zh_CN'){?>
						上传时间
					<?}else if($_SESSION['lang'] == 'zh_TW' ){?>
						上傳時間
					<?}else{?>
						<?=_t('작성일')?>
					<?}?>
				</th>
                <th width="100px"><?=_t('조회')?></th>
            </thead>
            <tbody>
                <?php
                if( $result_board['bo_notice'] ){
                    for($i=0; $i<count($notice_id); $i++){
                        $row = sql_fetch(" select * from g5_write_knotice where wr_id =".$notice_id[$i]);
                        $str_subject = cut_str(strip_tags($row['wr_subject_'.$_SESSION['lang']]),$board['bo_subject_len']);
                    ?>
                        <tr class='sub46_notice'>
                            <td align="center">
                                <span class="noticeTcon"><?=_t('공지')?></span>
                            </td>
                            <td class="noticeTD"><a href='/bbs/board.php?bo_table=knotice&wr_id=<?=$row['wr_id']?>&me_code=40&info=notice&num=3<?=lang_url_a($_SESSION['lang'])?>'><?=$str_subject?></a></td>
                            <td align="center"><?=substr($row['wr_datetime'],0,10);?></td>
                            <td align="center"><?=$row['wr_hit']?></td>
                        </tr>      
                    <?}}?>
                <?
                for($i=0; $i<count($list); $i++){
                    //썸네일 이미지 가져오기
            
                    //본문내용 텍스트만 가져오기
                    $str_subject = cut_str(strip_tags($list[$i]['wr_subject_'.$_SESSION['lang']]),$board['bo_subject_len']);

                ?>
                    <?if(!$list[$i]['is_notice']){?>
                        <tr>
                            <td align="center">
                                <?echo $list[$i]['num'];?>
                            </td>
                            <td class="noticeTD"><a href="<?php echo $list[$i]['href']."&me_code=".$me_code."&info=".$info."&num=".$num.lang_url_a($_SESSION['lang']); ?>"><?=$str_subject?></a></td>
                            <td align="center"><?=substr($list[$i]['wr_datetime'],0,10);?></td>
                            <td align="center"><?=$list[$i]['wr_hit']?></td>
                        </tr>
                    <?}?>
                <?}?>

            </tbody>
        </table>
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
