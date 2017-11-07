<table width="100%" border="0" class="searchTable_1" >
    <thead>
        <tr>
            <th style="width:445px;"><?=_t('판매점 주소')?></th>
            <th style="width:100px;"><?=_t('분류')?></th>
            <th style="width:150px;"><?=_t('연락처')?></th>
            <th style="width:100px;"><?=_t('영업시간')?></th>
            <th style="width:180px;"><?=_t('제공서비스')?></th>
        </tr>
    </thead>

	<style>
		.searchTable_1 tbody td.info a h4.line1{background:#022f87;color:white;}
		.searchTable_1 tbody td.info a h4.line2{background:#008e3b;color:white;}
		.searchTable_1 tbody td.info a h4.line3{background:#ea5827;color:white;}
		.searchTable_1 tbody td.info a h4.line4{background:#2393d1;color:white;}
	</style>



    <tbody>
        <?$cnt=0; while ($result = sql_fetch_array($row)) { ?>
            <tr>
                <td class="info info_focus info_num_<?=$cnt?>" valLink='<?=$result['wr_link1']?>'  valInfoLat='<?=$result['info_lat']?>' valCnt='<?=$cnt?>' valId='<?=$result['id']?>' valInfoLng='<?=$result['info_lng']?>'  valInfoNameko='<?=$result['info_name_ko_KR']?>' valInfoNameen='<?=$result['info_name_en_US']?>' valInfoNameja='<?=$result['info_name_ja_JP']?>' valInfoNamech1='<?=$result['info_name_zh_CN']?>' valInfoNamech2='<?=$result['info_name_zh_TW']?>'  valdetail='<?=_t('자세히보기')?>' style='cursor:pointer;'>

					<?
						$lineNum = str_split(preg_replace("/[^0-9]*/s", "", strrev($result['info_name_ko_KR']) ,1));
					
					?>

                    <a onclick="fnMove('1')">
                        <h4 class=<?if($result['type_ko_KR'] == '서울교통공사') echo 'line'.$lineNum[0] ?> ><?=++$cnt?></h4>
                        <div>
							<?if($result['type_ko_KR'] != '서울교통공사'){?>
	                           <p class="Bname"><?=$result['info_name_'.$_SESSION['lang']]?></p>
							   <p class="Sname"><?=$result['info_address_'.$_SESSION['lang']]?></p>
							<?}else{?>
								<p class="Bname" style="height:41px;line-height:41px;"><?=$result['info_name_'.$_SESSION['lang']]?></p>
							<?}?>
                        </div>
                    </a>
                </td>
                <td class="list1 <?=set_class('list1_jp','ja_JP')?>"><span style='background-color:<?=$result['type_color']?>'><?=$result['type_'.$_SESSION['lang']]?></span></td>
                <td><?=$result['info_phone']?></td>
                <td><?=$result['info_servicetime_'.$_SESSION['lang']]?></td>
                <td class="service service_val" val='<?=$result['service_id']?>'></td>
            </tr>

            <? 
                //$thumb1 = get_list_thumbnail_ktc('allshop', $result['store_detail'], '114', '50', '', '', '', '','',0);
                $thumb = get_list_thumbnail_ktc('allshop', $result['store_detail'], 114, 45, '', '', '', '','',0);
               
            ?>

            <div class='map_info' valSrc='<?php echo $thumb['src']?>'  valLink='<?=$result['wr_link1']?>' valTotalpage='<?=$totalPage?>' valId='<?=$result['id']?>' valInfoNameko='<?=$result['info_name_ko_KR']?>' valInfoNameen='<?=$result['info_name_en_US']?>' valInfoNameja='<?=$result['info_name_ja_JP']?>' valInfoNamech1='<?=$result['info_name_zh_CN']?>' valInfoNamech2='<?=$result['info_name_zh_TW']?>' valInfoAddressko='<?=$result['info_address_ko_KR']?>' valInfoAddressen='<?=$result['info_address_en_US']?>' valInfoAddressja='<?=$result['info_address_ja_JP']?>' valInfoAddressch1='<?=$result['info_address_zh_CN']?>' valInfoAddressch2='<?=$result['info_address_zh_TW']?>' valInfoLat='<?=$result['info_lat']?>' valInfoLng='<?=$result['info_lng']?>' valInfoServicetimeko='<?=$result['info_servicetime_ko_KR']?>' valInfoServicetimeen='<?=$result['info_servicetime_en_US']?>' valInfoServicetimeja='<?=$result['info_servicetime_ja_JP']?>' valInfoServicetimech1='<?=$result['info_servicetime_zh_CN']?>' valInfoServicetimech2='<?=$result['info_servicetime_zh_TW']?>' valNameko='<?=$result['name_ko_KR']?>' valNameen='<?=$result['name_en_US']?>' valNameja='<?=$result['name_ja_JP']?>' valNamech1='<?=$result['name_zh_CN']?>' valNamech2='<?=$result['name_zh_TW']?>' valTypeko='<?=$result['type_ko_KR']?>' valTypeen='<?=$result['type_en_US']?>' valTypeja='<?=$result['type_ja_JP']?>' valTypech1='<?=$result['type_zh_CN']?>' valTypech2='<?=$result['type_zh_TW']?>'  valdetail='<?=_t('자세히보기')?>'></div>
        <? } ?>
    </tbody>
</table>
<? $cnt = 1; while($service = sql_fetch_array($service_row)){ ?>
  <div class='service_img_src_<?=$cnt++;?>' val="<?=$service['service_img']?>"></div>
<? } ?>

<? include_once('../skin/board/map/pagenation.php') ?>
<?
  $write_pages = get_paging_ktc(9, $page, $totalPage, "./board.php?bo_table=".$bo_table."&info=".$info."&option[0]=".$option[0]."&option[1]=".$option[1]."&option[2]=".$option[2]."&word1=".$word1."&word=".$word."&me_code=".$me_code."&search=".$search."&num=".$num.lang_url_a($_SESSION['lang'])); 
  echo $write_pages;
?>


<script>


    function fnMove(seq){
        var offset = $(".div" + seq).offset();
        var top = offset.top;
        $('html, body').animate({scrollTop : top},300);
    }

</script>






