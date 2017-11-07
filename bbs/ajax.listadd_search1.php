<?
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');



$m_sql_result = explode('limit',$m_sql);
$m_sql_result = str_replace("\'".$word."\'", "'".$word."'" ,$m_sql_result[0]);


if($hash_ck){
	$result_add = sql_query($m_sql_result."limit 0, ".$page);
}else{
	$result_add = sql_query($m_sql_result."limit ".($page*$page_rows).", ".$page_rows);
}
$result_cnt_val = $m_sql_total;

$cnt = 0;
while($row = sql_fetch_array($result_add) ){

    $thumb1 = get_list_thumbnail("cardbenefit", $row['wr_id'], '120', '',true, true, 'left', false,'80/0.5/3',1);
    $thumb = get_list_thumbnail("cardbenefit", $row['wr_id'], $thumb1['width'], $thumb1['height'],'', '', '', '', '' ,1);?> 
  


                        <tr>
                            <td class="sub51info_img" style="width: 26%;">
                            
                                <?if($_SESSION['lang'] != "ko_KR"){?>
                                    <?if(  strpos( $row['wr_img_append_'.$_SESSION['lang']], "src=" ) ){?>
                                        <?=$row['wr_img_append_'.$_SESSION['lang']]?>
                                    <?}else if($thumb['src']){?>
                                        <img src="<?=$thumb['src']?>" alt="">
                                    <?}else{?>
                                        <img src="/img/default/ktc_cardbenefit_list.png">
                                    <?}?>
                                <?}else{?>
                                    <?if($thumb['src']){?>
                                            <img src="<?=$thumb['src']?>" alt="">
                                    <?}else{?>
                                        <img src="/img/default/ktc_cardbenefit_list.png">
                                    <?}?>
                                <?}?>
                                
                            </td>
                            <td class="sub51List_info1" style="position: relative;">
                                <a href="/bbs/board.php?bo_table=cardbenefit&wr_id=<?=$row['wr_id']?>&info=benefit&me_code=30&num=2<?=lang_url_a($_SESSION['lang'])?>" class='link1'>
									<div class="sub51List_info1_txt">
										<h3>
											<?if( $word ){?>
												<?if( $row['wr_title_'.$_SESSION['lang']] == ''){?>
													<?=$row['wr_subject_'.$_SESSION['lang']]?>   
												<?}else{?>
													<?=$row['wr_title_'.$_SESSION['lang']]?>   
												<?}?>
											<?}else{?>
												<?=$row['wr_title_'.$_SESSION['lang']]?>   
											<?}?>
										</h3>
										<p>
											<? $sql_bene = sql_fetch("select * from g5_board_file where bo_table='cardbenefit' and bf_no=4 and wr_id =".$row['wr_id']." order by bf_no"); 
											$sql_bene_cnt = sql_fetch("select count(*) cnt from g5_board_file where bo_table='cardbenefit' and wr_id =".$row['wr_id']); 
											$sql_bene_cnts = $sql_bene_cnt['cnt'] - 4;
											?>
											
											<?if($sql_bene_cnts <= 0){?>
											<?=_t('혜택없음')?>
											<?}else{?>
												<?if($_SESSION['lang'] == "ko_KR"){?>
													<?=$sql_bene['bf_content']?> <?=_t('혜택 등 총')?> <?=$sql_bene_cnts?><?=_t('건')?>
												<?}else if($_SESSION['lang'] == "en_US"){?>
													<?=$sql_bene['bf_content_'.$_SESSION['lang']]?> <?=$sql_bene_cnts?> inquiries in total such as  benefits
												<?}else{?>
													<?=$sql_bene['bf_content_'.$_SESSION['lang']]?> <?=_t('혜택 등 총')?> <?=$sql_bene_cnts?><?=_t('건')?>
												<?}?>
											<?}?>
										</p>
									</div>

									<div class="sub51List_more">
										<img src="/img/sub/sub5/m_more1.png" alt="더보기">
									</div>
                                </a>
                            </td>
                           <!--  <td class="sub51List_more"><a href="/bbs/board.php?bo_table=cardbenefit&wr_id=<?=$row['wr_id']?>&info=benefit&me_code=30&num=2"><img src="/img/sub/sub5/m_more1.png" alt="더보기"></a></td> -->

                        </tr>

<?$cnt++;}?>




