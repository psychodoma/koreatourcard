<?php // 굿빌더 ?>
<?php
/// 게시판 출력 형태의 전체 검색 스킨 good_bbs_list2 버젼 1.0 (검색 모듈)

include_once("./_common.php");

//if (!$stx) alert("검색어가 없습니다."); 

if($sfl == '') { ///***
    /// $sfl = "wr_good";
    $sfl = "wr_subject";
    $stx = "";
}
if (!$sop) $sop = "or";

$g5[title] = "검색 리스트: " . $stx;
include_once("./_head.php");

///*** if ($stx)
if ($stx !== '')
{
    //$stx = trim($stx);
    $stx = preg_replace("/\//", "\/", trim($stx));
    $sop = strtolower($sop);
    if (!$sop || !($sop == "and" || $sop == "or")) $sop = "and"; // 연산자 and , or
    if (!$srows) $srows = 10; // 한페이지에 출력하는 검색 행수

    unset($g5_search[tables]);
    unset($g5_search[read_level]);
    $sql = " select gr_id, bo_table, bo_read_level from $g5[board_table] where bo_use_search = '1' and bo_list_level <= '$member[mb_level]' ";
    //            and bo_read_level <= '$member[mb_level]' ";
    if ($gr_id)
        $sql .= " and gr_id = '$gr_id' ";
    if ($onetable) // 하나의 게시판만 검색한다면
        $sql .= " and bo_table = '$onetable' ";
    $sql .= " order by bo_order_search, gr_id, bo_table ";
    $result = sql_query($sql);
    for ($i=0; $row=sql_fetch_array($result); $i++) 
    {
        if ($is_admin != "super") 
        {
            // 그룹접근 사용에 대한 검색 차단
            $sql2 = " select gr_use_access, gr_admin from $g5[group_table] where gr_id = '$row[gr_id]' ";
            $row2 = sql_fetch($sql2);
            // 그룹접근을 사용한다면
            if ($row2[gr_use_access])
            {
                // 그룹관리자가 있으며 현재 회원이 그룹관리자라면 통과
                if ($row2[gr_admin] && $row2[gr_admin] == $member[mb_id])
                    ;
                else 
                {
                    $sql3 = " select count(*) as cnt from $g5[group_member_table] where gr_id = '$row[gr_id]' and mb_id = '$member[mb_id]' and mb_id <> '' ";
                    $row3 = sql_fetch($sql3);
                    if (!$row3[cnt])
                        continue;
                }
            }
        }
        $g5_search[tables][] = $row[bo_table];
        $g5_search[read_level][] = $row[bo_read_level];
    }

    $search_query = "sfl=".urlencode($sfl)."&stx=".urlencode($stx)."&sop=$sop";

    $text_stx = get_text(stripslashes($stx));

    $op1 = "";

    // 검색어를 구분자로 나눈다. 여기서는 공백
    $s = explode(" ", $stx);

    // 검색필드를 구분자로 나눈다. 여기서는 +
    $field = explode("||", trim($sfl));

    $str = "(";
    for ($i=0; $i<count($s); $i++) 
    {
        //$search_str = strtolower($s[$i]);
        $search_str = $s[$i];
        $str .= $op1;
        $str .= "(";
        
        $op2 = "";
        for ($k=0; $k<count($field); $k++) // 필드의 수만큼 다중 필드 검색 가능 (필드1+필드2...)
        {
            $str .= $op2;
            switch ($field[$k]) 
            {
                case "wr_good" :
                    $str .= "$field[$k] >= '$s[$i]'";
                    break;
                case "mb_id" :
                case "mb_name" :
                    $str .= "$field[$k] = '$s[$i]'";
                    break;
                default :
                    if (preg_match("/[a-zA-Z]/", $search_str))
                        $str .= "INSTR(LOWER($field[$k]), LOWER('$search_str'))";
                    else
                        $str .= "INSTR($field[$k], '$search_str')";
                    break;
            }
            $op2 = " or ";
        }
        $str .= ")";

        $op1 = " $sop ";

        /// <!--- 2010.03.02 굿빌더 (s) --->
        /// 인기검색어
        /// $sql = " insert into $g5[popular_table] set pp_word = '$search_str', pp_date = '$g5[time_ymd]', pp_ip = '$_SERVER[REMOTE_ADDR]' ";
        /// sql_query($sql, FALSE);
    }

    /// <!--- 2010.03.02 굿빌더 (s) --->
    /// 인기검색어
    $sql = " insert into $g5[popular_table] set pp_word = '$stx', pp_date = '$g5[time_ymd]', pp_ip = '$_SERVER[REMOTE_ADDR]' "; /// Moved here
    if($sfl != 'wr_good') ///***
       sql_query($sql, FALSE); /// Moved here

    $str .= ")";

    $sql_search = $str . " and wr_option not like '%secret%' "; // 비밀글은 제외
    //$sql_search = $str;
    $sql_search .= " and ca_name like '%$sca%' "; /// 카테고리 검색 지원

    if (!$sst) {
        $sst  = "wr_datetime";
        $sod = "desc";
    } else {
        $sst = preg_match("/^(wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
    }

    if ($sst)
        $sql_order = " order by $sst $sod ";

    $str_board_list = "";
    $board_count = 0;

    $time1 = get_microtime();

    $tmp_all = "g4_temp_all"; ///

    $cque = " CREATE TEMPORARY TABLE `$tmp_all` (
    `bo_table` varchar(60) NOT NULL,
    `wr_id` int(11) NOT NULL,
    `wr_parent` int(11) NOT NULL default '0',
    `wr_is_comment` tinyint(4) NOT NULL default '0',
    `wr_comment` int(11) NOT NULL default '0',
    `ca_name` varchar(255) NOT NULL default '',
    `wr_option` set('html1','html2','secret','mail') NOT NULL default '',
    `wr_subject` varchar(255) NOT NULL default '',
    `wr_content` text NOT NULL,
    `wr_hit` int(11) NOT NULL default '0',
    `wr_good` int(11) NOT NULL default '0',
    `wr_nogood` int(11) NOT NULL default '0',
    `mb_id` varchar(255) NOT NULL default '',
    `wr_name` varchar(255) NOT NULL default '',
    `wr_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
    PRIMARY KEY  (`bo_table`, `wr_id`)
    ) ENGINE=MyISAM ";

    $cres = sql_query($cque) or exit("create error");

    $total_count = 0;
    for ($i=0; $i<count($g5_search[tables]); $i++) 
    {
        $tmp_write_table = $g5[write_prefix] . $g5_search[tables][$i];

	$ique = " INSERT INTO $tmp_all (bo_table, wr_id, wr_parent, wr_is_comment, wr_comment, ca_name, wr_option, wr_subject, wr_content, wr_hit, wr_good, wr_nogood, mb_id, wr_name, wr_datetime) select '{$g5_search[tables][$i]}', wr_id, wr_parent, wr_is_comment, wr_comment, ca_name, wr_option, wr_subject, wr_content, wr_hit, wr_good, wr_nogood, mb_id, wr_name, wr_datetime from $tmp_write_table ";

        /// if($sfl == 'wr_good') $ique .= " where wr_is_comment = 0 ";

	/// echo $ique."<br>";
	$ires = sql_query($ique) or exit("insert error");

	/// $sque = " SELECT * FROM $tmp_all ";
	/// $sres = sql_query($sque);
	/// echo "rows=".sql_num_rows($sres)."<br>";
    }

    $bo_subject = array();
    $list = array();

    ///
    $que = " select count(*) as cnt from $tmp_all where $sql_search  ";
    $arr = sql_fetch($que);
    $total_count = $arr[cnt];

    $rows = $srows;
    $total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
    if ($page == "") { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)
    $from_record = ($page - 1) * $rows; // 시작 열을 구함

    $search_table[] = $tmp_all; ///***
    $table_index = 0; ///***
    $k=0;
    $idx = 0;

    $sql = " select * from $tmp_all where $sql_search $sql_order limit $from_record, $rows ";
    /// echo $sql."<br>";
    $result = sql_query($sql);
    /// echo sql_num_rows($result)."<br>";

    for ($i=0; $row=sql_fetch_array($result); $i++) 
    {
        // 검색어까지 링크되면 게시판 부하가 일어남
        $list[$idx][$i] = $row;
        /// <!--- 2010.03.02 굿빌더 (s) --->
        /// $list[$idx][$i][href] = "./board.php?bo_table=$search_table[$idx]&wr_id=$row[wr_parent]";
        /// include search query. New!!!
        $list[$idx][$i][href] = "./board.php?bo_table=$row[bo_table]&wr_id=$row[wr_parent]&$search_query";

        if ($row[wr_is_comment]) 
        { 
            $tmp_write_table = $g5[write_prefix] . $row[bo_table]; ///
            $link .= "#c{$row[wr_id]}";
            $sql2 = " select wr_subject, wr_option from $tmp_write_table where wr_id = '$row[wr_parent]' ";
            $row2 = sql_fetch($sql2);
            //$row[wr_subject] = $row2[wr_subject];
            $row[wr_subject] = get_text($row2[wr_subject]);
        }

        // 비밀글은 검색 불가
        if (strstr($row[wr_option].$row2[wr_option], "secret")) 
            $row[wr_content] = "[비밀글 입니다.]";

        $subject = get_text($row[wr_subject]);
        if (strstr($sfl, "wr_subject")) 
            /// <!--- 2010.03.02 굿빌더 (s) --->
            /// $subject = search_font($stx, $subject);
            $subject = search_font($stx, strip_tags($subject)); /// New

        if ($read_level[$idx] <= $member[mb_level])
        {
            /// <!--- 2010.03.02 굿빌더 (s) --->
            /// $content = cut_str(get_text($row[wr_content]),$content_len,"…");
            $content = cut_str(get_text(strip_tags($row[wr_content])),$content_len,"…"); /// New
            if (strstr($sfl, "wr_content")) 
                $content = search_font($stx, $content);
        }
        else
            $content = '';

        $list[$idx][$i][subject] = $subject;
        $list[$idx][$i][content] = $content;
        $list[$idx][$i][name] = get_sideview($row[mb_id], cut_str($row[wr_name], $config[cf_cut_name]), $row[wr_email], $row[wr_homepage]);
            
        $k++;
        if ($k >= $rows) 
            break; 
    }
    sql_free_result($result);
    ///

    $search_query2 = $search_query."&sst=$sst&sod=$sod";

    /// $write_pages = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$search_query&gr_id=$gr_id&srows=$srows&onetable=$onetable&page=");
    $write_pages = get_paging($config[cf_write_pages], $page, $total_page, "$_SERVER[PHP_SELF]?$search_query2&gr_id=$gr_id&srows=$srows&onetable=$onetable&sca=$sca&page=");

    ///echo "<script language=\"javascript\" src=\"$g5[url]/js/sideview.js\"></script>";
}

$group_select = "<select id='gr_id' name='gr_id' class=select><option value=''>전체 분류";
$sql = " select gr_id, gr_subject from $g5[group_table] order by gr_id ";
$result = sql_query($sql);
for ($i=0; $row=sql_fetch_array($result); $i++)
    $group_select .= "<option value='$row[gr_id]'>$row[gr_subject]";
$group_select .= "</select>";

///if (!$sfl) $sfl = "wr_subject";
//////*** if (!$sfl) $sfl = "wr_good";
///if (!$sop) $sop = "or";

include_once("$search_skin_th/search_list.skin.php");

include_once("./_tail.php");
?>
