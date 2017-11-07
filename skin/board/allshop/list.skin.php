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
			<div class="sub1_3topTxt">
				<h4><?php echo $board['bo_subject_'.$_SESSION['lang']] ?></h4>
			</div>
            <?if($word){?>
			<ul class="sub2_2storeInfo">
                <?php
                
                for($i=0; $i<count($list); $i++){
                    if($word == $list[$i]['wr_subject_'.$_SESSION['lang']]){
                    //썸네일 이미지 가져오기
                    $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], '224', '90');
                    
                    //본문내용 텍스트만 가져오기
                    $str_content = cut_str(strip_tags($list[$i]['wr_content']),150);
                ?>


                    <li>
						<?if( $list[$i]['info_name_'.$_SESSION['lang']] || !($_SESSION['lang']) ){?>
							<a href="<?=$list[$i]['info_name_'.$_SESSION['lang']]?>" target='_blank'>
						<?}else if( $list[$i]['info_name_en_US'] ){?>
							<a href="<?=$list[$i]['info_name_en_US']?>" target='_blank'>
						<?}else{?>
							<a href="<?=$list[$i]['info_name_ko_KR']?>" target='_blank'>
						<?}?>
							
							<!--
                            <h3><img src="<?php echo $thumb['src']?>" alt=""/></h3>

                            <div>
                                <h4><?php echo $list[$i]['wr_subject_'.$_SESSION['lang']]?><? if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new']; ?></h4>
                                <p><?php echo $list[$i]['wr_content_'.$_SESSION['lang']]?></p>
                            </div>
							-->



							<table>
								<tr>
									<td>
										<h3>
											<?if($thumb['src']){?>
												<img src="<?php echo $thumb['src']?>" alt=""/>
											<?}else{?>
												<img src="/img/default/ktc_allshop.png" alt="<?php echo $thumb['alt']?>"/>
											<?}?>

										</h3>
									</td>
									<td>
										<div>
											<h4><?php echo $list[$i]['wr_subject_'.$_SESSION['lang']]?><? if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new']; ?></h4>
											<p><?php echo $list[$i]['wr_content_'.$_SESSION['lang']]?></p>
										</div>
									</td>
								</tr>
							</table>


                        </a>
                    </li>
                    <?}?>

			    <?}?>
			</ul>
            <br><br><br><br>
            <?}?>
            



			<ul class="sub2_2storeInfo">
                <?php
                for($i=0; $i<count($list); $i++){
                    //썸네일 이미지 가져오기
                    $thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], '224', '90');
                    
                    //본문내용 텍스트만 가져오기
                    $str_content = cut_str(strip_tags($list[$i]['wr_content']),150);
                ?>


                    <li>
						<?if( $list[$i]['info_name_'.$_SESSION['lang']] || !($_SESSION['lang']) ){?>
						
							<a href="/bbs/board.php?bo_table=map&info=search&me_code=20&num=1&search=<?=$list[$i]['wr_id']?><?=lang_url_a($_SESSION['lang'])?>">
							<!-- <a href="<?=$list[$i]['info_name_'.$_SESSION['lang']]?>" target='_blank'> -->
						<?}else if( $list[$i]['info_name_en_US'] ){?>
							<a href="/bbs/board.php?bo_table=map&info=search&me_code=20&num=1&search=<?=$list[$i]['wr_id']?><?=lang_url_a($_SESSION['lang'])?>">
						<?}else{?>
							<a href="/bbs/board.php?bo_table=map&info=search&me_code=20&num=1&search=<?=$list[$i]['wr_id']?><?=lang_url_a($_SESSION['lang'])?>">
						<?}?>

							<table>
								<tr>
									<td>
										<h3>
											<?if($thumb['src']){?>
												<img src="<?php echo $thumb['src']?>" alt=""/>
											<?}else{?>
												<img src="/img/default/ktc_allshop.png" alt="<?php echo $thumb['alt']?>"/>
											<?}?>

										</h3>
									</td>
									<td>
										<div>
											<h4><?php echo $list[$i]['wr_subject_'.$_SESSION['lang']]?><? if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new']; ?></h4>
											<p><?php echo $list[$i]['wr_content_'.$_SESSION['lang']]?></p>
										</div>
									</td>
								</tr>
							</table>
                        </a>
                    </li>

			    <?}?>
			</ul>
        <?php 
        $write_pages = get_paging_ktc($config[cf_write_pages], $page, $total_page, "./board.php?bo_table=$bo_table".$qstr,"&info=".$info."&me_code=".$me_code."&num=".$num.lang_url_a($_SESSION['lang']));
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
