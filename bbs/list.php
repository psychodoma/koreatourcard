<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if($g5['is_db_trans'] && file_exists($g5['locale_path'].'/include/ml/bbs'.'/list.ml.php')) { include_once $g5['locale_path'].'/include/ml/bbs'.'/list.ml.php'; return; }

// 분류 사용 여부
$is_category = false;
$category_option = '';
if ($board[bo_use_category] && preg_match('/^g4_/', $board['bo_skin'])) {
    $is_category = true;
    $category_location = "./board.php?bo_table=$bo_table&sca=";
    $category_option = get_category_option($bo_table); // SELECT OPTION 태그로 넘겨받음
} else if ($board['bo_use_category']) {
    $is_category = true;
    $category_href = G5_BBS_URL.'/board.php?bo_table='.$bo_table;

    $category_option .= '<li><a href="'.$category_href.'"';
    if ($sca=='')
        $category_option .= ' id="bo_cate_on"';
    $category_option .= '>'._t('전체').'</a></li>';

    $categories = explode('|', $board['bo_category_list']); // 구분자가 , 로 되어 있음
    for ($i=0; $i<count($categories); $i++) {
        $category = trim($categories[$i]);
        if ($category=='') continue;
        $category_option .= '<li><a href="'.($category_href."&amp;sca=".urlencode($category)).'"';
        $category_msg = '';
        if ($category==$sca) { // 현재 선택된 카테고리라면
            $category_option .= ' id="bo_cate_on"';
            // $category_msg = '<span class="sound_only">'._t('열린 분류').' </span>';
        }
        $category_option .= '>'.$category_msg._t($category).'</a></li>';
    }
}


if($bo_table == "cardbenefit"){
    $category_option_cardbenefit = '';
    if ($board[bo_use_category] && preg_match('/^g4_/', $board['bo_skin'])) {
        $is_category = true;
        $category_location = "./board.php?bo_table=$bo_table&info=$info&me_code=$me_code&num=$num&sca=";
        $category_option_cardbenefit = get_category_option($bo_table); // SELECT OPTION 태그로 넘겨받음
    } else if ($board['bo_use_category']) {
        $is_category = true;
        $category_href = G5_BBS_URL.'/board.php?bo_table='.$bo_table.'&info='.$info.'&me_code='.$me_code.'&num='.$num.lang_url_a($_SESSION['lang']);

        $category_option_cardbenefit .= '<li><a href="'.$category_href.'"';
        if ($sca=='')
            $category_option_cardbenefit .= ' ';
            $category_option_cardbenefit .= 'class="benefitall" ><div class="sub31_icon sub31_icon1"></div><p>'._t('전체').'</p></a></li>';

        $categories = explode('|', $board['bo_category_list']); // 구분자가 , 로 되어 있음
        for ($i=0; $i<count($categories); $i++) {
            $imgnum = $i+2;
            $category = trim($categories[$i]);
            if ($category=='') continue;
            $category_option_cardbenefit .= '<li><a href="'.($category_href."&amp;sca=".urlencode($category)).'"';
            $category_msg = '';
            if ($category==$sca) { // 현재 선택된 카테고리라면
                $category_option_cardbenefit .= ' class="s32_act"';
                // $category_msg = '<span class="sound_only">'._t('열린 분류').' </span>';
            }
                $category_option_cardbenefit .= '><div class="sub31_icon sub31_icon'.$imgnum.'"></div><p>'.$category_msg._t(ck_category($category)).'</p></a></li>';
        }
    }
}


