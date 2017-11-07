<?
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
$result_board = sql_fetch(" select * from g5_board where bo_table = 'knotice' ");
$notice_id = explode(',',$result_board['bo_notice']);


// $result_board = sql_fetch(" select * from g5_board where bo_table = 'knotice' ");



// $notice_id = explode(',',$result_board['bo_notice']);
// $str = "select * from ( select * from g5_write_".$bo_table." where wr_id != ";
// $str_cnt = "select count(*) cnt from ( select * from g5_write_".$bo_table." where wr_id != ";
// for( $i=0; $i<count($notice_id); $i++ ){
//     if($i == 0){
//         $str .= " ".$notice_id[$i]." ";
//         $str_cnt .= " ".$notice_id[$i]." ";
//     }else{
//         $str .= " and wr_id != ".$notice_id[$i]." "; 
//         $str_cnt .= " and wr_id != ".$notice_id[$i]." "; 
//     }
// }
// $str .= " ) a";
// $str_cnt .= " ) a";

if( !$page ){
    $page = 1;
}

$nums = ($page*$page_rows) ;


$sql = " select * from g5_write_".$bo_table." where wr_is_comment = 0 ";
$sql .= " and wr_id not in (".$result_board['bo_notice'].") ";
$sql .= " {$sql_order} limit {$nums}, $page_rows ";

$sql_cnt = " select count(*) cnt from ( select * from g5_write_".$bo_table." where wr_is_comment = 0 ";
$sql_cnt .= " and wr_id not in (".$result_board['bo_notice'].") ";
$sql_cnt .= " {$sql_order} limit {$nums}, $page_rows ) a ";

$result_add = sql_query($sql);
$reuslt_cnt = sql_fetch($sql_cnt);
$reuslt_total = sql_fetch(" select count(*) cnt from g5_write_".$bo_table);


while($row = sql_fetch_array($result_add) ){

    $str_subject = cut_str(strip_tags($row['wr_subject_'.$_SESSION['lang']]),$subject_len);

?>
    <li <?if($row['is_notice']) echo "class='sub46_notice'"?> >
        <a href="<?php echo "/bbs/board.php?bo_table=".$bo_table."&wr_id=".$row['wr_id']."&me_code=".$me_code."&info=".$info."&num=".$num; ?><?=lang_url_a($_SESSION['lang'])?>">
            <div class="sub46_list_txt">
                <?if($row['is_notice']) echo "<h3>"._t('공지')."</h3>";?>
                <h2><?=$str_subject?></h2>
                <p class="sub46_list_date"><?=substr($row['wr_datetime'],0,10);?></p>
            </div>

            <p class="sub46_list_icon"><img src="/img/mobile/sub/sub4/sub4_6/notice_arrow.png" alt=""></p>
        </a>
    </li>


<?}?>
<?if(($page)*$page_rows + $reuslt_cnt['cnt'] + count($notice_id) < $reuslt_total['cnt']  ){?>
<div class="subMore_btn" style='padding-top:30px;'>
    <div class="subMore_btn_area">
        <a>
            <p class="subMore_icon"></p>
            <p class="subMore_info">(<?=($page)*$page_rows + $reuslt_cnt['cnt'] + count($notice_id)?> / <?echo $reuslt_total['cnt']?>)</p>
        </a>
    </div>
</div>
<?}?>
<?if(($page)*$page_rows + $reuslt_cnt['cnt'] + $reuslt_cnt['cnt'] != $reuslt_total['cnt']){?>

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

<?}?>


