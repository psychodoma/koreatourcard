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

$result_board = sql_fetch(" select * from g5_board where bo_table = 'knotice' ");
$notice_id = explode(',',$result_board['bo_notice']);

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

            <?if( count($list) > 0 ){?>

                <ul class="sub46_list">
                    <?php
                    for($i=0; $i<count($notice_id); $i++){
                        $row = sql_fetch(" select * from g5_write_knotice where wr_id =".$notice_id[$i]);
                        $str_subject = cut_str(strip_tags($row['wr_subject_'.$_SESSION['lang']]),$board['bo_subject_len']);
                    ?>

                        <li class='sub46_notice'>
                            <a href="<?php echo $list[$i]['href']."&me_code=".$me_code."&info=".$info."&num=".$num; ?><?=lang_url_a($_SESSION['lang'])?>">
                                <div class="sub46_list_txt">
                                    <h3><?=_t('공지')?></h3>
                                    <h2><?=$str_subject?></h2>
                                    <p class="sub46_list_date"><?=substr($list[$i]['wr_datetime'],0,10);?></p>
                                </div>

                                <p class="sub46_list_icon"><img src="/img/mobile/sub/sub4/sub4_6/notice_arrow.png" alt=""></p>
                            </a>
                        </li>

                    <?}?>


                    <?php
                    $notice_cnt = 0;
                    for($i=0; $i<count($list); $i++){
                        //썸네일 이미지 가져오기
                        if($list[$i]['is_notice']) { $notice_cnt++;}
                        //본문내용 텍스트만 가져오기
                        $str_subject = cut_str(strip_tags($list[$i]['wr_subject_'.$_SESSION['lang']]),$board['bo_subject_len']);
                        if( !$list[$i]['is_notice'] ){
                    ?>
                        <li>
                            <a href="<?php echo $list[$i]['href']."&me_code=".$me_code."&info=".$info."&num=".$num; ?>">
                                <div class="sub46_list_txt">
                                    <h2><?=$str_subject?></h2>
                                    <p class="sub46_list_date"><?=substr($list[$i]['wr_datetime'],0,10);?></p>
                                </div>

                                <p class="sub46_list_icon"><img src="/img/mobile/sub/sub4/sub4_6/notice_arrow.png" alt=""></p>
                            </a>
                        </li>

                    <?}}?>

                    <?if($total_count > $page_rows){?>
                    <div class="subMore_btn" style='padding-top:30px;'>
                        <div class="subMore_btn_area">
                            <a>
                                <p class="subMore_icon"></p>
                                <?if( $total_count < $page_rows ){
                                    $total_count_view = $page_rows;
                                }else{
                                    $total_count_view = $total_count;
                                }
                                ?>
                                <?if(!$stx){?>
                                    <p class="subMore_info">(<?=($page-1)*$page_rows + count($list)?> / <?=$total_count?>)</p>
                                <?}else{?>
                                    <p class="subMore_info">(<?=($page-1)*$page_rows + count($list)?> / <?=$total_count?>)</p>
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
            url: "/bbs/ajax.listadd_notice.php",
            data: {
                    'page': $('.remember_page').attr('valPage'),
                    'page_rows': '<?=$page_rows?>',
                    'bo_table': '<?=$bo_table?>',
                    'ww': <?=$board["bo_mobile_gallery_width"]?>,
                    'hh': <?=$board["bo_mobile_gallery_height"]?>,
                    'subject_len': <?=$board["bo_mobile_subject_len"]?>,
                    'info': '<?=$info?>',
                    'me_code': '<?=$me_code?>',
                    'num': '<?=$num?>'
                  },
            success:function(data){
                $('.subMore_btn').remove();
                var page_num = parseInt($('.remember_page').attr('valPage'))+1;
                var page_row = parseInt($('.remember_page').attr('valRow'));
                $('.sub46_list').append(data);
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
