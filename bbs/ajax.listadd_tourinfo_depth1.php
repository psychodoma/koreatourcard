<?
include_once('./_common.php');
// -------------변수 설명-------------
// $row['g_img'] 백그라인드 이미지 주소
// $row['g_icon'] 아이콘 이미지 주소
// $row['g_name'] 제목 
// ----------------------------------
  // 페이지당 개수

$list = get_group_list('tourinfo',$sca,$card_page+1,$page_rows);
$list_cnt = get_group_list_cnt('tourinfo',$sca);
$total_page = ktc_total_page( $list_cnt['cnt'], $page_rows );
$url = ktc_get_url();
?>


<ul class='tourinfo_ul <?if( $sca == "지역별 여행 추천 코스" ) echo "tourinfo_ul1";?> '>
    <?$i=0;while( $row = sql_fetch_array($list) ){?>
        <li>
            <a href="/bbs/board.php?bo_table=tourinfo&sca=<?=$sca?>&bo_table=tourinfo&info=event&me_code=40&num=3&g_id=<?=$row['g_id']?><?=lang_url_a($_SESSION['lang'])?>">
                <div class='tourinfo_div' style="background-image: url(<?=$row['g_img']?>)" >
                    <div class='tourinfo_div_div1'>
                        <span><?=_t($row['g_name_ko_KR'])?></span>
                    </div>

                    <div class='tourinfo_div_div2'>
                        <img src="<?=$row['g_icon']?>"/>
                    </div>

                    <div class="tourinfo_ulBG"></div>
                </div>
            </a>
        </li> 
    <?$i++;}?>
</ul>


<?if(($card_page)*$page_rows + $i < $list_cnt['cnt']){?>
<div class="subMore_btn" style='padding-top:30px;'>
    <div class="subMore_btn_area">
        <a>
            <p class="subMore_icon"></p>
            <p class="subMore_info">(<?=($card_page)*$page_rows + $i?> / <?echo $list_cnt['cnt']?>)</p>
        </a>
    </div>
</div>
<?}else{?>
<div class="subMore_btn" style='padding-top:60px;'></div>
<?}?>


<?if(($card_page)*$page_rows + $i != $list_cnt['cnt']){?>
<script>
$(function(){
    $('.subMore_btn_area a').click(function(){
		$(this).html('<div style="padding-top:10px;" ><i class="fa fa-spinner fa-spin fa-2x fa-fw "></i><span class="sr-only">Loading...</span></div>');
		$('.subMore_btn_area a').unbind('click');
        $.ajax({
            url: "/bbs/ajax.listadd_tourinfo_depth1.php",
            data: {
                    'card_page': $('.remember_page').attr('valPage'),
                    'page_rows': '<?=$page_rows?>',
                    'bo_table': '<?=$bo_table?>',
                    'ww': <?=$board["bo_mobile_gallery_width"]?>,
                    'hh': <?=$board["bo_mobile_gallery_height"]?>,
                    'subject_len': <?=$board["bo_mobile_subject_len"]?>,
                    'info': '<?=$info?>',
                    'me_code': '<?=$me_code?>',
                    'num': '<?=$num?>',
                    'sca': '<?=$sca?>',
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