if($bo_table == "cardbenefit" && G5_IS_MOBILE){
    $category_option_cardbenefit_mo = '';
    if ($board[bo_use_category] && preg_match('/^g4_/', $board['bo_skin'])) {
        $is_category = true;
        $category_location = "./board.php?bo_table=$bo_table&info=$info&me_code=$me_code&num=$num&sca=";
        $category_option_cardbenefit_mo = get_category_option($bo_table); // SELECT OPTION 태그로 넘겨받음
    } else if ($board['bo_use_category']) {
        $is_category = true;
        $category_href = G5_BBS_URL.'/board.php?bo_table='.$bo_table.'&info='.$info.'&me_code='.$me_code.'&num='.$num.lang_url_a($_SESSION['lang']);

        $category_option_cardbenefit_mo .= '<li><a href="'.$category_href.'"';
        if ($sca == ""){
            $category_option_cardbenefit_mo .= ' ';
            $category_option_cardbenefit_mo .= ' class="img_first" ><div class="sub31_icon sub31_icon1"></div><p';
			if($_SESSION['lang'] == "en_US"){
				$category_option_cardbenefit_mo .= ' class="sub32_navi_us" ';
			}else if($_SESSION['lang'] == "ja_JP"){
				$category_option_cardbenefit_mo .= ' class="sub32_navi_jp" ';
			}
			$category_option_cardbenefit_mo .= '>'._t('전체').'</p></a></li>';
		}else{

            $category_option_cardbenefit_mo .= ' ';
            $category_option_cardbenefit_mo .= ' class="img_first" ><div class="sub31_icon sub31_icon1"></div><p';
			if($_SESSION['lang'] == "en_US"){
				$category_option_cardbenefit_mo .= ' class="sub32_navi_us" ';
			}else if($_SESSION['lang'] == "ja_JP"){
				$category_option_cardbenefit_mo .= ' class="sub32_navi_jp" ';
			}
			$category_option_cardbenefit_mo .= '>'._t('전체').'</p></a></li>';

		}
        $categories = explode('|', $board['bo_category_list']); // 구분자가 , 로 되어 있음
        for ($i=0; $i<count($categories); $i++) {
            $imgnum = $i+2;
            $category = trim($categories[$i]);
            if ($category=='') continue;
            $category_option_cardbenefit_mo .= '<li><a href="'.($category_href."&amp;sca=".urlencode($category)).'"';
            $category_msg = '';
            if ($category==$sca) { // 현재 선택된 카테고리라면
                $category_option_cardbenefit_mo .= ' class="s32_act"';
                // $category_msg = '<span class="sound_only">'._t('열린 분류').' </span>';
            }
                $category_option_cardbenefit_mo .= '><div class="sub31_icon sub31_icon'.$imgnum.'"></div><p';
				if($_SESSION['lang'] == "en_US"){
					$category_option_cardbenefit_mo .= ' class="sub32_navi_us" ';
				}else if($_SESSION['lang'] == "ja_JP"){
				$category_option_cardbenefit_mo .= ' class="sub32_navi_jp" ';
			}
				$category_option_cardbenefit_mo .= '>'.$category_msg._t(ck_category($category)).'</p></a></li>';
        }
    }
}


if($bo_table == "tourinfo"){
    $category_option_tourinfo = '';
    if ($board[bo_use_category] && preg_match('/^g4_/', $board['bo_skin'])) {
        $is_category = true;
        $category_location = "./board.php?bo_table=$bo_table&info=$info&me_code=$me_code&num=$num&sca=";
        $category_option_tourinfo = get_category_option($bo_table); // SELECT OPTION 태그로 넘겨받음
    } else if ($board['bo_use_category']) {
        $is_category = true;
        $category_href = G5_BBS_URL.'/board.php?bo_table='.$bo_table.'&info='.$info.'&me_code='.$me_code.'&num='.$num.lang_url_a($_SESSION['lang']);

        //$category_option_tourinfo .= '<li><a href="'.$category_href.'"';
        if ($sca=='')
            $category_option_tourinfo .= ' ';

        $categories = explode('|', $board['bo_category_list']); // 구분자가 , 로 되어 있음
        for ($i=0; $i<count($categories); $i++) {
            $imgnum = $i+2;
            $category = trim($categories[$i]);
            if ($category=='') continue;
            $category_option_tourinfo .= '<li><a  href="'.($category_href."&amp;sca=".urlencode($category)).'"';
            $category_msg = '';
            if ($category==$sca) { // 현재 선택된 카테고리라면
                $category_option_tourinfo .= ' class="tab_link active"';
                // $category_msg = '<span class="sound_only">'._t('열린 분류').' </span>';
            }
                $category_option_tourinfo .= '>'.$category_msg._t($category).'</a></li>';
        }
    }
}

if($info == "benefitarea"){
	if(!$_GET['word']){
		$word = "서울";
	}
}

$sop = strtolower($sop);
if ($sop != 'and' && $sop != 'or')
    $sop = 'and';

