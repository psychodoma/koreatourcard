<?
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');


$m_sql_result = explode('limit',$m_sql);
$m_sql_result = str_replace("\'".$stx."\'", "'".$stx."'" ,$m_sql_result[0]);
$m_sql_result = str_replace("\'".$sca."\'", "'".$sca."'" ,$m_sql_result);

if($hash_ck){
	$result_add = sql_query($m_sql_result."limit 0, ".$page);
}else{
	$result_add = sql_query($m_sql_result."limit ".($page*$page_rows).", ".$page_rows);
}
//$result_add = sql_query($m_sql_result."limit ".($page*$page_rows).", ".$page_rows);

$reuslt_cnt  = sql_fetch(" select count(*) cnt from ( select * from g5_write_".$bo_table." where (wr_subject_ko_KR like '%".$stx."%' or wr_subject_en_US like '%".$stx."%' or wr_subject_ja_JP like '%".$stx."%' or wr_subject_zh_CN like '%".$stx."%' or wr_subject_zh_TW like '%".$stx."%') and wr_title_ko_KR != '' order by wr_num) a " );
//완료



$result_cnt_val = $reuslt_cnt['cnt'];

$reuslt_total = sql_fetch(" select count(*) cnt from g5_write_".$bo_table." where wr_subject_ko_KR like '%".$stx."%' or wr_subject_en_US like '%".$stx."%' or wr_subject_ja_JP like '%".$stx."%' or wr_subject_zh_CN like '%".$stx."%' or wr_subject_zh_TW like '%".$stx."%' ");


$cnt = 0;
while($row = sql_fetch_array($result_add) ){


    $thumb1 = get_list_thumbnail_ktc($board['bo_table'], $row['wr_id'], 205,108, '',"", "", '', "",1);

    $thumb = get_list_thumbnail_ktc($board['bo_table'], $row['wr_id'], $thumb1['width'],$thumb1['height'], '',"", "", '', "",1);   


    //본문내용 텍스트만 가져오기
    $str_content = cut_str(strip_tags($row['wr_content']),$subject_len);
    ?>
	<a class="link sub32_areaBtn" href="<?php echo "/bbs/board.php?bo_table=".$bo_table."&wr_id=".$row['wr_id']."&me_code=".$me_code."&info=".$info."&num=".$num; ?><?=lang_url_a($_SESSION['lang'])?>" >
    
	<div class="sub32_cont">
        <div class="sub32_cont_area">

            <div class="sub32_cont_area_head">
                <h3>
                    <?if($_SESSION['lang'] != "ko_KR"){?>
                        <?if(  strpos( $row['wr_img_append_'.$_SESSION['lang']], "img src=" ) ){?>
                            <?=$row['wr_img_append_'.$_SESSION['lang']]?>
                        <?}else if($thumb['src']){?>
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
                </h3>
                <p>
				
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
            </div>

            <ul class="sub32_cont_area_cont">
                <? $sql_bene = sql_query("select * from g5_board_file where wr_id =".$row['wr_id']." order by bf_no"); ?>
                        <?while($bene_reulst = sql_fetch_array($sql_bene)){
                            if($bene_reulst['bf_no'] > 3 ){
                        ?>
                            <li>                            
                                <?if($_SESSION['lang'] == "ko_KR"){?>
                                    <?=$bene_reulst['bf_content']?>
                                <?}else{?>
                                    <?=$bene_reulst['bf_content_'.$_SESSION['lang']]?>
                                <?}?>
                            </li>
                <?}}?>
            </ul>

            <p class="sub32_cont_areaBtn"><?=_t('자세히보기')?></p>
        </div>
    </div>
	</a>
	

<?$cnt++;}?>
<?if($hash_ck){?>
	<?if( $cnt < $m_sql_total){?>
	<div class="subMore_btn" style='width:92%;'>
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
	<div class="subMore_btn" style='width:92%;'>
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

	$('.sub32_cont_area_cont li').each(function(index){
		$(this).html($(this).text().replace(/\\/g,'<i class="fa fa-krw" style="font-size:12px;" aria-hidden="true"></i>'));
	})

    $('.subMore_btn_area a').click(function(){
		$(this).html('<div style="padding-top:10px;" ><i class="fa fa-spinner fa-spin fa-2x fa-fw "></i><span class="sr-only">Loading...</span></div>');
		$('.subMore_btn_area a').unbind('click');
        $.ajax({
			type: "post",
            url: "/bbs/ajax.listadd_benefit.php",
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
                    'stx': '<?=$stx?>',
                    'm_sql': "<?=$m_sql?>",
                    'm_sql_total': "<?=$m_sql_total?>",
                  },
            success:function(data){
                $('.subMore_btn').remove();
                var page_num = parseInt($('.remember_page').attr('valPage'))+1;
                var page_row = parseInt($('.remember_page').attr('valRow'));
                $('.sub3_2contents').append(data);
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



