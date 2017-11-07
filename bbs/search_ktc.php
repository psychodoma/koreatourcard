<?php
include_once('./_common.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
if($g5['is_db_trans'] && file_exists($g5['locale_path'].'/include/ml/bbs'.'/search.ml.php')) { include_once $g5['locale_path'].'/include/ml/bbs'.'/search.ml.php'; return; }

$g5['title'] = _t('전체검색 결과');
include_once('./_head_sub.php');
if($_SERVER["REMOTE_ADDR"] == "210.96.212.116" ) echo $lang;


$store_newimg_row = sql_query(" select if ( date_add(write_time,interval 61 day) < now() ,'0','1' ) newimg,name from g5_map_store ");
$v_all_search = "  ( (SELECT
wr_id,wr_num,wr_reply,wr_parent,wr_comment,ca_name,wr_subject,wr_subject_ko_KR,wr_subject_en_US,wr_subject_ja_JP,wr_subject_zh_CN,wr_subject_zh_TW,wr_content,wr_content_ko_KR,wr_content_en_US,wr_content_ja_JP,wr_content_zh_CN,wr_content_zh_TW,wr_link1,wr_link2,wr_name,wr_1,wr_2,wr_3,wr_4,wr_5,wr_6,wr_7,wr_8,wr_9,wr_10,info_name_ko_KR,info_name_en_US,info_name_ja_JP,info_name_zh_CN,info_name_zh_TW,info_address_ko_KR,info_address_en_US,info_address_ja_JP,info_address_zh_CN,info_address_zh_TW,store_id,info_phone,info_phone1,info_servicetime_ko_KR,info_servicetime_en_US,info_servicetime_ja_JP,info_servicetime_zh_CN,info_servicetime_zh_TW,info_table
FROM g5_write_map)
union (select
wr_id,wr_num,wr_reply,wr_parent,wr_comment,ca_name,wr_subject,wr_subject_ko_KR,wr_subject_en_US,wr_subject_ja_JP,wr_subject_zh_CN,wr_subject_zh_TW,wr_content,wr_content_ko_KR,wr_content_en_US,wr_content_ja_JP,wr_content_zh_CN,wr_content_zh_TW,wr_link1,wr_link2,wr_name,wr_1,wr_2,wr_3,wr_4,wr_5,wr_6,wr_7,wr_8,wr_9,wr_10,info_name_ko_KR,info_name_en_US,info_name_ja_JP,info_name_zh_CN,info_name_zh_TW,info_address_ko_KR,info_address_en_US,info_address_ja_JP,info_address_zh_CN,info_address_zh_TW,store_id,info_phone,info_phone1,info_servicetime_ko_KR,info_servicetime_en_US,info_servicetime_ja_JP,info_servicetime_zh_CN,info_servicetime_zh_TW,info_table
from g5_write_allshop) ) as v_all_search ";

$query_cnt = "select count(*)as cnt from ".$v_all_search." where info_name_ko_KR like '%".$word."%' or info_name_en_US like '%".$word."%' or info_name_ja_JP like '%".$word."%' or info_name_zh_CN like '%".$word."%' or  info_name_zh_TW like '%".$word."%' or info_address_ko_KR like '%".$word."%' or info_address_en_US like '%".$word."%' or info_address_ja_JP like '%".$word."%' or info_address_zh_CN like '%".$word."%' or info_address_zh_TW like '%".$word."%'  or   wr_subject_ko_KR like '%".$word."%' or  wr_subject like '%".$word."%' or wr_subject_en_US like '%".$word."%' or wr_subject_ja_JP like '%".$word."%' or wr_subject_zh_CN like '%".$word."%' or  wr_subject_zh_TW like '%".$word."%' or wr_content_ko_KR like '%".$word."%' or wr_content_en_US like '%".$word."%' or wr_content_ja_JP like '%".$word."%' or wr_content_zh_CN like '%".$word."%' or wr_content_zh_TW like '%".$word."%' or wr_content like '%".$word."%' ";

