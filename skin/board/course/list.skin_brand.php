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


		<div class="sub2_2center">
			<div class="sub1_3topTxt">
				<h4>코리아투어카드 한장으로 다양한 혜택을 누리실 수 있습니다.<br/>
				쇼핑부터 한류컨텐츠까지! 한국 방방곳곳에서 누릴 수 있는 사용처를 지금 확인해보세요!</h4>
			</div>


			<ul class="sub3_1List">
                <?php
                for($i=0; $i<count($list); $i++){
					$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], '200', '',true, false, 'left', false,'80/0.5/3',2);
					$thumb1 = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], '200', '',false, true, 'center', true,'80/0.5/3',3);
					?>
					
                    <li <?if($i%4 == 3) echo "class='li_margin_r'";?> >
						<div class="grid">
							<div class="effect-bubba">
                                <?if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];?>
								<img src="<?php echo $thumb['src']?>" class="imgsell" alt="" style='width:100%; max-width:190px; min-height:140px;'/>
								<p class="title"><?php echo $list[$i]['wr_subject'.$lang]?></p>


									<div valid='<?php echo $thumb1['src']?>' class="figcap bgss" style='background-image:url(../img/sub/sub3/sub3_1/sub3_logo2_over.jpg); opacity:0;'>
										<h2><img src="/img/sub/sub3/sub3_1/sub3_1more.png" alt="더보기 아이콘"/></h2>
										<p class="hover_more"><?php echo $list[$i]['wr_subject']?><br/>자세히보기</p>
										<a href="<?php echo $list[$i]['href']."&info=".$info."&me_code=".$me_code."&num=".$num; ?>" title="<?php echo $list[$i]['wr_subject']?>">View more</a>
									</div>
								
									<div valid='<?php echo $thumb1['src']?>' class="figcap bg<?=$i?>">
										<h2><img src="/img/sub/sub3/sub3_1/sub3_1more.png" alt="더보기 아이콘"/></h2>
										<p class="hover_more"><?php echo $list[$i]['wr_subject']?><br/>자세히보기</p>
										<a href="<?php echo $list[$i]['href']."&info=".$info."&me_code=".$me_code."&num=".$num; ?>" title="<?php echo $list[$i]['wr_subject']?>">View more</a>
									</div>
							</div>
						</div>
					</li>
				<? } ?>
			</ul>

            <?php 
            $write_pages = get_paging_ktc($config[cf_write_pages], $page, $total_page, "./board.php?bo_table=$bo_table".$qstr."&page=","&me_code=".$me_code."&info=".$info."&num=".$num);
            echo $write_pages; 
            ?>
		</div>
    






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
$(function(){


})



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