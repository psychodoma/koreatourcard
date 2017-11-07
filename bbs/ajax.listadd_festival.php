<?
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');


if( !$page ){
    $page = 1;
}

$nums = ($page*$page_rows) ;

$result_add = get_festival_list($stx, $sca, $today, $page+1 ,$page_rows);
$reuslt_total = get_festival_list_cnt($stx, $sca, $today, $page+1);

while($row = sql_fetch_array($result_add) ){

    $str_subject = cut_str(strip_tags($row['wr_subject_'.$_SESSION['lang']]),$subject_len);

?>
    <li>
        <a href="<?=$row['wr_link1']?>" target='_blank' style='text-decoration:none;'>
            <div class="sub43_listArea">
                <p class="sub46_list_date calendar_txt2">
                    <?
                        echo _t(substr($row['ca_name'],0,6)."/".substr($row['ca_name'],7,6)." ");
                    ?>
                </p>

                <h2 class="sub43_list_txt"><?=$str_subject?></h2>

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


<?}?>
<?if(($page+1)*$page_rows + $reuslt_cnt['cnt'] + count($notice_id) < $reuslt_total['cnt']  ){?>
<div class="subMore_btn" style='padding-top:30px;'>
    <div class="subMore_btn_area">
        <a>
            <p class="subMore_icon"></p>
            <p class="subMore_info">(<?=($page+1)*$page_rows + $reuslt_cnt['cnt'] + count($notice_id)?> / <?echo $reuslt_total['cnt']?>)</p>
        </a>
    </div>
</div>
<?}?>
<?if(($page+1)*$page_rows + $reuslt_cnt['cnt'] + $reuslt_cnt['cnt'] != $reuslt_total['cnt']){?>

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

<?}?>


