<?
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

	$v_map_info = " ( SELECT A.store_detail, wr_6, A.wr_7, A.wr_8, A.wr_9, A.wr_10, A.wr_1, A.wr_link1, A.wr_id, A.info_name_ko_KR, A.info_name_en_US, A.info_name_ja_JP, A.info_name_zh_CN, A.info_name_zh_TW, A.info_address_ko_KR, A.info_address_en_US, A.info_address_ja_JP, A.info_address_zh_CN, A.info_address_zh_TW, A.info_lat, A.info_lng, A.store_id, A.info_phone, A.service_id, A.info_servicetime_ko_KR, A.info_servicetime_en_US, A.info_servicetime_ja_JP, A.info_servicetime_zh_CN, A.info_servicetime_zh_TW, A.info_write_time, B.name, B.name_ko_KR, B.name_en_US, B.name_ja_JP, B.name_zh_CN, B.name_zh_TW, B.write_time, B.type_ko_KR, B.type_en_US, B.type_ja_JP, B.type_zh_CN, B.type_zh_TW, B.type_color
	FROM g5_write_map AS A
	INNER JOIN g5_map_store AS B
	ON A.store_id = B.id ) v_map_info ";

if($hash_ck){
	$result_add = sql_query(" select * from ".$v_map_info." where info_name_ko_KR like '%".$word."%' or info_name_en_US like '%".$word."%' or info_name_ja_JP like '%".$word."%' or info_name_zh_CN like '%".$word."%' or  info_name_zh_TW like '%".$word."%' or info_address_ko_KR like '%".$word."%' or info_address_en_US like '%".$word."%' or info_address_ja_JP like '%".$word."%' or info_address_zh_CN like '%".$word."%' or info_address_zh_TW like '%".$word."%' order by info_name_".$_SESSION['lang']." limit 0, ".$page );
}else{
	$result_add = sql_query(" select * from ".$v_map_info." where info_name_ko_KR like '%".$word."%' or info_name_en_US like '%".$word."%' or info_name_ja_JP like '%".$word."%' or info_name_zh_CN like '%".$word."%' or  info_name_zh_TW like '%".$word."%' or info_address_ko_KR like '%".$word."%' or info_address_en_US like '%".$word."%' or info_address_ja_JP like '%".$word."%' or info_address_zh_CN like '%".$word."%' or info_address_zh_TW like '%".$word."%' order by info_name_".$_SESSION['lang']." limit ".($page*$page_rows).", ".$page_rows );
}




$reuslt_cnt = sql_fetch("select count(*) cnt from ( select * from ".$v_map_info." where info_name_ko_KR like '%".$word."%' or info_name_en_US like '%".$word."%' or info_name_ja_JP like '%".$word."%' or info_name_zh_CN like '%".$word."%' or  info_name_zh_TW like '%".$word."%' or info_address_ko_KR like '%".$word."%' or info_address_en_US like '%".$word."%' or info_address_ja_JP like '%".$word."%' or info_address_zh_CN like '%".$word."%' or info_address_zh_TW like '%".$word."%' order by info_name_".$_SESSION['lang']." limit ".($page*$page_rows).", ".$page_rows.") a" );
$reuslt_total = sql_fetch(" select count(*) cnt from ".$v_map_info." where info_name_ko_KR like '%".$word."%' or info_name_en_US like '%".$word."%' or info_name_ja_JP like '%".$word."%' or info_name_zh_CN like '%".$word."%' or  info_name_zh_TW like '%".$word."%' or info_address_ko_KR like '%".$word."%' or info_address_en_US like '%".$word."%' or info_address_ja_JP like '%".$word."%' or info_address_zh_CN like '%".$word."%' or info_address_zh_TW like '%".$word."%' " );

