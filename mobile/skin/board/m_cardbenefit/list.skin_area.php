<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 2;

if ($is_checkbox) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);


if( $stx ){

}else{
    $reuslt_cnt = sql_fetch("select count(*) cnt from ( select * from g5_write_".$bo_table." order by wr_num limit 0, ".$page_rows.") a" );
    $reuslt_total = sql_fetch(" select count(*) cnt from g5_write_".$bo_table);
}


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
<link href='<?=$board_skin_url?>/area.css' type='text/css' rel='stylesheet' >

<script src="../skin/board/map/map.js"></script>
<script src="<?echo G5_TMPL_URL;?>/js/map.js"></script>




<script src="/plugin/ask_banner/js/clipboard.min.js"></script>
<style>
.sub3_1List a{
	padding:0 !important;
}

.gm-style .gm-style-iw div{
	overflow: inherit !important;
}
.gm-style-iw{
	text-align:center;
}

.sub31_List_area{border:none;}
.sub31_List_area li{width:auto;min-height:100px;padding:25px 20px;border-radius:5px;border:1px solid #bbb;margin:15px 15px;}

.sub31_List_area li a{display:table;position:relative;height:50px;}
.sub31_List_area li a .sub31_ListImg{margin:0;padding:0;display:table-cell;vertical-align:middle;float:initial;text-align:center;width:100px;}
.sub31_List_area li a .sub31_ListImg img{width:100px;height:50px;min-height:50px;vertical-align:middle;}

.sub31_List_area li .sub31_txt > p {font-size:15px;padding:0;max-height:85px;overflow:hidden;}

.sub31_List_area .link1 .sub31_txt{display:table-cell;vertical-align:middle;text-align:center;width:100%;padding-left:15px;}
.sub31_List_area .link1 .sub31_txt p{word-break: keep-all; word-wrap: break-word;line-height:22px;}
.sub31_List_area .link1 .sub31_txt p.JP{word-break: break-all; }

/*.info{clear:both;position:inherit;width:auto;top:55px;left:0;height:0;height:25px;padding:10px 0;margin-bottom:10px;}*/
.info{clear:both;position:inherit;width:auto;top:-5px;left:0;height:0;height:25px;padding:10px 0;}


@media screen and (max-width: 375px){
	.sub31_List_area li {
		min-height:110px;
		height:auto;
		max-height: 180px ;
	}
}
</style>





<script>

$(function(){

	$('.Address_D option').each(function(index){
		if( $(this).val() == "<?=$word?>" ){
			$(this).prop("selected", true);

			jQuery.ajax({
				type: "POST",
				url: "../skin/board/cardbenefit/juso/2.php",
				data: "Name=" + $('.Address_D').val() + "&word1="+$('.Address_S').val() + "&info=<?=$info?>",
				success: function (msg) {
					$('.Address_S').html(msg);

					$('.Address_S option').each(function(index){
						if( $(this).val() == "<?=$word1?>" ){

							$(this).prop("selected", true);
						}
					})
				},
			});


		}
	})



	$('.Address_S').change(function(index){
		$('#forms_sub').submit();
	})


	$('.info_focus_area_m').click(function(){
		var cnt =  $(this).attr('valCnt');

		$('.info_focus_area_m').each(function(index){
			if(cnt == index){
				$(this).children('img').attr('src','/img/sub/sub3/sub3_3/ktc_map_icon_red_'+cnt+'.png');
			}else{
				$(this).children('img').attr('src','/img/sub/sub3/sub3_3/ktc_map_icon_'+index+'.png');
			}

		})

	})
})

</script>


<div class='lang' valLang='<?=$_SESSION['lang']?>'></div>
<div class='url' valUrl='<?=$url?>'></div>
<?if(!$stx){ ?>
	<div class='map_address' valaddress='<?=urlencode($map_address)?>'></div>
	<div class='map_zoom' valzoom='<?=$map_zoom?>'></div>
<?}?>

<div class='infoarea' valinfo='<?=$info?>'></div>

<div class="sub1_3area">





			<div class="sub4_6form_area" style='border-bottom: 0px solid #888; ' >
				<div class="sub4_6form">
					<form id='forms_sub' name="fsearchbox" method="get" action="/bbs/board.php" onsubmit="return fsearchbox_submit(this);" class="">



                    <input type='hidden' name='num' value='<?=$num;?>'>

                    <ul class="sub2_1form1">
                        <li class="select_box">
							<label  class='Address_D_label box1 <?=set_class('Address_D_label_jp','ja_JP')?>' for="color"><?if($word){?><?=_t(ktc_area_init($word))?><?}else{?><?=_t('전체')?><?}?></label>
                            <select class="Address_D" name='word' id="color" title="select color">
                                <option class='base_select' value=''><?=_t('전체')?></option>
                                <option value='서울' <?if($word == '서울') ?> ><?=_t('서울특별시')?></option>
                                <!--<option value='광주' <?if($word == '광주') ?> ><?=_t('광주광역시')?></option>-->
                                <option value='대구' <?if($word == '대구') ?> ><?=_t('대구광역시')?></option>
                                <!--<option value='대전' <?if($word == '대전') ?> ><?=_t('대전광역시')?></option>-->
                                <option value='부산' <?if($word == '부산') ?> ><?=_t('부산광역시')?></option>
                                <!--<option value='울산' <?if($word == '울산') ?> ><?=_t('울산광역시')?></option>-->
                                <option value='인천' <?if($word == '인천') ?> ><?=_t('인천광역시')?></option>
                                <!--<option value='세종' <?if($word == '세종') ?> ><?=_t('세종특별자치시')?></option>-->
                                <option value='강원' <?if($word == '강원') ?> ><?=_t('강원도')?></option>
                                <option value='경기' <?if($word == '경기') ?> ><?=_t('경기도')?></option>
                                <option value='경상남도' <?if($word == '경상남도') ?> ><?=_t('경상남도')?></option>
                                <option value='경상북도' <?if($word == '경상북도') ?> ><?=_t('경상북도')?></option>
                                <option value='전라남도' <?if($word == '전라남도') ?> ><?=_t('전라남도')?></option>
                                <option value='전라북도' <?if($word == '전라북도') ?> ><?=_t('전라북도')?></option>
                                <!--<option value='제주' <?if($word == '제주') ?> ><?=_t('제주특별자치도')?></option>-->
                                <option value='충청남도' <?if($word == '충청남도') ?> ><?=_t('충청남도')?></option>
                                <option value='충청북도' <?if($word == '충청북도') ?> ><?=_t('충청북도')?></option>
                            </select>

                        </li>

                        <li class="select_box">
							<label  class='Address_D_label box2' for="color"><?if($word1){?><?=_t($word1)?><?}else{?><?=_t('전체')?><?}?></label>
                            <select class="Address_S" name='word1' id="color" title="select color">

                            </select>
                        </li>



                    </ul><!-- sub2_1form 끝 -->




						<fieldset>
                            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                            <input type="hidden" name="sca" value="<?php echo $sca ?>">
                            <input type="hidden" name="me_code" value="<?php echo $me_code ?>">
                            <input type="hidden" name="info" value="<?php echo $info ?>">
                            <input type="hidden" name="sop" value="and">
							<input type='hidden' name='lang' value='<?=lang_url($_SESSION['lang'])?>' >
							<label for="sch_stx" class="sound_only hide">검색어<strong class="sound_only"> 필수</strong></label>

							<ul>
								<li class="search45_input">
									<label for="" class="hide">검색창</label>
									<input type="text" class="sub45_bar" name="stx" value='<?=$stx?>' id="sch_stx" maxlength="" placeholder="<?=_t('검색어를 입력하세요.')?>">
								</li>

								<li class="search45_btn">
									<input type="image" class="syb21_loginbtn" id="sch_submit" src="/img/mobile/main/search.png" alt="검색" title="검색" />
								</li>
							</ul>

							<script>
								function fsearchbox_submit(f)
								{
									/*if (f.stx.value.length < 2) {
										alert("<?=_t('검색어는 두글자 이상 입력하십시오.')?>");
										f.stx.select();
										f.stx.focus();
										return false;
									}*/

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
						</fieldset>
					</form>
				</div>

			</div><!-- sub4_5form_area 끝 -->



			<?if($total_count > 0){?>
			<div id='map' style='width:100%; height:350px;' class="div1"></div>
			<?}?>


			<?if( $_SESSION['lang'] != "en_US" ){?>
				<h2><?=_t('총')?> <span><?php echo number_format($total_count)?></span><?=_t('개 매장의 혜택이 있습니다.')?></h2>
			<?}else{?>
				<h2>Find out benefits from <span><?php echo number_format($total_count)?></span> shops. </h2>
			<?}?>


    <?$cnt = 0;?>
    <div class="sub3_1List">
        <ul class="sub31_List_area">

            <?php
            for ($i=0; $i<count($list); $i++) {

            // $pattern = "/<img.*?src=[\"']?(?P<url>[^(http)].*?)[\"' >]/i";
            // preg_match($pattern,stripslashes(str_replace('&amp;','&',$list[$i]["wr_content"])), $match);
            // $img = substr($match['url'],1);


            $thumb1 = get_list_thumbnail_ktc($board['bo_table'], $list[$i]['wr_id'], 205,108, '',"", "", '', "",1);

            $thumb = get_list_thumbnail_ktc($board['bo_table'], $list[$i]['wr_id'], $thumb1['width'],$thumb1['height'], '',"", "", '', "",1);
            //본문내용 텍스트만 가져오기
            $str_content = cut_str(strip_tags($list[$i]['wr_content']),$board['bo_subject_len']);

            ?>

                <li class="add_btn">
                    <a href="<?php echo "/bbs/board.php?bo_table=".$bo_table."&wr_id=".$list[$i]['wr_id']."&me_code=".$me_code."&info=benefit&num=".$num; ?><?=lang_url_a($_SESSION['lang'])?>" class='link1' id="div_<?=$list[$i]['wr_id']?>"  >



                        <div class="sub31_ListImg">
                            <?if($_SESSION['lang'] != "ko_KR"){?>
                                <?if( strpos($list[$i]['wr_img_append_'.$_SESSION['lang']], 'src=') ){?>
                                    <div class="imgsell" alt="" ><?=$list[$i]['wr_img_append_'.$_SESSION['lang']]?></div>
                                <?}else if( $thumb['src'] ){?>
                                    <img src="<?php echo $thumb['src']?>" alt="" class="imgsell" />
                                <?}else{?>
                                    <img src="/img/default/ktc_cardbenefit_list.png" alt="<?php echo $thumb['alt']?>" class="imgsell"/>
                                <?}?>
                            <?}else{?>
                                <?if($thumb['src']){?>
                                    <img src="<?php echo $thumb['src']?>" alt="" class="imgsell" />
                                <?}else{?>
                                    <img src="/img/default/ktc_cardbenefit_list.png" alt="<?php echo $thumb['alt']?>" class="imgsell"/>
                                <?}?>
                            <?}?>
                        </div>



						<div class="sub31_txt">
                        <p class="<? set_class('JP','ja_JP')?>">
                           <?=$list[$i]['wr_subject_'.$_SESSION['lang']]?>
                        </p>

						<?
						$service_sql = sql_fetch( " select * from g5_write_cardbenefit where wr_id = ".$list[$i]['wr_id'] );

						if($_SESSION['lang'] == 'ko_KR'){
							$service_txt = get_view_thumbnail($service_sql['wr_service']);
						}else{
							$service_txt = get_view_thumbnail($service_sql['wr_service_'.$_SESSION['lang']]);
						}
						$service_txt = explode("\r", $service_txt );
						?>


						<?
						$add_sql = sql_fetch( " select * from g5_write_cardbenefit where wr_id = ".$list[$i]['wr_id'] );

						$copy_add = "";
						if($_SESSION['lang'] == 'ko_KR'){
							$copy_add = $add_sql['wr_address_txt'];
						}else{
							$copy_add = $add_sql['wr_address_txt_'.$_SESSION['lang']];
						}
						?>
						</div>
					</a>



					 <div onclick="fnMove('1')" class="    info info_focus_area_m info_num_<?=$cnt?>"  valLink='/bbs/board.php?bo_table=cardbenefit&wr_id=<?=$list[$i]['wr_id']?>&info=benefit&me_code=30&num=2&lang=kr'  valInfoLat='<?=$list[$i]['wr_lat']?>' valCnt='<?=$cnt?>' valId='<?=$list[$i]['wr_id']?>' valInfoLng='<?=$list[$i]['wr_lng']?>'  valInfoNameko='<?=$list[$i]['wr_subject_ko_KR']?>' valInfoNameen='<?=$list[$i]['wr_subject_en_US']?>' valInfoNameja='<?=$list[$i]['wr_subject_ja_JP']?>' valInfoNamech1='<?=$list[$i]['wr_subject_zh_CN']?>' valInfoNamech2='<?=$list[$i]['wr_subject_zh_TW']?>'  valdetail='<?=_t('자세히보기')?>' ><img src="http://www.koreatourcard.kr/img/sub/sub3/sub3_3/ktc_map_icon_<?=$cnt?>.png">

					 <?if($_SESSION['lang'] == "en_US"){?>
						<?=_t($list[$i]['wr_local2_ko_KR'])?>, <?=_t($list[$i]['wr_local1_ko_KR'])?>
					 <?}else{?>
						<?=_t($list[$i]['wr_local1_ko_KR'])?>, <?=_t($list[$i]['wr_local2_ko_KR'])?>
					 <?}?>


					 </div>
					<!--<div><a href="tel:<?=$service_txt[0]?>">전화<a></div>
					<div>
						<a class="clipboard_btn" data-clipboard-text="<?=$copy_add?>" onclick='alert("<?=_t('주소가 복사되었습니다.')?>")'>복사</a>
					</div> -->



                </li>


                <div class='map_info' valSrc='<?php echo $thumb['src']?>'  vallocal1='<?=_t($list[$i]['wr_local1_ko_KR'])?>' valLink='/bbs/board.php?bo_table=cardbenefit&wr_id=<?=$list[$i]['wr_id']?>&info=benefit&me_code=30&num=2&lang=kr' valTotalpage='<?=$totalPage?>' valId='<?=$list[$i]['wr_id']?>' valInfoNameko='<?=$list[$i]['wr_subject_ko_KR']?>' valInfoNameen='<?=$list[$i]['wr_subject_en_US']?>' valInfoNameja='<?=$list[$i]['wr_subject_ja_JP']?>' valInfoNamech1='<?=$list[$i]['wr_subject_zh_CN']?>' valInfoNamech2='<?=$list[$i]['wr_subject_zh_TW']?>' valInfoAddressko='<?=$list[$i]['wr_subject_ko_KR']?>' valInfoAddressen='<?=$list[$i]['info_address_en_US']?>' valInfoAddressja='<?=$list[$i]['info_address_ja_JP']?>' valInfoAddressch1='<?=$list[$i]['info_address_zh_CN']?>' valInfoAddressch2='<?=$list[$i]['info_address_zh_TW']?>' valInfoLat='<?=$list[$i]['wr_lat']?>' valInfoLng='<?=$list[$i]['wr_lng']?>' valInfoServicetimeko='<?=$list[$i]['wr_subject_ko_KR']?>' valInfoServicetimeen='<?=$list[$i]['info_servicetime_en_US']?>' valInfoServicetimeja='<?=$list[$i]['info_servicetime_ja_JP']?>' valInfoServicetimech1='<?=$list[$i]['info_servicetime_zh_CN']?>' valInfoServicetimech2='<?=$list[$i]['info_servicetime_zh_TW']?>' valNameko='<?=$list[$i]['wr_subject_ko_KR']?>' valNameen='<?=$list[$i]['name_en_US']?>' valNameja='<?=$list[$i]['name_ja_JP']?>' valNamech1='<?=$list[$i]['name_zh_CN']?>' valNamech2='<?=$list[$i]['name_zh_TW']?>' valTypeko='<?=$list[$i]['wr_subject_ko_KR']?>' valTypeen='<?=$list[$i]['type_en_US']?>' valTypeja='<?=$list[$i]['type_ja_JP']?>' valTypech1='<?=$list[$i]['type_zh_CN']?>' valTypech2='<?=$list[$i]['type_zh_TW']?>'  valdetail='<?=_t('자세히보기')?>'></div>



            <?$cnt++;}?>


        <?if( count($list) == 0 ){?>
            <div style="text-align:center; font-size:15px; color:#868686; padding:10% 0;"><?=_t('검색 결과가 없습니다.')?></div>
        <?}?>

        </ul>


        <?$write_pages = get_paging_ktc(5, $page, $total_page, "./board.php?bo_table=$bo_table","&me_code="."&stx=".$stx."&info=".$info."&word=".$word."&word1=".$word1."&num=".$num.lang_url_a($_SESSION['lang']));
            echo $write_pages;
		?>

    </div>




</div>
<?if( $total_count >= $page_rows ){?>

<script>
$(function(){

})
</script>

<?}?>

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
        alert(document.pressed + "<?php echo _t('할 게시물을 하나 이상 선택하세요.'); ?>");
        return false;
    }

    if(document.pressed == "<?php echo _t('선택복사'); ?>") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "<?php echo _t('선택이동'); ?>") {
        select_copy("move");
        return;
    }

    if(document.pressed == "<?php echo _t('선택삭제'); ?>") {
        if (!confirm("<?php echo _t('선택한 게시물을 정말 삭제하시겠습니까?').'\n\n'._t('한번 삭제한 자료는 복구할 수 없습니다').'\n\n'._t('답변글이 있는 게시글을 선택하신 경우').'\n'._t('답변글도 선택하셔야 게시글이 삭제됩니다.'); ?>"))
            return false;

        f.removeAttribute("target");
        f.action = "./board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == 'copy')
        str = "<?php echo _t('복사'); ?>";
    else
        str = "<?php echo _t('이동'); ?>";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = "./move.php";
    f.submit();
}
</script>

<!-- 게시판 목록 끝 -->


<script>


    function fnMove(seq){
        var offset = $(".div" + seq).offset();
        var top = offset.top-50;
        $('html, body').animate({scrollTop : top},300);
    }

</script>



<?
$map_lang = explode("_", $_SESSION['lang']);
?>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIX9g1T3yPSC5_ewJO25c7mCiRs0clTU8&language=<?=$map_lang[0]?>&region=<?=$map_lang[1]?>"></script>