$row = sql_fetch($query_cnt);
$cnt_ck = $row['cnt'];

if($row['cnt']  == 0){
    //echo "<script>alert(\"검색한 결과가 없습니다.\"); history.back();</script>";
}else{
    $query = " select * from ".$v_all_search." where info_name_ko_KR like '%".$word."%' or info_name_en_US like '%".$word."%' or info_name_ja_JP like '%".$word."%' or info_name_zh_CN like '%".$word."%' or  info_name_zh_TW like '%".$word."%' or info_address_ko_KR like '%".$word."%' or info_address_en_US like '%".$word."%' or info_address_ja_JP like '%".$word."%' or info_address_zh_CN like '%".$word."%' or info_address_zh_TW like '%".$word."%' or  wr_subject_ko_KR like '%".$word."%' or  wr_subject like '%".$word."%' or wr_subject_en_US like '%".$word."%' or wr_subject_ja_JP like '%".$word."%' or wr_subject_zh_CN like '%".$word."%' or  wr_subject_zh_TW like '%".$word."%' or wr_content_ko_KR like '%".$word."%' or wr_content_en_US like '%".$word."%' or wr_content_ja_JP like '%".$word."%' or wr_content_zh_CN like '%".$word."%' or wr_content_zh_TW like '%".$word."%' or wr_content like '%".$word."%'  ";
    $row_shop = sql_fetch($query_cnt);

    $pagecnt = 5;
    $totalPage  = ceil($row['cnt'] / $pagecnt);  // 전체 페이지 계산
    $tatalCnt = $row['cnt'];

    if(!(isset($page))){
        $page = 1;
    }

    $current_first  = (int)($page-1)*$pagecnt;
    $current_second  = (int)$page*$pagecnt;
    $query .= " limit $current_first, $pagecnt ";

    $row_shop = sql_query($query);
}


// $card_query_cnt = " select count(*) cnt from g5_write_cardbenefit where (wr_subject_ko_KR like '%".$word."%' or wr_subject_en_US like '%".$word."%' or wr_subject_ja_JP like '%".$word."%' or wr_subject_zh_CN like '%".$word."%' or  wr_subject_zh_TW like '%".$word."%') and wr_title_ko_KR != ''  ";
// $card_query_cnt1 = " select count(*) cnt from g5_write_cardbenefit where (wr_subject_ko_KR like '%".$word."%' or wr_subject_en_US like '%".$word."%' or wr_subject_ja_JP like '%".$word."%' or wr_subject_zh_CN like '%".$word."%' or  wr_subject_zh_TW like '%".$word."%') and wr_title_ko_KR = '' group by wr_group ";
// $row_card = sql_fetch($card_query_cnt);
// $row_card1 = sql_fetch($card_query_cnt1);
// $cnt1_ck = $row_card['cnt'] + $row_card1['cnt'];
// if($cnt1_ck == 0){

// }else{
//     $card_query  = " (select * from g5_write_cardbenefit where (wr_subject_ko_KR like '%".$word."%' or wr_subject_en_US like '%".$word."%' or wr_subject_ja_JP like '%".$word."%' or wr_subject_zh_CN like '%".$word."%' or  wr_subject_zh_TW like '%".$word."%') and wr_title_ko_KR != '') union  ";
//     $card_query .= " (select * from g5_write_cardbenefit where (wr_subject_ko_KR like '%".$word."%' or wr_subject_en_US like '%".$word."%' or wr_subject_ja_JP like '%".$word."%' or wr_subject_zh_CN like '%".$word."%' or  wr_subject_zh_TW like '%".$word."%') and wr_title_ko_KR = '' group by wr_group )  ";

//     $row_card = sql_fetch($card_query_cnt);
//     $row_card1 = sql_fetch($card_query_cn1);