// 분류 선택 또는 검색어가 있다면
$stx = trim($stx);
if ($sca || $stx) {
    $sql_search = ktc_get_sql_search($sca, $sfl, $stx, $sop);

	if($info == "benefitarea"){
		$sql_search = ktc_get_sql_search_area($sca, $sfl, $stx, $sop, $word, $word1);
	}



    // 가장 작은 번호를 얻어서 변수에 저장 (하단의 페이징에서 사용)
    $sql = " select MIN(wr_num) as min_wr_num from {$write_table} ";
    $row = sql_fetch($sql);
    $min_spt = (int)$row['min_wr_num'];

    if (!$spt) $spt = $min_spt;



    if($bo_table == "cardbenefit" && $info != "benefitarea" ){
        $sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} WHERE {$sql_search} ";

        $sql = " SELECT COUNT(DISTINCT `wr_group`) AS `cnt` FROM {$write_table} WHERE {$sql_search} and wr_group != 0 ";
        $row = sql_fetch($sql);

        $sql = " SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} WHERE {$sql_search} and wr_group = 0 ";
        $srow = sql_fetch($sql);

        $total_count = $row['cnt'] + $srow['cnt'];

    }else if($bo_table == "prcenter"){
		if($_SESSION['lang']=="ko_KR"){
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table}  WHERE {$sql_search} and wr_1 = 'on' ");
		}else if($_SESSION['lang']=="en_US"){
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table}  WHERE {$sql_search} and wr_2 = 'on' ");
		}else if($_SESSION['lang']=="ja_JP"){
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table}  WHERE {$sql_search} and wr_3 = 'on' ");
		}else if($_SESSION['lang']=="zh_CN"){
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table}  WHERE {$sql_search} and wr_4 = 'on' ");
		}else if($_SESSION['lang']=="zh_TW"){
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table}  WHERE {$sql_search} and wr_5 = 'on' ");
		}else{
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table}  WHERE {$sql_search} and wr_1 = 'on' ");
		}

		$total_count = $sql_pr['cnt'];
	}else if($bo_table == "knotice"){
  if($_SESSION['lang']=="ko_KR"){
    $sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table}  WHERE {$sql_search} and wr_1 = 'on' and wr_6 = '' ");
  }else if($_SESSION['lang']=="en_US"){
    $sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table}  WHERE {$sql_search} and wr_2 = 'on' and wr_6 = '' ");
  }else if($_SESSION['lang']=="ja_JP"){
    $sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table}  WHERE {$sql_search} and wr_3 = 'on' and wr_6 = '' ");
  }else if($_SESSION['lang']=="zh_CN"){
    $sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table}  WHERE {$sql_search} and wr_4 = 'on' and wr_6 = '' ");
  }else if($_SESSION['lang']=="zh_TW"){
    $sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table}  WHERE {$sql_search} and wr_5 = 'on' and wr_6 = '' ");
  }else{
    $sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table}  WHERE {$sql_search} and wr_1 = 'on' and wr_6 = '' ");
  }

  $total_count = $sql_pr['cnt'];
}else if($info == "benefitarea"  ){

		if($_SESSION['lang']=="ko_KR"){
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where {$sql_search} and wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%' ");
		}else if($_SESSION['lang']=="en_US"){
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where {$sql_search} and wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%' ");
		}else if($_SESSION['lang']=="ja_JP"){
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where {$sql_search} and wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%' ");
		}else if($_SESSION['lang']=="zh_CN"){
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where {$sql_search} and wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%' ");
		}else if($_SESSION['lang']=="zh_TW"){
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where {$sql_search} and wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%' ");
		}else{
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where {$sql_search} and wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%' ");
		}

		$total_count = $sql_pr['cnt'];

	}else{
        $sql_search .= " and (wr_num between {$spt} and ({$spt} + {$config['cf_search_part']})) ";
        $row = sql_fetch($sql);
        $total_count = $row['cnt'];
    }


    // 원글만 얻는다. (코멘트의 내용도 검색하기 위함)
    // 라엘님 제안 코드로 대체 http://sir.kr/bbs/board.php?bo_table=g5_bug&wr_id=2922
    /*
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search} ";
    $result = sql_query($sql);
    $total_count = sql_num_rows($result);
    */
} else {

    if($bo_table == "cardbenefit" && $info != "benefitarea" ){
        $sql_beneift_cnt_val = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where wr_title_ko_KR != '' ");
        $total_count = $sql_beneift_cnt_val['cnt'];
    }else if($bo_table == "prcenter"){
		if($_SESSION['lang']=="ko_KR"){
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where wr_1 = 'on' ");
		}else if($_SESSION['lang']=="en_US"){
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where wr_2 = 'on' ");
		}else if($_SESSION['lang']=="ja_JP"){
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where wr_3 = 'on' ");
		}else if($_SESSION['lang']=="zh_CN"){
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where wr_4 = 'on' ");
		}else if($_SESSION['lang']=="zh_TW"){
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where wr_5 = 'on' ");
		}else{
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where wr_1 = 'on' ");
		}

		$total_count = $sql_pr['cnt'];
	}else if($bo_table == "knotice"){
  if($_SESSION['lang']=="ko_KR"){
    $sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where wr_1 = 'on' and wr_6 = '' ");
  }else if($_SESSION['lang']=="en_US"){
    $sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where wr_2 = 'on' and wr_6 = '' ");
  }else if($_SESSION['lang']=="ja_JP"){
    $sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where wr_3 = 'on' and wr_6 = '' ");
  }else if($_SESSION['lang']=="zh_CN"){
    $sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where wr_4 = 'on' and wr_6 = '' ");
  }else if($_SESSION['lang']=="zh_TW"){
    $sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where wr_5 = 'on' and wr_6 = '' ");
  }else{
    $sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where wr_1 = 'on' and wr_6 = '' ");
  }

  $total_count = $sql_pr['cnt'];
}else if($info == "benefitarea"  ){

		if($_SESSION['lang']=="ko_KR"){
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%' ");
		}else if($_SESSION['lang']=="en_US"){
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%'  ");
		}else if($_SESSION['lang']=="ja_JP"){
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%'  ");
		}else if($_SESSION['lang']=="zh_CN"){
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%'  ");
		}else if($_SESSION['lang']=="zh_TW"){
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%'  ");
		}else{
			$sql_pr = sql_fetch(" SELECT COUNT(DISTINCT `wr_parent`) AS `cnt` FROM {$write_table} where wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%'  ");
		}

		$total_count = $sql_pr['cnt'];



	}else{
        $total_count = $board['bo_count_write'];
    }
}



