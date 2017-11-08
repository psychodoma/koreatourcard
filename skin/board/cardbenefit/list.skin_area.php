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


if(!$word&&!$word1&&!$stx){  //초기 맵 기본값
	$map_address = "서울";
	$map_zoom = "11";
}

if($word && !$word1 && !$stx){ // 지역만 입력했을경우
	$map_address = $word;
	$map_zoom = "9";
}


if($word && $word1 && !$stx){ // 지역 + 시.군.구 입력했을경우
	$map_address = $word." ".$word1;
	$map_zoom = "12";
}



?>







<link rel="stylesheet" href="<?=$board_skin_url?>/sub3_3.css" type="text/css" />
<link href='/css/prettydropdowns.css' type='text/css' rel='stylesheet' >

<script src="/js/jquery.prettydropdowns.js"></script>
<script src="<?echo G5_TMPL_URL;?>/js/map.js"></script>




<style>
	.gm-style .gm-style-iw div div a div:hover{
		background-color:#415d72;
		color:#fff;
	}

	.gm-style-iw{
		text-align:center;
	}
/* 이슈 없으면 11월 2일 오전에 삭제 합니다.
	.list_top_cnt {
		background: url('/img/ktc_map_icon_000.png') no-repeat top left;
		width:31px;
		height:40px;
		display:inline-block;
		vertical-align:top;
		line-height:32px;
		padding-right: 1.5px;
	}

 	.list_top_txt{
		line-height:40px;
		margin-left:10px;
	}

	.suburb{
		padding:5px 0;
	}

	.suburb_hover{
		padding:5px 0;
	} */
</style>

<style type="text/css">
	/* 모든 input에 대해 X버튼 제거  */
	input[type=text]::-ms-clear {
		display: none;
	}

	/* class로 특정 input의 X버튼 제거 */
	.search2::-ms-clear {
		display: none;
	}

</style>


<div class='lang' valLang='<?=$_SESSION['lang']?>'></div>
<div class='url' valUrl='<?=$url?>'></div>

<?if(!$stx){ ?>
	<div class='map_address' valaddress='<?=urlencode($map_address)?>'></div>
	<div class='map_zoom' valzoom='<?=$map_zoom?>'></div>
<?}?>

		<div class="sub2_2center">
<!-- 			<div class="sub1_3topTxt">
				<h4><?php echo $board['bo_subject_'.$_SESSION['lang']] ?></h4>
			</div> -->


<script language="javascript">
//ENTER 안먹게 하는것

$(function(){
	$('.Address_D').prettyDropdown({
		customClass: "select_word arrow",
		classic: true,
		afterLoad: function(){
			$('.select_word li').each(function(index){
				if( index == 0 && "" == "<?=$word?>" ){
					$(this).addClass('selected');
				}
			})
		}
	});

	$('.grid').hover(function(){
		$(this).find('.bgss').css('opacity',1);
		$('.bgss').css('z-index',10);
	},function(){
		$(this).find('.bgss').css('opacity',0);
	})

	$('.cancel_btn').click(function(){
		$('#stx').val("");
	})

	var this1;
	var this2;
	var this3;
	var this4;

	$('.fn_move_func').click(function(){
		if(this1){
			this1.removeClass('active');
			this2.removeClass('active');
			this3.removeClass('active');
			this4.removeClass('active');
		}

		this1 = $(this).parent();
		this1.addClass('active');

		this2 = $(this).parent().find('.suburb_hover');
		this2.addClass('active');

		this3 = $(this).parent().find('.suburb_hover_bottom');
		this3.addClass('active');

		this4 = $(this).parent().parent().find('.figcap');
		this4.addClass('active');
	})

})

function captureReturnKey(e) {
    if(e.keyCode==13 && e.srcElement.type != 'textarea')
    return false;
}


