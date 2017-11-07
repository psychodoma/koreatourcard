<?
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

//$result_add = sql_query(" select * from g5_write_".$bo_table." where wr_subject_ko_KR like '%".$stx."%' or wr_subject_en_US like '%".$stx."%' or wr_subject_ja_JP like '%".$stx."%' or wr_subject_zh_CN like '%".$stx."%' or wr_subject_zh_TW like '%".$stx."%'  order by wr_num limit ".($page*$page_rows).", ".$page_rows);




$m_sql_result = explode('limit',$m_sql);
$m_sql_result = str_replace("\'".$stx."\'", "'".$stx."'" ,$m_sql_result[0]);
//echo $m_sql_result."limit ".($page*$page_rows).", ".$page_rows;

$cnt_count = 0;

if($hash_ck){
	$result_add = sql_query($m_sql_result."limit 0, ".$page);
}else{
	$result_add = sql_query($m_sql_result."limit ".($page*$page_rows).", ".$page_rows);
}
$reuslt_cnt  = sql_fetch(" select count(*) cnt from ( select * from g5_write_".$bo_table." where (wr_subject_ko_KR like '%".$stx."%' or wr_subject_en_US like '%".$stx."%' or wr_subject_ja_JP like '%".$stx."%' or wr_subject_zh_CN like '%".$stx."%' or wr_subject_zh_TW like '%".$stx."%') and wr_title_ko_KR != '' order by wr_num) a " );
//완료

//$reuslt_cnt1 = sql_fetch(" select count(DISTINCT `wr_parent`) cnt from ( select * from g5_write_".$bo_table." where wr_subject_ko_KR like '%".$stx."%' or wr_subject_en_US like '%".$stx."%' or wr_subject_ja_JP like '%".$stx."%' or wr_subject_zh_CN like '%".$stx."%' or wr_subject_zh_TW like '%".$stx."%' and wr_group = 0 order by wr_num) a " );


$result_cnt_val = $reuslt_cnt['cnt'];

//$reuslt_total = sql_fetch(" select count(*) cnt from g5_write_".$bo_table." where wr_subject_ko_KR like '%".$stx."%' or wr_subject_en_US like '%".$stx."%' or wr_subject_ja_JP like '%".$stx."%' or wr_subject_zh_CN like '%".$stx."%' or wr_subject_zh_TW like '%".$stx."%' ");




$cnt = 0;
while($row = sql_fetch_array($result_add) ){

    // $pattern = "/<img.*?src=[\"']?(?P<url>[^(http)].*?)[\"' >]/i";
    // preg_match($pattern,stripslashes(str_replace('&amp;','&',$row["wr_content"])), $match);
    // $img = substr($match['url'],1);

    $thumb1 = get_list_thumbnail_ktc($bo_table, $row['wr_id'], 137,68, '',"", "", '', "",1);

    $thumb = get_list_thumbnail_ktc($bo_table, $row['wr_id'], $thumb1['width'],$thumb1['height'], '',"", "", '', "",1);


    //본문내용 텍스트만 가져오기
    ?>

    
    <li <?if($cnt%2 == 1) echo "class='fl_right'"; else echo "class='fl_left'";?>  >
        <a href="<?php echo "/bbs/board.php?bo_table=".$bo_table."&wr_id=".$row['wr_id']."&me_code=".$me_code."&info=".$info."&num=".$num; ?><?=lang_url_a($_SESSION['lang'])?>"  class="link" id="div_<?=$row['wr_id']?>" >
            <div class="sub31_ListImg">
                <?if($_SESSION['lang'] != "ko_KR"){?>
                    <?if( strpos($row['wr_img_append_'.$_SESSION['lang']], 'img src=') ){?>
                        <div class="imgsell" alt="" ><?=$row['wr_img_append_'.$_SESSION['lang']]?></div>
                    <?}else if( $thumb['src'] ){?>
                        <img src="<?php echo $thumb['src']?>" alt="" class="imgsell" />
                    <?}else{?>
                        <img src="/img/default/ktc_cardbenefit_list.png" alt="<?php echo $thumb['alt']?>" class="imgsell"/>
                    <?}?>
                <?}else{?>
                    <?if($thumb['src']){?>
                        <img src="<?php echo $thumb['src']?>" alt="" class="imgsell" />
                    <?}else{?>
                        <img src="/img/default/ktc_cardbenefit_list.png" alt="<?php echo $thumb['alt']?>" class="imgsell"/>
                    <?}?>
                <?}?>
            </div>
            <p style='color:#616161;'>
                  <?if( $stx ){?>
                      <?if( $row['wr_title_'.$_SESSION['lang']] == ''){?>
                          <?=$row['wr_subject_'.$_SESSION['lang']]?>   
                      <?}else{?>
                          <?=$row['wr_title_'.$_SESSION['lang']]?>   
                      <?}?>
                  <?}else{?>
                      <?=$row['wr_title_'.$_SESSION['lang']]?>   
                  <?}?>
			</p>
        </a>
    </li>


<?$cnt++;}?>

<?if($hash_ck){?>
	<?if( $cnt < $m_sql_total){?>
	<div class="subMore_btn" style='padding-top:30px; clear:both;'>
		<div class="subMore_btn_area" style='padding:0;'>
			<a>
				<p class="subMore_icon"></p>
				<p class="subMore_info">(<?=$cnt?> / <?echo $m_sql_total?>)</p>
			</a>
		</div>
	</div>
	<?}?>

<?}else{?>

	<?if(($page)*$page_rows + $cnt < $m_sql_total){?>
	<div class="subMore_btn" style='padding-top:30px; clear:both;'>
		<div class="subMore_btn_area" style='padding:0;'>
			<a>
				<p class="subMore_icon"></p>
				<p class="subMore_info">(<?=($page)*$page_rows + $cnt?> / <?echo $m_sql_total?>)</p>
			</a>
		</div>
	</div>
	<?}?>

<?}?>


<script>
$(function(){

    $('.subMore_btn_area a').click(function(){
		$(this).html('<div style="padding-top:10px;" ><i class="fa fa-spinner fa-spin fa-2x fa-fw "></i><span class="sr-only">Loading...</span></div>');
		$('.subMore_btn_area a').unbind('click');
        $.ajax({
            url: "/bbs/ajax.listadd_brand.php",
			type: "post",
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
                    'm_sql': "<?=$m_sql?>",
                    'm_sql_total': "<?=$m_sql_total?>",
                  },
            success:function(data){
                $('.subMore_btn').remove();
                var page_num = parseInt($('.remember_page').attr('valPage'))+1;
                var page_row = parseInt($('.remember_page').attr('valRow'));
                $('.sub31_List_area').append(data);
                $('.remember_page').attr('valPage',page_num);

				$('.link').click(function(){
					if( $('.subMore_info').text() ){
						var page_value = $('.subMore_info').text().split('(')[1].split('/')[0].trim();
						document.location.hash = "#"+page_value+","+$(document).scrollTop();	
					}else{
						document.location.hash = "#<?=$m_sql_total?>,"+$(document).scrollTop();	
					}
				})
            }
        })
    })
})
</script>