$m_sql_total = $total_count;
if(G5_IS_MOBILE) {
    $page_rows = $board['bo_mobile_page_rows'];
    $list_page_rows = $board['bo_mobile_page_rows'];

	if($info == "benefitarea"){
        $page_rows = 5;
        $list_page_rows = 5;
	}

  // if($info == "notice"){
  //     $result_board = sql_fetch(" select * from g5_board where bo_table = 'knotice' ");
  //     $notice_id = explode(',',$result_board['bo_notice']);
  //     $page_rows = $board['bo_page_rows'] - count($notice_id);
  //     $list_page_rows = $board['bo_page_rows'] - count($notice_id);
  // }

} else {
    if($info == "benefitshop"){
        $page_rows = 5;
        $list_page_rows = 5;
    }else if($info == "benefitarea"){
        $page_rows = 100;
        $list_page_rows = 100;
    }
    // else if($info == "notice"){
    //     $result_board = sql_fetch(" select * from g5_board where bo_table = 'knotice1' ");
    //     $notice_id = explode(',',$result_board['bo_notice']);
    //     $page_rows = $board['bo_page_rows'] - count($notice_id);
    //     $list_page_rows = $board['bo_page_rows'] - count($notice_id);
    // }
    else{
        $page_rows = $board['bo_page_rows'];
        $list_page_rows = $board['bo_page_rows'];
    }

}

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

// 년도 2자리
$today2 = G5_TIME_YMD;

$list = array();
$i = 0;
$notice_count = 0;
$notice_array = array();

