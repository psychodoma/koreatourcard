<?
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$service_row = sql_query(" select * from g5_map_service");
$store_row = sql_query(" select * from g5_map_store");
$store_row1 = sql_query(" select * from g5_map_store");
$store_newimg_row = sql_query(" select if ( date_add(write_time,interval 61 day) < now() ,'0','1' ) newimg,name from g5_map_store ");
$url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

$options = $option;

$option = explode(",", $option);

	$v_map_info = " ( SELECT A.store_detail, wr_6, A.wr_7, A.wr_8, A.wr_9, A.wr_10, A.wr_1, A.wr_link1, A.wr_id, A.info_name_ko_KR, A.info_name_en_US, A.info_name_ja_JP, A.info_name_zh_CN, A.info_name_zh_TW, A.info_address_ko_KR, A.info_address_en_US, A.info_address_ja_JP, A.info_address_zh_CN, A.info_address_zh_TW, A.info_lat, A.info_lng, A.store_id, A.info_phone, A.service_id, A.info_servicetime_ko_KR, A.info_servicetime_en_US, A.info_servicetime_ja_JP, A.info_servicetime_zh_CN, A.info_servicetime_zh_TW, A.info_write_time, B.name, B.name_ko_KR, B.name_en_US, B.name_ja_JP, B.name_zh_CN, B.name_zh_TW, B.write_time, B.type_ko_KR, B.type_en_US, B.type_ja_JP, B.type_zh_CN, B.type_zh_TW, B.type_color
	FROM g5_write_map AS A
	INNER JOIN g5_map_store AS B
	ON A.store_id = B.id ) v_map_info ";

