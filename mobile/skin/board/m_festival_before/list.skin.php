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


<div class="sub1_3center">
        <!--<ul class="btn_bo_user">
            <?php if ($list_href) { ?><li><a href="<?php echo $list_href ?>" class="btn btn-default">목록</a></li><?php } ?>
        </ul>-->
    <div class="sub1_3topTxt">
        <h4><?php echo $board['bo_subject'] ?></h4>
    </div>
        <form name="fsearch" method="get" class="sub_search">
            <fieldset>
                <ul>
                    <li class="input">
                        <label for="stx" class="hide">검색창<strong class="sound_only"> 필수</strong></label>
                        <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class=" " size="15" maxlength="20">
                    </li>
                    <li class="btn">
                        <input type="submit" value="검색" class="btn_submit" title="검색">
                    </li>
                <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                <input type="hidden" name="sca" value="<?php echo $sca ?>">
                <input type="hidden" name="me_code" value="<?php echo $me_code ?>">
                <input type="hidden" name="info" value="<?php echo $info ?>">
                <input type="hidden" name="sop" value="and">
                <!--<label for="sfl" class="sound_only">검색대상</label>-->
                <select name="sfl" id="sfl" style='display:none;'>
                    <option value="wr_subject"<?php echo get_selected($sfl, 'wr_subject', true); ?>>제목</option>
                    <option value="wr_content"<?php echo get_selected($sfl, 'wr_content'); ?>>내용</option>
                    <option value="wr_subject||wr_content"<?php echo get_selected($sfl, 'wr_subject||wr_content'); ?>>제목+내용</option>
                    <option value="mb_id,1"<?php echo get_selected($sfl, 'mb_id,1'); ?>>회원아이디</option>
                    <option value="mb_id,0"<?php echo get_selected($sfl, 'mb_id,0'); ?>>회원아이디(코)</option>
                    <option value="wr_name,1"<?php echo get_selected($sfl, 'wr_name,1'); ?>>글쓴이</option>
                    <option value="wr_name,0"<?php echo get_selected($sfl, 'wr_name,0'); ?>>글쓴이(코)</option>
                </select>
                <!--<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>-->
                <!--<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="frm_input required" size="15" maxlength="20">
                <input type="submit" value="검색" class="btn_submit">-->
                <ul>
            </fieldset>
        </form>

        <table class="sub1_3table" style="width:<?php echo $width; ?>">
            <form name="fboardlist" id="fboardlist" action="./board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
            <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
            <input type="hidden" name="stx" value="<?php echo $stx ?>">
            <input type="hidden" name="spt" value="<?php echo $spt ?>">
            <input type="hidden" name="sca" value="<?php echo $sca ?>">
            <input type="hidden" name="sst" value="<?php echo $sst ?>">
            <input type="hidden" name="sod" value="<?php echo $sod ?>">
            <input type="hidden" name="page" value="<?php echo $page ?>">
            <input type="hidden" name="me_code" value="<?php echo $me_code ?>">
            <input type="hidden" name="info" value="<?php echo $info ?>">
            <input type="hidden" name="sw" value="">




	<?php
	for($i=0; $i<count($list); $i++){
		//썸네일 이미지 가져오기
		$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $board['bo_gallery_width'], $board['bo_gallery_height']);
		
		//본문내용 텍스트만 가져오기
		$str_content = cut_str(strip_tags($list[$i]['wr_content']),70);
	?>
	<tr>
		<td>
			<?php if($thumb['src']){ ?>
			<div class="board_area">
			    <a href="<?php echo $list[$i]['href']."&me_code=".$me_code."&info=".$info."&num=".$num; ?>" title="<?php echo $list[$i]['wr_subject']?>">
			        <div class='img'><img src="<?php echo $thumb['src']?>" alt="<?php echo $thumb['alt']?>"/></div>
                    <div class="info">
                        <h3><?php echo $list[$i]['wr_subject']?>&nbsp;&nbsp;<?if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];?></h3>
                        
                        <p class="txt">
                          <?php echo $str_content?>
                        </p>
                        <p class="date"><?php echo $list[$i]['wr_datetime']?></p>
                    </div>
                    <p class="icon"><img src="<?echo $g5['tmpl_url']?>/img/sub/sub1/arrow.jpg" alt="이동아이콘"/></p>
			    </a>
            </div>

			<?php }?>
		</td>
	</tr>
    <?}?>

            <form>
        </table>

<?php 
$write_pages = get_paging_ktc($config[cf_write_pages], $page, $total_page, "./board.php?bo_table=$bo_table".$qstr."&info=".$info."&page=","&me_code=".$me_code."&num=".$num);
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
