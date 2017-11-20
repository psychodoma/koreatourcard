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

if( !$today ){
    $today = date("Y-m");
    $fetivaltitle = explode('-',$today);
}else{
    $fetivaltitle = explode('-',$today);
    if($cnt == "up"){
        $fetivaltitle[1] = $fetivaltitle[1]+1;

        if( $fetivaltitle[1] < 10 ){
            $fetivaltitle[1] = "0".$fetivaltitle[1];
        }else if(  $fetivaltitle[1] == 13 ){
            $fetivaltitle[1] =  "01";
            $fetivaltitle[0] =  $fetivaltitle[0] + 1;
        }
    }else if($cnt == "down"){
        $fetivaltitle[1] = $fetivaltitle[1]-1;
        if( $fetivaltitle[1] < 10 ){
            $fetivaltitle[1] = "0".$fetivaltitle[1];
        }
        if(  $fetivaltitle[1] == "00" ){
            $fetivaltitle[1] =  "12";
            $fetivaltitle[0] =  $fetivaltitle[0] - 1;
        }
    }
    $today =  $fetivaltitle[0]."-". $fetivaltitle[1];
}

$fe_title = "";
$fe_img = 0;


$fe_title = $fetivaltitle[0].".&nbsp;&nbsp;".$fetivaltitle[1].".";



$list = get_festival_list($stx, $sca, $today,$page,$page_rows);
$list_cnt = get_festival_list_cnt($stx, $sca, $today);
$total_page  = ceil($list_cnt['cnt'] / $page_rows);

