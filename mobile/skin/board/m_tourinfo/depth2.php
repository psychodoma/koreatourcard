<?
$page_rows = 6;  // 페이지당 개수
//$list = get_tourinfo_depth_list($g_id);
$list = ktc_get_table_list("g5_write_tourinfo" ,$stx, $sca, $page ,$page_rows, $g_id);
$list_cnt = ktc_get_table_list_cnt("g5_write_tourinfo" ,$stx, $sca, $page ,$page_rows,$g_id);
$total_page = ktc_total_page( $list_cnt['cnt'], $page_rows );
?>

<div class='remember_page' valPage='<?=$page?>' valRow='<?=$page_rows?>' ></div>

<?php while( $row = sql_fetch_array($list) ){
    $thumb1 = get_list_thumbnail($board['bo_table'], $row['wr_id'], 100,100);
    $thumb = get_list_thumbnail($board['bo_table'], $row['wr_id'], $thumb1['width'],$thumb1['height']);
	if( $_SESSION['lang'] != 'en_US' ){
		$str_content = cut_str(strip_tags($row['wr_content_'.$_SESSION['lang']]),$board['bo_mobile_subject_len']);
	}else{
		$str_content = cut_str(strip_tags($row['wr_content_'.$_SESSION['lang']]),100);
	}
?>
    <div class="sub4_1List">
        <div class="sub4_1List_imgArea">
            <a href="/bbs/board.php?bo_table=tourinfo&info=<?=$info?>&me_code=<?=$me_code?>&num=<?=$num?>&sca=<?=$sca?>&g_id=<?=$g_id?>&wr_id=<?=$row['wr_id']?><?=lang_url_a($_SESSION['lang'])?>"  >
                <div class="sub4_1List_img <?if( $sca == "지역별 여행 추천 코스" ) echo "sub4_1List_img1";?> "  >
                    <?if( $thumb['src'] ){?>
                        <img src="<?php echo $thumb['src']?>" />
                    <?}else{?>
                        <img src="/img/default/ktc_cardbenefit_background.png" alt="<?=$row['wr_subject']?>"/>
                    <?}?>
                </div>
                <h3 class="sub4_1List_title"><?=$row['wr_subject_'.$_SESSION['lang']]?></h3>
                <div class="sub4_1List_Black"></div>
            </a>
        </div>

        <div class="sub4_1List_txt">
            <p><?=$str_content?></p>
        </div>
    </div>
<?}?>

<?if($list_cnt['cnt'] == 0){?>
    <div style="text-align:center; font-size:15px; color:#868686; padding:10% 0;"><?=_t('게시물이 없습니다.')?></div>
<?}?>

<?if($list_cnt['cnt'] > $page_rows){?>
    <div class="subMore_btn" style='padding-top:30px;'>
        <div class="subMore_btn_area">
            <a>
                <p class="subMore_icon"></p>
                <?if( $list_cnt['cnt'] < $page_rows ){
                    $total_count_view = $page_rows;
                }else{
                    $total_count_view = $list_cnt['cnt'];
                }
                ?>
                <p class="subMore_info">(<?=($page-1)*$page_rows + count($list)?> / <?=$list_cnt['cnt']?>)</p>
            </a>
        </div>
    </div>
<?}?>


<?if(($page)*$page_rows + $i != $list_cnt['cnt']){?>
<script>
$(function(){
    $('.subMore_btn_area a').click(function(){
		$(this).html('<div style="padding-top:10px;" ><i class="fa fa-spinner fa-spin fa-2x fa-fw "></i><span class="sr-only">Loading...</span></div>');
		$('.subMore_btn_area a').unbind('click');
        $.ajax({
            url: "/bbs/ajax.listadd_tourinfo_depth2.php",
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
                    'g_id': '<?=$g_id?>',
                  },
            success:function(data){
                $('.subMore_btn').remove();
                var page_num = parseInt($('.remember_page').attr('valPage'))+1;
                var page_row = parseInt($('.remember_page').attr('valRow'));
                $('.tabContents1').append(data);
                $('.remember_page').attr('valPage',page_num);
                
            }
        })
    })
})
</script>
<?}?>

