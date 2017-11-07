<?
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$result_add = sql_query(" select * from g5_write_".$bo_table." order by wr_num limit ".($page*$page_rows).", ".$page_rows);
$reuslt_cnt = sql_fetch("select count(*) cnt from ( select * from g5_write_".$bo_table." order by wr_num limit ".($page*$page_rows).", ".$page_rows.") a" );
$reuslt_total = sql_fetch(" select count(*) cnt from g5_write_".$bo_table);


while($row = sql_fetch_array($result_add) ){

    // $pattern = "/<img.*?src=[\"']?(?P<url>[^(http)].*?)[\"' >]/i";
    // preg_match($pattern,stripslashes(str_replace('&amp;','&',$row["wr_content"])), $match);
    // $img = substr($match['url'],1);

    $thumb1 = get_list_thumbnail($bo_table, $row['wr_id'], 100,100);

    $thumb = get_list_thumbnail($bo_table, $row['wr_id'], $thumb1['width'],$thumb1['height']);


    //본문내용 텍스트만 가져오기
    $str_subject = cut_str(strip_tags($row['wr_subject_'.$_SESSION['lang']]),$board['bo_mobile_subject_len']);
    $str_content = cut_str(strip_tags($row['wr_content_'.$_SESSION['lang']]),$subject_len);
    ?>

    <li>
        <a href="<?php echo "/bbs/board.php?bo_table=event&wr_id=".$row['wr_id']."&me_code=".$me_code."&info=".$info."&num=".$num; ?><?=lang_url_a($_SESSION['lang'])?>" class="sub44_list_link">
            <div class="sub44_list_img sub44_img<?=$i+1?>" style='background-image: url("<?=$thumb['src']?>")'></div>
            <!--<img src="<?=$thumb['src']?>" alt=""/>-->
            <div class="sub44_list_txt">
                <h3><?=$str_subject?></h3>
                <p class="sub44_txt"><?=$str_content?></p>

                <p class="sub44_btn"><?=_t('자세히보기')?> <span>></span><p>
            </div>
        </a>
    </li>

<?}?>

<?if(($page)*$page_rows + $reuslt_cnt['cnt'] < $reuslt_total['cnt']){?>
<div class="subMore_btn" style='padding-top:30px;'>
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
            url: "/bbs/ajax.listadd_event.php",
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
                $('.sub44_list').append(data);
                $('.remember_page').attr('valPage',page_num);
                
            }
        })
    })
})
</script>

<?}?>