if($search){
    $row_add = " select * from ".$v_map_info." where store_detail = ".$search." limit ".($page*$page_rows).", ".$page_rows;

	$reuslt_cnt = " select count(*) cnt from ( select * from ".$v_map_info." where store_detail = ".$search." limit ".($page*$page_rows).", ".$page_rows.") a";

    $reuslt_total = " select count(*) cnt from ".$v_map_info." where store_detail = ".$search." ";
	$reuslt_total1 = " select count(*) cnt from ".$v_map_info." where store_detail = ".$search." ";

    $reuslt_total = sql_fetch($reuslt_total);
    $reuslt_total = $reuslt_total['cnt'];
    if($reuslt_total['cnt'] == 0){
        echo "<script>alert('"._t('검색 결과가 없습니다.')."'); history.back();</script>";
    }else{
       // include_once("../skin/board/map/pagenation_query.php");
        $row_add = sql_query($row_add);
		$reuslt_cnt = sql_fetch($reuslt_cnt);
		$reuslt_total = sql_fetch($reuslt_total1);
    }


}else if($option[0] != ""){  // 옵션이 있다면..
    $row_add = " select * from ".$v_map_info." ";
    $reuslt_cnt = " select count(*) cnt from (select * from ".$v_map_info." ";
    $reuslt_total = " select count(*) cnt from ".$v_map_info." ";

    if($word){
        $row_add = " select * from ( select * from ".$v_map_info." where  info_name_ko_KR like '%".$word."%' and info_name_ko_KR like '%".$word1."%' or info_name_en_US like '%".$word."%' and info_name_en_US like '%".$word1."%' or info_name_ja_JP like '%".$word."%' and info_name_ja_JP like '%".$word1."%' or info_name_zh_CN like '%".$word."%' and info_name_zh_CN like '%".$word1."%' or  info_name_zh_TW like '%".$word."%' and info_name_zh_TW like '%".$word1."%' or info_address_ko_KR like '%".$word."%' and info_address_ko_KR like '%".$word1."%' or info_address_en_US like '%".$word."%' and info_address_en_US like '%".$word1."%' or info_address_ja_JP like '%".$word."%' and info_address_ja_JP like '%".$word1."%' or info_address_zh_CN like '%".$word."%' and info_address_zh_CN like '%".$word1."%' or info_address_zh_TW like '%".$word."%' and info_address_zh_TW like '%".$word1."%' ) b ";
        $reuslt_cnt = " select count(*) cnt from ( select * from ( select * from ".$v_map_info." where  info_name_ko_KR like '%".$word."%' and info_name_ko_KR like '%".$word1."%' or info_name_en_US like '%".$word."%' and info_name_en_US like '%".$word1."%' or info_name_ja_JP like '%".$word."%' and info_name_ja_JP like '%".$word1."%' or info_name_zh_CN like '%".$word."%' and info_name_zh_CN like '%".$word1."%' or  info_name_zh_TW like '%".$word."%' and info_name_zh_TW like '%".$word1."%' or info_address_ko_KR like '%".$word."%' and info_address_ko_KR like '%".$word1."%' or info_address_en_US like '%".$word."%' and info_address_en_US like '%".$word1."%' or info_address_ja_JP like '%".$word."%' and info_address_ja_JP like '%".$word1."%' or info_address_zh_CN like '%".$word."%' and info_address_zh_CN like '%".$word1."%' or info_address_zh_TW like '%".$word."%' and info_address_zh_TW like '%".$word1."%' ) b";
        $reuslt_total = " select count(*) cnt from ( select * from ".$v_map_info." where  info_name_ko_KR like '%".$word."%' and info_name_ko_KR like '%".$word1."%' or info_name_en_US like '%".$word."%' and info_name_en_US like '%".$word1."%' or info_name_ja_JP like '%".$word."%' and info_name_ja_JP like '%".$word1."%' or info_name_zh_CN like '%".$word."%' and info_name_zh_CN like '%".$word1."%' or  info_name_zh_TW like '%".$word."%' and info_name_zh_TW like '%".$word1."%' or info_address_ko_KR like '%".$word."%' and info_address_ko_KR like '%".$word1."%' or info_address_en_US like '%".$word."%' and info_address_en_US like '%".$word1."%' or info_address_ja_JP like '%".$word."%' and info_address_ja_JP like '%".$word1."%' or info_address_zh_CN like '%".$word."%' and info_address_zh_CN like '%".$word1."%' or info_address_zh_TW like '%".$word."%' and info_address_zh_TW like '%".$word1."%' ) b";
    }

    for ($i=0; $i < count($option); $i++) {
        if($i == 0) {
            if($option[$i] != ""){
                $row_add .= " where  store_id = ".$option[$i];
                $reuslt_cnt .= " where  store_id = ".$option[$i];
                $reuslt_total .= " where  store_id = ".$option[$i];
            }
        }else{
            if($option[$i] != ""){
                $row_add .= " or store_id = ".$option[$i];
                $reuslt_cnt .= " or store_id = ".$option[$i];
                $reuslt_total .= " or store_id = ".$option[$i];
            }
        }
    }


    $row_add .= " order by info_name_".$_SESSION['lang']." limit ".($page*$page_rows).", ".$page_rows;

    $reuslt_cnt .= " limit ".($page*$page_rows).", ".$page_rows.") a";

    //echo $reuslt_cnt;


    $row_add = sql_query($row_add);
    $reuslt_cnt = sql_fetch($reuslt_cnt);
    $reuslt_total = sql_fetch($reuslt_total);

}else if(!$word){  //단어가 있따면
        $row_add = sql_query(" select * from ".$v_map_info." order by info_name_".$_SESSION['lang']." limit ".($page*$page_rows).", ".$page_rows);
        $reuslt_cnt = sql_fetch("select count(*) cnt from ( select * from ".$v_map_info." order by info_name_".$_SESSION['lang']." limit ".($page*$page_rows).", ".$page_rows.") a" );
        $reuslt_total = sql_fetch(" select count(*) cnt from ".$v_map_info." ");
}else{ //아무런 검색결과가 없다
        $row_add = sql_query(" select * from ".$v_map_info." where info_name_ko_KR like '%".$word."%' and info_name_ko_KR like '%".$word1."%' or info_name_en_US like '%".$word."%' and info_name_en_US like '%".$word1."%' or info_name_ja_JP like '%".$word."%' and info_name_ja_JP like '%".$word1."%' or info_name_zh_CN like '%".$word."%' and info_name_zh_CN like '%".$word1."%' or  info_name_zh_TW like '%".$word."%' and info_name_zh_TW like '%".$word1."%' or info_address_ko_KR like '%".$word."%' and info_address_ko_KR like '%".$word1."%' or info_address_en_US like '%".$word."%' and info_address_en_US like '%".$word1."%' or info_address_ja_JP like '%".$word."%' and info_address_ja_JP like '%".$word1."%' or info_address_zh_CN like '%".$word."%' and info_address_zh_CN like '%".$word1."%' or info_address_zh_TW like '%".$word."%' and info_address_zh_TW like '%".$word1."%' order by info_name_".$_SESSION['lang']." limit ".($page*$page_rows).", ".$page_rows );
        $reuslt_cnt = sql_fetch("select count(*) cnt from ( select * from ".$v_map_info." where info_name_ko_KR like '%".$word."%' and info_name_ko_KR like '%".$word1."%' or info_name_en_US like '%".$word."%' and info_name_en_US like '%".$word1."%' or info_name_ja_JP like '%".$word."%' and info_name_ja_JP like '%".$word1."%' or info_name_zh_CN like '%".$word."%' and info_name_zh_CN like '%".$word1."%' or  info_name_zh_TW like '%".$word."%' and info_name_zh_TW like '%".$word1."%' or info_address_ko_KR like '%".$word."%' and info_address_ko_KR like '%".$word1."%' or info_address_en_US like '%".$word."%' and info_address_en_US like '%".$word1."%' or info_address_ja_JP like '%".$word."%' and info_address_ja_JP like '%".$word1."%' or info_address_zh_CN like '%".$word."%' and info_address_zh_CN like '%".$word1."%' or info_address_zh_TW like '%".$word."%' and info_address_zh_TW like '%".$word1."%' order by info_name_".$_SESSION['lang']." limit ".($page*$page_rows).", ".$page_rows.") a" );
        $reuslt_total = sql_fetch(" select count(*) cnt from ".$v_map_info." where info_name_ko_KR like '%".$word."%' and info_name_ko_KR like '%".$word1."%' or info_name_en_US like '%".$word."%' and info_name_en_US like '%".$word1."%' or info_name_ja_JP like '%".$word."%' and info_name_ja_JP like '%".$word1."%' or info_name_zh_CN like '%".$word."%' and info_name_zh_CN like '%".$word1."%' or  info_name_zh_TW like '%".$word."%' and info_name_zh_TW like '%".$word1."%' or info_address_ko_KR like '%".$word."%' and info_address_ko_KR like '%".$word1."%' or info_address_en_US like '%".$word."%' and info_address_en_US like '%".$word1."%' or info_address_ja_JP like '%".$word."%' and info_address_ja_JP like '%".$word1."%' or info_address_zh_CN like '%".$word."%' and info_address_zh_CN like '%".$word1."%' or info_address_zh_TW like '%".$word."%' and info_address_zh_TW like '%".$word1."%'" );
}