//
//     $card_totalPage  = ceil($row_card['cnt'] + $row_card1['cnt'] / $card_pagecnt);  // 전체 페이지 계산
//     $card_tatalCnt = $row_card['cnt'] + $row_card1['cnt'];

//     if(!(isset($card_page))){
//         $card_page = 1;
//     }

//     $card_current_first  = (int)($card_page-1)*$card_pagecnt;
//     $card_current_second  = (int)$card_page*$card_pagecnt;
//     $card_query .= " order by wr_id desc limit $card_current_first, $card_pagecnt ";

//     $row_card = sql_query($card_query);
// }

$word = trim($word);
if ($sca || $word) {
    $sql_search = ktc_get_sql_search($sca, $sfl, $word, $sop,$lang);


    // 가장 작은 번호를 얻어서 변수에 저장 (하단의 페이징에서 사용)
    $sql = " select MIN(wr_num) as min_wr_num from g5_write_cardbenefit ";
    $row = sql_fetch($sql);
    $min_spt = (int)$row['min_wr_num'];

    if (!$spt) $spt = $min_spt;

        $sql = " SELECT COUNT(DISTINCT `wr_group`) AS `cnt` FROM g5_write_cardbenefit WHERE {$sql_search} and wr_group != 0 ";
        $row = sql_fetch($sql);

        $sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM g5_write_cardbenefit WHERE {$sql_search} and wr_group = 0 ";
        $srow = sql_fetch($sql);

        $total_count = $row['cnt'] + $srow['cnt'];


    // 원글만 얻는다. (코멘트의 내용도 검색하기 위함)
    // 라엘님 제안 코드로 대체 http://sir.kr/bbs/board.php?bo_table=g5_bug&wr_id=2922
    /*
    $sql = " select distinct wr_parent from g5_write_cardbenefit where {$sql_search} ";
    $result = sql_query($sql);
    $total_count = sql_num_rows($result);
    */
} else {
    $sql_search = "";
    $sql_beneift_cnt_val = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM g5_write_cardbenefit where wr_title_ko_KR != '' ");
    $total_count = $sql_beneift_cnt_val['cnt'];
}
$m_sql_total = $total_count;


$card_pagecnt = 6;
$card_totalPage  = ceil($total_count / $card_pagecnt);  // 전체 페이지 계산
$card_tatalCnt = $total_count;

if(!(isset($card_page))){
    $card_page = 1;
}



$card_pagecnt = 6;

$from_record = ($card_page - 1) * $card_pagecnt; // 시작 열을 구함

// 공지글이 있으면 변수에 반영
if(!empty($notice_array)) {
    if( !($info == "notice") ){
        $from_record -= count($notice_array);
    }

    if($from_record < 0)
        $from_record = 0;

    if($notice_count > 0)
        $card_pagecnt -= $notice_count;

    if($card_pagecnt < 0)
        $card_pagecnt = $list_card_pagecnt;
}


if(!$sst)
    $sst  = "wr_num, wr_reply";

if ($sst) {
    $sql_order = " order by {$sst} {$sod} ";
}

if ($sca || $word) {

    $sql = " ( select * from (select * from g5_write_cardbenefit where {$sql_search} and wr_group != 0 order by wr_title_ko_KR desc) a group by wr_group ) union";
    $sql .= " (select * from g5_write_cardbenefit where {$sql_search} and wr_group = 0) ";
    $sql .= " limit {$from_record}, $card_pagecnt ";

} else {

    $sql = " select * from g5_write_cardbenefit where wr_is_comment = 0 ";

    $sql .= " and wr_title_ko_KR != '' ";

    if(!empty($notice_array))
        $sql .= " and wr_id not in (".implode(', ', $notice_array).") ";
    $sql .= " {$sql_order} limit {$from_record}, $card_pagecnt ";

}
$m_sql = $sql;

$row_card = sql_query($sql);

















include_once('./search_sub_start.php');
include_once($search_skin_path.'/search.skin.php');
include_once('./search_sub_end.php');
include_once('./_tail.php');
?>