<?if($hash_ck){?>
	<?if( $cnt < $result_cnt_val){?>
		<tr>
		<td class='sub5_1List_more_btn' colspan=3>
		<div class="subMore_btn subMore_btn2" style='margin-top:30px;'>
			<div class="subMore_btn_area subMore_btn_area2">
				<a>
					<p class="subMore_icon"></p>
					<p class="subMore_info">(<?=$cnt?> / <?echo $result_cnt_val?>)</p>
				</a>
			</div>
		</div>
		</td>
		</tr>
	<?}?>
<?}else{?>
	<?if(($page)*$page_rows + $cnt < $result_cnt_val){?>
		<tr>
		<td class='sub5_1List_more_btn' colspan=3>
		<div class="subMore_btn subMore_btn2" style='margin-top:30px;'>
			<div class="subMore_btn_area subMore_btn_area2">
				<a>
					<p class="subMore_icon"></p>
					<p class="subMore_info">(<?=($page)*$page_rows + $cnt?> / <?echo $result_cnt_val?>)</p>
				</a>
			</div>
		</div>
		</td>
		</tr>
	<?}?>
<?}?>


<script>
$(function(){
    $('.subMore_btn_area2 a').click(function(){
		$(this).html('<div style="padding-top:10px;" ><i class="fa fa-spinner fa-spin fa-2x fa-fw "></i><span class="sr-only">Loading...</span></div>');
		$('.subMore_btn_area2 a').unbind('click');
        $.ajax({
            url: "/bbs/ajax.listadd_search1.php",
			type: "post",
            data: {
                    'page': $('.remember_page2').attr('valPage'),
                    'page_rows': 5,
                    'bo_table': 'cardbenefit',
                    'word': '<?=$word?>',
                    'm_sql': "<?=$m_sql?>",
                    'm_sql_total': "<?=$m_sql_total?>",
                  },
            success:function(data){
                $('.sub5_1List_more_btn').remove();
                var page_num = parseInt($('.remember_page2').attr('valPage'))+1;
                var page_row = parseInt($('.remember_page2').attr('valRow'));
                $('.sub51List4').append(data);
                $('.remember_page2').attr('valPage',page_num);  


					$('.link1').click(function(){

						if( $('.subMore_btn2 .subMore_info').text() ){
							var page_value = $('.subMore_btn2 .subMore_info').text().split('(')[1].split('/')[0].trim();
							if( $('.subMore_btn1 .subMore_info').text() ){
								var page_value1 = "#"+$('.subMore_btn1 .subMore_info').text().split('(')[1].split('/')[0].trim();
							}else{
								var HashLocationName = document.location.hash;
								HashLocationName = HashLocationName.split(',');
								var page_value1 = HashLocationName[0];
								//var page_value1 = "<?echo $reuslt_total['cnt']?>";
							}
							document.location.hash = page_value1+","+$(document).scrollTop()+","+page_value;	
						}else{
							if( $('.subMore_btn1 .subMore_info').text() ){
								var page_value1 = "#"+$('.subMore_btn1 .subMore_info').text().split('(')[1].split('/')[0].trim();
							}else{
								var HashLocationName = document.location.hash;
								HashLocationName = HashLocationName.split(',');
								var page_value1 = HashLocationName[0];
								//var page_value1 = "<?echo $reuslt_total['cnt']?>";
							}
							document.location.hash = page_value1+","+$(document).scrollTop()+","+"<?=$result_cnt_val?>";
						}

	
					})


            }
        })
    })
})
</script>


