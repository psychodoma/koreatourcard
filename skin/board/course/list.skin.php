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
if($_SESSION['lang'] == 'ko_KR'){
    $lang = "";
}else{
    $lang = "_".$_SESSION['lang'];
}
?>

	

		<div class="sub3_2center">

            <?php if ($is_category) { ?>
                <ul class="sub32_navi">
                    <?php echo $category_option_cardbenefit ?>
                </ul>
            </nav>
            <?php } ?>




			<table width="100%" class="sub32_table">
				<tr>
					<td colspan="3" class="sub32_tb_head"><h2 class="sub32_tableHead">총 <span><?php echo number_format($total_count)?></span>개의 혜택이 있습니다.</h2></td>
				</tr>

                <?php
                for($i=0; $i<count($list); $i++){
					$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], '200', '',false, true, 'center', true,'80/0.5/3',2);?>
				
				
				<tr>
					<td class="sub32_tb_logo">
						<img src="<?php echo $thumb['src']?>" alt=""/>
						<h3><?=$list[$i]['wr_subject'.$lang]?></h3>
						<p><a href="<?php echo $list[$i]['href']."&info=benefit&me_code=".$me_code."&num=".$num; ?>" title="<?php echo $list[$i]['wr_subject'.$lang]?>">자세히보기 <span>></span></a></p>
					</td>
					<td class="sub32_tb_benti">혜택</td>
					<td class="sub32_tb_list">
					<? $sql_bene = sql_query("select * from g5_board_file where wr_id =".$list[$i]['wr_id']." order by bf_no"); ?>
						<ul>
							<?while($bene_reulst = sql_fetch_array($sql_bene)){
								if($bene_reulst['bf_no'] > 3 ){
							?>
								
								<li><?=$bene_reulst['bf_content'.$lang]?></li>
							<?}}?>
						</ul>
					</td>
				</tr>
				<? } ?>



			</table>



            <?php 
            $write_pages = get_paging_ktc($config[cf_write_pages], $page, $total_page, "./board.php?bo_table=$bo_table".$qstr,"&info=".$info."&me_code=".$me_code."&num=".$num);
            echo $write_pages; 
            ?>


		</div><!--sub2_2center 끝                  여기 위에 적용 해아한다 !!!!!!!!!!!!!!!!!               --> 





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