$cntss = 0;
while($row = sql_fetch_array($result_add) ){

    // $pattern = "/<img.*?src=[\"']?(?P<url>[^(http)].*?)[\"' >]/i";
    // preg_match($pattern,stripslashes(str_replace('&amp;','&',$row["wr_content"])), $match);
    // $img = substr($match['url'],1);

    //$thumb1 = get_list_thumbnail($bo_table, $row['wr_id'], 100,100);

    //$thumb = get_list_thumbnail($bo_table, $row['wr_id'], $thumb1['width'],$thumb1['height']);


    //본문내용 텍스트만 가져오기
    //$str_content = cut_str(strip_tags($row['wr_content']),$subject_len);
    ?>

    <li>
        <div class="sub51List_area">
            <div class="sub51List_info">
                <a style='cursor:pointer;' href="/bbs/board.php?bo_table=map&info=search&me_code=20&num=1&word=<?=$row['info_name_'.$_SESSION['lang']]?><?=lang_url_a($_SESSION['lang'])?>" class='link'>
					<div class="sub51List_info_txt">
						<h3><?=$row['info_name_'.$_SESSION['lang']]?></h3>
						<p class="sub51info_add"><?=$row['info_address_'.$_SESSION['lang']]?></p>
					</div>
					<p class="sub51List_icon"><img src="/img/sub/sub5/m_more1.png" alt="더보기"></p>
                </a>
            </div>

            <p class="sub51info_tel" style='padding-bottom:5px;' >
				<?if($row['info_phone']){?>
					<a href="tel:<?=$row['info_phone']?>"><?=$row['info_phone']?></a>
				<?}?>
			</p>
			<?if( $row['info_servicetime_'.$_SESSION['lang']] ){?>
				<p class="sub21_info_tel" style='background-image: url(/img/mobile/sub/sub3/sub3_1/sub31list_icon3.jpg' ><?=$row['info_servicetime_'.$_SESSION['lang']]?></p>
			<?}?>

        </div>
    </li>

<?$cntss++;}?>



<?if($hash_ck){?>
	<?if( $cntss < $reuslt_total['cnt']){?>
		<div class="subMore_btn subMore_btn1" style='margin-top:30px;'>
			<div class="subMore_btn_area subMore_btn_area1">
				<a>
					<p class="subMore_icon"></p>
					<p class="subMore_info">(<?=$cntss?> / <?echo $reuslt_total['cnt']?>)</p>
				</a>
			</div>
		</div>
	<?}?>
<?}else{?>
	<?if(($page)*$page_rows + $cntss < $reuslt_total['cnt']){?>
		<div class="subMore_btn subMore_btn1" style='margin-top:30px;'>
			<div class="subMore_btn_area subMore_btn_area1">
				<a>
					<p class="subMore_icon"></p>
					<p class="subMore_info">(<?=($page)*$page_rows + $reuslt_cnt['cnt']?> / <?echo $reuslt_total['cnt']?>)</p>
				</a>
			</div>
		</div>
	<?}?>
<?}?>

<script>
$(function(){
    $('.subMore_btn_area1 a').click(function(){
		$(this).html('<div style="padding-top:10px;" ><i class="fa fa-spinner fa-spin fa-2x fa-fw "></i><span class="sr-only">Loading...</span></div>');
		$('.subMore_btn_area1 a').unbind('click');
        $.ajax({
            url: "/bbs/ajax.listadd_search.php",
            data: {
                    'page': $('.remember_page1').attr('valPage'),
                    'page_rows': 5,
                    'bo_table': 'map',
                    'word': '<?=$word?>',
					'type': '1',
                  },
            success:function(data){
                $('.subMore_btn1').remove();
                var page_num = parseInt($('.remember_page1').attr('valPage'))+1;
                var page_row = parseInt($('.remember_page1').attr('valRow'));
                $('.sub51List3').append(data);
                $('.remember_page1').attr('valPage',page_num);


				$('.link').click(function(){
					if( $('.subMore_btn1 .subMore_info').text() ){
						var page_value = $('.subMore_btn1 .subMore_info').text().split('(')[1].split('/')[0].trim();
						if( $('.subMore_btn2 .subMore_info').text() ){
							var page_value1 = $('.subMore_btn2 .subMore_info').text().split('(')[1].split('/')[0].trim();
						}else{
							var HashLocationName = document.location.hash;
							HashLocationName = HashLocationName.split(',');
							var page_value1 = HashLocationName[2];
							//var page_value1 = "<?echo $reuslt_total['cnt']?>";
						}
						document.location.hash = "#"+page_value+","+$(document).scrollTop()+","+page_value1;
					}else{
						if( $('.subMore_btn2 .subMore_info').text() ){
							var page_value1 = $('.subMore_btn2 .subMore_info').text().split('(')[1].split('/')[0].trim();
						}else{
							var HashLocationName = document.location.hash;
							HashLocationName = HashLocationName.split(',');
							var page_value1 = HashLocationName[2];
							//var page_value1 = "<?echo $reuslt_total['cnt']?>";
						}
						document.location.hash = "#<?echo $reuslt_total['cnt']?>,"+$(document).scrollTop()+","+page_value1;
					}
				})

            }
        })
    })
})
</script>
