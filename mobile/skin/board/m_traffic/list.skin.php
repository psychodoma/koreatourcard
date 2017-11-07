<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 2;

if ($is_checkbox) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
?>
<div class='remember_page' valPage='<?=$page?>' valRow='<?=$page_rows?>' ></div>



		<div class="sub1_3area">
			<div class="sub1_3topTxt">
				<h4><?=$board['bo_mobile_subject_'.$_SESSION['lang']]?></h4>
			</div>

			<div class="sub4_2_area">
				
            <ul class="sub4_2_list">    
                <?for ($i=0; $i<count($categories); $i++) {
                    $sql_traffic = sql_query( "select * from g5_write_traffic where ca_name = '".$categories[$i]."'" );
                ?>
                    <li class="sub42_list <?if($i==0) echo 'li_margin_l';?>">
                        <div>
                            <img src="/img/sub/sub4/sub4_2/sub42_icon<?=$i+1?>.jpg" alt="지하철"/>

                            <h3><?=_t($categories[$i])?></h3>

                            <ul class="sub42_btn">
								<?while( $row = sql_fetch_array($sql_traffic) ){?>
									<li>
										<?if($_SESSION['lang'] == "ko_KR" || $_SESSION['lang'] == ""){?>
											<a href="<?=$row['wr_1']?>" target='_blank'><?=$row['wr_subject_'.$_SESSION['lang']]?></a>
										<?}else if($_SESSION['lang'] == "en_US" && $row['wr_2'] ){?>
											<a href="<?=$row['wr_2']?>" target='_blank'><?=$row['wr_subject_'.$_SESSION['lang']]?></a>
										<?}else if($_SESSION['lang'] == "ja_JP" && $row['wr_3'] ){?>
											<a href="<?=$row['wr_3']?>" target='_blank'><?=$row['wr_subject_'.$_SESSION['lang']]?></a>
										<?}else if($_SESSION['lang'] == "zh_CN" && $row['wr_4'] ){?>
											<a href="<?=$row['wr_4']?>" target='_blank'><?=$row['wr_subject_'.$_SESSION['lang']]?></a>
										<?}else if($_SESSION['lang'] == "zh_TW" && $row['wr_5'] ){?>
											<a href="<?=$row['wr_5']?>" target='_blank'><?=$row['wr_subject_'.$_SESSION['lang']]?></a>
										<?}else{?>
											<a href="<?=$row['wr_1']?>" target='_blank'><?=$row['wr_subject_'.$_SESSION['lang']]?></a>
										<?}?>
									</li>
								<?}?>
                            </ul>
                        </div>
                    </li>
                <?}?>
            </ul>
            
			</div><!-- sub4_2_area 끝 -->

		</div>













<?if( $total_count >= $page_rows ){?>
<script>
$(function(){
    $('.subMore_btn_area a').click(function(){
        $.ajax({
            url: "/bbs/ajax.listadd.php",
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
                $('.sub13_board').append(data);
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
