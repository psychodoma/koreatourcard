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


?>
<script type="text/javascript">
$(document).ready(function(){
	$('.sub1_3topTxt h4').wordBreakKeepAll();
});
</script>



<div class='remember_page' valPage='<?=$page?>' valRow='<?=$page_rows?>' ></div>

<div class="sub1_3area">
    <div class="sub1_3topTxt">
        <h4><?=$board['bo_mobile_subject_'.$_SESSION['lang']]?></h4>
    </div>



    <div class="sub22_board">
        
        <?php
        for ($i=0; $i<count($list); $i++) {

        // $pattern = "/<img.*?src=[\"']?(?P<url>[^(http)].*?)[\"' >]/i";
        // preg_match($pattern,stripslashes(str_replace('&amp;','&',$list[$i]["wr_content"])), $match);
        // $img = substr($match['url'],1);


        $thumb1 = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], 205,108);

		$thumb = get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $thumb1['width'],$thumb1['height']);
		//본문내용 텍스트만 가져오기
		$str_content = cut_str(strip_tags($list[$i]['wr_content_'.$_SESSION['lang']]),1000);

        ?>
        
            <div class="sub22_board_area">
				<?if( $list[$i]['info_name_'.$_SESSION['lang']] || !($_SESSION['lang']) ){?>
					<a href="/bbs/board.php?bo_table=map&info=search&me_code=20&num=1&search=<?=$list[$i]['wr_id']?><?=lang_url_a($_SESSION['lang'])?>">
				<?}else if( $list[$i]['info_name_en_US'] ){?>
					<a href="/bbs/board.php?bo_table=map&info=search&me_code=20&num=1&search=<?=$list[$i]['wr_id']?><?=lang_url_a($_SESSION['lang'])?>">
				<?}else{?>
					<a href="/bbs/board.php?bo_table=map&info=search&me_code=20&num=1&search=<?=$list[$i]['wr_id']?><?=lang_url_a($_SESSION['lang'])?>">
				<?}?>
					<table>	
						<tr>
							
							<td class="sub22_td1">
								<div class="sub22_board_img">
									<div class="sub22_imgArea">
										<?if( $thumb['src'] ){?>
											<img src="<?php echo $thumb['src']?>" alt="" />
										<?}else{?>
											<img src="/img/default/ktc_cardbenefit_list.png" alt="<?php echo $thumb['alt']?>"/>
										<?}?>
									</div>
								</div>
							</td>

							<td class="sub22_td2">
								<div class="sub22_board_info">
									<h3><?=$list[$i]['wr_subject_'.$_SESSION['lang']]?></h3>
									<p><?=$str_content?></p>
								</div>
							</td>
						</tr>
					</table>
                </a>
            </div>
        <?}?>


        <?if($total_count > $page_rows){?>

        <div class="subMore_btn" style='margin-top:30px;'>
            <div class="subMore_btn_area">
                <a>
                    <p class="subMore_icon"></p>
                    <?if( $total_count < $page_rows ){
                        $total_count_view = $page_rows;
                    }else{
                        $total_count_view = $total_count;
                    }
                    ?>
                    <p class="subMore_info">(<?=($page-1)*$page_rows + count($list)?> / <?=$total_count?>)</p>
                </a>
            </div>
        </div>

        <?}?>
        
    </div>




</div>

<?if( $total_count >= $page_rows ){?>

<script>
$(function(){
    $('.subMore_btn_area a').click(function(){
		$(this).html('<div style="padding-top:10px;" ><i class="fa fa-spinner fa-spin fa-2x fa-fw "></i><span class="sr-only">Loading...</span></div>');
		$('.subMore_btn_area a').unbind('click');
        $.ajax({
            url: "/bbs/ajax.listadd_allshop.php",
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
                $('.sub22_board').append(data);
                $('.remember_page').attr('valPage',page_num);
                
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