// 공지 처리
if (!$sca && !$stx) {
    $arr_notice = explode(',', trim($board['bo_notice']));
    $from_notice_idx = ($page - 1) * $page_rows;
    if($from_notice_idx < 0)
        $from_notice_idx = 0;
    $board_notice_count = count($arr_notice);

    for ($k=0; $k<$board_notice_count; $k++) {
        if (trim($arr_notice[$k]) == '') continue;

        $row = sql_fetch(" select * from {$write_table} where wr_id = '{$arr_notice[$k]}' ");

        if (!$row['wr_id']) continue;

        $notice_array[] = $row['wr_id'];

        if($k < $from_notice_idx) continue;


        if($bo_table == "cardbenefit"){
            $list[$i] = get_list_ktc($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
        }else{
            $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
        }

        $list[$i]['is_notice'] = true;

        $i++;
        $notice_count++;

        if($notice_count >= $list_page_rows)
            break;
    }
}


if($info == "notice"){
    $notice_count = 0;
}


$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함

// 공지글이 있으면 변수에 반영
if(!empty($notice_array)) {
    if( !($info == "notice") ){
        $from_record -= count($notice_array);
    }

    if($from_record < 0)
        $from_record = 0;

    if($notice_count > 0)
        $page_rows -= $notice_count;

    if($page_rows < 0)
        $page_rows = $list_page_rows;
}

// 관리자라면 CheckBox 보임
$is_checkbox = false;
if ($is_member && ($is_admin == 'super' || $group['gr_admin'] == $member['mb_id'] || $board['bo_admin'] == $member['mb_id']))
    $is_checkbox = true;

// 정렬에 사용하는 QUERY_STRING
$qstr2 = 'bo_table='.$bo_table.'&amp;sop='.$sop;

// 0 으로 나눌시 오류를 방지하기 위하여 값이 없으면 1 로 설정
$bo_gallery_cols = $board['bo_gallery_cols'] ? $board['bo_gallery_cols'] : 1;
$td_width = (int)(100 / $bo_gallery_cols);

// 정렬
// 인덱스 필드가 아니면 정렬에 사용하지 않음
//if (!$sst || ($sst && !(strstr($sst, 'wr_id') || strstr($sst, "wr_datetime")))) {
if (!$sst) {
    if ($board['bo_sort_field']) {
        $sst = $board['bo_sort_field'];
    } else {
        $sst  = "wr_num, wr_reply";
        $sod = "";
    }
} else {
    // 게시물 리스트의 정렬 대상 필드가 아니라면 공백으로 (nasca 님 09.06.16)
    // 리스트에서 다른 필드로 정렬을 하려면 아래의 코드에 해당 필드를 추가하세요.
    // $sst = preg_match("/^(wr_subject|wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
    $sst = preg_match("/^(wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
}

if(!$sst)
    $sst  = "wr_num, wr_reply";

if ($sst) {
    $sql_order = " order by {$sst} {$sod} ";
}

if( $bo_table=='cardbenefit' ){
	$sql_order = " order by wr_order,  wr_title_".$_SESSION['lang'];
}

if( $info=='benefitarea' ){
	//$sql_order = " order by case WHEN ( wr_local1_ko_KR LIKE '%서울%' ) then 1  else wr_local1_ko_KR end ";
	$sql_order = " order by wr_local2_ko_KR asc ";
}




if ($sca || $stx) {

    if($bo_table=='cardbenefit' && $info != "benefitarea" ){
        $sql = " ( select * from (select * from {$write_table} where {$sql_search} and wr_group != 0 order by wr_title_ko_KR desc) a group by wr_group ) union";
        $sql .= " (select * from {$write_table} where {$sql_search} and wr_group = 0) ";
        $sql .= " {$sql_order} limit {$from_record}, $page_rows ";

    }else if($bo_table=='prcenter'){
		if($_SESSION['lang']=="ko_KR"){
			$sql = " select distinct wr_parent from {$write_table} where {$sql_search}   {$sql_order} limit {$from_record}, $page_rows ";
		}else if($_SESSION['lang']=="en_US"){
			$sql = " select distinct wr_parent from {$write_table} where {$sql_search}   {$sql_order} limit {$from_record}, $page_rows ";
		}else if($_SESSION['lang']=="ja_JP"){
			$sql = " select distinct wr_parent from {$write_table} where {$sql_search}   {$sql_order} limit {$from_record}, $page_rows ";
		}else if($_SESSION['lang']=="zh_CN"){
			$sql = " select distinct wr_parent from {$write_table} where {$sql_search}   {$sql_order} limit {$from_record}, $page_rows ";
		}else if($_SESSION['lang']=="zh_TW"){
			$sql = " select distinct wr_parent from {$write_table} where {$sql_search}   {$sql_order} limit {$from_record}, $page_rows ";
		}else{
			$sql = " select distinct wr_parent from {$write_table} where {$sql_search}   {$sql_order} limit {$from_record}, $page_rows ";
		}
	}else if($bo_table == "knotice"){
  if($_SESSION['lang']=="ko_KR"){
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search} and wr_6 = ''  {$sql_order} limit {$from_record}, $page_rows ";
  }else if($_SESSION['lang']=="en_US"){
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search} and wr_6 = ''  {$sql_order} limit {$from_record}, $page_rows ";
  }else if($_SESSION['lang']=="ja_JP"){
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search} and wr_6 = ''  {$sql_order} limit {$from_record}, $page_rows ";
  }else if($_SESSION['lang']=="zh_CN"){
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search} and wr_6 = ''  {$sql_order} limit {$from_record}, $page_rows ";
  }else if($_SESSION['lang']=="zh_TW"){
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search} and wr_6 = ''  {$sql_order} limit {$from_record}, $page_rows ";
  }else{
    $sql = " select distinct wr_parent from {$write_table} where {$sql_search} and wr_6 = ''  {$sql_order} limit {$from_record}, $page_rows ";
  }
}else if($info=='benefitarea'){
		if($_SESSION['lang']=="ko_KR"){
			$sql = " select distinct wr_parent from {$write_table} where {$sql_search} and wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%'  {$sql_order} limit {$from_record}, $page_rows ";
		}else if($_SESSION['lang']=="en_US"){
			$sql = " select distinct wr_parent from {$write_table} where {$sql_search} and wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%'  {$sql_order} limit {$from_record}, $page_rows ";
		}else if($_SESSION['lang']=="ja_JP"){
			$sql = " select distinct wr_parent from {$write_table} where {$sql_search} and wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%'  {$sql_order} limit {$from_record}, $page_rows ";
		}else if($_SESSION['lang']=="zh_CN"){
			$sql = " select distinct wr_parent from {$write_table} where {$sql_search} and wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%'  {$sql_order} limit {$from_record}, $page_rows ";
		}else if($_SESSION['lang']=="zh_TW"){
			$sql = " select distinct wr_parent from {$write_table} where {$sql_search} and wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%'  {$sql_order} limit {$from_record}, $page_rows ";
		}else{
			$sql = " select distinct wr_parent from {$write_table} where {$sql_search} and wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%'  {$sql_order} limit {$from_record}, $page_rows ";
		}
	}else{
        $sql = " select distinct wr_parent from {$write_table} where {$sql_search} {$sql_order} limit {$from_record}, $page_rows ";
    }
} else {


    $sql = " select * from {$write_table} where wr_is_comment = 0 ";

    if($bo_table=='prcenter'){
  		if($_SESSION['lang']=="ko_KR"){
  			$sql .= " and wr_1 = 'on' ";
  		}else if($_SESSION['lang']=="en_US"){
  			$sql .= " and wr_2 = 'on' ";
  		}else if($_SESSION['lang']=="ja_JP"){
  			$sql .= " and wr_3 = 'on' ";
  		}else if($_SESSION['lang']=="zh_CN"){
  			$sql .= " and wr_4 = 'on' ";
  		}else if($_SESSION['lang']=="zh_TW"){
  			$sql .= " and wr_5 = 'on' ";
  		}else{
  			$sql .= " and wr_1 = 'on' ";
  		}
    }

    if($bo_table == "knotice"){
  		if($_SESSION['lang']=="ko_KR"){
  			$sql .= " and wr_1 = 'on' and wr_6 = '' ";
  		}else if($_SESSION['lang']=="en_US"){
  			$sql .= " and wr_2 = 'on' and wr_6 = '' ";
  		}else if($_SESSION['lang']=="ja_JP"){
  			$sql .= " and wr_3 = 'on' and wr_6 = '' ";
  		}else if($_SESSION['lang']=="zh_CN"){
  			$sql .= " and wr_4 = 'on' and wr_6 = '' ";
  		}else if($_SESSION['lang']=="zh_TW"){
  			$sql .= " and wr_5 = 'on' and wr_6 = '' ";
  		}else{
  			$sql .= " and wr_1 = 'on' and wr_6 = '' ";
  		}
    }


    if($bo_table=='cardbenefit' && $info != "benefitarea" ){

        $sql .= " and wr_title_ko_KR != '' ";
    }else if($info=='benefitarea'){
		if($_SESSION['lang']=="ko_KR"){
			$sql .= "  and  wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%' ";
		}else if($_SESSION['lang']=="en_US"){
			$sql .= "  and  wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%' ";
		}else if($_SESSION['lang']=="ja_JP"){
			$sql .= "  and  wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%' ";
		}else if($_SESSION['lang']=="zh_CN"){
			$sql .= "  and  wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%' ";
		}else if($_SESSION['lang']=="zh_TW"){
			$sql .= "  and  wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%' ";
		}else{
			$sql .= " and  wr_local1_ko_KR like '%".$word."%' and wr_local2_ko_KR like '%".$word1."%' ";
		}
	}



    if(!empty($notice_array))
        $sql .= " and wr_id not in (".implode(', ', $notice_array).") ";
    $sql .= " {$sql_order} limit {$from_record}, $page_rows ";

}