$cnt = 0;

?>


<? $cnt = 1; while($service = sql_fetch_array($service_row)){ ?>
  <div class='service_img_src_<?=$cnt++;?>' val="<?=$service['service_img']?>"></div>
<? } ?>




<?

while($row = sql_fetch_array($row_add) ){

    // $pattern = "/<img.*?src=[\"']?(?P<url>[^(http)].*?)[\"' >]/i";
    // preg_match($pattern,stripslashes(str_replace('&amp;','&',$row["wr_content"])), $match);
    // $img = substr($match['url'],1);

    $thumb1 = get_list_thumbnail($bo_table, $row['wr_id'], 137,68, '',"", "", '', "",1);

    $thumb = get_list_thumbnail($bo_table, $row['wr_id'], $thumb1['width'],$thumb1['height'], '',"", "", '', "",1);


    //본문내용 텍스트만 가져오기
    ?>

    <div class='sub2_1info_area'>
    <?
		$thumb = get_list_thumbnail_ktc('allshop', $row['store_detail'], 114, 45, '', '', '', '','',0);

    ?>

        <div class="info info_num_<?=$cnt?> sub21_info sub21_info<?=$page?>" style='background-image: url(""); position:relative;' valSrc='<?php echo $thumb['src']?>' valLink='<?=$row['wr_link1']?>'  valInfoLat='<?=$row['info_lat']?>' valCnt='<?=$cnt?>' valId='<?=$row['id']?>' valInfoLng='<?=$row['info_lng']?>'  valInfoNameko='<?=$row['info_name_'.$_SESSION['lang']]?>' valInfoNameen='<?=$row['info_name_en_US']?>' valInfoNameja='<?=$row['info_name_ja_JP']?>' valInfoNamech1='<?=$row['info_name_zh_CN']?>' valInfoNamech2='<?=$row['info_name_zh_TW']?>' style='cursor:pointer;'>
            <h3><?=$row['info_name_'.$_SESSION['lang']]?></h3>
            <p class="sub21_info_add"><?=$row['info_address_'.$_SESSION['lang']]?></p>
            <a href = "tel:<?=$row['info_phone']?>"><p class="sub21_info_tel"><?=$row['info_phone']?></p></a>

			<?if( $row['info_servicetime_'.$_SESSION['lang']] ){?>
				<p class="sub21_info_tel" style='background-image: url(/img/mobile/sub/sub3/sub3_1/sub31list_icon3.jpg' ><?=$row['info_servicetime_'.$_SESSION['lang']]?></p>
			<?}?>

            <ul class="service service_val<?=$page?>" val='<?=$row['service_id']?>'></ul>
            <img class='img_pin<?=$page?> img_pin'  src='/img/mobile/sub/sub2/sub2_1/sub21_arrow1_1.png'>
        </div>
        <div class="sub21_map">
            <div class="sub21_map_area">

            </div>
        </div>
    </div>



    <div class='map_info' valcked='<?=$cnt?>' valSrc='<?php echo $thumb['src']?>'  valLink='<?=$row['wr_link1']?>' valTotalpage='<?=$totalPage?>' valId='<?=$row['id']?>' valInfoNameko='<?=$row['info_name_ko_KR']?>' valInfoNameen='<?=$row['info_name_en_US']?>' valInfoNameja='<?=$row['info_name_ja_JP']?>' valInfoNamech1='<?=$row['info_name_zh_CN']?>' valInfoNamech2='<?=$row['info_name_zh_TW']?>' valInfoAddressko='<?=$row['info_address_ko_KR']?>' valInfoAddressen='<?=$row['info_address_en_US']?>' valInfoAddressja='<?=$row['info_address_ja_JP']?>' valInfoAddressch1='<?=$row['info_address_zh_CN']?>' valInfoAddressch2='<?=$row['info_address_zh_TW']?>' valInfoLat='<?=$row['info_lat']?>' valInfoLng='<?=$row['info_lng']?>' valInfoServicetimeko='<?=$row['info_servicetime_ko_KR']?>' valInfoServicetimeen='<?=$row['info_servicetime_en_US']?>' valInfoServicetimeja='<?=$row['info_servicetime_ja_JP']?>' valInfoServicetimech1='<?=$row['info_servicetime_zh_CN']?>' valInfoServicetimech2='<?=$row['info_servicetime_zh_TW']?>' valNameko='<?=$row['name_ko_KR']?>' valNameen='<?=$row['name_en_US']?>' valNameja='<?=$row['name_ja_JP']?>' valNamech1='<?=$row['name_zh_CN']?>' valNamech2='<?=$row['name_zh_TW']?>' valTypeko='<?=$row['type_ko_KR']?>' valTypeen='<?=$row['type_en_US']?>' valTypeja='<?=$row['type_ja_JP']?>' valTypech1='<?=$row['type_zh_CN']?>' valTypech2='<?=$row['type_zh_TW']?>'></div>

<?$cnt++;}?>