</script>



		  <div class="sub2_1form_area">

                <div class="sub2_1form"style="height:100px;">
                    <form action="" class='search_change' >
                        <fieldset style="position:absolute;z-index:9;">
                            <ul>
                                <li class="">
                                    <label for="" class="hide">검색창</label>
                                    <? include_once('juso/1.php') ?>
                                </li>
                                <!-- <li class="btn">
                                    <input type="image" src="/img/sub/sub3/sub3_3/ktc_serach_btn.png"   title="<?=_t('검색')?>" style='width:33px; height:33px; margin-top: 5px; background-color: #efefef;'/>
                                </li> -->
                            </ul>
                        </fieldset>

						<div class="sub2_1button" style='float:right;'>

								<fieldset>
									<ul>
										<li class="input" style='width:200px; background-image:none; border: 1px solid #d8d8d8; border-radius:5px;'>
											<label for="stx" class="hide">검색창<strong class="sound_only"> 필수</strong></label>
											<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" id="stx" class=" " size="15" maxlength="20" style='width: 160px;'><img src="http://www.koreatourcard.kr/img/sub/sub3/sub3_3/x_btn.png" class='cancel_btn' style="margin-top:5px; cursor:pointer;"/>
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
									</ul>
								</fieldset>
						</div>
					</form>
                </div>
			</div>


			<?if($total_count > 0){?>
			<div id='map' style='width:100%; height:479px;' class="div1"></div>
			<?}?>

			<?if( $_SESSION['lang'] != "en_US" ){?>
				<h2 class="area_ct"><?=_t('총')?> <span><?php echo number_format($total_count)?></span><?=_t('개 매장의 혜택이 있습니다.')?></h2>
			<?}else{?>
				<h2 class="area_ct">Find out benefits from <span><?php echo number_format($total_count)?></span> shops. </h2>
			<?}?>

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

								<style>
										.bgss.active {opacity:1 !important;}
										.suburb_hover.active{opacity:1;}
										.sub3_1List li .effect-bubba .suburb_hover_bottom.active h2{opacity:1;margin-bottom:0;transform:translate3d(0,0,0)}
										.sub3_1List li .effect-bubba .suburb_hover_bottom.active .hover_more{opacity:1;transform:translate3d(0,0,0)}

										.sub3_1List li .effect-bubba .figcap.active:before{opacity:1 !important;}
										.sub3_1List li .effect-bubba .figcap.active{opacity:1 !important;}
								</style>

			<ul class="sub3_1List">
                <?php
                for($i=0; $i<count($list); $i++){
					$cnt = $i;
					$thumb = get_list_thumbnail_ktc($board['bo_table'], $list[$i]['wr_id'], '200', '',true, false, 'left', false,'80/0.5/3',1);
					$thumb1 = get_list_thumbnail_ktc($board['bo_table'], $list[$i]['wr_id'], '200', '',false, true, 'center', true,'80/0.5/3',2);
					?>

                    <li class="info info_focus_area info_num_<?=$cnt?><?if($i%4 == 3) echo ' li_margin_r ';?>"  valLink='/bbs/board.php?bo_table=cardbenefit&wr_id=<?=$list[$i]['wr_id']?>&info=benefit&me_code=30&num=2&lang=<?=lang_url($_SESSION['lang'])?>'  valInfoLat='<?=$list[$i]['wr_lat']?>' valCnt='<?=$cnt?>' valId='<?=$list[$i]['wr_id']?>' valInfoLng='<?=$list[$i]['wr_lng']?>'  valInfoNameko='<?=$list[$i]['wr_subject_ko_KR']?>' valInfoNameen='<?=$list[$i]['wr_subject_en_US']?>' valInfoNameja='<?=$list[$i]['wr_subject_ja_JP']?>' valInfoNamech1='<?=$list[$i]['wr_subject_zh_CN']?>' valInfoNamech2='<?=$list[$i]['wr_subject_zh_TW']?>'  valdetail='<?=_t('자세히보기')?>'  >
						<div class="grid">
							<div class="effect-bubba">
                                <?if (isset($list[$i]['icon_new'])) echo $list[$i]['icon_new'];?>

								<div class="suburb" style="margin-lett:-15px;">
									<div style="margin-left:-15px;">
										<span class="list_top_cnt"><?=$cnt+1?></span><span class="list_top_txt"><?=_t($list[$i]['wr_local1_ko_KR'])?></span>
									</div>
								</div>

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
										 <?=$list[$i]['wr_subject_'.$_SESSION['lang']]?>
									</p>

									<a onclick='fnMove("1")'  target='_blank' class="fn_move_func" >
											<?if($thumb1['src']){?>
												<div valid='<?php echo $thumb1['src']?>' class="figcap bgss hoverOpBack" style='opacity:0;'>
											<?}else{?>
												<div valid='/img/default/ktc_cardbenefit_background1.jpg' class="figcap bgss hoverOpBack" style='opacity:0;'>
											<?}?>
									</a>

									<div class="suburb_hover" >
										<div style="margin-left:-15px;">
											<span class="list_top_cnt" style="color:#333;"><?=$cnt+1?></span><span class="list_top_txt"><?=_t($list[$i]['wr_local2_ko_KR'])?></span>
										</div>
									</div>

									<div class="suburb_hover_bottom">
										<a href="<?php echo $list[$i]['href']."&info=benefit&me_code=".$me_code."&num=".$num.lang_url_a($_SESSION['lang']); ?>"  target='_blank'  >
											<h2><img src="/img/sub/sub3/sub3_1/sub3_1more.png" /></h2>
											<p class="hover_more">
												<?=$list[$i]['wr_subject_'.$_SESSION['lang']]?>
												<br/><?=_t('자세히보기')?>
											</p>
										</a>
									</div>
							</div>

                                    <?if($thumb1['src']){?>
                                        <div valid='<?php echo $thumb1['src']?>' class="figcap bg<?=$i?>" style="opacity:1">
                                    <?}else{?>
                                        <div valid='/img/default/ktc_cardbenefit_background.png' class="figcap bg<?=$i?>">
                                    <?}?>

										<a href="<?php echo $list[$i]['href']."&info=benefit&me_code=".$me_code."&num=".$num.lang_url_a($_SESSION['lang']); ?>"  target='_blank'  >View more</a>
									</div>
							</div>
						</div>
					</li>


                <div class='map_info' valSrc='<?php echo $thumb['src']?>'  vallocal1='<?=_t($list[$i]['wr_local2_ko_KR'])?>' valLink='/bbs/board.php?bo_table=cardbenefit&wr_id=<?=$list[$i]['wr_id']?>&info=benefit&me_code=30&num=2&lang=<?=lang_url($_SESSION['lang'])?>' valTotalpage='<?=$totalPage?>' valId='<?=$list[$i]['wr_id']?>' valInfoNameko='<?=$list[$i]['wr_subject_ko_KR']?>' valInfoNameen='<?=$list[$i]['wr_subject_en_US']?>' valInfoNameja='<?=$list[$i]['wr_subject_ja_JP']?>' valInfoNamech1='<?=$list[$i]['wr_subject_zh_CN']?>' valInfoNamech2='<?=$list[$i]['wr_subject_zh_TW']?>' valInfoAddressko='<?=$list[$i]['wr_subject_ko_KR']?>' valInfoAddressen='<?=$list[$i]['info_address_en_US']?>' valInfoAddressja='<?=$list[$i]['info_address_ja_JP']?>' valInfoAddressch1='<?=$list[$i]['info_address_zh_CN']?>' valInfoAddressch2='<?=$list[$i]['info_address_zh_TW']?>' valInfoLat='<?=$list[$i]['wr_lat']?>' valInfoLng='<?=$list[$i]['wr_lng']?>' valInfoServicetimeko='<?=$list[$i]['wr_subject_ko_KR']?>' valInfoServicetimeen='<?=$list[$i]['info_servicetime_en_US']?>' valInfoServicetimeja='<?=$list[$i]['info_servicetime_ja_JP']?>' valInfoServicetimech1='<?=$list[$i]['info_servicetime_zh_CN']?>' valInfoServicetimech2='<?=$list[$i]['info_servicetime_zh_TW']?>' valNameko='<?=$list[$i]['wr_subject_ko_KR']?>' valNameen='<?=$list[$i]['name_en_US']?>' valNameja='<?=$list[$i]['name_ja_JP']?>' valNamech1='<?=$list[$i]['name_zh_CN']?>' valNamech2='<?=$list[$i]['name_zh_TW']?>' valTypeko='<?=$list[$i]['wr_subject_ko_KR']?>' valTypeen='<?=$list[$i]['type_en_US']?>' valTypeja='<?=$list[$i]['type_ja_JP']?>' valTypech1='<?=$list[$i]['type_zh_CN']?>' valTypech2='<?=$list[$i]['type_zh_TW']?>'  valdetail='<?=_t('자세히보기')?>'></div>


				<? } ?>

                <?if( count($list) == 0 ){?>
                    <div style="text-align:center; font-size:15px; color:#868686; padding:10% 0;"><?=_t('검색 결과가 없습니다.')?></div>
                <?}?>

			</ul>

            <?php
            $write_pages = get_paging_ktc($config[cf_write_pages], $page, $total_page, "./board.php?bo_table=$bo_table","&me_code=".$me_code."&info=".$info."&word=".$word."&word1=".$word1."&stx=".$stx."&num=".$num.lang_url_a($_SESSION['lang']));
            echo $write_pages;
            ?>
		</div>

<script>

    function fnMove(seq){
        var offset = $(".div" + seq).offset();
        var top = offset.top - 220;
        $('html, body').animate({scrollTop : top},300);
    }

</script>


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


<?
$map_lang = explode("_", $_SESSION['lang']);
?>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIX9g1T3yPSC5_ewJO25c7mCiRs0clTU8&language=<?=$map_lang[0]?>&region=<?=$map_lang[1]?>"></script>
