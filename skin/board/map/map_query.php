<?php
$service_row = sql_query(" select * from g5_map_service");
$store_row = sql_query(" select * from g5_map_store");
$store_row1 = sql_query(" select * from g5_map_store");
$store_newimg_row = sql_query(" select if ( date_add(write_time,interval 61 day) < now() ,'0','1' ) newimg,name from g5_map_store ");
$url = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

	$v_map_info = " ( SELECT A.store_detail, wr_6, A.wr_7, A.wr_8, A.wr_9, A.wr_10, A.wr_1, A.wr_link1, A.wr_id, A.info_name_ko_KR, A.info_name_en_US, A.info_name_ja_JP, A.info_name_zh_CN, A.info_name_zh_TW, A.info_address_ko_KR, A.info_address_en_US, A.info_address_ja_JP, A.info_address_zh_CN, A.info_address_zh_TW, A.info_lat, A.info_lng, A.store_id, A.info_phone, A.service_id, A.info_servicetime_ko_KR, A.info_servicetime_en_US, A.info_servicetime_ja_JP, A.info_servicetime_zh_CN, A.info_servicetime_zh_TW, A.info_write_time, B.name, B.name_ko_KR, B.name_en_US, B.name_ja_JP, B.name_zh_CN, B.name_zh_TW, B.write_time, B.type_ko_KR, B.type_en_US, B.type_ja_JP, B.type_zh_CN, B.type_zh_TW, B.type_color
	FROM g5_write_map AS A
	INNER JOIN g5_map_store AS B
	ON A.store_id = B.id ) v_map_info ";
