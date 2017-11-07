<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 2;

if ($is_checkbox) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

$reuslt_cnt = sql_fetch("select count(*) cnt from ( select * from g5_write_".$bo_table." order by wr_num limit 0, ".$page_rows.") a" );
$reuslt_total = sql_fetch(" select count(*) cnt from g5_write_".$bo_table);
                    
if( $total_count < $page_rows ){
	$total_count_view = $page_rows;
}else{
	$total_count_view = $total_count;
}


?>
<script type="text/javascript" src="/js/jquery.loading.min.js"></script>
<script type="text/javaScript" language="javascript"> 
	$('body').loadingModal({text: 'Loading...'}).loadingModal('animation', 'cubeGrid');
</script>
<div class='remember_page' valPage='<?=$page?>' valRow='<?=$page_rows?>' ></div>

    <div class="sub3_2navi" style='display:none;'>
        <ul class="bxslider1 sub32_navi">
                <?php echo $category_option_cardbenefit_mo ?>
        </ul>
    </div>


    <div class="sub3_2contents">
			<div class="sub4_6form_area" style='border-bottom: 0px solid #888; border-top: 0px solid #888; ' >
				<div class="sub4_6form">
					<form name="fsearchbox" method="get" action="/bbs/board.php" onsubmit="return fsearchbox_submit(this);" class="">
						<fieldset>
                            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                            <input type="hidden" name="sca" value="<?php echo $sca ?>">
                            <input type="hidden" name="me_code" value="<?php echo $me_code ?>">
                            <input type="hidden" name="info" value="<?php echo $info ?>">
                            <input type="hidden" name="sop" value="and">  
							<input type='hidden' name='lang' value='<?=lang_url($_SESSION['lang'])?>'>
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
						</fieldset>
					</form>
				</div>

			</div><!-- sub4_5form_area 끝 -->










        <div class="sub32_listAll">
            <h2>
				<?if( $_SESSION['lang'] != "en_US" ){?>
					<?=_t('총')?> <span><?php echo number_format($total_count)?></span><?=_t('개 브랜드의 혜택이 있습니다.')?>
				<?}else{?>
					Find out benefits from <span><?php echo number_format($total_count)?></span> brands.
				<?}?>
			</h2>
        </div>

        <?php
        for ($i=0; $i<count($list); $i++) {
                $thumb1 = get_list_thumbnail_ktc($board['bo_table'], $list[$i]['wr_id'], 205,108, '',"", "", '', "",1);

                $thumb = get_list_thumbnail_ktc($board['bo_table'], $list[$i]['wr_id'], $thumb1['width'],$thumb1['height'], '',"", "", '', "",1);     
        ?>
        <a href="<?php echo "/bbs/board.php?bo_table=".$bo_table."&wr_id=".$list[$i]['wr_id']."&me_code=".$me_code."&info=".$info."&num=".$num; ?><?=lang_url_a($_SESSION['lang'])?>" class="sub32_areaBtn">
            <div class="sub32_cont">
                <div class="sub32_cont_area">
                    <div class="sub32_cont_area_head">
                        <h3>
                            <?if($_SESSION['lang'] != "ko_KR"){?>
                                <?if(  strpos( $list[$i]['wr_img_append_'.$_SESSION['lang']], "src=" ) ){?>
                                    <?=$list[$i]['wr_img_append_'.$_SESSION['lang']]?>
                                <?}else if($thumb['src']){?>
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
                        </h3>
                        <p>
                        
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
                    </div>
                        
                    <ul class="sub32_cont_area_cont">
					<? $sql_bene = sql_query("select * from g5_board_file where wr_id =".$list[$i]['wr_id']." order by bf_no"); ?>
							<?while($bene_reulst = sql_fetch_array($sql_bene)){
								if($bene_reulst['bf_no'] > 3 ){
							?>
								<li>
                                    <?if($_SESSION['lang'] == "ko_KR"){?>
                                        <?=$bene_reulst['bf_content']?>
                                    <?}else{?>
                                        <?=$bene_reulst['bf_content_'.$_SESSION['lang']]?>
                                    <?}?>
                                </li>
							<?}}?>
                    </ul>

                    <p class="sub32_cont_areaBtn <?=set_class('sub32_cont_areaBtn_us','en_US')?>"><?=_t('자세히보기')?></p>

                </div>
            </div>
        </a>
        <?}?>

        <?if( count($list) == 0 ){?>
            <div style="text-align:center; font-size:15px; color:#868686; padding:10% 0;"><?=_t('검색 결과가 없습니다.')?></div>
        <?}?>


        <?if($total_count > $page_rows){?>
        <div class="subMore_btn">
            <div class="subMore_btn_area">
                <a>
                    <p class="subMore_icon"></p>
                    <?if( $total_count < $page_rows ){
                        $total_count_view = $page_rows;
                    }else{
                        $total_count_view = $total_count;
                    }
                    ?>
                    <p class="subMore_info">(<?=($page-1)*$page_rows + count($list)?> / <?=$total_count_view?>)</p>
                </a>
            </div>
        </div>
        <?}?>

    </div>



<?if(!$sca){?>



<script>
    $('.img_first').addClass('s32_act');
</script>

<?}?>

<script>
$(function(){
	
	$('.sub3_2navi').css('display','block');
	var cateslider = $('.bxslider1').bxSlider({
		slideWidth: 80,
		minSlides: 1,
		maxSlides: 10,
		moveSlides: 4,
		//slideMargin: 3,
		infiniteLoop: false,
		pager: false,
		hideControlOnEnd: true,
		onSliderLoad:function(){
			setTimeout(function(){
				$('body').loadingModal('destroy') ;
			},800);
			
		}
	});


})


</script>



<?if( $total_count >= $page_rows ){?>

<script>
$(function(){



	if(document.location.hash){
		$('.sub32_cont').each(function(){
			$(this).remove();
		})
		var HashLocationName = document.location.hash;
		HashLocationName = HashLocationName.split(',');
		var div_tag = HashLocationName[1];

		HashLocationName = HashLocationName[0].replace('#','');

		if(HashLocationName != ''){

			$(".subMore_btn_area a").html('<div style="padding-top:10px;" ><i class="fa fa-spinner fa-spin fa-2x fa-fw "></i><span class="sr-only">Loading...</span></div>');
			$('.subMore_btn_area a').unbind('click');
			$.ajax({
				url: "/bbs/ajax.listadd_benefit.php",
				type: "post",
				data: {
						'page': HashLocationName,
						'page_rows': '<?=$page_rows?>',
						'bo_table': '<?=$bo_table?>',
						'ww': <?=$board["bo_mobile_gallery_width"]?>,
						'hh': <?=$board["bo_mobile_gallery_height"]?>,
						'subject_len': <?=$board["bo_mobile_subject_len"]?>,
						'info': '<?=$info?>',
						'me_code': '<?=$me_code?>',
						'num': '<?=$num?>',
						'sca': '<?=$sca?>',
						'stx': '<?=$stx?>',
						'm_sql': "<?=$m_sql?>",
						'm_sql_total': "<?=$m_sql_total?>",
						'hash_ck': true
					  },
				success:function(data){
					$('.subMore_btn').remove();
					//var page_num = parseInt(HashLocationName);
					var page_row = parseInt($('.remember_page').attr('valRow'));
					$('.sub3_2contents').append(data);

					if( $('.subMore_info').text() ){
						var page_value = $('.subMore_info').text().split('(')[1].split('/')[0].trim();
						if(page_value%page_row == 0){
							$('.remember_page').attr('valPage',page_value/page_row);
						}else{
							$('.remember_page').attr('valPage',(page_value+1)/page_row);
						}
					}

					setTimeout(function(){
						$('html, body').scrollTop(div_tag);
					},200);
					

					$('.link').click(function(){
						if( $('.subMore_info').text() ){
							var page_value = $('.subMore_info').text().split('(')[1].split('/')[0].trim();
							document.location.hash = "#"+page_value+","+$(document).scrollTop();	
						}else{
							document.location.hash = "#<?=$total_count_view?>,"+$(document).scrollTop();	
						}	
					})
				}
			})
		}
	}






	$('.sub32_cont_area_cont li').each(function(index){
		$(this).html($(this).text().replace(/\\/g,'<i class="fa fa-krw" style="font-size:12px;" aria-hidden="true"></i>'));
	})

    $('.subMore_btn_area a').click(function(){
		$(this).html('<div style="padding-top:10px;" ><i class="fa fa-spinner fa-spin fa-2x fa-fw "></i><span class="sr-only">Loading...</span></div>');
		$('.subMore_btn_area a').unbind('click');
        $.ajax({
            url: "/bbs/ajax.listadd_benefit.php",
			type: "post",
            data: {
                    'page': $('.remember_page').attr('valPage'),
                    'page_rows': '<?=$page_rows?>',
                    'bo_table': '<?=$bo_table?>',
                    'ww': <?=$board["bo_mobile_gallery_width"]?>,
                    'hh': <?=$board["bo_mobile_gallery_height"]?>,
                    'subject_len': <?=$board["bo_mobile_subject_len"]?>,
                    'info': '<?=$info?>',
                    'me_code': '<?=$me_code?>',
                    'num': '<?=$num?>',
                    'sca': '<?=$sca?>',
                    'stx': '<?=$stx?>',
                    'm_sql': "<?=$m_sql?>",
                    'm_sql_total': "<?=$m_sql_total?>"
                  },
            success:function(data){
                $('.subMore_btn').remove();
                var page_num = parseInt($('.remember_page').attr('valPage'))+1;
                var page_row = parseInt($('.remember_page').attr('valRow'));
                $('.sub3_2contents').append(data);
                $('.remember_page').attr('valPage',page_num);
                


				$('.link').click(function(){
					if( $('.subMore_info').text() ){
						var page_value = $('.subMore_info').text().split('(')[1].split('/')[0].trim();
						document.location.hash = "#"+page_value+","+$(document).scrollTop();	
					}else{
						document.location.hash = "#<?=$total_count_view?>,"+$(document).scrollTop();	
					}
				})



            }
        })
    })
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