?>
<div class='remember_page' valPage='<?=$page?>' valRow='<?=$page_rows?>' ></div>

		<div class="sub3_1area">

			<div class="sub4_6form_area">
				<div class="sub4_6form">
					<form name="fsearchbox" method="get" action="" onsubmit="return fsearchbox_submit(this);" class="">
						<fieldset>
                            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                            <input type="hidden" name="sca" value="<?php echo $sca ?>">
                            <input type="hidden" name="me_code" value="<?php echo $me_code ?>">
                            <input type="hidden" name="info" value="<?php echo $info ?>">

							<input type='hidden' name='lang' value='<?=lang_url($_SESSION['lang'])?>' >

                            <input type="hidden" name="today" value="<?php echo $today ?>">
                            <input type="hidden" name="sop" value="and">
							<label for="sch_stx" class="sound_only hide">검색어<strong class="sound_only"> 필수</strong></label>

							<ul>
								<li class="search45_input">
									<label for="" class="hide">검색창</label>
									<input type="text" class="sub45_bar" name="stx" value='<?=$stx?>' id="sch_stx"  placeholder="<?=_t('검색어를 입력하세요.')?>">
								</li>

								<li class="search45_btn">
									<input type="image" class="syb21_loginbtn" id="sch_submit" src="/img/mobile/main/search.png" alt="검색" title="검색" />
								</li>
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

			</div><!-- sub4_5form_area 끝 -->



            <div class="sub4_trafficTab <?=set_class('sub4_trafficTab_us','en_US')?>" style='margin-bottom:0'>
                <ul class="traffic_searchTab">
                    <li style="width:33.33%;"><a class="tab_link <?if($sca == "") echo 'active';?>  " href="/bbs/board.php?bo_table=festival&info=info&me_code=40&num=3<?=lang_url_a($_SESSION['lang'])?>"><?=_t('전체 일정')?></a></li>
                    <li style="width:33.33%;"><a class="tab_link <?if($sca == "축제&행사") echo 'active';?>  " href="/bbs/board.php?bo_table=festival&info=info&me_code=40&num=3&sca=<?=urlencode('축제&행사')?><?=lang_url_a($_SESSION['lang'])?>"><?=_t('축제/행사')?></a></li>
                    <li style="width:33.33%;"><a class="tab_link <?if($sca == "공연&전시") echo 'active';?>" href="/bbs/board.php?bo_table=festival&info=info&me_code=40&num=3&sca=<?=urlencode('공연&전시')?><?=lang_url_a($_SESSION['lang'])?>" ids="1"><?=_t('공연/전시 ')?></a></li>
                </ul>
            </div>





            <div class="sub4_3calendar">
                <div class='calendar_left'>
                    <a href='./board.php?bo_table=festival&sca=<?=urlencode($sca)?>&info=<?=$info?>&me_code=40&cnt=down&num=3&today=<?=$today?>&stx=<?=$stx?><?=lang_url_a($_SESSION['lang'])?>'>
                        <i class="fa fa-chevron-left fa-2x" aria-hidden="true"></i>
                    </a>
                </div>

                <div class="sub4_3calendar_title"><?=$fe_title?></div>

                <div class='calendar_right'>
                    <a href='./board.php?bo_table=festival&sca=<?=urlencode($sca)?>&info=<?=$info?>&me_code=40&num=3&cnt=up&today=<?=$today?>&stx=<?=$stx?><?=lang_url_a($_SESSION['lang'])?>'>
                        <i class="fa fa-chevron-right fa-2x" aria-hidden="true"></i>
                    </a>
                </div>
            </div>





            <?if( $list_cnt['cnt'] != 0 ){?>

                <ul class="sub43_list">

                    <?php
                    $festival_cnt = 0;
                    while( $row = sql_fetch_array($list) ){
                        $festival_cnt++;
                        $str_subject = cut_str(strip_tags($row['wr_subject_'.$_SESSION['lang']]),$board['bo_subject_len']);
                        if( !$row['is_notice'] ){
                    ?>

                        <li>

                            <?if(!$row['wr_link_'.$_SESSION['lang']]){?>
                              <?if($row['wr_link_en_US']){?>
                                <a href='<?=$row['wr_link_en_US']?>' target='_blank' style='text-decoration:none;'>
                              <?}else{?>
                                <a href='<?=$row['wr_link_ko_KR']?>' target='_blank' style='text-decoration:none;'>
                              <?}?>
                            <?}else{?>
                                <a href='<?=$row['wr_link_'.$_SESSION['lang']]?>' target='_blank' style='text-decoration:none;'>
                            <?}?>



                                <div class="sub43_listArea">
                                    <p class="sub46_list_date calendar_txt2">
                                        <?
                                            echo _t(substr($row['ca_name'],0,6)."/".substr($row['ca_name'],7,6)." ");
                                        ?>
                                    </p>

                                    <h2 class="sub43_list_txt <?=set_class('sub43_list_txt_jp','ja_JP/zh_CN/zh_TW')?> <?=set_class('sub43_list_txt_cn','zh_CN/zh_TW')?>"><?=$str_subject?></h2>

                                    <p class="sub46_list_date calendar_txt1">
                                        <?
                                            echo substr($row['wr_1'],0,4);
                                            echo ". ";
                                            echo substr($row['wr_1'],4,2);
                                            echo ". ";
                                            echo substr($row['wr_1'],6,2);
                                            echo "&nbsp;&nbsp;~&nbsp;&nbsp;";
                                            echo substr($row['wr_2'],0,4);
                                            echo ". ";
                                            echo substr($row['wr_2'],4,2);
                                            echo ". ";
                                            echo substr($row['wr_2'],6,2);
                                        ?>
                                    </p>

                                    <p class="sub46_list_date calendar_txt3">
                                        <?if( $row['wr_3'] ){?>
                                            <?=_t($row['wr_3'])?>&nbsp;
                                        <?}?>
                                        <?if( $row['wr_4'] ){?>
                                            <?=_t($row['wr_4'])?>
                                        <?}?>
                                    </p>

                                </div>
                            </a>
                        </li>

                    <?}}?>

                    <?if($list_cnt['cnt'] > $page_rows){?>
                    <div class="subMore_btn" style='padding-top:30px;'>
                        <div class="subMore_btn_area">
                            <a>
                                <p class="subMore_icon"></p>
                                <?if( $list_cnt['cnt'] < $page_rows ){
                                    $total_count_view = $page_rows;
                                }else{
                                    $total_count_view = $total_count;
                                }
                                ?>
                                <?if(!$stx){?>
                                    <p class="subMore_info">(<?=($page-1)*$page_rows + $festival_cnt?> / <?=$list_cnt['cnt']?>)</p>
                                <?}else{?>
                                    <p class="subMore_info">(<?=($page-1)*$page_rows + $festival_cnt?> / <?=$list_cnt['cnt']?>)</p>
                                <?}?>
                            </a>
                        </div>
                    </div>
                    <?}?>


                </ul>
            <?}else{?>
                <?if( $stx ){?>
                    <div style="text-align:center; font-size:15px; color:#868686; padding:10% 0;"><?=_t('검색 결과가 없습니다.')?></div>
                <?}else{?>
                    <div style="text-align:center; font-size:15px; color:#868686; padding:10% 0;"><?=_t('게시물이 없습니다.')?></div>
                <?}?>
            <?}?>


		</div><!-- sub3_1area 끝 -->



<script>

$(function(){

    $('.subMore_btn_area a').click(function(){
		$(this).html('<div style="padding-top:10px;" ><i class="fa fa-spinner fa-spin fa-2x fa-fw "></i><span class="sr-only">Loading...</span></div>');
		$('.subMore_btn_area a').unbind('click');
        $.ajax({
            url: "/bbs/ajax.listadd_festival.php",
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
                    'stx': '<?=$stx?>',
                    'sca': '<?=$sca?>',
                    'today': '<?=$today?>',
                  },
            success:function(data){
                $('.subMore_btn').remove();
                var page_num = parseInt($('.remember_page').attr('valPage'))+1;
                var page_row = parseInt($('.remember_page').attr('valRow'));
                $('.sub43_list').append(data);
                $('.remember_page').attr('valPage',page_num);

            }
        })
    })

})

</script>







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