if($_SERVER["REMOTE_ADDR"] == "210.96.212.116" )
{
	//echo $sql;
}
$m_sql = $sql;
// 페이지의 공지개수가 목록수 보다 작을 때만 실행
if($page_rows > 0) {
    $result = sql_query($sql);
    $k = 0;

    while ($row = sql_fetch_array($result))
    {
        // 검색일 경우 wr_id만 얻었으므로 다시 한행을 얻는다
        if ($sca || $stx)
            $row = sql_fetch(" select * from {$write_table} where wr_id = '{$row['wr_parent']}' ");

        if($bo_table == "cardbenefit"){
            $list[$i] = get_list_ktc($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
        }else{
            $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
        }

        if (strstr($sfl, 'subject')) {
            $list[$i]['subject'] = search_font($stx, $list[$i]['subject']);
        }
        $list[$i]['is_notice'] = false;
        $list_num = $total_count - ($page - 1) * $list_page_rows - $notice_count;
        $list[$i]['num'] = $list_num - $k;

        $i++;
        $k++;
    }
}

$write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './board.php?bo_table='.$bo_table.$qstr.'&amp;page=');

$list_href = '';
$prev_part_href = '';
$next_part_href = '';
if ($sca || $stx) {
    $list_href = './board.php?bo_table='.$bo_table;

    $patterns = array('#&amp;page=[0-9]*#', '#&amp;spt=[0-9\-]*#');

    //if ($prev_spt >= $min_spt)
    $prev_spt = $spt - $config['cf_search_part'];
    if (isset($min_spt) && $prev_spt >= $min_spt) {
        $qstr1 = preg_replace($patterns, '', $qstr);
        $prev_part_href = './board.php?bo_table='.$bo_table.$qstr1.'&amp;spt='.$prev_spt.'&amp;page=1';
        $write_pages = page_insertbefore($write_pages, '<a href="'.$prev_part_href.'" class="pg_page pg_prev">'._t('이전검색').'</a>');
    }

    $next_spt = $spt + $config['cf_search_part'];
    if ($next_spt < 0) {
        $qstr1 = preg_replace($patterns, '', $qstr);
        $next_part_href = './board.php?bo_table='.$bo_table.$qstr1.'&amp;spt='.$next_spt.'&amp;page=1';
        $write_pages = page_insertafter($write_pages, '<a href="'.$next_part_href.'" class="pg_page pg_end">'._t('다음검색').'</a>');
    }
}


$write_href = '';
if ($member['mb_level'] >= $board['bo_write_level']) {
    $write_href = './write.php?bo_table='.$bo_table;
}

$nobr_begin = $nobr_end = "";
if (preg_match("/gecko|firefox/i", $_SERVER['HTTP_USER_AGENT'])) {
    $nobr_begin = '<nobr>';
    $nobr_end   = '</nobr>';
}

// RSS 보기 사용에 체크가 되어 있어야 RSS 보기 가능 061106
$rss_href = '';
if ($board['bo_use_rss_view']) {
    $rss_href = './rss.php?bo_table='.$bo_table;
}

$stx = get_text(stripslashes($stx));
if($info == "benefit"){
    include_once($board_skin_path.'/list.skin_brand.php');
}else if($mapinfo){
    include_once($board_skin_path.'/list.skin_tab2.php');
}else if($info == "benefitarea"){
    include_once($board_skin_path.'/list.skin_area.php');
}else{
    include_once($board_skin_path.'/list.skin.php');
}
?>