<?if(($page)*$page_rows + $reuslt_cnt['cnt'] < $reuslt_total['cnt']){?>

<div class="subMore_btn" style='width: 100%; max-width: 786px; clear:both;'>
    <div class="subMore_btn_area" style='padding: 0 3%; margin-top: 60px;'>
        <a>
            <p class="subMore_icon"></p>
            <p class="subMore_info">(<?=($page)*$page_rows + $reuslt_cnt['cnt']?> / <?echo $reuslt_total['cnt']?>)</p>
        </a>
    </div>
</div>

<?}?>


<script>
$(function(){




var d_map;
// var m_map;
var ccc = 0;

$(".img_pin<?=$page?>").click(function(){

    var th = $(this).parent();
    var lats = parseFloat($(this).parent().attr('valInfoLat'));
    var lngs = parseFloat($(this).parent().attr('valInfoLng'));
    var src = $(this).parent().attr('valSrc') ;
    var link = $(this).parent().attr('valLink') ;
    var name1 = $(this).parent().attr('valInfoName'+t_lang);

    d_map = $('#map').detach();
    // m_map = d_map;

    var thisel = $(this).parent().parent().find(".sub21_map").css("display");
        $(".sub21_info").each(function(){
            var thatel = $(this).parent().find(".sub21_map").css("display");
            if(thisel != thatel){
            $(this).parent().find(".sub21_map").hide();
            $(this).children('img').attr('src','/img/mobile/sub/sub2/sub2_1/sub21_arrow1_1.png');
            }
        });


        $(this).parent().parent().find(".sub21_map").slideToggle("",function(){
            //$('.sub21_map_area').html("<div id='map' style='width:100%; height:479px;' class='div1'></div>");

            $(this).children('.sub21_map_area').html(d_map);
            $('#map').css('display','block');
            resetPositon_add({ lat: lats, lng:lngs }  , name1  ,  parseInt($(this).attr('valCnt')) , link , src );

        });

    return false;
});



$(".img_pin<?=$page?>").click(function(){

    var ck = $(this).parent().hasClass('sub21_active1');

    var class_name = $(this).parent().attr("class");
    var class_name_arr = class_name.split(" ");
    var menu_number = class_name_arr[0];
    $("#" + menu_number).slideToggle();


    $('.sub21_active1').each(function(){
        $(this).removeClass("sub21_active1");
        //$(this).toggleClass("naviClick").siblings("#navigation .navigation_list li.b_sub .drop").removeClass("naviClick");
    })

    $(this).parent().toggleClass("sub21_active1").siblings(".sub21_info").removeClass("sub21_active1");
    $(this).attr('src','/img/mobile/sub/sub2/sub2_1/sub21_arrow1_2.png');




    if(ck){
        $('.sub21_info').each(function(){
            $(this).removeClass("sub21_active1");
            $(this).children('img').attr('src','/img/mobile/sub/sub2/sub2_1/sub21_arrow1_1.png');
            // $('.sub21_map_area').each(function(){
            //     $(this).remove();
            // })
            //$(this).toggleClass("naviClick").siblings("#navigation .navigation_list li.b_sub .drop").removeClass("naviClick");
        })
    }



});














    $('.subMore_btn_area a').click(function(){
		$(this).html('<div style="padding-top:10px;" ><i class="fa fa-spinner fa-spin fa-2x fa-fw "></i><span class="sr-only">Loading...</span></div>');
		$('.subMore_btn_area a').unbind('click');
        $.ajax({
            url: "/bbs/ajax.listadd_map.php",
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
                    'word': '<?=$word?>',
                    'word1': '<?=$word1?>',
                    'option': '<?=$options?>',
					'search' : '<?=$search?>'
                  },
            success:function(data){
                $('.subMore_btn').remove();
                var page_num = parseInt($('.remember_page').attr('valPage'))+1;
                var page_row = parseInt($('.remember_page').attr('valRow'));
                $('.sub21_storeChoi').append(data);
                $('.remember_page').attr('valPage',page_num);

            }
        })
    })
})


$('.service_val<?=$page?>').each(function (index) {
    $str = "";
    $th = $(this);
    if($(this).attr('val')){
        $len = $(this).attr('val').split(',').length - 1;
        $(this).attr('val').split(',').forEach(function (element, index) {
            $str += "<li><img src='/" + $('.service_img_src_' + element).attr('val') + "'></li>";
        });
        $th.append($str);
    }
})

$('.sub2_1board').css('margin-bottom','0');

</script>
