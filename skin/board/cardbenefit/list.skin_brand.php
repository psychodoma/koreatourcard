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



                         <form name="fsearch" method="get" class="sub_search sub32_table" style='border-top:none;' onsubmit="return fsearchbox_submit(this);"><h2 class="sub32_tableHead" style='float:left; line-height:30px;'>
						 <?if( $_SESSION['lang'] != "en_US" ){?>
							<?=_t('총')?> <span><?php echo number_format($total_count)?></span><?=_t('개 브랜드의 혜택이 있습니다.')?></h2>
						 <?}else{?>
							Find out benefits from <span><?php echo number_format($total_count)?></span> brands. </h2>
						 <?}?>
                            <fieldset>
                                <ul>
                                    <li class="input">
                                        <label for="stx" class="hide">검색창<strong class="sound_only"> 필수</strong></label>
                                        <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" id="stx" class=" " size="15" maxlength="20">
                                    </li>
                                    <li class="btn">
                                        <input type="submit" value="<?=_t('검색')?>" class="btn_submit" >
                                    </li>
                                <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                                <input type="hidden" name="sca" value="<?php echo $sca ?>">
                                <input type="hidden" name="num" value="<?php echo $num ?>">
                                <input type="hidden" name="me_code" value="<?php echo $me_code ?>">
                                <input type="hidden" name="info" value="<?php echo $info ?>">
                                <input type="hidden" name="sop" value="and">
								<input type='hidden' name='lang' value="<?=lang_url($_SESSION['lang'])?>">
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



			<ul class="sub3_1List">
                <?php
                for($i=0; $i<count($list); $i++){
					$thumb = get_list_thumbnail_ktc($board['bo_table'], $list[$i]['wr_id'], '200', '',true, false, 'left', false,'80/0.5/3',1);
					$thumb1 = get_list_thumbnail_ktc($board['bo_table'], $list[$i]['wr_id'], '200', '',false, true, 'center', true,'80/0.5/3',2);
					?>
					
                    <li <?if($i%4 == 3) echo "class='li_margin_r'";?> >
						<div class="grid">
							<div class="effect-bubba">
                                <?if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];?>

                                <?if($_SESSION['lang'] != "ko_KR"){?>
                                    <?if( strpos($list[$i]['wr_img_append_'.$_SESSION['lang']], 'src=') ){?>
                                        <div class="imgsell"  ><?=$list[$i]['wr_img_append_'.$_SESSION['lang']]?></div>
                                    <?}else if( $thumb['src'] ){?>
                                        <img src="<?php echo $thumb['src']?>" class="imgsell"  style='width:100%; max-width:190px;'/>
                                    <?}else{?>
                                        <img src="/img/default/ktc_cardbenefit_list.png" class="imgsell"  style='width:100%; max-width:190px;'/>
                                    <?}?>
                                <?}else{?>
                                    <?if($thumb['src']){?>
                                        <img src="<?php echo $thumb['src']?>" class="imgsell"  style='width:100%; max-width:190px;'/>
                                    <?}else{?>
                                        <img src="/img/default/ktc_cardbenefit_list.png" class="imgsell"  style='width:100%; max-width:190px;'/>
                                    <?}?>
                                <?}?>


								
								<p class="title">
                                    
                                    <?if( $stx ){?>
                                        <?if( $list[$i]['wr_title_'.$_SESSION['lang']] == ''){?>
                                            <?=$list[$i]['wr_subject_'.$_SESSION['lang']]?>   
                                        <?}else{?>
                                            <?=$list[$i]['wr_title_'.$_SESSION['lang']]?>   
                                        <?}?>
                                    <?}else{?>
                                        <?=$list[$i]['wr_title_'.$_SESSION['lang']]?>   
                                    <?}?>
                                
                                </p>
									<a href="<?php echo $list[$i]['href']."&info=".$info."&me_code=".$me_code."&num=".$num.lang_url_a($_SESSION['lang']); ?>" >
                                    <?if($thumb1['src']){?>
                                        <div valid='<?php echo $thumb1['src']?>' class="figcap bgss hoverOpBack" style='background-image:url(../img/sub/sub3/sub3_1/sub3_logo2_over.jpg); opacity:0;'>
                                    <?}else{?>
                                        <div valid='/img/default/ktc_cardbenefit_background1.jpg' class="figcap bgss hoverOpBack" style='background-image:url(../img/sub/sub3/sub3_1/sub3_logo2_over.jpg); opacity:0;'>
                                    <?}?>
										<h2><img src="/img/sub/sub3/sub3_1/sub3_1more.png" /></h2>
										<p class="hover_more">

                                        <?if( $stx ){?>
                                            <?if( $list[$i]['wr_title_'.$_SESSION['lang']] == ''){?>
                                                <?=$list[$i]['wr_subject_'.$_SESSION['lang']]?>   
                                            <?}else{?>
                                                <?=$list[$i]['wr_title_'.$_SESSION['lang']]?>   
                                            <?}?>
                                        <?}else{?>
                                            <?=$list[$i]['wr_title_'.$_SESSION['lang']]?>   
                                        <?}?>          
                                    
                                        <br/><?=_t('자세히보기')?></p>
										
									</div>
								</a>
								

                                    <?if($thumb1['src']){?>
                                        <div valid='<?php echo $thumb1['src']?>' class="figcap bg<?=$i?>">
                                    <?}else{?>
                                        <div valid='/img/default/ktc_cardbenefit_background1.jpg' class="figcap bg<?=$i?>">
                                    <?}?>
										<h2><img src="/img/sub/sub3/sub3_1/sub3_1more.png" /></h2>
										<p class="hover_more">
                                        
                                            <?if( $stx ){?>
                                                <?if( $list[$i]['wr_title_'.$_SESSION['lang']] == ''){?>
                                                    <?=$list[$i]['wr_subject_'.$_SESSION['lang']]?>   
                                                <?}else{?>
                                                    <?=$list[$i]['wr_title_'.$_SESSION['lang']]?>   
                                                <?}?>
                                            <?}else{?>
                                                <?=$list[$i]['wr_title_'.$_SESSION['lang']]?>   
                                            <?}?>

                                        <br/><?=_t('자세히보기')?></p>
										<a href="<?php echo $list[$i]['href']."&info=".$info."&me_code=".$me_code."&num=".$num.lang_url_a($_SESSION['lang']); ?>" >View more</a>
									</div>
							</div>
						</div>
					</li>
				<? } ?>


                <?if( count($list) == 0 ){?>
                    <div style="text-align:center; font-size:15px; color:#868686; padding:10% 0;"><?=_t('검색 결과가 없습니다.')?></div>
                <?}?>

			</ul>

            <?php 
            $write_pages = get_paging_ktc($config[cf_write_pages], $page, $total_page, "./board.php?bo_table=$bo_table".$qstr."&page=","&me_code=".$me_code."&info=".$info."&num=".$num.lang_url_a($_SESSION['lang']));
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