if($search){
    $query = " select * from ".$v_map_info." where store_detail = ".$search." ";
    $query_cnt = " select count(*) cnt from ".$v_map_info." where store_detail = ".$search." ";

    $row = sql_fetch($query_cnt);
    $current_cnt = $row['cnt'];
    if($row['cnt'] == 0){
        echo "<script>alert('"._t('검색 결과가 없습니다.')."'); history.back();</script>";
    }else{
        include_once("../skin/board/map/pagenation_query.php");
        $row = sql_query($query);
    }

}else if($option[0] != ""){


    $query = " select * from ".$v_map_info." ";
    $query_cnt = " select count(*) cnt from ".$v_map_info." ";



    if($word){
        $query = "select * from ( select * from ".$v_map_info." where wr_1 = 0 and info_name_ko_KR like '%".$word."%' and info_name_ko_KR like '%".$word1."%' or info_name_en_US like '%".$word."%' and info_name_en_US like '%".$word1."%' or info_name_ja_JP like '%".$word."%' and info_name_ja_JP like '%".$word1."%' or info_name_zh_CN like '%".$word."%' and info_name_zh_CN like '%".$word1."%' or  info_name_zh_TW like '%".$word."%' and info_name_zh_TW like '%".$word1."%' or info_address_ko_KR like '%".$word."%' and info_address_ko_KR like '%".$word1."%' or info_address_en_US like '%".$word."%' and info_address_en_US like '%".$word1."%' or info_address_ja_JP like '%".$word."%' and info_address_ja_JP like '%".$word1."%' or info_address_zh_CN like '%".$word."%' and info_address_zh_CN like '%".$word1."%' or info_address_zh_TW like '%".$word."%' and info_address_zh_TW like '%".$word1."%' ) a";
        $query_cnt = "select count(*) cnt from ( select * from ".$v_map_info." where wr_1 = 0 and info_name_ko_KR like '%".$word."%' and info_name_ko_KR like '%".$word1."%' or info_name_en_US like '%".$word."%' and info_name_en_US like '%".$word1."%' or info_name_ja_JP like '%".$word."%' and info_name_ja_JP like '%".$word1."%' or info_name_zh_CN like '%".$word."%' and info_name_zh_CN like '%".$word1."%' or  info_name_zh_TW like '%".$word."%' and info_name_zh_TW like '%".$word1."%' or info_address_ko_KR like '%".$word."%' and info_address_ko_KR like '%".$word1."%' or info_address_en_US like '%".$word."%' and info_address_en_US like '%".$word1."%' or info_address_ja_JP like '%".$word."%' and info_address_ja_JP like '%".$word1."%' or info_address_zh_CN like '%".$word."%' and info_address_zh_CN like '%".$word1."%' or info_address_zh_TW like '%".$word."%' and info_address_zh_TW like '%".$word1."%' ) a";
    }

    for ($i=0; $i < count($option); $i++) {
        if($i == 0) {
            if($option[$i] != ""){
                $query .= " where wr_1 = 0 and store_id = ".$option[$i];
                $query_cnt .= " where wr_1 = 0 and store_id = ".$option[$i];
            }
        }else{
            if($option[$i] != ""){
                $query .= " or store_id = ".$option[$i];
                $query_cnt .= " or store_id = ".$option[$i];
            }
        }
    }


    $row = sql_fetch($query_cnt);
    $current_cnt = $row['cnt'];
    if($row['cnt'] == 0){
        echo "<script>alert('"._t('검색 결과가 없습니다.')."'); history.back();</script>";
    }else{
        include_once("../skin/board/map/pagenation_query.php");
        $row = sql_query($query);
    }


}else if(!$word){    // 그냥 아무런 조건 없을때 여기로 들어간다..
    $query = " select * from ".$v_map_info." ";
    $query_cnt = " select count(*) cnt from ".$v_map_info." ";
    $row = sql_fetch($query_cnt);
    $current_cnt = $row['cnt'];
    include_once("../skin/board/map/pagenation_query.php");
    $row = sql_query($query);

}else{  //단어검색으로 검색했을대 여기로 들어감..
    $query_cnt = " select count(*) cnt from ".$v_map_info." where info_name_ko_KR like '%".$word."%' and info_name_ko_KR like '%".$word1."%' or info_name_en_US like '%".$word."%' and info_name_en_US like '%".$word1."%' or info_name_ja_JP like '%".$word."%' and info_name_ja_JP like '%".$word1."%' or info_name_zh_CN like '%".$word."%' and info_name_zh_CN like '%".$word1."%' or  info_name_zh_TW like '%".$word."%' and info_name_zh_TW like '%".$word1."%' or info_address_ko_KR like '%".$word."%' and info_address_ko_KR like '%".$word1."%' or info_address_en_US like '%".$word."%' and info_address_en_US like '%".$word1."%' or info_address_ja_JP like '%".$word."%' and info_address_ja_JP like '%".$word1."%' or info_address_zh_CN like '%".$word."%' and info_address_zh_CN like '%".$word1."%' or info_address_zh_TW like '%".$word."%' and info_address_zh_TW like '%".$word1."%' ";
    $row = sql_fetch($query_cnt);
    $current_cnt = $row['cnt'];
    if($row['cnt'] == 0){
        echo "<script>alert('"._t('검색 결과가 없습니다.')."'); history.back();</script>";
    }else{
        $query = " select * from ".$v_map_info." where info_name_ko_KR like '%".$word."%' and info_name_ko_KR like '%".$word1."%' or info_name_en_US like '%".$word."%' and info_name_en_US like '%".$word1."%' or info_name_ja_JP like '%".$word."%' and info_name_ja_JP like '%".$word1."%' or info_name_zh_CN like '%".$word."%' and info_name_zh_CN like '%".$word1."%' or  info_name_zh_TW like '%".$word."%' and info_name_zh_TW like '%".$word1."%' or info_address_ko_KR like '%".$word."%' and info_address_ko_KR like '%".$word1."%' or info_address_en_US like '%".$word."%' and info_address_en_US like '%".$word1."%' or info_address_ja_JP like '%".$word."%' and info_address_ja_JP like '%".$word1."%' or info_address_zh_CN like '%".$word."%' and info_address_zh_CN like '%".$word1."%' or info_address_zh_TW like '%".$word."%' and info_address_zh_TW like '%".$word1."%' ";
        $row = sql_fetch($query_cnt);
        $current_cnt = $row['cnt'];
        include_once("../skin/board/map/pagenation_query.php");
        $row = sql_query($query);
    }

		//echo $query;
}

?>
