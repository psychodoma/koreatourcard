<?
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

		if($_SESSION['lang']=="ko_KR"){
			$result_add = sql_query(" select * from g5_write_".$bo_table." where wr_1 = 'on' order by wr_num limit ".($page*$page_rows).", ".$page_rows);
			$reuslt_cnt = sql_fetch("select count(*) cnt from ( select * from g5_write_".$bo_table." where wr_1 = 'on' order by wr_num limit ".($page*$page_rows).", ".$page_rows.") a" );
			$reuslt_total = sql_fetch(" select count(*) cnt from g5_write_".$bo_table." where wr_1 = 'on' ");
		}else if($_SESSION['lang']=="en_US"){
			$result_add = sql_query(" select * from g5_write_".$bo_table." where wr_2 = 'on' order by wr_num limit ".($page*$page_rows).", ".$page_rows);
			$reuslt_cnt = sql_fetch("select count(*) cnt from ( select * from g5_write_".$bo_table." where wr_2 = 'on' order by wr_num limit ".($page*$page_rows).", ".$page_rows.") a" );
			$reuslt_total = sql_fetch(" select count(*) cnt from g5_write_".$bo_table." where wr_2 = 'on' ");
		}else if($_SESSION['lang']=="ja_JP"){
			$result_add = sql_query(" select * from g5_write_".$bo_table." where wr_3 = 'on' order by wr_num limit ".($page*$page_rows).", ".$page_rows);
			$reuslt_cnt = sql_fetch("select count(*) cnt from ( select * from g5_write_".$bo_table." where wr_3 = 'on' order by wr_num limit ".($page*$page_rows).", ".$page_rows.") a" );
			$reuslt_total = sql_fetch(" select count(*) cnt from g5_write_".$bo_table." where wr_3 = 'on' ");
		}else if($_SESSION['lang']=="zh_CN"){
			$result_add = sql_query(" select * from g5_write_".$bo_table." where wr_4 = 'on' order by wr_num limit ".($page*$page_rows).", ".$page_rows);
			$reuslt_cnt = sql_fetch("select count(*) cnt from ( select * from g5_write_".$bo_table." where wr_4 = 'on' order by wr_num limit ".($page*$page_rows).", ".$page_rows.") a" );
			$reuslt_total = sql_fetch(" select count(*) cnt from g5_write_".$bo_table." where wr_4 = 'on' ");
		}else if($_SESSION['lang']=="zh_TW"){
			$result_add = sql_query(" select * from g5_write_".$bo_table." where wr_5 = 'on' order by wr_num limit ".($page*$page_rows).", ".$page_rows);
			$reuslt_cnt = sql_fetch("select count(*) cnt from ( select * from g5_write_".$bo_table." where wr_5 = 'on' order by wr_num limit ".($page*$page_rows).", ".$page_rows.") a" );
			$reuslt_total = sql_fetch(" select count(*) cnt from g5_write_".$bo_table." where wr_5 = 'on' ");
		}else{
			$result_add = sql_query(" select * from g5_write_".$bo_table." where wr_1 = 'on' order by wr_num limit ".($page*$page_rows).", ".$page_rows);
			$reuslt_cnt = sql_fetch("select count(*) cnt from ( select * from g5_write_".$bo_table." where wr_1 = 'on' order by wr_num limit ".($page*$page_rows).", ".$page_rows.") a" );
			$reuslt_total = sql_fetch(" select count(*) cnt from g5_write_".$bo_table." where wr_1 = 'on' ");
		}	




while($row = sql_fetch_array($result_add) ){

    // $pattern = "/<img.*?src=[\"']?(?P<url>[^(http)].*?)[\"' >]/i";
    // preg_match($pattern,stripslashes(str_replace('&amp;','&',$row["wr_content"])), $match);
    // $img = substr($match['url'],1);

    $thumb1 = get_list_thumbnail($bo_table, $row['wr_id'], 100,100);

    $thumb = get_list_thumbnail($bo_table, $row['wr_id'], $thumb1['width'],$thumb1['height']);


    //본문내용 텍스트만 가져오기
    $str_content = cut_str(strip_tags($row['wr_content_'.$_SESSION['lang']]),$subject_len);
    ?>
    <div class="sub13_board_area">
        <a style='color:#333;' href="<?php echo "/bbs/board.php?bo_table=".$bo_table."&wr_id=".$row['wr_id']."&me_code=".$me_code."&info=".$info."&num=".$num; ?><?=lang_url_a($_SESSION['lang'])?>">
            <div class="sub13_board_img">
                <?if( $thumb['src'] ){?>
                    <img src="<?php echo $thumb['src']?>" alt="" />
                <?}else{?>
                    <img src="/img/default/ktc_prcenter_M.png" alt="<?php echo $thumb['alt']?>"/>
                <?}?>
            </div>

            <div class="sub13_info">
                <h3><?=$row['wr_subject_'.$_SESSION['lang']]?></h3>
                <p class="sub13_info_txt"><?=$str_content?></p>
                <p class="sub13_info_date"><?=substr($row['wr_datetime'],0,10);?></p>
            </div>
        </a>
    </div>

<?}?>


<?if(($page)*$page_rows + $reuslt_cnt['cnt'] < $reuslt_total['cnt']){?>

<div class="subMore_btn">
    <div class="subMore_btn_area">
        <a>
            <p class="subMore_icon"></p>
            <p class="subMore_info">(<?=($page)*$page_rows + $reuslt_cnt['cnt']?> / <?echo $reuslt_total['cnt']?>)</p>
        </a>
    </div>
</div>

<?}?>

<?if(($page)*$page_rows + $reuslt_cnt['cnt'] != $reuslt_total['cnt']){?>

<script>
$(function(){
    $('.subMore_btn_area a').click(function(){
		$(this).html('<div style="padding-top:10px;" ><i class="fa fa-spinner fa-spin fa-2x fa-fw "></i><span class="sr-only">Loading...</span></div>');
		$('.subMore_btn_area a').unbind('click');
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


